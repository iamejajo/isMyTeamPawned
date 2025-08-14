<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Organization;
use App\Models\Team;
use App\Models\Monitor;
use App\Models\BreachEvent;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->url(route('filament.admin.resources.users.index')),

            Stat::make('Organizations', Organization::count())
                ->description('Total companies')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('info')
                ->url(route('filament.admin.resources.organizations.index')),
            Stat::make('Teams', Team::count())
                ->description('Total teams across organizations')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('warning'),
            Stat::make('Total Team Members', User::whereHas('teams')->count())
                ->description('Users across all teams')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('warning'),
                // ->url(route('filament.admin.resources.users.index')),

            Stat::make('Active Monitors', Monitor::where('is_active', true)->count())
                ->description('Currently monitored items')
                ->descriptionIcon('heroicon-m-eye')
                ->color('primary'),
                // monitors are managed in company panel

            Stat::make('Breach Events', BreachEvent::count())
                ->description('Total breach findings')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
                //breach events are viewed in company panel
        ];
    }
}
