@extends('layouts.admin')

@section('content')

<div class="table-card">

<div class="d-flex
justify-content-between
mb-4">

<h3>

Data Guru

</h3>


<a

href="{{ route(
'admin.guru.create'
) }}"

class="btn btn-primary">

Tambah Guru

</a>

</div>


<table class="table">

<tr>

<th>Nama Lengkap</th>
<th>Jenis Kelamin</th>
<th>Tempat Lahir</th>
<th>Tanggal Lahir</th>
<th>NUPTK</th>
<th>NIK</th>
<th>Pendidikan</th>
<th>Alamat</th>
<th>Aksi</th>

</tr>


@foreach($gurus as $item)



<tr>

<td>
{{$item->nama_lengkap}}
</td>

<td>
{{$item->jkelamin}}
</td>

<td>
{{$item->tempat_lahir}}
</td>

<td>
{{$item->tanggal_lahir}}
</td>

<td>
{{$item->NUPTK}}
</td>

<td>
{{$item->NIK}}
</td>

<td>
{{$item->pendidikan}}
</td>

<td>
{{$item->alamat}}
</td>

<td>

<a

href="{{ route(
'admin.guru.edit',
$item->id
) }}"

class="btn btn-warning">

Edit

</a>

<form

method="POST"

action="{{route(
'admin.guru.destroy',
$item->id
)}}"

class="d-inline">

@csrf

@method('DELETE')

<button
class="btn btn-danger btn-sm">

Delete

</button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

@endsection