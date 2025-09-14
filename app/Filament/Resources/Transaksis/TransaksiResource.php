<?php

namespace App\Filament\Resources\Transaksis;

use App\Filament\Resources\Transaksis\Pages\CreateTransaksi;
use App\Filament\Resources\Transaksis\Pages\EditTransaksi;
use App\Filament\Resources\Transaksis\Pages\ListTransaksis;
use App\Filament\Resources\Transaksis\Pages\ViewTransaksi;
use App\Filament\Resources\Transaksis\Schemas\TransaksiForm;
use App\Filament\Resources\Transaksis\Schemas\TransaksiInfolist;
use App\Filament\Resources\Transaksis\Tables\TransaksisTable;
use App\Models\Transaksi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingCart;

    protected static string | UnitEnum | null $navigationGroup = 'Data Transaksi';

    protected static ?string $recordTitleAttribute = 'Transaksi';

    public static function form(Schema $schema): Schema
    {
        return TransaksiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TransaksiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransaksisTable::configure($table);
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
            'index' => ListTransaksis::route('/'),
            'create' => CreateTransaksi::route('/create'),
            'view' => ViewTransaksi::route('/{record}'),
            'edit' => EditTransaksi::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        return static::hitungTotal($data);
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        return static::hitungTotal($data);
    }

    protected static function hitungTotal(array $data): array
    {
        $details = $data['details'] ?? [];

        $total = collect($details)->sum(function ($d) {
            $harga = (int) ($d['harga_satuan'] ?? 0);
            $jumlah = (int) ($d['jumlah_beli'] ?? 0);
            return $jumlah * $harga;
        });

        $data['total_harga'] = $total;

        return $data;
    }
}
