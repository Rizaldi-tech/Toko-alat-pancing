@extends('adminlte::page')

{{-- @section('title', 'Dashboard') --}}

@section('content_header')
<h1 class="text-center mb-4">Ranking Produk</h1>
@stop

@section('content')
    <div class="container mt-5">
        <form method="post" action="{{ route('transaksis.ranking') }}">
            @csrf
            <label for="start_date">Start Date:</label>
            <input type="date" name="startDate" id="start_date"
                   value="{{ old('startDate', $startDate) }}" required>

            <label for="end_date">End Date:</label>
            <input type="date" name="endDate" id="end_date"
                   value="{{ old('endDate', $endDate) }}" required>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Nilai Preferensi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ranking as $rank)
                        <tr>
                            <td>{{ $rank['id'] }}</td>
                            <td>{{ $rank['title'] }}</td>
                            <td>{{ number_format($rank['nilai'], 4) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada barang</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop
