<?php

namespace App\Filament\Widgets;

use App\Models\Listing;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestListings extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Listing::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('company')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('job_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'full-time' => 'success',
                        'part-time' => 'warning',
                        'contract' => 'info',
                        'freelance' => 'danger',
                        'internship' => 'secondary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('-', ' ', $state))),
                
                Tables\Columns\TextColumn::make('salary_range')
                    ->label('Salary')
                    ->formatStateUsing(function ($record) {
                        if ($record->salary_min && $record->salary_max) {
                            return '$' . number_format($record->salary_min) . ' - $' . number_format($record->salary_max);
                        } elseif ($record->salary_min) {
                            return '$' . number_format($record->salary_min) . '+';
                        }
                        return 'Not specified';
                    }),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (Listing $record): string => route('filament.admin.resources.listings.edit', $record))
                    ->icon('heroicon-m-eye')
                    ->label('View'),
            ]);
    }
}
