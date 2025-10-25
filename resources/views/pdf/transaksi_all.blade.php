<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Semua Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #6ecbcf; }
        h2, h3 { margin: 10px 0; }
        .right { text-align: right; }
        .status-lunas { color: green; font-weight: bold; }
        .status-belum { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
        <div>
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height: 80px;">
        </div>
        <h2>Laporan Semua Transaksi</h2>
    </div>

    @foreach ($transaksis as $index => $transaksi)
        <table>
            <tr>
                <th style="width:5%">No</th>
                <td>{{ $index + 1 }}</td>
                <th style="width:20%">Nama Pasien</th>
                <td>{{ $transaksi->pasien->nama ?? '-' }}</td>
                <th style="width:15%">Tanggal</th>
                <td>{{ $transaksi->created_at->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td colspan="3">{{ $transaksi->keterangan ?? '-' }}</td>
                <th>Metode</th>
                <td>{{ $transaksi->metode_pembayaran ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td colspan="5">
                    <span class="{{ $transaksi->active ? 'status-lunas' : 'status-belum' }}">
                        {{ $transaksi->active ? 'Lunas' : 'Belum Lunas' }}
                    </span>
                </td>
            </tr>
        </table>

        {{-- Detail Transaksi --}}
        @if ($transaksi->detailTransaksi->count() > 0)
            <table style="margin-top: 5px;">
                <thead>
                    <tr>
                        <th>Obat</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->detailTransaksi as $detail)
                        <tr>
                            <td>{{ $detail->obat->nama ?? '-' }}</td>
                            <td>{{ ucfirst($detail->jenis_penjualan) }}</td>
                            <td>{{ $detail->jumlah_beli }}</td>
                            <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h4 class="right" style="margin-top: 10px;">
            Total Transaksi: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
        </h4>
        <hr style="margin: 20px 0;">
    @endforeach

    <h3 class="right" style="margin-top: 30px;">
        Total Keseluruhan: Rp {{ number_format($totalAmount, 0, ',', '.') }}
    </h3>

</body>
</html>
