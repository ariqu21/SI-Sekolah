<?php

namespace App\Http\Controllers;

use App\Models\Registrasi;
use Illuminate\Http\Request;
use App\Exports\RegistrasiExport;
use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrasi=Registrasi::latest()->paginate(10);
        return view('admin.registrasi.index', compact('registrasi')
        );

    }

    public function frontend()
    {
        return view('frontend.registrasi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.registrasi.create');
    }

    public function storeFrontend(Request $request)
    {
        $data = $request->validate([

            'nama_lengkap'=>'required',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'alamat'=>'required',
            'nama_orangtua'=>'required',
            'telepon'=>'required',
            'jkelamin'=>'required'

        ]);

        $last = Registrasi::latest()->first();

        $number = $last
            ? ((int) substr($last->no_pendaftaran, -4)) + 1
            : 1;

        $data['no_pendaftaran'] =
            'RA-' .
            date('Y') .
            '-' .
            str_pad($number, 4, '0', STR_PAD_LEFT);


        $registrasi =
        Registrasi::create($data);

        if (Auth::check()) {

            $user = Auth::user();

            $user->registrasi_id = $registrasi->id;

            $user->save();
        }


        $message = urlencode(
        "Assalamualaikum Admin
        Saya telah melakukan pendaftaran.
        No Pendaftaran : ".$registrasi->no_pendaftaran."
        Nama Anak : ".$registrasi->nama_lengkap."
        Mohon verifikasi data saya.
        Terima kasih."
        );

            return redirect()->route('registrasi')->with(
                'wa',
                "https://wa.me/62895618207612?text=".$message
            )->with('success',true
        );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'nama_lengkap'=>'required',
        'tempat_lahir'=>'required',
        'tanggal_lahir'=>'required',
        'alamat'=>'required',
        'nama_orangtua'=>'required',
        'telepon'=>'required',
        'jkelamin'=>'required'
        ]);

        $last = Registrasi::latest()->first();

        $number = $last
            ? ((int) substr($last->no_pendaftaran, -4)) + 1
            : 1;

        $data['no_pendaftaran'] =
            'RA-' .
            date('Y') .
            '-' .
            str_pad($number, 4, '0', STR_PAD_LEFT);

        Registrasi::create($data);

        return redirect()
        ->route('registrasi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Registrasi $registrasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registrasi $registrasi)
    {
        return view('admin.registrasi.edit', compact('registrasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registrasi $registrasi)
    {
        $data = $request->validate([
        'nama_lengkap'=>'required',
        'tempat_lahir'=>'required',
        'tanggal_lahir'=>'required',
        'alamat'=>'required',
        'nama_orangtua'=>'required',
        'telepon'=>'required',
        'jkelamin'=>'required',
        'status'=>'required'
        ]);

        $registrasi->update($data);

        return redirect()
        ->route('registrasi.index');
    }

    public function updateStatus(
        Request $request,
        Registrasi $registrasi
    )
    {
        $request->validate([
            'status' => 'required'
        ]);

        $registrasi->update([
            'status' => $request->status
        ]);

        if(
            $request->status == 'Diterima'
            &&
            $registrasi->status != 'Diterima'
        ){
            $this->generatePayment(
                $registrasi
            );
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registrasi $registrasi)
    {
        $registrasi->delete();
        return back();
    }

    public function export()
    {
        return Excel::download(
            new RegistrasiExport,
            'registrasi.xlsx'
        );
    }

    private function generatePayment(Registrasi $registrasi)
    {
        $types =
        PaymentType::all();

        foreach($types as $type){

            Payment::firstOrCreate(

            [

                'registrasi_id' =>
                $registrasi->id,

                'payment_type_id' =>
                $type->id

            ],

            [

                'nominal' =>
                $type->nominal,

                'tanggal_bayar' =>
                now(),

                'status' =>
                'Belum Bayar'

            ]

        );}

    }
}
