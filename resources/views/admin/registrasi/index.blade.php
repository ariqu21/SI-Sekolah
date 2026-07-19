@extends('layouts.admin')

@section('title','PPDB')

@section('header','Pendaftaran Siswa')

@section('content')

<style>

.status-select{
    border:none;
    border-radius:8px;
    padding:6px 12px;
    font-weight:600;
    font-size:14px;
    cursor:pointer;
    min-width:120px;
}

.status-menunggu{
    background:#FFC107;
    color:white;
}

.status-diterima{
    background:#28A745;
    color:white;
}

.status-ditolak{
    background:#DC3545;
    color:white;
}

</style>

<div class="table-card">

<div class="d-flex justify-content-between mb-3">

<h4>Data Pendaftaran</h4>

<a
href="{{route('admin.registrasi.create')}}"
class="btn btn-primary">

Tambah


</a>


</div>

<a

href="{{ route(
'admin.registrasi.export'
) }}"

class="btn btn-success mb-3">

Export Excel

</a>

<table class="table">

<thead>

<tr>

<th>No</th>

<th>No Pendaftaran</th>

<th>Name</th>

<th>Jenis Kelamin</th>

<th>Status</th>

<th>Aksi</th>

<th>Pembayaran</th>

</tr>

</thead>

<tbody>

@foreach($registrasi as $item)

<tr>

<td>{{$loop->iteration}}</td>

<td>{{ $item->no_pendaftaran }}</td>

<td>{{$item->nama_lengkap}}</td>

<td>{{$item->jkelamin}}</td>

<td>

<form
action="{{ route('admin.registrasi.status', $item->id) }}"
method="POST">

@csrf
@method('PATCH')

<select
name="status"

class="status-select
{{ $item->status == 'Menunggu' ? 'status-menunggu' : '' }}
{{ $item->status == 'Diterima' ? 'status-diterima' : '' }}
{{ $item->status == 'Ditolak' ? 'status-ditolak' : '' }}"

onchange="this.form.submit()">

<option value="Menunggu"
{{ $item->status == 'Menunggu' ? 'selected' : '' }}>
Menunggu
</option>

<option value="Diterima"
{{ $item->status == 'Diterima' ? 'selected' : '' }}>
Diterima
</option>

<option value="Ditolak"
{{ $item->status == 'Ditolak' ? 'selected' : '' }}>
Ditolak
</option>

</select>

</form>

</td>

<td>

<a
href="{{route(
'admin.registrasi.edit',
$item->id
)}}"
class="btn btn-sm btn-warning">

Edit

</a>

<form
action="{{route(
'admin.registrasi.destroy',
$item->id
)}}"

method="POST"

class="d-inline">

@csrf

@method('DELETE')

<button class="btn btn-danger btn-sm">

Delete

</button>

</form>

</td>

<td>

<a
href="{{ route(
'admin.payments.student',
$item->id
) }}"
class="btn btn-success btn-sm">

Pembayaran

</a>

</td>

</tr>



@endforeach

</tbody>

</table>

{{$registrasi->links()}}

</div>

<script>

document.addEventListener(
'DOMContentLoaded',
function(){

document.querySelectorAll(
'.status-select'
).forEach(function(select){

updateColor(select);

select.addEventListener(
'change',
function(){

updateColor(this);

});

});

});

function updateColor(select){

select.classList.remove(
'status-menunggu',
'status-diterima',
'status-ditolak'
);

if(select.value === 'Menunggu'){

select.classList.add(
'status-menunggu'
);

}
else if(select.value === 'Diterima'){

select.classList.add(
'status-diterima'
);

}
else{

select.classList.add(
'status-ditolak'
);

}

}

</script>

@endsection