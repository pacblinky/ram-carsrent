<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation.media');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.models.gallery_item.navigation_label');
    }

    // --- ADDED METHODS ---
    public static function getModelLabel(): string
    {
        return __('admin.models.gallery_item.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.models.gallery_item.plural_label');
    }
    // --- END OF ADDED METHODS ---

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image_path')
                    ->label(__('admin.form.image'))
                    ->image()
                    ->directory('gallery')
                    ->disk('public')
                    ->required(fn($operation) => $operation === 'create')
                    ->rules(['image', 'mimes:jpg,jpeg,png,webp,gif'])
                    ->previewable(true)
                    ->openable()
                    ->downloadable()
                    ->visibility('public')
                    ->getUploadedFileNameForStorageUsing(function ($file, $record, $component) {
                        $name = $record?->name ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $slug = Str::slug($name);
                        $extension = $file->getClientOriginalExtension();
                        return $slug . '-' . uniqid() . '.' . $extension;
                    })
                    ->validationMessages([
                        'image' => 'The file must be an image.',
                        'mimes' => 'The image must be a file of type: jpg, jpeg, png, webp, gif.',
                        'required' => 'The image field is required.',
                    ]),

                TextInput::make('name')
                    ->label(__('admin.form.name'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->disabled(fn ($operation) => $operation === 'edit'),

                TextInput::make('alt_text')
                    ->label(__('admin.form.alt_text'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label(__('admin.table.image'))
                    ->disk('public')
                    ->square()
                    ->height(60),

                TextColumn::make('name')
                    ->label(__('admin.table.name'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('alt_text')
                    ->label(__('admin.table.alt_text'))
                    ->limit(30),

                TextColumn::make('created_at')
                    ->label(__('admin.table.created_at'))
                    ->dateTime()
                    ->since()
                    ->sortable(),
            ])
            ->filters([])
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
            'index' => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'edit' => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }
}