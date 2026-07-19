@extends('frontend.layout')

@section('styles')

<link href="{{ asset('css/landing.css') }}" rel="stylesheet">

@endsection

@section('content')

<section class="ppdb-header">

<div class="container">

    <div class="text-center mb-5">

        <span class="ppdb-badge">
            PPDB ONLINE
        </span>

        <h2 class="mt-3">
            Upload Bukti Pembayaran
        </h2>

        <p class="text-muted">
            Upload bukti pembayaran untuk seluruh tagihan PPDB.
        </p>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0">

                <div class="card-header bg-success text-white">

                    <h4 class="mb-0">

                        Ringkasan Pembayaran

                    </h4>

                </div>

                <div class="card-body">

                    <table class="table">

                        <tr>

                            <th width="220">
                                Nama Siswa
                            </th>

                            <td>
                                {{ $registrasi->nama_lengkap }}
                            </td>

                        </tr>

                        <tr>

                            <th>
                                No Pendaftaran
                            </th>

                            <td>
                                {{ $registrasi->no_pendaftaran }}
                            </td>

                        </tr>

                        <tr>

                            <th>
                                Total Tagihan
                            </th>

                            <td class="fw-bold text-success">

                                Rp {{ number_format($payments->sum('nominal'),0,',','.') }}

                            </td>

                        </tr>

                        <tr>

                            <th>
                                Status Verifikasi
                            </th>

                            <td>

                                @if($transaction->verification_status == 'Belum Upload')

                                    <span class="badge bg-secondary">

                                        Belum Upload

                                    </span>

                                @elseif($transaction->verification_status == 'Menunggu')

                                    <span class="badge bg-warning">

                                        Menunggu Verifikasi

                                    </span>

                                @elseif($transaction->verification_status == 'Terverifikasi')

                                    <span class="badge bg-success">

                                        Terverifikasi

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Ditolak

                                    </span>

                                @endif

                            </td>

                        </tr>

                    </table>

                    <hr>

                    @if($transaction->payment_proof)

                        <div class="text-center">

                            <p class="mb-3">

                                Bukti pembayaran telah diupload.

                            </p>

                            <a
                                href="{{ asset('storage/'.$transaction->payment_proof) }}"
                                target="_blank"
                                class="btn btn-outline-success">

                                Lihat Bukti Pembayaran

                            </a>

                        </div>

                    @else

                        <form
                            action="{{ route('wali.payment.proof.store') }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">

                                    Upload Screenshot Bukti Pembayaran

                                </label>

                                <input
                                    type="file"
                                    name="payment_proof"
                                    class="form-control"
                                    accept="image/*"
                                    required>

                            </div>

                            <button
                                class="btn btn-success w-100">

                                Upload Bukti Pembayaran

                            </button>

                        </form>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

</section>

@endsection