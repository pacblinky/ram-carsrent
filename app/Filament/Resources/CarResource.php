<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Models\Car;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationLabel = 'Cars';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('brand')->required(),
                Select::make('category')
                    ->label('Category')
                    ->options([
                        'sedan' => 'Sedan',
                        'suv' => 'SUV',
                        'hatchback' => 'Hatchback',
                        'coupe' => 'Coupe',
                        'convertible' => 'Convertible',
                        'pickup' => 'Pickup Truck',
                        'van' => 'Van',
                    ])
                    ->searchable()
                    ->required()
                    ->native(false),
                Select::make('fuel_type')
                    ->label('Fuel Type')
                    ->options([
                        'petrol' => 'Petrol',
                        'diesel' => 'Diesel',
                        'electric' => 'Electric',
                        'hybrid' => 'Hybrid',
                    ])
                    ->required()
                    ->native(false), // nice Filament-styled dropdown
                Select::make('transmission')
                    ->label('Transmission')
                    ->options([
                        'manual' => 'Manual',
                        'automatic' => 'Automatic',
                        'semi-automatic' => 'Semi-Automatic',
                    ])
                    ->required()
                    ->native(false),
                TextInput::make('number_of_seats')->numeric()->minValue(1),
                TextInput::make('number_of_doors')->numeric()->minValue(1),
                TextInput::make('price_per_day')
                    ->numeric()
                    ->prefix('$')
                    ->required(),
                Select::make('location_id')
                    ->label('Location')
                    ->options(Location::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Textarea::make('description')->rows(3),
                Toggle::make('is_available')->label('Available')->default(true),
                FileUpload::make('images')
                    ->label('Car Images')
                    ->directory('cars')
                    ->multiple()
                    ->reorderable()
                    ->image()
                    ->maxFiles(5)
                    ->helperText('Upload up to 5 images'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('brand')->sortable()->searchable(),
                TextColumn::make('category'),
                TextColumn::make('price_per_day')->money('usd', true),
                TextColumn::make('location.name')->label('Location'),
                IconColumn::make('is_available')->boolean()->label('Available'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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