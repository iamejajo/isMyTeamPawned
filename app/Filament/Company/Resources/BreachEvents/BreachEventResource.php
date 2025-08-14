<?php

namespace App\Filament\Company\Resources\BreachEvents;

use App\Filament\Company\Resources\BreachEvents\Pages\CreateBreachEvent;
use App\Filament\Company\Resources\BreachEvents\Pages\EditBreachEvent;
use App\Filament\Company\Resources\BreachEvents\Pages\ListBreachEvents;
use App\Filament\Company\Resources\BreachEvents\Pages\ViewBreachEvent;
use App\Filament\Company\Resources\BreachEvents\Schemas\BreachEventForm;
use App\Filament\Company\Resources\BreachEvents\Schemas\BreachEventInfolist;
use App\Filament\Company\Resources\BreachEvents\Tables\BreachEventsTable;
use App\Models\BreachEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BreachEventResource extends Resource
{
    protected static ?string $model = BreachEvent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShieldExclamation;

    public static function form(Schema $schema): Schema
    {
        return BreachEventForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BreachEventInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BreachEventsTable::configure($table);
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
            'index' => ListBreachEvents::route('/'),
            'create' => CreateBreachEvent::route('/create'),
            'view' => ViewBreachEvent::route('/{record}'),
            'edit' => EditBreachEvent::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $userTeams = $user->teams;
        $teamIds = $userTeams->pluck('id');

        return parent::getEloquentQuery()->whereHas('monitor', function ($query) use ($teamIds) {
            $query->whereIn('team_id', $teamIds);
        });
    }
}
