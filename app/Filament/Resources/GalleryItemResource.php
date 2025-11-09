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
    protected static ?string $navigationGroup = 'Media';
    protected static ?string $navigationLabel = 'Images';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // ✅ Image can be edited
                FileUpload::make('image_path')
                    ->label('Image')
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

                // 🚫 Name cannot be edited
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->disabled(fn ($operation) => $operation === 'edit'),

                TextInput::make('alt_text')
                    ->label('Alt Text')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('public')
                    ->square()
                    ->height(60),

                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('alt_text')
                    ->label('Alt Text')
                    ->limit(30),

                TextColumn::make('created_at')
                    ->label('Created')
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