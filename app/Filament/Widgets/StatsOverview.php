<?php

namespace App\Filament\Widgets;

use App\Models\Listing;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalListings = Listing::count();
        $totalUsers = User::count();
        $activeListings = Listing::where('is_active', true)->count();
        $recentListings = Listing::where('created_at', '>=', now()->subDays(7))->count();
        $recentUsers = User::where('created_at', '>=', now()->subDays(7))->count();

        return [
            Stat::make('Total Job Listings', $totalListings)
                ->description('All time job postings')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total Users', $totalUsers)
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([17, 16, 14, 15, 14, 13, 12]),

            Stat::make('Active Jobs', $activeListings)
                ->description('Currently active listings')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('New This Week', $recentListings)
                ->description('Listings posted in last 7 days')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('New Users This Week', $recentUsers)
                ->description('Users registered in last 7 days')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('info'),

            Stat::make('Avg. Salary Range', '$65,000 - $95,000')
                ->description('Based on active listings')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }
}
