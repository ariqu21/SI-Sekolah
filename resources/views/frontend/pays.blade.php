@extends('frontend.layout')

@section('styles')

<link
href="{{ asset('css/landing.css') }}"
rel="stylesheet">

@endsection

@section('content')

<section class="ppdb-header">

<div class="container text-center">

<span class="ppdb-badge">

PPDB ONLINE

</span>

<h1>

Pendaftaran Siswa Baru

</h1>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0">

                <div class="card-header bg-success text-white">

                    <h4 class="mb-0">
                        Pembayaran PPDB
                    </h4>

                </div>

                <div class="card-body">

    <table class="table table-bordered">

        <tr>
            <th width="220">
                No Pendaftaran
            </th>
            <td>
                {{ $registrasi->no_pendaftaran }}
            </td>
        </tr>

        <tr>
            <th>
                Nama Siswa
            </th>
            <td>
                {{ $registrasi->nama_lengkap }}
            </td>
        </tr>

    </table>

    <h5 class="mt-4 mb-3">
        Rincian Tagihan
    </h5>

    <div class="table-responsive">

        <table class="table table-striped align-middle">

            <thead>

                <tr>

                    <th>
                        Jenis Pembayaran
                    </th>

                    <th class="text-end">
                        Nominal
                    </th>

                    <th class="text-center">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

            @foreach($payments as $item)

                <tr>

                    <td>
                        {{ $item->paymentType->nama }}
                    </td>

                    <td class="text-end">

                        Rp {{ number_format(
                            $item->nominal,
                            0,
                            ',',
                            '.'
                        ) }}

                    </td>

                    <td class="text-center">

                        @if($item->status == 'Lunas')

                            <span class="badge bg-success">

                                Lunas

                            </span>

                        @else

                            <span class="badge bg-warning text-dark">

                                Belum Bayar

                            </span>

                        @endif

                    </td>

                </tr>

            @endforeach

            </tbody>

            <tfoot>

                <tr class="table-success">

                    <th>
                        Total
                    </th>

                    <th class="text-end">

                        Rp {{ number_format(
                            $total,
                            0,
                            ',',
                            '.'
                        ) }}

                    </th>

                    <th></th>

                </tr>

            </tfoot>

        </table>

    </div>

    @if(
        $payments->where('status','!=','Lunas')->count()
    )

        <div class="text-center mt-4">

            <button
                id="pay-button"
                class="btn btn-success btn-lg px-5">

                Bayar 

            </button>

        </div>

    @else

        <div class="alert alert-success">

            Semua pembayaran telah lunas.

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger mt-3">

            {{ session('error') }}

        </div>

    @endif

</div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const payButton =
    document.getElementById('pay-button');

    if(payButton){

        payButton.addEventListener('click', function () {

            snap.pay('{{ $snapToken }}', {

                onSuccess: function(result){

                    alert('Pembayaran berhasil');

                    window.location.href = "/";

                },

                onPending: function(result){

                    alert('Menunggu pembayaran');

                },

                onError: function(result){

                    alert('Pembayaran gagal');

                    console.log(result);

                },

                onClose: function(){

                    alert('Popup pembayaran ditutup');

                }

            });

        });

    }

});

</script>

@endsection