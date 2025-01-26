@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Barang Masuk</h1>
    <form action="{{ route('barangmasuks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="Nama_barang" id="Nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="Tanggal" class="form-label">Tanggal</label>
            <input type="date" name="Tanggal" id="Tanggal" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
