@extends('layouts.admin')

@section('content')

<div class="table-card">

<h4 class="mb-4">

Edit Pendaftaran

</h4>

<form
method="POST"
action="{{ route(
'admin.registrasi.update',
$registrasi->id
) }}">

@csrf

@method('PUT')

<a> Nama Lengkap </a>

<input
class="form-control mb-3"

name="nama_lengkap"

value="{{ $registrasi->nama_lengkap }}">

<a> Tempat Lahir </a>

<input
class="form-control mb-3"

name="tempat_lahir"

value="{{ $registrasi->tempat_lahir }}">

<a> Tanggal Lahir </a>

<input
type="date"

class="form-control mb-3"

name="tanggal_lahir"

value="{{ $registrasi->tanggal_lahir }}">

<a> Jenis Kelamin </a>

<select
name="jkelamin"

class="form-control mb-3">

<option
value="L"

{{ $registrasi->jkelamin=="L"
?'selected':'' }}>

L

</option>

<option
value="P"

{{ $registrasi->jkelamin=="P"
?'selected':'' }}>

P

</option>

</select>

<a> Alamat </a>

<textarea
name="alamat"

class="form-control mb-3">{{ $registrasi->alamat }}</textarea>

<a> Nama Orang Tua </a>

<input
class="form-control mb-3"

name="nama_orangtua"

value="{{ $registrasi->nama_orangtua }}">

<a> No HP </a>

<input
class="form-control mb-3"

name="telepon"

value="{{ $registrasi->telepon }}">

<a> Status Pendaftaran </a>

<select
name="status"
class="form-control mb-3">

<option
value="Menunggu"

{{ $registrasi->status=="Menunggu"
?'selected':'' }}>

Menunggu

</option>


<option
value="Diterima"

{{ $registrasi->status=="Diterima"
?'selected':'' }}>

Diterima

</option>


<option
value="Ditolak"

{{ $registrasi->status=="Ditolak"
?'selected':'' }}>

Ditolak

</option>

</select>


<button class="btn btn-primary">

Update

</button>

</form>

</div>

@endsection