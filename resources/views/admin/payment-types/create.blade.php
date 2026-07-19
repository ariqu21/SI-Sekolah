@extends('layouts.admin')

@section('content')

<div class="table-card">

<form

action="{{ route('admin.payment-types.store') }}"

method="POST">

@csrf

<input

name="nama"

class="form-control mb-3"

placeholder="Nama Pembayaran">


<input

type="number"

name="nominal"

class="form-control mb-3"

placeholder="Nominal">


<textarea

name="deskripsi"

class="form-control mb-3"

placeholder="Deskripsi">

</textarea>


<button
class="btn btn-primary">

Simpan

</button>

</form>

</div>

@endsection