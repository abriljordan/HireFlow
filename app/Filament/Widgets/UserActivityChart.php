<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Listing;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class UserActivityChart extends ChartWidget
{
    protected static ?string $heading = 'User Activity (Last 30 Days)';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $days = collect();
        $userData = collect();
        $listingData = collect();

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $days->push($date->format('M d'));
            
            $userCount = User::whereDate('created_at', $date)->count();
            $userData->push($userCount);
            
            $listingCount = Listing::whereDate('created_at', $date)->count();
            $listingData->push($listingCount);
        }

        return [
            'datasets' => [
                [
                    'label' => 'New Users',
                    'data' => $userData->toArray(),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
                [
                    'label' => 'New Job Listings',
                    'data' => $listingData->toArray(),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $days->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
