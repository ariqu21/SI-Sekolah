@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-success text-white">

            <h4 class="mb-0">

                Detail Pembayaran Siswa

            </h4>

        </div>

        <div class="card-body">

            <div class="row mb-4">

                <div class="col-md-6">

                    <strong>No Registrasi</strong><br>

                    {{ $registrasi->no_pendaftaran }}

                </div>

                <div class="col-md-6">

                    <strong>Nama Siswa</strong><br>

                    {{ $registrasi->nama_lengkap }}

                </div>

            </div>

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>Jenis Pembayaran</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Tanggal</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($payments as $payment)

                    <tr>

                        <td>

                            {{ $payment->paymentType->nama }}

                        </td>

                        <td>

                            Rp {{ number_format($payment->nominal,0,',','.') }}

                        </td>

                        <td>

                            @if($payment->status == 'Lunas')

                                <span class="badge bg-success">

                                    Lunas

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Belum Bayar

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $payment->tanggal_bayar }}

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection