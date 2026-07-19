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
            Data Siswa
        </h3>

    </div>

    <div class="card-body">

        <table class="table">

            <tr>
                <th width="220">No Pendaftaran</th>
                <td>{{ $registrasi->no_pendaftaran }}</td>
            </tr>

            <tr>
                <th>Nama Siswa</th>
                <td>{{ $registrasi->nama_lengkap }}</td>
            </tr>

            <tr>
                <th>Nama Orang Tua</th>
                <td>{{ $registrasi->nama_orangtua }}</td>
            </tr>

            <tr>
                <th>Status Pendaftaran</th>
                <td>

                    @if($registrasi->status=='Diterima')

                        <span class="badge bg-success">
                            Diterima
                        </span>

                    @elseif($registrasi->status=='Ditolak')

                        <span class="badge bg-danger">
                            Ditolak
                        </span>

                    @else

                        <span class="badge bg-warning">
                            Menunggu
                        </span>

                    @endif

                </td>
            </tr>

        </table>

    </div>

</div>

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