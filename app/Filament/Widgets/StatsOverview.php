<?php

namespace App\Filament\Widgets;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $pasien = Pasien::count();
        $obat = Obat::count();
        $transaksi = Transaksi::count();
        
        return [
            Stat::make('Jumlah Pasien', $pasien)
                ->description('Pasien')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([7, 2, 10, 3, 15, 20, 32])
                ->color('info'),
            Stat::make('Jumlah Obat', $obat)
                ->description('Obat')
                ->descriptionIcon('heroicon-m-beaker')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),
            Stat::make('Jumlah Transaksi', $transaksi)
                ->description('Transaksi')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
