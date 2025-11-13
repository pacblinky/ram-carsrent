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

    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation.cars_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.models.car.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.models.car.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.models.car.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make(__('admin.sections.car.basic_info'))
                ->description(__('admin.sections.car.basic_info_desc'))
                ->icon('heroicon-o-information-circle')
                ->schema([
                    TextInput::make('name')
                        ->label(__('admin.form.name'))
                        ->required()
                        ->maxLength(255),

                    Select::make('brand_id')
                        ->label(__('admin.form.brand'))
                        ->relationship('brand', 'name')
                        ->searchable()
                        ->required()
                        ->native(false),

                    Select::make('category')
                        ->label(__('admin.form.category'))
                        ->options(__('admin.form.options.categories'))
                        ->searchable()
                        ->required()
                        ->native(false),

                    Select::make('location_id')
                        ->label(__('admin.form.location'))
                        ->relationship('location', 'name')
                        ->searchable()
                        ->required(),
                ])
                ->columns(2),

            Section::make(__('admin.sections.car.specifications'))
                ->icon('heroicon-o-cog-8-tooth')
                ->schema([
                    Select::make('fuel_type')
                        ->label(__('admin.form.fuel_type'))
                        ->options(__('admin.form.options.fuel_types'))
                        ->required()
                        ->native(false),

                    Select::make('transmission')
                        ->label(__('admin.form.transmission'))
                        ->options(__('admin.form.options.transmissions'))
                        ->required()
                        ->native(false),

                    TextInput::make('number_of_seats')
                        ->numeric()
                        ->minValue(1)
                        ->label(__('admin.form.seats'))
                        ->required(),

                    TextInput::make('number_of_doors')
                        ->numeric()
                        ->minValue(1)
                        ->label(__('admin.form.doors'))
                        ->required(),

                    TextInput::make('quantity')
                        ->numeric()
                        ->minValue(1)
                        ->default(1)
                        ->label(__('admin.form.quantity'))
                        ->required()
                        ->helperText(__('admin.form.quantity_helper')),

                    Toggle::make('is_available')
                        ->label(__('admin.form.is_available'))
                        ->default(true)
                        ->helperText(__('admin.form.is_available_helper')),
                ])
                ->columns(3),

            Section::make(__('admin.sections.car.pricing'))
                ->icon('heroicon-o-currency-dollar')
                ->schema([
                    TextInput::make('price_per_day')
                        ->numeric()
                        ->prefix("SAR")
                        ->label(__('admin.form.price_per_day'))
                        ->required(),
                ]),

            Section::make(__('admin.sections.car.media'))
            ->icon('heroicon-o-photo')
            ->schema([
                FileUpload::make('images')
                    ->label(__('admin.form.images'))
                    ->directory('cars')
                    ->multiple()
                    ->reorderable()
                    ->image()
                    ->maxFiles(5)
                    ->helperText(__('admin.form.images_helper')),
            ]), 

        Section::make(__('admin.sections.car.description'))
            ->icon('heroicon-o-chat-bubble-bottom-center-text')
            ->schema([
                Textarea::make('description.en')
                    ->label(__('admin.form.desc_en'))
                    ->rows(4)
                    ->maxLength(1000)
                    ->placeholder(__('admin.form.desc_en_placeholder')),
                
                Textarea::make('description.ar')
                    ->label(__('admin.form.desc_ar'))
                    ->rows(4)
                    ->maxLength(1000)
                    ->placeholder(__('admin.form.desc_ar_placeholder')),
            ])
            ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
                ->label(__('admin.table.name'))
                ->sortable()
                ->searchable(),

            TextColumn::make('brand.name')
                ->label(__('admin.table.brand'))
                ->sortable()
                ->searchable(),

            TextColumn::make('quantity')
                ->label(__('admin.table.quantity_short'))
                ->sortable(),

            TextColumn::make('category')
                ->label(__('admin.table.category'))
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
                ->money('sar', true)
                ->label(__('admin.table.price_per_day'))
                ->sortable(),

            TextColumn::make('location.name')
                ->label(__('admin.table.location'))
                ->sortable()
                ->searchable(),

            IconColumn::make('is_available')
                ->boolean()
                ->label(__('admin.table.active')),

            TextColumn::make('created_at')
                ->dateTime('M d, Y')
                ->label(__('admin.table.created_at'))
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->defaultSort('created_at', 'desc')
        ->filters([
            Tables\Filters\TernaryFilter::make('is_available')
                ->label(__('admin.filters.availability')),
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