<?php

namespace App\Filament\Company\Resources\BreachEvents\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BreachEventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('monitor_id')
                    ->numeric(),
                TextEntry::make('breach_name'),
                TextEntry::make('breach_date')
                    ->date(),
                TextEntry::make('source'),
                TextEntry::make('added_at')
                    ->dateTime(),
                IconEntry::make('is_new')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
