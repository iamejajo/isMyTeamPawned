<?php

namespace App\Filament\Company\Resources\Monitors;

use App\Filament\Company\Resources\Monitors\Pages\CreateMonitor;
use App\Filament\Company\Resources\Monitors\Pages\EditMonitor;
use App\Filament\Company\Resources\Monitors\Pages\ListMonitors;
use App\Filament\Company\Resources\Monitors\Schemas\MonitorForm;
use App\Filament\Company\Resources\Monitors\Tables\MonitorsTable;
use App\Models\Monitor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MonitorResource extends Resource
{
    protected static ?string $model = Monitor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ComputerDesktop;

    protected static ?string $recordTitleAttribute = 'Monitor';

    public static function form(Schema $schema): Schema
    {
        return MonitorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MonitorsTable::configure($table);
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
            'index' => ListMonitors::route('/'),
            'create' => CreateMonitor::route('/create'),
            'edit' => EditMonitor::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $userTeams = $user->teams;
        $teamIds = $userTeams->pluck('id');

        return parent::getEloquentQuery()->whereIn('team_id', $teamIds);
    }
}
