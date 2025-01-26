<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Barang Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .barangmasuk-image {
            width: 100%;
            object-fit: cover;
            border-radius: 10px;
        }
        .barangmasuk-title {
            font-weight: 600;
            color: #343a40;
        }
        .barangmasuk-price {
            font-size: 1.2rem;
            color: #28a745;
            font-weight: bold;
        }
        .barangmasuk-description {
            font-size: 1rem;
            color: #6c757d;
        }
        .barangmasuk-stock {
            font-size: 1rem;
            color: #ff4d4d;
        }
    </style>
</head>
<body>

    <div class="container mt-5 mb-5">
      
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body p-4">
                        <h3 class="barangmasuk-title">{{ $barangmasuk->title }}</h3>
                        <hr/>
                        <p class="barangmasuk-price">{{ "Rp " . number_format($barangmasuk->price, 2, ',', '.') }}</p>
                        <div class="barangmasuk-description">
                            {!! $barangmasuk->description !!}
                        </div>
                        <hr/>
                        <p class="barangmasuk-stock">Stok: {{ $barangmasuk->stock }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
