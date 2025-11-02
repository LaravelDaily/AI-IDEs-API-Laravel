<?php

namespace App\Filament\Resources\Versions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VersionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tool.name')
                    ->searchable(),
                TextColumn::make('version')
                    ->searchable(),
                TextColumn::make('release_date')
                    ->date()
                    ->sortable(),
            ])
            ->defaultSort('release_date', 'desc')
            ->paginated(false)
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
