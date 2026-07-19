@extends('layouts.admin')

@section('content')

<div class="table-card">

<h3 class="mb-4">

Tambah Profil Sekolah

</h3>

<form

method="POST"

action="{{ route(
'admin.profil.store'
) }}"

enctype="multipart/form-data">

@csrf


<!-- Nama Sekolah -->

<label class="mb-2">

Nama Sekolah

</label>

<input

name="nama_sekolah"

class="form-control mb-4"

value="{{ old('nama_sekolah') }}"

placeholder="Nama Sekolah">


<!-- Program -->

<label class="mb-2">

Program Sekolah

</label>

<textarea

name="program"

rows="6"

class="form-control mb-4"

placeholder="Program">{{

old('program')

}}</textarea>



<!-- Visi -->

<label class="mb-2">

Visi Sekolah

</label>

<textarea

name="visi"

rows="4"

class="form-control mb-4"

placeholder="Visi">{{

old('visi')

}}</textarea>



<!-- Misi -->

<label class="mb-2">

Misi Sekolah

</label>

<textarea

name="misi"

rows="6"

class="form-control mb-4"

placeholder="Misi">{{

old('misi')

}}</textarea>



<!-- Sejarah -->

<label class="mb-2">

Sejarah Sekolah

</label>

<textarea

name="sejarah"

rows="8"

class="form-control mb-4"

placeholder="Sejarah">{{

old('sejarah')

}}</textarea>



<!-- Alamat -->

<label class="mb-2">

Alamat

</label>

<input

name="alamat"

class="form-control mb-4"

value="{{ old('alamat') }}"

placeholder="Alamat Sekolah">



<!-- Telepon -->

<label class="mb-2">

Telepon

</label>

<input

name="telepon"

class="form-control mb-4"

value="{{ old('telepon') }}"

placeholder="Nomor Telepon">



<!-- Email -->

<label class="mb-2">

Email

</label>

<input

type="email"

name="email"

class="form-control mb-4"

value="{{ old('email') }}"

placeholder="Email Sekolah">



<button class="btn btn-primary">

Simpan Profil

</button>

</form>

</div>

@endsection