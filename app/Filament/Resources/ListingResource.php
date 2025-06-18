<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListingResource\Pages;
use App\Filament\Resources\ListingResource\RelationManagers;
use App\Models\Listing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    
    protected static ?string $navigationLabel = 'Job Listings';
    
    protected static ?string $modelLabel = 'Job Listing';
    
    protected static ?string $pluralModelLabel = 'Job Listings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Job Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Senior Laravel Developer'),
                        
                        Forms\Components\TextInput::make('company')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Tech Corp'),
                        
                        Forms\Components\TextInput::make('location')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., San Francisco, CA'),
                        
                        Forms\Components\Select::make('job_type')
                            ->required()
                            ->options([
                                'full-time' => 'Full Time',
                                'part-time' => 'Part Time',
                                'contract' => 'Contract',
                                'freelance' => 'Freelance',
                                'internship' => 'Internship',
                            ])
                            ->default('full-time'),
                        
                        Forms\Components\Select::make('experience_level')
                            ->required()
                            ->options([
                                'entry' => 'Entry Level',
                                'junior' => 'Junior',
                                'mid' => 'Mid Level',
                                'senior' => 'Senior',
                                'lead' => 'Lead',
                                'executive' => 'Executive',
                            ])
                            ->default('mid'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Compensation & Details')
                    ->schema([
                        Forms\Components\TextInput::make('salary_min')
                            ->numeric()
                            ->prefix('$')
                            ->placeholder('50000'),
                        
                        Forms\Components\TextInput::make('salary_max')
                            ->numeric()
                            ->prefix('$')
                            ->placeholder('80000'),
                        
                        Forms\Components\DatePicker::make('application_deadline')
                            ->required()
                            ->minDate(now()),
                        
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->placeholder('jobs@company.com'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Job Description')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(10)
                            ->placeholder('Describe the job responsibilities, requirements, and benefits...'),
                        
                        Forms\Components\Textarea::make('requirements')
                            ->rows(5)
                            ->placeholder('List the required skills, experience, and qualifications...'),
                        
                        Forms\Components\Textarea::make('benefits')
                            ->rows(3)
                            ->placeholder('List the benefits and perks...'),
                    ]),
                
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->directory('logos')
                            ->visibility('public'),
                        
                        Forms\Components\TextInput::make('website')
                            ->url()
                            ->placeholder('https://company.com'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Listing')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('company')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->sortable(),
                
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
                
                Tables\Columns\TextColumn::make('application_deadline')
                    ->date()
                    ->sortable()
                    ->color(fn ($record) => $record->application_deadline < now() ? 'danger' : 'success'),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Posted By')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('job_type')
                    ->options([
                        'full-time' => 'Full Time',
                        'part-time' => 'Part Time',
                        'contract' => 'Contract',
                        'freelance' => 'Freelance',
                        'internship' => 'Internship',
                    ]),
                
                Tables\Filters\SelectFilter::make('experience_level')
                    ->options([
                        'entry' => 'Entry Level',
                        'junior' => 'Junior',
                        'mid' => 'Mid Level',
                        'senior' => 'Senior',
                        'lead' => 'Lead',
                        'executive' => 'Executive',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Listings'),
                
                Tables\Filters\Filter::make('salary_range')
                    ->form([
                        Forms\Components\TextInput::make('min_salary')
                            ->numeric()
                            ->placeholder('Minimum salary'),
                        Forms\Components\TextInput::make('max_salary')
                            ->numeric()
                            ->placeholder('Maximum salary'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['min_salary'],
                                fn (Builder $query, $minSalary): Builder => $query->where('salary_min', '>=', $minSalary),
                            )
                            ->when(
                                $data['max_salary'],
                                fn (Builder $query, $maxSalary): Builder => $query->where('salary_max', '<=', $maxSalary),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}
