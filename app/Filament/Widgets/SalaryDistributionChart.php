<?php

namespace App\Filament\Widgets;

use App\Models\Listing;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class SalaryDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'Salary Distribution';
    protected static ?string $maxHeight = '300px';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // Define salary ranges
        $ranges = [
            'Under $30k' => [0, 30000],
            '$30k - $50k' => [30000, 50000],
            '$50k - $75k' => [50000, 75000],
            '$75k - $100k' => [75000, 100000],
            '$100k - $150k' => [100000, 150000],
            'Over $150k' => [150000, null],
        ];

        $data = [];
        $labels = [];

        foreach ($ranges as $label => $range) {
            $query = Listing::whereNotNull('salary_min')->whereNotNull('salary_max');
            
            if ($range[1] === null) {
                // Over $150k
                $query->where('salary_min', '>=', $range[0]);
            } else {
                $query->where(function($q) use ($range) {
                    $q->whereBetween('salary_min', $range)
                      ->orWhereBetween('salary_max', $range)
                      ->orWhere(function($q2) use ($range) {
                          $q2->where('salary_min', '<=', $range[0])
                             ->where('salary_max', '>=', $range[1]);
                      });
                });
            }

            $count = $query->count();
            $data[] = $count;
            $labels[] = $label;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Number of Jobs',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',   // Blue
                        'rgba(16, 185, 129, 0.8)',   // Green
                        'rgba(245, 158, 11, 0.8)',   // Yellow
                        'rgba(239, 68, 68, 0.8)',    // Red
                        'rgba(139, 92, 246, 0.8)',   // Purple
                        'rgba(236, 72, 153, 0.8)',   // Pink
                    ],
                    'borderColor' => [
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(236, 72, 153, 1)',
                    ],
                    'borderWidth' => 2,
                    'borderRadius' => 4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
                'tooltip' => [
                    'backgroundColor' => 'rgba(0, 0, 0, 0.8)',
                    'titleColor' => 'white',
                    'bodyColor' => 'white',
                    'borderColor' => 'rgba(255, 255, 255, 0.1)',
                    'borderWidth' => 1,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => 'rgba(156, 163, 175, 0.1)',
                    ],
                    'ticks' => [
                        'color' => '#9ca3af',
                        'stepSize' => 1,
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'color' => '#9ca3af',
                        'maxRotation' => 45,
                    ],
                ],
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
        ];
    }
}
