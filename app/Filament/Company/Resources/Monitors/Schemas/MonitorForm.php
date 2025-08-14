<?php

namespace App\Filament\Company\Resources\Monitors\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MonitorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('team_id')
                    ->required()
                    ->numeric(),
                TextInput::make('type')
                    ->required()
                    ->default('email'),
                TextInput::make('value')
                    ->required(),
                DateTimePicker::make('last_scanned_at'),
                Toggle::make('is_active')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
