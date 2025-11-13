<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation.cars_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.models.brand.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.models.brand.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.models.brand.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('admin.form.brand_name'))
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Forms\Components\FileUpload::make('logo_path')
                    ->label(__('admin.form.logo'))
                    ->image()
                    ->imageEditor()
                    ->directory('brands/logos')
                    ->imagePreviewHeight('120')
                    ->maxSize(2048)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_path')
                    ->label(__('admin.table.logo'))
                    ->square()
                    ->height(60),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.table.brand_name'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('cars_count')
                    ->counts('cars')
                    ->label(__('admin.table.cars_count'))
                    ->sortable(),
            ])
            ->filters([
                // You can add filters later if needed
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
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
}