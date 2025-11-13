<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;
    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    
    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation.media');
    }

    // --- ADDED METHODS ---
    public static function getNavigationLabel(): string
    {
        return __('admin.models.video.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.models.video.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.models.video.plural_label');
    }
    // --- END OF ADDED METHODS ---

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('video_path')
                    ->label(__('admin.form.video_path'))
                    ->directory('videos')
                    ->required()
                    ->acceptedFileTypes(['video/mp4', 'video/mov', 'video/webm'])
                    ->columnSpanFull(),

                FileUpload::make('thumbnail')
                    ->label(__('admin.form.thumbnail'))
                    ->directory('thumbnails')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->label(__('admin.form.title'))
                    ->maxLength(255),

                Toggle::make('is_active')
                    ->label(__('admin.form.is_active_slideshow'))
                    ->default(true),

                TextInput::make('order')
                    ->label(__('admin.form.order'))
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label(__('admin.table.preview'))
                    ->square(),
                TextColumn::make('title')
                    ->label(__('admin.table.title'))
                    ->searchable(),
                TextColumn::make('video_path')
                    ->label(__('admin.table.video_path'))
                    ->limit(30),
                IconColumn::make('is_active')
                    ->label(__('admin.table.active'))
                    ->boolean(),
                TextColumn::make('order')
                    ->label(__('admin.table.order'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('admin.table.created_at')),
            ])
            ->defaultSort('order', 'asc')
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}