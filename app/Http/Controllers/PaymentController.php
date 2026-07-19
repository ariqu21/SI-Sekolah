<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use App\Models\Registrasi;
use App\Models\PaymentType;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Midtrans\Notification;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments =
        Payment::with([
            'registrasi',
            'paymentType'
        ])
        ->latest()
        ->get();

        return view(
            'admin.payments.index',
            compact('payments')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $registrasis =
        Registrasi::orderBy(
            'nama_lengkap'
        )->get();

        $types =
        PaymentType::all();

        return view(
            'admin.payments.create',
            compact(
                'registrasis',
                'types'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =
        $request->validate([

            'registrasi_id'=>'required',

            'payment_type_id'=>'required',

            'nominal'=>'required',

            'tanggal_bayar'=>'nullable|date',

            'status'=>'required',

            'metode'=>'nullable',

            'keterangan'=>'nullable'

        ]);

        Payment::create($data);

        return redirect()
        ->route('payments.index')
        ->with(
            'success',
            'Pembayaran berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $registrasis =
        Registrasi::all();

        $types =
        PaymentType::all();

        return view(
            'admin.payments.edit',
            compact(
                'payment',
                'registrasis',
                'types'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([

            'payment_type_id' => 'required',
            'status' => 'required',
            'keterangan' => 'nullable'

        ]);

        $type = PaymentType::findOrFail(
            $request->payment_type_id
            );

            $data = [

                'payment_type_id' =>
                $request->payment_type_id,

                'nominal' =>
                $type->nominal,

                'status' =>
                $request->status,

                'keterangan' =>
                $request->keterangan

            ];

            if(
                $request->status == 'Lunas'
                &&
                !$payment->tanggal_bayar
            ){
                $data['tanggal_bayar'] = Carbon::now();
            }

            $payment->update($data);

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Pembayaran berhasil diperbarui'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return back();
    }

    public function studentPayments(
    Registrasi $registrasi
    )
    {
        $payments =
        $registrasi
        ->payments()
        ->with('paymentType')
        ->get();

        return view(
            'admin.payments.student',
            compact(
                'registrasi',
                'payments'
            )
        );
    }

    public function pay(Payment $payment)
    {
        $registrasi = $payment->registrasi;

        $payments = Payment::where(
            'registrasi_id',
            $registrasi->id
        )
        ->where('status','!=','Lunas')
        ->get();

        $total = $payments->sum('nominal');

        if($total <= 0){
            return back()->with(
                'error',
                'Tidak ada tagihan yang dapat dibayar'
            );
        }

        Config::$serverKey =
        config('midtrans.server_key');

        Config::$isProduction =
        config('midtrans.is_production');

        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId =
        'REG-'.$registrasi->id.'-'.time();

        PaymentTransaction::updateOrCreate(

            [
                'order_id'=>$orderId
            ],

            [

                'registrasi_id'=>$registrasi->id,

                'total'=>$total

            ]

        );

        $params = [

            'transaction_details' => [

                'order_id' => $orderId,
                'gross_amount' => $total

            ],
            'customer_details' => [

                'first_name' =>
                $registrasi->nama_lengkap

            ]
        ];
        try{
            $snapToken =
            Snap::getSnapToken(
                $params
            );
        }catch(\Exception $e){
            dd([
                'error' => $e->getMessage(),
                'params' => $params
            ]);
        }

        foreach($payments as $item){
            $item->update([

                'order_id' => $orderId,
                'snap_token' => $snapToken

            ]);
        }

        return view(
            'frontend.pays',
            compact(
                'registrasi',
                'payments',
                'total',
                'snapToken'
            )
        );
    }

    public function callback(Request $request)
    {
        Log::info('MIDTRANS CALLBACK MASUK');
        Log::info($request->all());

        Config::$serverKey =
        config('midtrans.server_key');

        Config::$isProduction =
        config('midtrans.is_production');

        $notif = new \Midtrans\Notification();

        $payments = Payment::where(
            'order_id',
            $notif->order_id
        )->get();

        if($payments->isEmpty()){

            Log::warning(
                'Payment tidak ditemukan',
                [
                    'order_id' =>
                    $notif->order_id
                ]
            );

            return response()->json([
                'message' => 'Payment not found'
            ],404);

        }

        if(
            in_array(
                $notif->transaction_status,
                ['capture','settlement']
            )
        ){
            foreach($payments as $payment){
                $payment->update([

                    'status' => 'Lunas',
                    'transaction_id' =>
                    $notif->transaction_id,
                    'tanggal_bayar' => now()

                ]);
            }
        }
        elseif(
            $notif->transaction_status == 'pending'
        ){
            foreach($payments as $payment){

                $payment->update([
                    'status' => 'Pending'
                ]);
            }
        }
        elseif(
            in_array(
                $notif->transaction_status,
                ['deny','cancel','expire']
            )
        ){
            foreach($payments as $payment){

                $payment->update([
                    'status' => 'Gagal'
                ]);
            }
        }

        return response()->json([
            'success' => true            
        ]);
    }

    public function checkPayment(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required'
        ]);

        $registrasi = Registrasi::where(
            'no_pendaftaran',
            $request->no_pendaftaran
        )
        ->with([
            'payments.paymentType'
        ])
        ->first();
        return view(
            'frontend.payment-check',
            compact('registrasi')
        );
    }
}
