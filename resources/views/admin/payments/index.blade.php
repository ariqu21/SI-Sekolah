@extends('layouts.admin')

@section('content')

<div class="card p-4">

<div class="d-flex justify-content-between mb-3">

<h4>

Data Pembayaran

</h4>

<a
href="{{ route('payments.create') }}"
class="btn btn-success">

Tambah Pembayaran

</a>

</div>

<table class="table">

<thead>

<tr>

<th>No</th>

<th>Siswa</th>

<th>Jenis</th>

<th>Nominal</th>

<th>Status</th>

<th>Tanggal Bayar</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@foreach($payments as $item)

<tr>

<td>

{{ $loop->iteration }}

</td>

<td>

{{ $item->registrasi->nama_lengkap }}

</td>

<td>

{{ $item->paymentType->nama }}

</td>

<td>

Rp {{ number_format($item->nominal) }}

</td>

<td>

@if($item->status=='Lunas')

<span class="badge bg-success">

Lunas

</span>

@else

<span class="badge bg-warning">

Belum Bayar

</span>

@endif

</td>

<td>

@if($item->tanggal_bayar)

    {{ \Carbon\Carbon::parse(
        $item->tanggal_bayar
    )->format('d-m-Y') }}

@else

    -

@endif

</td>

<td>

<a

href="{{ route(
'payments.edit',
$item->id
) }}"

class="btn btn-warning btn-sm">

Edit

</a>

<form

action="{{ route(
'payments.destroy',
$item->id
) }}"

method="POST"

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

</tbody>

</table>

</div>

@endsection