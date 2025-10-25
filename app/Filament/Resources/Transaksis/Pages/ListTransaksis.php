<?php

namespace App\Filament\Resources\Transaksis\Pages;

use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Transaksis\TransaksiResource;

class ListTransaksis extends ListRecords
{
    protected static string $resource = TransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('print_all')
                ->label('Print Transaksi')
                ->icon('heroicon-o-printer')
                ->color('info')
                ->url(route('transaksi.printAll'))
                ->openUrlInNewTab(),
        ];
    }
}
