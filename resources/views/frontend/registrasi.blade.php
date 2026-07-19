@extends('frontend.layout')

@section('styles')

<link
href="{{ asset('css/landing.css') }}"
rel="stylesheet">

@endsection


@section('content')


<!-- HEADER -->

<section class="ppdb-header">

<div class="container text-center">

<span class="ppdb-badge">

PPDB ONLINE

</span>

<h1>

Pendaftaran Siswa Baru

</h1>

<p>

Isi formulir berikut untuk melakukan pendaftaran siswa baru.

</p>

</div>

</section>



<section class="ppdb-section">

<div class="container">


<div class="row justify-content-center">

<div class="col-lg-10">


<div class="form-card">





<h3 class="section-title">

Formulir Pendaftaran

</h3>


@if(session('success'))

<div class="modal fade" id="successModal" tabindex="-1">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content border-0 rounded-4">

<div class="modal-body text-center p-5">

<div style="font-size:70px">

✅

</div>


<h3>

Registrasi Berhasil

</h3>


<p>

Data pendaftaran telah dikirim.

Silakan hubungi admin untuk verifikasi.

</p>


<a

href="{{ session('wa') }}"

class="submit-btn"

target="_blank">

Chat Admin

</a>


</div>

</div>

</div>

</div>

@endif


@if($errors->any())

<div class="alert alert-danger rounded-4">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>

{{ $error }}

</li>

@endforeach

</ul>

</div>

@endif



<form

action="{{ route('registrasi.storeFrontend') }}"

method="POST">

@csrf


<div class="row">


<div class="col-md-6 mb-4">

<label>

Nama Lengkap

</label>

<input

type="text"

name="nama_lengkap"

class="modern-input"

value="{{ old('nama_lengkap') }}">

</div>



<div class="col-md-6 mb-4">

<label>

Nama Orang Tua

</label>

<input

type="text"

name="nama_orangtua"

class="modern-input"

value="{{ old('nama_orangtua') }}">

</div>



<div class="col-md-6 mb-4">

<label>

Tempat Lahir

</label>

<input

type="text"

name="tempat_lahir"

class="modern-input"

value="{{ old('tempat_lahir') }}">

</div>



<div class="col-md-6 mb-4">

<label>

Tanggal Lahir

</label>

<input

type="date"

name="tanggal_lahir"

class="modern-input"

value="{{ old('tanggal_lahir') }}">

</div>



<div class="col-md-6 mb-4">

<label>

Jenis Kelamin

</label>

<select

name="jkelamin"

class="modern-input">

<option>

Pilih Jenis Kelamin

</option>

<option value="L">

Laki-Laki

</option>

<option value="P">

Perempuan

</option>

</select>

</div>



<div class="col-md-6 mb-4">

<label>

Nomor Telepon

</label>

<input

type="text"

name="telepon"

class="modern-input"

value="{{ old('telepon') }}">

</div>



<div class="col-12 mb-4">

<label>

Alamat

</label>

<textarea

name="alamat"

rows="5"

class="modern-input">

{{ old('alamat') }}

</textarea>

</div>


</div>



<button

type="submit"

class="submit-btn">

Kirim Pendaftaran

</button>


</form>

</div>

</div>

</div>

</div>

</section>

@if(session('success'))

<script>

document.addEventListener(

'DOMContentLoaded',

function(){

new bootstrap.Modal(

document.getElementById(

'successModal'

)

).show();

}

);

</script>

@endif

@endsection