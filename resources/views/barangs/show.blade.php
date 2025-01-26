<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Barang </title>
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
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center my-4">Detail Barang </h3>
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <td>{{ $barang->id }}</td>
                            </tr>
                            <tr>
                                <th>Barang</th>
                                <td>{{ $barang->barang->title }}</td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>{{ $barang->quantity }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>{{ number_format($barang->total, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Diterima</th>
                                <td>{{ $barang->received_date }}</td>
                            </tr>
                        </table>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('barangs.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-warning">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
