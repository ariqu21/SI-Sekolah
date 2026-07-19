@extends('layouts.admin')

@section('content')

<div class="table-card">

<form

action="{{ route(
'admin.admin.payment-types.update',
$payment_type->id
) }}"

method="POST">

@csrf

@method('PUT')

<input

name="nama"

value="{{ $payment_type->nama }}"

class="form-control mb-3">


<input

type="number"

name="nominal"

value="{{ $payment_type->nominal }}"

class="form-control mb-3">


<textarea

name="deskripsi"

class="form-control mb-3">

{{ $payment_type->deskripsi }}

</textarea>


<button
class="btn btn-primary">

Update

</button>

</form>

</div>

@endsection