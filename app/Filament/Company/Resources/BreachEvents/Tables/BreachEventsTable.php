<?php

namespace App\Filament\Company\Resources\BreachEvents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BreachEventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('monitor.value')
                    ->label('Monitored Item')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('breach_name')
                    ->searchable(),
                TextColumn::make('breach_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('source')
                    ->searchable(),
                TextColumn::make('added_at')
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('is_new')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
