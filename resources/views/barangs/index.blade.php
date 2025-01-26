<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center">Daftar Barang</h3>
    <div class="d-flex justify-content-between mb-3">
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>

        <a href="{{ route('barangs.create') }}" class="btn btn-success">Tambah Barang</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
              
                <th>Tanggal Diterima</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
            <tr>
              
                <td>{{ $barang->title }}</td>
               
                <td>{{ $barang->received_date }}</td>
                <td>
                    <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $barangs->links() }}
</div>

</body>
</html>
