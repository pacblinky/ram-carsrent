<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\TextColumn;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation.management');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.models.location.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.models.location.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.models.location.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('admin.form.name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('google_maps_link')
                    ->label(__('admin.form.google_maps_link'))
                    ->url()
                    ->suffixIcon('heroicon-o-map')
                    ->maxLength(255),

                Textarea::make('google_maps_embed')
                    ->label(__('admin.form.google_maps_embed'))
                    ->rows(8)
                    ->placeholder(__('admin.form.google_maps_embed_placeholder'))
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('admin.table.name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('google_maps_link')
                    ->label(__('admin.table.google_maps'))
                    ->url(fn ($record) => $record->google_maps_link, true)
                    ->openUrlInNewTab(),

                TextColumn::make('google_maps_embed')
                    ->label(__('admin.table.google_maps_embed'))
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->google_maps_embed),
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
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}