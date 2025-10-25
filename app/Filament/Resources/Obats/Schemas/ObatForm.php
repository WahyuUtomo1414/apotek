<?php

namespace App\Filament\Resources\Obats\Schemas;

use App\Models\Satuan;
use Filament\Support\RawJs;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

class ObatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('obat')
                    ->columnSpanFull(),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
                TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('id_satuan')
                    ->required()
                    ->label('Satuan')
                    ->options(Satuan::where('active', true)->pluck('name', 'id')),
                DatePicker::make('expired_at'),
                TextInput::make('harga_reseller')
                    ->required()
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix("Rp")
                    ->default(0),
                TextInput::make('harga_eceran')
                    ->required()
                    ->default(0)
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix("Rp"),
                Toggle::make('active')
                    ->label('Status')
                    ->required(),
            ]);
    }
}
