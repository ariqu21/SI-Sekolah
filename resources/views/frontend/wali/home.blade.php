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

<div class="container py-5">

<div class="row">

<div class="col-lg-8">

<div class="card shadow mb-4">

<div class="card-header bg-success text-white">

<h4>

Portal Wali Murid

</h4>

</div>

<div class="card-body">

<h5>

Selamat datang,

<strong>

{{ $user->name }}

</strong>

</h5>

<hr>

@if(!$registrasi)

<div class="alert alert-warning">

Anda belum melakukan pendaftaran PPDB.

</div>

<a
href="{{ route('registrasi') }}"
class="btn btn-success">

Daftar PPDB

</a>

@else

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

<a
href="{{ route('wali.payment') }}"
class="btn btn-primary">

Pembayaran

</a>

@endif

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card shadow">

<div class="card-header">

Profil Wali

</div>

<div class="card-body">

<p>

<strong>Nama</strong><br>

{{ $user->name }}

</p>

<p>

<strong>Email</strong><br>

{{ $user->email }}

</p>

<p>

<strong>No HP</strong><br>

{{ $user->phone }}

</p>

<form
action="{{ route('wali.logout') }}"
method="POST">

@csrf

<button
class="btn btn-danger w-100">

Logout

</button>

</form>

</div>

</div>

</div>

</div>

</div>

@endsection