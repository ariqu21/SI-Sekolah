@extends('layouts.admin')

@section('content')

<div class="table-card">

<div class="d-flex
justify-content-between
mb-4">

<h3>

Profil Sekolah

</h3>

<a
href="{{ route(
'admin.profil.create'
) }}"
class="btn btn-primary">

Tambah

</a>

</div>


<table class="table">

<tr>

<th>Nama</th>

<th>Aksi</th>

</tr>

@foreach($profils as $item)

<tr>

<td>

{{$item->nama_sekolah}}

</td>

<td>

<a
href="{{ route(
'admin.profil.edit',
$item->id
) }}"

class="btn btn-warning">

Edit

</a>

<form
method="POST"
action="{{ route(
'admin.profil.destroy',
$item->id
) }}"
class="d-inline">

@csrf

@method('DELETE')

<button class="btn btn-danger">

Delete

</button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

@endsection