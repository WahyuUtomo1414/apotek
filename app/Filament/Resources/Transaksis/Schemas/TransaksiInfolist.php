<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use App\Models\Transaksi;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class TransaksiInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('pasien.nama')
                    ->label('Nama Pasien'),
                TextEntry::make('total_harga')
                    ->label('Total Harga')
                    ->prefix('Rp. '),
                TextEntry::make('keterangan')
                    ->label('Keterangan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('metode_pembayaran')
                    ->label('Metode Pembayaran'),
                IconEntry::make('active')
                    ->label('Status pembayaran')
                    ->boolean(),
                
                Section::make('Detail Transaksi')
                    ->description('Daftar obat yang dibeli')
                    ->icon(Heroicon::ShoppingBag)
                    ->schema([
                        RepeatableEntry::make('detailTransaksi')
                            ->label('-')
                            ->schema([
                                TextEntry::make('obat.nama')
                                    ->label('Nama Obat'),
                                TextEntry::make('jenis_penjualan')
                                    ->label('Jenis Penjualan'),
                                TextEntry::make('jumlah_beli')
                                    ->label('Jumlah'),
                                TextEntry::make('harga_satuan')
                                    ->label('Harga Satuan')
                                    ->prefix('Rp. '),
                                TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->prefix('Rp. '),
                            ])
                            ->columns(5),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),

                Section::make('Informasi Pengguna')
                ->schema([
                    TextEntry::make('createdBy.name')
                        ->label('Created By'),
                    TextEntry::make('updatedBy.name')
                        ->label("Updated by"),
                    TextEntry::make('deletedBy.name')
                        ->label("Deleted by"),
                ])->columns(3)->columnSpanFull()->collapsible(),

                Section::make('Timestamps')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Created At')
                                    ->dateTime('d/m/Y H:i'),
                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime('d/m/Y H:i'),
                            ]),
                    ])->columnSpanFull()->collapsible(),
            ]);
    }
}
