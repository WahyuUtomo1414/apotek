<?php

namespace App\Filament\Resources\Satuans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SatuanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('code'),
                Textarea::make('description')
                    ->columnSpanFull(),
                Toggle::make('active')
                    ->required(),
            ]);
    }
}
