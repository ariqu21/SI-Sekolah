@extends('layouts.admin')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            Edit Pembayaran
        </h4>
    </div>

    <div class="card-body">

        <form
            action="{{ route('payments.update', $payment->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            {{-- SISWA --}}

            <div class="mb-3">

                <label class="form-label">

                    Siswa

                </label>

                <select
                    name="registrasi_id"
                    id="registrasi_id"
                    class="form-select">

                    @foreach($registrasis as $siswa)

                    <option
                        value="{{ $siswa->id }}"

                        data-noreg="{{ $siswa->no_pendaftaran }}"

                        data-nama="{{ $siswa->nama_lengkap }}"

                        data-orangtua="{{ $siswa->nama_orangtua }}"

                        data-telepon="{{ $siswa->telepon }}"

                        {{ $payment->registrasi_id == $siswa->id ? 'selected' : '' }}>

                        {{ $siswa->nama_lengkap }}

                    </option>

                    @endforeach

                </select>

            </div>


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


            {{-- JENIS PEMBAYARAN --}}

            <div class="mb-3">

                <label class="form-label">

                    Jenis Pembayaran

                </label>

                <select
                    name="payment_type_id"
                    id="payment_type"
                    class="form-select">

                    @foreach($types as $type)

                    <option

                        value="{{ $type->id }}"

                        data-nominal="{{ $type->nominal }}"

                        {{ $payment->payment_type_id == $type->id ? 'selected' : '' }}>

                        {{ $type->nama }}

                    </option>

                    @endforeach

                </select>

            </div>


            <div class="mb-3">

                <label>

                    Nominal

                </label>

                <input
                    type="text"
                    id="nominal"
                    class="form-control"
                    readonly>

            </div>


            <!-- <div class="mb-3">

                <label>

                    Tanggal Bayar

                </label>

                <input
                    type="date"
                    name="tanggal_bayar"
                    value="{{ $payment->tanggal_bayar }}"
                    class="form-control">

            </div> -->


            <div class="mb-3">

                <label>

                    Status

                </label>

                <select
                    name="status"
                    class="form-select">

                    <option
                        value="Belum Bayar"
                        {{ $payment->status == 'Belum Bayar' ? 'selected' : '' }}>

                        Belum Bayar

                    </option>

                    <option
                        value="Lunas"
                        {{ $payment->status == 'Lunas' ? 'selected' : '' }}>

                        Lunas

                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label>

                    Keterangan

                </label>

                <textarea
                    name="keterangan"
                    class="form-control"
                    rows="3">{{ $payment->keterangan }}</textarea>

            </div>


            <button
                class="btn btn-success">

                Update Pembayaran

            </button>

            <a
                href="{{ route('payments.index') }}"
                class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>


<script>

function loadStudentData(){

    let option =
    document.getElementById('registrasi_id')
    .selectedOptions[0];

    document.getElementById('no_registrasi').value =
    option.dataset.noreg ?? '';

    document.getElementById('nama_siswa').value =
    option.dataset.nama ?? '';

    document.getElementById('nama_orangtua').value =
    option.dataset.orangtua ?? '';

    document.getElementById('telepon').value =
    option.dataset.telepon ?? '';

}

function loadNominal(){

    let option =
    document.getElementById('payment_type')
    .selectedOptions[0];

    let nominal =
    option.dataset.nominal ?? 0;

    document.getElementById('nominal').value =
    'Rp ' +
    Number(nominal)
    .toLocaleString('id-ID');

}

document
.getElementById('registrasi_id')
.addEventListener('change', loadStudentData);

document
.getElementById('payment_type')
.addEventListener('change', loadNominal);

loadStudentData();
loadNominal();

</script>

@endsection