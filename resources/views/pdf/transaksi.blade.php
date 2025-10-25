<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: ##6ecbcf; }
    </style>
</head>
<body>
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
        <!-- Logo di kiri -->
        <div>
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height: 90px;">
        </div>
        <h2>Invoice Transaksi #{{ $transaksi->id }}</h2>
        <p>Pasien: {{ $transaksi->pasien->nama ?? '-' }}</p>
        <p>Tanggal: {{ $transaksi->created_at->format('d F Y') }}</p>
        <p>Keterangan: {{ $transaksi->keterangan }}</p>
        <p>Terapi Obat: {{ $transaksi->pasien->terapi_obat ?? '-' }}</p>
        <br>

        <table>
            <thead>
                <tr>
                    <th>Obat</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->detailTransaksi as $detail)
                    <tr>
                        <td>{{ $detail->obat->nama }}</td>
                        <td>{{ ucfirst($detail->jenis_penjualan) }}</td>
                        <td>{{ $detail->jumlah_beli }}</td>
                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3 style="text-align:right; margin-top:20px;">
            Total: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
        </h3>
        <h3 style="text-align:right; margin-top:20px;">
            Metode Pembayaran: {{ $transaksi->metode_pembayaran }}
        </h3>
        <h3 style="text-align:right; margin-top:20px;">
            Status Pembayaran:
            <span style="color: {{ $transaksi->active ? 'green' : 'red' }}; font-weight: bold;">
                {{ $transaksi->active ? 'Lunas' : 'Belum Lunas' }}
            </span>
        </h3>
    </div>
</body>
</html>
