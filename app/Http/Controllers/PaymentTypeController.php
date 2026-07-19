<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types =
        PaymentType::latest()
        ->get();

        return view(
            'admin.payment-types.index',
            compact('types')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
        'admin.payment-types.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =
        $request->validate([

            'nama'=>'required',

            'nominal'=>'required|numeric',

            'deskripsi'=>'nullable'

        ]);

        PaymentType::create($data);

        return redirect()
        ->route('payment-types.index')
        ->with(
            'success',
            'Jenis pembayaran berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentType $paymentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentType $paymentType)
    {
        return view(
        'admin.payment-types.edit',
        compact('payment_type')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentType $paymentType)
    {
        $data =
        $request->validate([

            'nama'=>'required',

            'nominal'=>'required|numeric',

            'deskripsi'=>'nullable'

        ]);

        $paymentType->update($data);

        return redirect()
        ->route('payment-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentType $paymentType)
    {
        $paymentType->delete();

        return back();
    }
}
