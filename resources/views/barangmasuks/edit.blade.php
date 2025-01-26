@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Barang Masuk</h1>
    <form action="{{ route('barangmasuks.update', $barangMasuk->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="Nama_barang" id="Nama_barang" class="form-control" value="{{ $barangMasuk->Nama_barang }}" required>
        </div>
        <div class="mb-3">
            <label for="Tanggal" class="form-label">Tanggal</label>
            <input type="date" name="Tanggal" id="Tanggal" class="form-control" value="{{ $barangMasuk->Tanggal }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
