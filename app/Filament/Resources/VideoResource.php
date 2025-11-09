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
    protected static ?string $navigationGroup = 'Media';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('video_path')
                    ->label('Video File or URL')
                    ->directory('videos')
                    ->required()
                    ->acceptedFileTypes(['video/mp4', 'video/mov', 'video/webm'])
                    ->columnSpanFull(),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->directory('thumbnails')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->label('Title')
                    ->maxLength(255),

                Toggle::make('is_active')
                    ->label('Active in Slideshow')
                    ->default(true),

                TextInput::make('order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')->label('Preview')->square(),
                TextColumn::make('title')->searchable(),
                TextColumn::make('video_path')->label('Video Path')->limit(30),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('order')->sortable(),
                TextColumn::make('created_at')->dateTime()->label('Created'),
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