@extends('layouts.admin')

@section('content')

<div class="table-card">

<h3 class="mb-4">

Edit Profil Sekolah

</h3>

<form

method="POST"

action="{{ route(
'admin.profil.update',
$profil->id
) }}"

enctype="multipart/form-data">

@csrf

@method('PUT')


<!-- Nama Sekolah -->

<label class="mb-2">

Nama Sekolah

</label>

<input

name="nama_sekolah"

class="form-control mb-4"

value="{{ old(
'nama_sekolah',
$profil->nama_sekolah
) }}">



<!-- Program -->

<label class="mb-2">

Program Sekolah

</label>

<textarea

name="program"

rows="6"

class="form-control mb-4">{{

old(
'program',
$profil->program
)

}}</textarea>



<!-- VISI -->

<label class="mb-2">

Visi Sekolah

</label>

<textarea

name="visi"

rows="4"

class="form-control mb-4">{{

old(
'visi',
$profil->visi
)

}}</textarea>



<!-- MISI -->

<label class="mb-2">

Misi Sekolah

</label>

<textarea

name="misi"

rows="6"

class="form-control mb-4">{{

old(
'misi',
$profil->misi
)

}}</textarea>



<!-- SEJARAH -->

<label class="mb-2">

Sejarah Sekolah

</label>

<textarea

name="sejarah"

rows="8"

class="form-control mb-4">{{

old(
'sejarah',
$profil->sejarah
)

}}</textarea>



<!-- ALAMAT -->

<label class="mb-2">

Alamat

</label>

<input

name="alamat"

class="form-control mb-4"

value="{{ old(
'alamat',
$profil->alamat
) }}">



<!-- TELEPON -->

<label class="mb-2">

Telepon

</label>

<input

name="telepon"

class="form-control mb-4"

value="{{ old(
'telepon',
$profil->telepon
) }}">



<!-- EMAIL -->

<label class="mb-2">

Email

</label>

<input

name="email"

type="email"

class="form-control mb-4"

value="{{ old(
'email',
$profil->email
) }}">



<button class="btn btn-primary">

Update Profil

</button>

</form>

</div>

@endsection