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

<section class="py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow border-0">

                    <div class="card-header bg-success text-white">

                        <h3 class="mb-0">
                            Cek Pembayaran Siswa
                        </h3>

                    </div>

                    <div class="card-body">

                        <form action="{{ route('payment.check.search') }}"
                              method="POST">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">

                                    Nomor Pendaftaran

                                </label>

                                <input
                                    type="text"
                                    name="no_pendaftaran"
                                    class="form-control"
                                    placeholder="Contoh: RA-2026-0001">

                            </div>

                            <button
                                type="submit"
                                class="btn btn-success">

                                Cari Data

                            </button>

                        </form>

                    </div>

                </div>

                @isset($registrasi)

                <div class="card shadow border-0 mt-4">

                    <div class="card-body">

                        <h4>Data Siswa</h4>

                        <hr>

                        <table class="table">

                            <tr>
                                <th width="200">
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

                            <tr>
                                <th>
                                    Status
                                </th>
                                <td>
                                    {{ $registrasi->status }}
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

                @endisset

            </div>

            @if(isset($registrasi))

<div class="card payment-card shadow-lg border-0 mt-4">

    <div class="card-header payment-header">

        <div>
            <h4 class="mb-1">
                Data Pembayaran
            </h4>

            <small>
                Riwayat tagihan dan pembayaran siswa
            </small>
        </div>

    </div>

    <div class="card-body">

        @if($registrasi->payments->count())

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>
                            <th>Jenis Pembayaran</th>
                            <th>Nominal</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                    @foreach($registrasi->payments as $payment)

                        <tr>

                            <td>

                                <div class="fw-bold">
                                    {{ $payment->paymentType->nama }}
                                </div>

                            </td>

                            <td>

                                <span class="fw-bold text-success">
                                    Rp {{ number_format($payment->nominal,0,',','.') }}
                                </span>

                            </td>

                            <td>

                                @if($payment->status == 'Lunas')

                                    <span class="badge status-success">
                                        ✔ Lunas
                                    </span>

                                @else

                                    <span class="badge status-pending">
                                        ⏳ Belum Bayar
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

                <div class="card mt-4 border-success">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <h4 class="fw-bold">Total</h4>

                        <h4 class="text-success">

                            Rp {{ number_format(
                                $registrasi->payments->sum('nominal'),
                                0,
                                ',',
                                '.'
                            ) }}

                        </h4>

                    </div>

                </div>

            </div>

            @if(
    $registrasi->payments
    ->where('status','!=','Lunas')
    ->count()
)

<div class="text-center mt-4">

    <a
        href="{{ route(
            'payments.pay',
            $registrasi->payments->first()->id
        ) }}"
        class="btn btn-success btn-lg">

        Bayar
        (Rp {{ number_format(
            $registrasi->payments
            ->where('status','!=','Lunas')
            ->sum('nominal'),
            0,
            ',',
            '.'
        ) }})

    </a>

</div>

@endif

            </div>

        @else

            <div class="empty-payment">

                <div class="empty-icon">

                    💳

                </div>

                <h5>
                    Belum Ada Tagihan
                </h5>

                <p>
                    Data pembayaran siswa belum tersedia.
                </p>

            </div>

        @endif

    </div>

</div>

@endif

        </div>

    </div>

</section>

@endsection