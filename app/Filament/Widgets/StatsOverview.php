<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Pengguna', 12)
                ->description('Pengguna')
                ->descriptionIcon('heroicon-m-user')
                ->chart([7, 2, 10, 3, 15, 20, 32])
                ->color('info'),
            Stat::make('Jumlah DPC', 12)
                ->description('DPC')
                ->descriptionIcon('heroicon-m-building-office')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),
            Stat::make('Jumlah Recruitment Anggota', 12)
                ->description('Anggota')
                ->descriptionIcon('heroicon-m-user-plus')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
