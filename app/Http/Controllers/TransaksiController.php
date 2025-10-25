<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function print(Transaksi $transaksi)
    {
        $transaksi->load('detailTransaksi.obat');

        $pdf = Pdf::loadView('pdf.transaksi', [
            'transaksi' => $transaksi,
        ]);

        return $pdf->stream("transaksi-{$transaksi->id}.pdf");
    }

    public function printAll()
    {
        $transaksis = Transaksi::with(['pasien', 'detailTransaksi.obat'])->get();

        // Siapkan data untuk tabel ringkas
        $data = $transaksis->map(function ($transaksi) {
            return [
                'nama' => $transaksi->pasien->nama ?? '-',
                'tanggal' => $transaksi->created_at->format('d F Y'),
                'keterangan' => $transaksi->keterangan ?? '-',
                'obat' => $transaksi->detailTransaksi->pluck('obat.nama')->implode(', '),
                'jumlah' => $transaksi->detailTransaksi->sum('jumlah_beli'),
                'metode' => $transaksi->metode_pembayaran ?? '-',
                'status' => $transaksi->active ? 'Lunas' : 'Belum Lunas',
                'total_harga' => $transaksi->total_harga,
            ];
        });

        $totalAmount = $data->sum('total_harga');

        $pdf = Pdf::loadView('pdf.transaksi_all', [
            'data' => $data,
            'totalAmount' => $totalAmount,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-transaksi.pdf');
    }
}
