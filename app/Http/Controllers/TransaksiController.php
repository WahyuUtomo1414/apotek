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

        $totalAmount = $transaksis->sum('total_harga');

        $pdf = Pdf::loadView('pdf.transaksi_all', [
            'transaksis' => $transaksis,
            'totalAmount' => $totalAmount,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-semua-transaksi.pdf');
    }
}
