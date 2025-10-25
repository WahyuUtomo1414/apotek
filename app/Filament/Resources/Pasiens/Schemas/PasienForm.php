<?php

namespace App\Filament\Resources\Pasiens\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PasienForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('alamat')
                    ->columnSpanFull(),
                TextInput::make('umur')
                    ->required()
                    ->numeric()
                    ->suffix('Tahun'),
                Select::make('jenis_kelamin')
                    ->options(['Laki-laki' => 'Laki laki', 'Perempuan' => 'Perempuan'])
                    ->required(),
                Textarea::make('diagnosa')
                    ->columnSpanFull(),
                Textarea::make('terapi_obat')
                    ->columnSpanFull(),
                Toggle::make('active')
                    ->required(),
            ]);
    }
}
