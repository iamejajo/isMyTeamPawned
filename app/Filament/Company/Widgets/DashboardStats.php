<?php

namespace App\Filament\Company\Widgets;

use App\Models\Monitor;
use App\Models\BreachEvent;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        // Get user's teams
        $userTeams = $user->teams;
        $teamIds = $userTeams->pluck('id');

        // Get monitoring stats
        $totalMonitors = Monitor::whereIn('team_id', $teamIds)->count();
        $activeMonitors = Monitor::whereIn('team_id', $teamIds)->where('is_active', true)->count();
        $emailMonitors = Monitor::whereIn('team_id', $teamIds)->where('type', 'email')->count();
        $domainMonitors = Monitor::whereIn('team_id', $teamIds)->where('type', 'domain')->count();

        // Get breach stats
        $totalBreaches = BreachEvent::whereHas('monitor', function ($query) use ($teamIds) {
            $query->whereIn('team_id', $teamIds);
        })->count();

        $newBreaches = BreachEvent::whereHas('monitor', function ($query) use ($teamIds) {
            $query->whereIn('team_id', $teamIds);
        })->where('is_new', true)->count();

        return [
            Stat::make('Total Monitors', $totalMonitors)
                ->description('All monitored items')
                ->descriptionIcon('heroicon-m-eye')
                ->color('primary'),

            Stat::make('Active Monitors', $activeMonitors)
                ->description('Currently monitoring')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Email Monitors', $emailMonitors)
                ->description('Email addresses')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('info'),

            Stat::make('Domain Monitors', $domainMonitors)
                ->description('Domain names')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('warning'),

            Stat::make('Total Breaches', $totalBreaches)
                ->description('All detected breaches')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),

            Stat::make('New Breaches', $newBreaches)
                ->description('Recently detected')
                ->descriptionIcon('heroicon-m-bell')
                ->color('danger'),
        ];
    }
}
