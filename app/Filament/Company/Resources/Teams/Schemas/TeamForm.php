<?php

namespace App\Filament\Company\Resources\Teams\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('organization_id')
                    ->label('Organization')
                    ->options(function () {
                        $user = Auth::user();
                        return $user->ownedOrganizations->pluck('name', 'id');
                    })
                    ->required()
                    ->searchable(),
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
