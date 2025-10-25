<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Detail Semua Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; margin: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #6ecbcf; }
        .right { text-align: right; }
        .status-lunas { color: green; font-weight: bold; }
        .status-belum { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
        <div>
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height: 90px;">
        </div>
        <h2>Laporan Transaksi</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Obat</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row['nama'] }}</td>
                    <td>{{ $row['tanggal'] }}</td>
                    <td>{{ $row['keterangan'] }}</td>
                    <td>{{ $row['obat'] }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                    <td>{{ $row['metode'] }}</td>
                    <td class="{{ $row['status'] === 'Lunas' ? 'status-lunas' : 'status-belum' }}">
                        {{ $row['status'] }}
                    </td>
                    <td class="right">Rp {{ number_format($row['total_harga'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="right" style="margin-top: 20px;">
        Total Keseluruhan: Rp {{ number_format($totalAmount, 0, ',', '.') }}
    </h3>

</body>
</html>
