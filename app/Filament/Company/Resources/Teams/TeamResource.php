<?php

namespace App\Filament\Company\Resources\Teams;

use App\Filament\Company\Resources\Teams\Pages\CreateTeam;
use App\Filament\Company\Resources\Teams\Pages\EditTeam;
use App\Filament\Company\Resources\Teams\Pages\ListTeams;
use App\Filament\Company\Resources\Teams\Pages\ViewTeam;
use App\Filament\Company\Resources\Teams\Schemas\TeamForm;
use App\Filament\Company\Resources\Teams\Schemas\TeamInfolist;
use App\Filament\Company\Resources\Teams\Tables\TeamsTable;
use App\Models\Team;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    public static function form(Schema $schema): Schema
    {
        return TeamForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TeamInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TeamsTable::configure($table);
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
            'index' => ListTeams::route('/'),
            'create' => CreateTeam::route('/create'),
            'view' => ViewTeam::route('/{record}'),
            'edit' => EditTeam::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        return parent::getEloquentQuery()->whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }
}
