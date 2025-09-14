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
}
