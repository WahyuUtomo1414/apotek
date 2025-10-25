<?php

namespace App\Filament\Resources\Obats\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ObatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable(),
                ImageColumn::make('image')
                    ->disk('public')
                    ->default(asset('images/obat.png'))
                    ->imageSize(70),
                TextColumn::make('deskripsi')
                    ->searchable()
                    ->limit(80),
                TextColumn::make('stok')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('satuan.name')
                    ->searchable(),
                TextColumn::make('expired_at')
                    ->date('d F Y')
                    ->sortable(),
                TextColumn::make('harga_reseller')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->sortable(),
                TextColumn::make('harga_eceran')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->sortable(),
                TextColumn::make('harga_modal')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->sortable(),
                IconColumn::make('active')
                    ->label('Status')
                    ->boolean(),
                TextColumn::make('createdBy.name')
                    ->label('Created By'),
                TextColumn::make('updatedBy.name')
                    ->label("Updated by"),
                TextColumn::make('deletedBy.name')
                    ->label("Deleted by"),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
