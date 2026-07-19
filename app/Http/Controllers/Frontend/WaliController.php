<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentTransaction;

class WaliController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('wali.login');
        }

        $registrasi = $user->registrasi;

        return view(
            'frontend.wali.home',
            compact(
                'user',
                'registrasi'
            )
        );
    }

    public function payment()
    {
        $user = Auth::user();

        $registrasi = $user->registrasi;

        if (!$registrasi) {

            return redirect()
                ->route('wali.home')
                ->with(
                    'error',
                    'Silakan lakukan pendaftaran terlebih dahulu.'
                );

        }

        $payments = $registrasi
            ->payments()
            ->with('paymentType')
            ->get();

        $total = $payments->sum('nominal');

        return view(
            'frontend.wali.payment',
            compact(
                'registrasi',
                'payments',
                'total'
            )
        );
    }

    public function paymentProof()
    {
        $registrasi = Auth::user()->registrasi;

        $payments = $registrasi->payments;

        $transaction = PaymentTransaction::firstOrCreate(

        [
            'registrasi_id' => $registrasi->id
        ],

        [
            'total' => $payments->sum('nominal'),
            'verification_status' => 'Belum Upload'
        ]

    );
        return view(
            'frontend.wali.payment-proof',
            compact(
                'registrasi',
                'payments',
                'transaction'
            )
        );
    }

    public function storePaymentProof(Request $request)
    {
        $request->validate([

            'payment_proof'=>'required|image|max:4096'

        ]);

        $registrasi = Auth::user()->registrasi;

        $transaction = PaymentTransaction::where(

            'registrasi_id',

            $registrasi->id

        )->latest()->first();

        $file = $request

            ->file('payment_proof')

            ->store(

                'payment-proof',

                'public'

            );

        $transaction->update([

            'payment_proof'=>$file,

            'verification_status'=>'Menunggu'

        ]);

        return back()->with(

            'success',

            'Bukti berhasil diupload.'

        );
    }
}