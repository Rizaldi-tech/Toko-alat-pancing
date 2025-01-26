<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center">Daftar Barang Masuk</h3>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
        <a href="{{ route('barangmasuks.create') }}" class="btn btn-success">Tambah Barang Masuk</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangMasuks as $barangMasuk)
            <tr>
                <td>{{ $barangMasuk->Nama_barang }}</td>
                <td>{{ $barangMasuk->Tanggal }}</td>
                <td>
                    <a href="{{ route('barangmasuks.edit', $barangMasuk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barangmasuks.destroy', $barangMasuk->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $barangMasuks->links() }}
</div>

</body>
</html>
