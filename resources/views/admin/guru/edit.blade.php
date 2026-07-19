@extends('layouts.admin')

@section('content')

<div class="table-card">

<form

method="POST"

action="{{ route(
'admin.guru.update',
$guru->id
) }}"

enctype="multipart/form-data">

@csrf

<div>

<a> Nama Lengkap </a>
<input
name="nama_lengkap"
class="form-control mb-3"
placeholder="Nama Lengkap"
value="{{ old('nama_lengkap', $guru->nama_lengkap) }}">
</div>

<select
name="jkelamin"
class="form-control mb-3">

<option value="L" {{ old('jkelamin', $guru->jkelamin) == 'L' ? 'selected' : '' }}>L</option>

<option value="P" {{ old('jkelamin', $guru->jkelamin) == 'P' ? 'selected' : '' }}>P</option>

</select>


<input
name="tempat_lahir"
class="form-control mb-3"
placeholder="Tempat Lahir"
value="{{ old('tempat_lahir', $guru->tempat_lahir) }}">

<input
type="date"
name="tanggal_lahir"
class="form-control mb-3"
value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}">

<input
name="NUPTK"
class="form-control mb-3"
placeholder="NUPTK"
value="{{ old('NUPTK', $guru->NUPTK) }}">

<input
name="NIK"
class="form-control mb-3"
placeholder="NIK"
value="{{ old('NIK', $guru->NIK) }}">

<input
name="pendidikan"
class="form-control mb-3"
placeholder="Pendidikan"
value="{{ old('pendidikan', $guru->pendidikan) }}">

<textarea
name="alamat"
class="form-control mb-3">
{{ old('alamat', $guru->alamat) }}
</textarea>



<button class="btn btn-primary">

Simpan

</button>

</form>

</div>

@endsection