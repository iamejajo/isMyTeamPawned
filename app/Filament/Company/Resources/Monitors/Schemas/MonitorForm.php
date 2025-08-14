<?php

namespace App\Filament\Company\Resources\Monitors\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class MonitorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('team_id')
                    ->label('Team')
                    ->options(function () {
                        $user = Auth::user();
                        return $user->teams->pluck('name', 'id');
                    })
                    ->required()
                    ->searchable(),
                Select::make('type')
                    ->options([
                        'email' => 'Email',
                        'domain' => 'Domain',
                    ])
                    ->required()
                    ->default('email'),
                TextInput::make('value')
                    ->required(),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
