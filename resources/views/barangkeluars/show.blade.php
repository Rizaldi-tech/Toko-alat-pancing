<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Detail Barang Keluar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
    }
    .barangkeluar-image {
      width: 100%;
      object-fit: cover;
      border-radius: 10px;
    }
    .barangkeluar-title {
      font-weight: 600;
      color: #343a40;
    }
    .barangkeluar-price {
      font-size: 1.2rem;
      color: #28a745;
      font-weight: bold;
    }
    .barangkeluar-description {
      font-size: 1rem;
      color: #6c757d;
    }
    .barangkeluar-stock {
      font-size: 1rem;
      color: #ff4d4d;
    }
  </style>
</head>
<body>

  <div class="container mt-5 mb-5">

    <div class="row">
      <div class="col-md-4">
        <img src="{{ $barangkeluar->image_url }}" alt="{{ $barangkeluar->Nama_barang }}" class="barangkeluar-image">
      </div>
      <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded">
          <div class="card-body p-4">
            <h3 class="barangkeluar-title">{{ $barangkeluar->Nama_barang }}</h3>
            <hr/>
            <p class="barangkeluar-price">
              @if ($barangkeluar->price)
                {{ "Rp " . number_format($barangkeluar->price, 2, ',', '.') }}
              @else
                Harga tidak tersedia
              @endif
            </p>
            <div class="barangkeluar-description">
              {!! $barangkeluar->description ?? 'Tidak ada deskripsi' !!}
            </div>
            <hr/>
            <p class="barangkeluar-stock">
              @if ($barangkeluar->stock)
                Stok: {{ $barangkeluar->stock }}
              @else
                Stok tidak tersedia
              @endif
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>