<?php

namespace App\Filament\Resources\Obats\Schemas;

use App\Models\Obat;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class ObatInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama'),
                ImageEntry::make('image')
                    ->placeholder('-')
                    ->default(asset('images/obat.png'))
                    ->disk('public'),
                TextEntry::make('deskripsi')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('stok')
                    ->numeric(),
                TextEntry::make('satuan.name')
                    ->label('satuan'),
                TextEntry::make('expired_at')
                    ->date('d F Y')
                    ->placeholder('-'),
                TextEntry::make('harga_reseller')
                    ->numeric()
                    ->prefix('Rp. '),
                TextEntry::make('harga_eceran')
                    ->numeric()
                    ->prefix('Rp. '),
                TextEntry::make('harga_modal')
                    ->numeric()
                    ->prefix('Rp. '),
                IconEntry::make('active')
                    ->label('Status')
                    ->boolean(),
                
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
