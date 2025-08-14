<?php

namespace App\Filament\Company\Resources\BreachEvents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BreachEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('monitor_id')
                    ->required()
                    ->numeric(),
                TextInput::make('breach_name')
                    ->required(),
                DatePicker::make('breach_date')
                    ->required(),
                Textarea::make('data_classes')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('source')
                    ->required()
                    ->default('hibp'),
                DateTimePicker::make('added_at')
                    ->required(),
                Toggle::make('is_new')
                    ->required(),
            ]);
    }
}
