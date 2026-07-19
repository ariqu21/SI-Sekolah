@extends('layouts.admin')

@section('content')

<div class="card p-4">

<form
action="{{ route('payments.store') }}"
method="POST">

@csrf

<label>Siswa</label>

<select
name="registrasi_id"
id="registrasi_id"
class="form-control mb-3">

<option value="">
Pilih Siswa
</option>

@foreach($registrasis as $siswa)

<option

value="{{ $siswa->id }}"

data-noreg="{{ $siswa->no_pendaftaran }}"

data-nama="{{ $siswa->nama_lengkap }}"

data-orangtua="{{ $siswa->nama_orangtua }}"

data-telepon="{{ $siswa->telepon }}">

{{ $siswa->nama_lengkap }}

</option>

@endforeach

</select>

<div class="row">

<div class="col-md-6">

<label>No Registrasi</label>

<input

type="text"

id="no_registrasi"

class="form-control mb-3"

readonly>

</div>


<div class="col-md-6">

<label>Nama Siswa</label>

<input

type="text"

id="nama_siswa"

class="form-control mb-3"

readonly>

</div>


<div class="col-md-6">

<label>Nama Orang Tua</label>

<input

type="text"

id="nama_orangtua"

class="form-control mb-3"

readonly>

</div>


<div class="col-md-6">

<label>Telepon</label>

<input

type="text"

id="telepon"

class="form-control mb-3"

readonly>

</div>

</div>

<label>Jenis Pembayaran</label>

<select
name="payment_type_id"
id="payment_type"
class="form-control mb-3">

@foreach($types as $type)

<option
value="{{ $type->id }}"
data-nominal="{{ $type->nominal }}">

{{ $type->nama }}

</option>

@endforeach

</select>

<label>Nominal</label>

<input
type="number"
name="nominal"
id="nominal"
class="form-control mb-3"
readonly>

<!-- <label>Tanggal Bayar</label>

<input
type="date"
name="tanggal_bayar"
class="form-control mb-3"> -->

<label>Status</label>

<select
name="status"
class="form-control mb-3">

<option value="Belum Bayar">
Belum Bayar
</option>

<option value="Lunas">
Lunas
</option>

</select>

<button
class="btn btn-primary">

Simpan

</button>

</form>

</div>

<script>

document
.getElementById('registrasi_id')
.addEventListener(
'change',
function(){

let option =
this.options[
this.selectedIndex
];

document
.getElementById(
'no_registrasi'
)
.value =
option.dataset.noreg ?? '';

document
.getElementById(
'nama_siswa'
)
.value =
option.dataset.nama ?? '';

document
.getElementById(
'nama_orangtua'
)
.value =
option.dataset.orangtua ?? '';

document
.getElementById(
'telepon'
)
.value =
option.dataset.telepon ?? '';

});

document
.getElementById('payment_type')
.addEventListener('change', function(){

let nominal =
this.options[
this.selectedIndex
].dataset.nominal;

document
.getElementById('nominal')
.value = nominal;

});

</script>

@endsection