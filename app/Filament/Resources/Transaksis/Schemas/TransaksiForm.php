<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use App\Models\Obat;
use App\Models\Pasien;
use Filament\Support\RawJs;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_pasien')
                    ->required()
                    ->label('Nama Pasien')
                    ->options(fn () => Pasien::all()->pluck('nama', 'id'))
                    ->columnSpanFull(),
                Section::make('Detail Transaksi')
                    ->description('Pilih Obat yang dibeli beserta jumlahnya')
                    ->icon(Heroicon::Beaker)
                    ->schema([
                        Repeater::make('details')
                            ->label('Obat')
                            ->relationship('detailTransaksi')
                            ->schema([
                                Select::make('id_obat')
                                    ->label('Obat')
                                    ->options(Obat::all()->pluck('nama', 'id'))
                                    ->searchable()
                                    ->required(),
                                Select::make('jenis_penjualan')
                                    ->label('Jenis Penjualan')
                                    ->options([
                                        'eceran' => 'Eceran',
                                        'reseller' => 'Reseller',
                                    ])
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, $get) {
                                        $obat = \App\Models\Obat::find($get('id_obat'));
                                        if ($obat) {
                                            if ($state === 'eceran') {
                                                $set('harga_satuan', $obat->harga_eceran);
                                            } elseif ($state === 'reseller') {
                                                $set('harga_satuan', $obat->harga_reseller);
                                            }
                                        }
                                    }),

                                TextInput::make('jumlah_beli')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->default(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        // hitung subtotal untuk baris ini
                                        $set('subtotal', $state * $get('harga_satuan'));

                                        // hitung ulang total dari semua repeater
                                        $allDetails = $get('../../details') ?? []; // perhatikan ../../ biar ambil semua repeater
                                        $total = collect($allDetails)->sum(fn ($d) => (int) ($d['subtotal'] ?? 0));
                                        $set('../../total_harga', $total);
                                    }),

                                TextInput::make('harga_satuan')
                                    ->label('Harga Satuan')
                                    ->numeric()
                                    ->dehydrated()
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->prefix("Rp"),

                                TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->disabled()
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->prefix("Rp")
                                    ->dehydrated(true),
                            ])
                            ->columnSpanFull()
                            ->columns(3)
                            ->columnSpanFull(),
                    ])->columnSpanFull()->columns(1),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
                Select::make('metode_pembayaran')
                    ->required()
                    ->options([
                            'tunai' => 'Tunai',
                            'transfer' => 'Transfer',
                            'Qriz' => 'Qriz',
                        ]),
                TextInput::make('total_harga')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix("Rp"),
                Toggle::make('active')
                    ->required()
                    ->label('Lunas ?'),
            ]);
    }
}
