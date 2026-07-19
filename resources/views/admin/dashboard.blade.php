@extends('layouts.admin')

@section('title','Dashboard')

@section('header','Dashboard')

@section('content')


<div class="row g-4">

<div class="col-md-3">

<div class="stat-card">

<div>

<p>Total Pendaftar</p>

<h2>

{{$total}}

</h2>

</div>

<i class="bi bi-people-fill fs-1"></i>

</div>

</div>


<div class="col-md-3">

<div class="stat-card">

<div>

<p>Menunggu</p>

<h2>

{{$menunggu}}

</h2>

</div>

<i class="bi bi-clock fs-1"></i>

</div>

</div>


<div class="col-md-3">

<div class="stat-card">

<div>

<p>Diterima</p>

<h2>

{{$diterima}}

</h2>

</div>

<i class="bi bi-check-circle fs-1"></i>

</div>

</div>


<div class="col-md-3">

<div class="stat-card">

<div>

<p>Ditolak</p>

<h2>

{{$ditolak}}

</h2>

</div>

<i class="bi bi-x-circle fs-1"></i>

</div>

</div>

</div>

<div class="row mt-4">

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6>Total Tagihan</h6>

                <h3>

                    Rp {{ number_format($totalTagihan,0,',','.') }}

                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6>Sudah Dibayar</h6>

                <h3 class="text-success">

                    Rp {{ number_format($totalLunas,0,',','.') }}

                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6>Belum Dibayar</h6>

                <h3 class="text-danger">

                    Rp {{ number_format($totalBelum,0,',','.') }}

                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6>Total Transaksi</h6>

                <h3>

                    {{ $totalTransaksi }}

                </h3>

            </div>

        </div>

    </div>

</div>



<div class="row mt-4">

<div class="col-lg-8">

<div class="table-card">

<h5 class="mb-4">

Pendaftar Terbaru

</h5>

<table class="table">

<thead>

<tr>

<th>No</th>

<th>Nama</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($latest as $item)

<tr>

<td>{{$loop->iteration}}</td>

<td>

{{$item->nama_lengkap}}

</td>

<td>

@if($item->status=="Menunggu")

<span class="badge bg-warning">

Menunggu

</span>

@endif


@if($item->status=="Diterima")

<span class="badge bg-success">

Diterima

</span>

@endif


@if($item->status=="Ditolak")

<span class="badge bg-danger">

Ditolak

</span>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>


<div class="col-lg-4">

<div class="table-card">

<h5>

Welcome Back

</h5>

<hr>

<h3>

{{ auth()->user()->name }}

</h3>

<p>

Kelola PPDB sekolah dari dashboard admin.

</p>

</div>

</div>

</div>


@endsection