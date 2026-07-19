@extends('frontend.layout')

@section('styles')

<link
href="{{ asset('css/landing.css') }}"
rel="stylesheet">

@endsection

@section('content')

<section class="ppdb-header">

<div class="container">

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-6">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4 class="text-center">

Registrasi Akun Wali

</h4>

</div>

<div class="card-body">

@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form
method="POST"
action="{{ route('wali.register.store') }}">

@csrf

<div class="mb-3">

<label>Nama Wali</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>No HP</label>

<input
type="text"
name="phone"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Konfirmasi Password</label>

<input
type="password"
name="password_confirmation"
class="form-control"
required>

</div>

<button
class="btn btn-success w-100">

Daftar

</button>

</form>

<div class="text-center mt-3">

Sudah punya akun?

<a
href="{{ route('wali.login') }}">

Login

</a>

</div>

</div>

</div>

</div>

</div>

</div>

@endsection