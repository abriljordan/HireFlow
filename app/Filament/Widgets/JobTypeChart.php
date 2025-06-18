<?php

namespace App\Filament\Widgets;

use App\Models\Listing;
use Filament\Widgets\ChartWidget;

class JobTypeChart extends ChartWidget
{
    protected static ?string $heading = 'Jobs by Type';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $jobTypes = [
            'full-time' => 'Full Time',
            'part-time' => 'Part Time',
            'contract' => 'Contract',
            'freelance' => 'Freelance',
            'internship' => 'Internship',
        ];

        $data = [];
        $labels = [];

        foreach ($jobTypes as $type => $label) {
            $count = Listing::where('job_type', $type)->count();
            $data[] = $count;
            $labels[] = $label;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Number of Jobs',
                    'data' => $data,
                    'backgroundColor' => [
                        '#10b981', // green
                        '#f59e0b', // yellow
                        '#3b82f6', // blue
                        '#ef4444', // red
                        '#6b7280', // gray
                    ],
                    'borderColor' => [
                        '#10b981',
                        '#f59e0b',
                        '#3b82f6',
                        '#ef4444',
                        '#6b7280',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
