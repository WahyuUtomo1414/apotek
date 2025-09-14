<?php

namespace App\Filament\Resources\Obats\Pages;

use App\Filament\Resources\Obats\ObatResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewObat extends ViewRecord
{
    protected static string $resource = ObatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
