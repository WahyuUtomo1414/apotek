<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/transaksis/{transaksi}/print', [TransaksiController::class, 'print'])
    ->name('transaksi.print');
