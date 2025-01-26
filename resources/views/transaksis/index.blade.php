<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 15px;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-custom {
            font-weight: bold;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin: 0;
        }
        .pagination .page-item {
            margin: 0 3px;
        }
        .pagination .page-item .page-link {
            border-radius: 5px;
            font-weight: bold;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
        }
        .pagination .page-item.active .page-link {
            background-color: #28a745;
            border-color: #28a745;
        }
        .pagination .page-item.disabled .page-link {
            background-color: #f1f1f1;
            color: #ccc;
            pointer-events: none;
        }
        .pagination .page-link:hover {
            background-color: #0056b3;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div>
                    <h3 class="text-center my-4">Sistem Manajemen JavaJuice</h3>
                    <h4 class="text-center mb-4 text-muted">Data Transaksi</h4>
                    <hr>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('transaksis.create') }}" class="btn btn-md btn-success btn-custom">+ Tambah Transaksi</a>
                            <form action="{{ route('transaksis.ranking') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-md btn-warning btn-custom">Hasil Ranking</button>
                            </form>
                            <div>
                                <a href="{{ route('dashboard') }}" class="btn btn-md btn-outline-secondary btn-custom">Dashboard</a>
                                <a href="{{ route('products.index') }}" class="btn btn-md btn-outline-info btn-custom">Produk</a>
                                <a href="{{ route('laporans.index') }}" class="btn btn-md btn-outline-primary btn-custom">Laporan</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Jumlah Barang</th>
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
                                        <td>{{ "Rp " . number_format($transaksi->Total_pembayaran, 2, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST">
                                                <a href="{{ route('transaksis.show', $transaksi->id) }}" class="btn btn-sm btn-outline-dark me-1">Lihat</a>
                                                <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                                <a href="{{ route('transaksis.batal', $transaksi->id) }}" class="btn btn-sm btn-outline-primary me-1">Batal</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="alert alert-warning my-3">Data Transaksi belum tersedia.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <!-- Tombol Previous -->
                                    <li class="page-item {{ $transaksis->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $transaksis->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <!-- Pagination Numbers -->
                                    @foreach ($transaksis->getUrlRange(1, $transaksis->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $transaksis->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    <!-- Tombol Next -->
                                    <li class="page-item {{ $transaksis->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $transaksis->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>
</html>
