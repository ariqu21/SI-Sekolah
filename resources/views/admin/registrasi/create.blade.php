@extends('layouts.admin')

@section('content')

<div class="table-card">

<form
method="POST"
action="{{route('admin.registrasi.store')}}">

@csrf

<div>

<a> Nama Lengkap </a>
<input
name="nama_lengkap"
class="form-control mb-3"
placeholder="Nama Lengkap">

</div>

<a> Tempat Lahir </a>

<input
name="tempat_lahir"
class="form-control mb-3"
placeholder="Tempat Lahir">

<a> Tanggal Lahir </a>

<input
type="date"
name="tanggal_lahir"
class="form-control mb-3">

<a> Jenis Kelamin </a>

<select
name="jkelamin"
class="form-control mb-3">

<option>L</option>

<option>P</option>

</select>

<a> Alamat </a>

<textarea
name="alamat"
class="form-control mb-3"
placeholder="Alamat">

</textarea>

<a> Nama Orang Tua </a>

<input
name="nama_orangtua"
class="form-control mb-3"
placeholder="Nama Orang Tua">

<a> No HP </a>

<input
name="telepon"
class="form-control mb-3"
placeholder="No HP">

<button class="btn btn-primary">

Simpan

</button>

</form>

</div>

@endsection