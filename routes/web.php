<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/transaksis/{transaksi}/print', [TransaksiController::class, 'print'])
    ->name('transaksi.print');
