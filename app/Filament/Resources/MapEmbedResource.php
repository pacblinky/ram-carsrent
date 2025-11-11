<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MapEmbedResource\Pages;
use App\Models\MapEmbed;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ReorderAction;

class MapEmbedResource extends Resource
{
    protected static ?string $model = MapEmbed::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Site Settings';
    protected static ?string $navigationLabel = 'Map Embeds';
    protected static ?int $navigationSort = 5; // Adjust as needed

    // Define the column name for reordering
    protected static string $orderColumn = 'sort_order';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('page')
                    ->options([
                        'about' => 'About Page',
                        'contact' => 'Contact Page',
                    ])
                    ->required(),
                Textarea::make('embed_code')
                    ->label('Map Embed Code')
                    ->helperText('Paste the full <iframe ...> code.')
                    ->rows(8)
                    ->required(),
                TextInput::make('location_name')
                    ->label('Location Name')
                    ->helperText('e.g., "Main Showroom"'),
                
                TextInput::make('google_maps_link')
                    ->label('Google Maps Link')
                    ->url()
                    ->helperText('The "View Map" link for this location.'),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'about' => 'About Page',
                        'contact' => 'Contact Page',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('location_name')
                    ->label('Location Name')
                    ->searchable(),
                TextColumn::make('sort_order')
                    ->label('Sort Order')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            // Add the reorder action
            ->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMapEmbeds::route('/'),
            'create' => Pages\CreateMapEmbed::route('/create'),
            'edit' => Pages\EditMapEmbed::route('/{record}/edit'),
        ];
    }
}