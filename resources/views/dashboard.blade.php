@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistem Manajemen JavaJuz</h1>
@stop


    <!-- Tombol navigasi -->
     @section('content')
    <div class="mt-4">
        <a href="{{ route('laporans.index') }}" class="btn btn-primary">Laporan</a>
        <a href="{{ route('barang.index') }}" class="btn btn-primary">Barang</a>
        <a href="{{ route('barang_masuk.index') }}" class="btn btn-primary">Barang Masuk</a>
        <a href="{{ route('barang_keluar.index') }}" class="btn btn-primary">Barang Keluar</a>
    </div>

@section('content')
    {{-- Card Daftar Produk --}}
    <div class="card bg-dark text-white mb-4">
        <div class="card-header d-flex justify-content-between align-barangss-center">
            <h3 class="card-title">Produk</h3>
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-success">Tambah Produk</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col" style="width: 20%">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset('storage/'.$product->image) }}" class="rounded" style="width: 150px">
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td class="text-center">
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" style="display: inline-block;">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-dark">Lihat</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="alert alert-success">Data Produk belum tersedia.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Card Transaksi --}}
    <div class="card bg-dark text-white mb-4">
        <div class="card-header d-flex justify-content-between align-barangss-center">
            <h3 class="card-title">Transaksi</h3>
            <a href="{{ route('transaksis.create') }}" class="btn btn-sm btn-success">Tambah Transaksi</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">Produk</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Jumlah produk</th>
                        <th scope="col">Total Pembayaran</th>
                        <th scope="col" style="width: 20%">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->product->title }}</td>
                            <td>{{ $transaksi->Tanggal_transaksi }}</td>
                            <td>{{ $transaksi->Jumlah_barang }}</td>
                            <td>{{ 'Rp ' . number_format($transaksi->Total_pembayaran, 2, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                    <a href="{{ route('transaksis.show', $transaksi->id) }}" class="btn btn-sm btn-dark">Lihat</a>
                                    <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('transaksis.batal', $transaksi->id) }}" class="btn btn-sm btn-outline-primary me-1">Batal</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="alert alert-success">Data Transaksi belum tersedia.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

