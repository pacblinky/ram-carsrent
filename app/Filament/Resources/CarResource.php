<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Cars Management';
    protected static ?string $navigationLabel = 'Cars';
    protected static ?string $modelLabel = 'Car';
    protected static ?string $pluralModelLabel = 'Cars';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Basic Information')
                ->description('General details about the car.')
                ->icon('heroicon-o-information-circle')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    Select::make('brand_id')
                        ->label('Brand')
                        ->relationship('brand', 'name')
                        ->searchable()
                        ->required()
                        ->native(false),

                    Select::make('category')
                        ->label('Category')
                        ->options([
                            'sedan' => 'Sedan',
                            'suv' => 'SUV',
                            'sports_car' => 'Sports Car',
                            'hatchback' => 'Hatchback',
                            'coupe' => 'Coupe',
                            'convertible' => 'Convertible',
                            'pickup_truck' => 'Pickup Truck',
                            'van' => 'Van'
                        ])
                        ->searchable()
                        ->required()
                        ->native(false),

                    Select::make('location_id')
                        ->label('Location')
                        ->relationship('location', 'name')
                        ->searchable()
                        ->required(),
                ])
                ->columns(2),

            Section::make('Specifications')
                ->icon('heroicon-o-cog-8-tooth')
                ->schema([
                    Select::make('fuel_type')
                        ->label('Fuel Type')
                        ->options([
                            'petrol' => 'Petrol',
                            'diesel' => 'Diesel',
                            'electric' => 'Electric',
                            'hybrid' => 'Hybrid',
                        ])
                        ->required()
                        ->native(false),

                    Select::make('transmission')
                        ->label('Transmission')
                        ->options([
                            'manual' => 'Manual',
                            'automatic' => 'Automatic',
                            'semi-automatic' => 'Semi-Automatic',
                        ])
                        ->required()
                        ->native(false),

                    TextInput::make('number_of_seats')
                        ->numeric()
                        ->minValue(1)
                        ->label('Seats')
                        ->required(),

                    TextInput::make('number_of_doors')
                        ->numeric()
                        ->minValue(1)
                        ->label('Doors')
                        ->required(),

                    // New Quantity Input
                    TextInput::make('quantity')
                        ->numeric()
                        ->minValue(1)
                        ->default(1)
                        ->label('Total Quantity')
                        ->required()
                        ->helperText('How many of this exact car model are available?'),

                    Toggle::make('is_available')
                        ->label('Available for Rent')
                        ->default(true)
                        ->helperText('Master switch to hide/show this car entirely.'),
                ])
                ->columns(3),

            Section::make('Pricing')
                ->icon('heroicon-o-currency-dollar')
                ->schema([
                    TextInput::make('price_per_day')
                        ->numeric()
                        ->prefix('$')
                        ->label('Price per Day')
                        ->required(),
                ]),

            Section::make('Media & Description')
                ->icon('heroicon-o-photo')
                ->schema([
                    FileUpload::make('images')
                        ->label('Car Images')
                        ->directory('cars')
                        ->multiple()
                        ->reorderable()
                        ->image()
                        ->maxFiles(5)
                        ->helperText('Upload up to 5 images of the car'),
                    
                    Textarea::make('description')
                        ->rows(4)
                        ->maxLength(1000)
                        ->placeholder('Brief description, features, or notes about the car...'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
                ->sortable()
                ->searchable(),

            TextColumn::make('brand.name')
                ->label('Brand')
                ->sortable()
                ->searchable(),

            // Added Quantity Column to Table View
            TextColumn::make('quantity')
                ->label('Qty')
                ->sortable(),

            TextColumn::make('category')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'suv' => 'success',
                    'sedan' => 'primary',
                    'pickup' => 'warning',
                    'van' => 'gray',
                    'hatchback' => 'info',
                    'coupe' => 'danger',
                    default => 'secondary',
                }),

            TextColumn::make('price_per_day')
                ->money('usd', true)
                ->label('Price/Day')
                ->sortable(),

            TextColumn::make('location.name')
                ->label('Location')
                ->sortable()
                ->searchable(),

            IconColumn::make('is_available')
                ->boolean()
                ->label('Active'),

            TextColumn::make('created_at')
                ->dateTime('M d, Y')
                ->label('Created')
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->defaultSort('created_at', 'desc')
        ->filters([
            Tables\Filters\TernaryFilter::make('is_available')
                ->label('Availability Master Switch'),
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
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}