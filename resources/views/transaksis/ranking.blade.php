@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow rounded-3">
        <div class="card-header bg-dark text-white d-flex align-items-center">
            <i class="bi bi-bar-chart-line me-2"></i>
            <h1 class="mb-0">Ranking Penjualan Harian</h1>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-striped table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">
                            <i class="bi bi-calendar-event me-1"></i>Tanggal
                        </th>
                        <th scope="col">
                            <i class="bi bi-box-seam me-1"></i>Produk
                        </th>
                        <th scope="col">
                            <i class="bi bi-cart-check me-1"></i>Total Penjualan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ranking as $data)
                        <tr>
                            <td>{{ $data['Tanggal'] }}</td>
                            <td>{{ $data['Produk'] }}</td>
                            <td>{{ $data['TotalPenjualan'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Data tidak tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('transaksis.index') }}" class="btn btn-dark mt-4 d-flex align-items-center">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection