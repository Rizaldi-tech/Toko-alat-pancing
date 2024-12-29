<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
</head>
<body>
    <h2>Laporan Transaksi</h2>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th>Tanggal Transaksi</th>
                <th>Jumlah Barang</th>
                <th>Total Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $laporan)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($laporan->Tanggal_transaksi)->format('d F Y') }}</td>
                    <td>{{ $laporan->Jumlah_barang }}</td>
                    <td>{{ number_format($laporan->Total_pembayaran, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
