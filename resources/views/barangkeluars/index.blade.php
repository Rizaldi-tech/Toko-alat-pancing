<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Barang Keluar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h3 class="text-center">Daftar Barang Keluar</h3>
  <div class="d-flex justify-content-between mb-3">
    <a href="{{ route('barangkeluars.index') }}" class="btn btn-primary">Dashboard</a> <a href="{{ route('barangkeluars.create') }}" class="btn btn-success">Tambah Barang Keluar</a>
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
    @foreach ($barangkeluars as $barangkeluar)
    <tr>
        <td>{{ $barangkeluar->Nama_barang }}</td> 
        <td>{{ $barangkeluar->Tanggal }}</td> 
        <td> 
            </td>
    </tr>

          <a href="{{ route('barangkeluars.edit', $barangkeluar->id) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('barangkeluars.destroy', $barangkeluar->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $barangkeluar->links() }}
</div>

</body>
</html>