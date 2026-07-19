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

<div class="col-lg-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4 class="text-center">

Login Wali Murid

</h4>

</div>

<div class="card-body">

@if(session('error'))

<div class="alert alert-danger">

{{ session('error') }}

</div>

@endif

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<form
method="POST"
action="{{ route('wali.authenticate') }}">

@csrf

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
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

<button
class="btn btn-success w-100">

Login

</button>

</form>

<div class="text-center mt-3">

Belum punya akun?

<a
href="{{ route('wali.register') }}">

Daftar

</a>

</div>

</div>

</div>

</div>

</div>

</div>

@endsection