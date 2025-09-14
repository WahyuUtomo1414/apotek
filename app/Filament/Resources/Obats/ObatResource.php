<?php

namespace App\Filament\Resources\Obats;

use App\Filament\Resources\Obats\Pages\CreateObat;
use App\Filament\Resources\Obats\Pages\EditObat;
use App\Filament\Resources\Obats\Pages\ListObats;
use App\Filament\Resources\Obats\Pages\ViewObat;
use App\Filament\Resources\Obats\Schemas\ObatForm;
use App\Filament\Resources\Obats\Schemas\ObatInfolist;
use App\Filament\Resources\Obats\Tables\ObatsTable;
use App\Models\Obat;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ObatResource extends Resource
{
    protected static ?string $model = Obat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Beaker;

    protected static string | UnitEnum | null $navigationGroup = 'Data Apotek';

    protected static ?string $recordTitleAttribute = 'Obat';

    public static function form(Schema $schema): Schema
    {
        return ObatForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ObatInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ObatsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListObats::route('/'),
            'create' => CreateObat::route('/create'),
            'view' => ViewObat::route('/{record}'),
            'edit' => EditObat::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
