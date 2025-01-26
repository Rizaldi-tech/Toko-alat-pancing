<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .form-title {
            font-weight: 600;
            color: #343a40;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
    </style>
</head>
<body>

    <div class="container mt-5 mb-5">
        <h3 class="text-center my-4 form-title">Tambahkan Transaksi</h3>

        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('transaksis.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="product_id" class="form-label">Pilih Produk</label>
                                <select name="product_id" class="form-control" required>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->title }} (Stok: {{ $product->stock }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="Jumlah_barang" class="form-label">Jumlah Barang</label>
                                <input type="number" name="Jumlah_barang" class="form-control" min="1" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="Tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                                <input type="date" name="Tanggal_transaksi" class="form-control" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="Nama_pembeli" class="form-label">Nama Pembeli</label>
                                <input type="text" name="Nama_pembeli" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary me-3">Simpan</button>
                            <button type="reset" class="btn btn-warning">Ulangi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
