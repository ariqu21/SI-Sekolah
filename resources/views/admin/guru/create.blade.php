@extends('layouts.admin')

@section('content')

<div class="table-card">

<form

method="POST"

action="{{ route(
'admin.guru.store'
) }}"

enctype="multipart/form-data">

@csrf

<div>

<a> Nama Lengkap </a>
<input
name="nama_lengkap"
class="form-control mb-3"
placeholder="Nama Lengkap">

</div>

<select
name="jkelamin"
class="form-control mb-3">

<option>L</option>

<option>P</option>

</select>


<input
name="tempat_lahir"
class="form-control mb-3"
placeholder="Tempat Lahir">

<input
type="date"
name="tanggal_lahir"
class="form-control mb-3">

<input
name="NUPTK"
class="form-control mb-3"
placeholder="NUPTK">

<input
name="NIK"
class="form-control mb-3"
placeholder="NIK">

<input
name="pendidikan"
class="form-control mb-3"
placeholder="Pendidikan">

<textarea
name="alamat"
class="form-control mb-3">

</textarea>



<button class="btn btn-primary">

Simpan

</button>

</form>

</div>

@endsection