<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ranking</title>
</head>
<body>
    <h1>Ranking Produk</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ranking as $rank)
                <tr>
                    <td>{{ $rank['id'] }}</td>
                    <td>{{ $rank['title'] }}</td>
                    <td>{{ number_format($rank['nilai'], 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
