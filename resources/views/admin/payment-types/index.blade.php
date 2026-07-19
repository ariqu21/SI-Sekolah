@extends('layouts.admin')

@section('content')

<div class="table-card">

<div class="d-flex
justify-content-between
mb-3">

<h3>

Jenis Pembayaran

</h3>

<a

href="{{ route('admin.payment-types.create') }}"

class="btn btn-success">

Tambah

</a>

</div>


<table class="table">

<thead>

<tr>

<th>No</th>

<th>Nama</th>

<th>Nominal</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@foreach($types as $item)

<tr>

<td>

{{ $loop->iteration }}

</td>

<td>

{{ $item->nama }}

</td>

<td>

Rp {{ number_format($item->nominal) }}

</td>

<td>

<a

href="{{ route(
'admin.payment-types.edit',
$item->id
) }}"

class="btn btn-warning">

Edit

</a>


<form

action="{{ route(
'admin.payment-types.destroy',
$item->id
) }}"

method="POST"

class="d-inline">

@csrf

@method('DELETE')

<button
class="btn btn-danger">

Delete

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection