<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationLabel(): string
    {
        return __('admin.models.user.navigation_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.models.user.plural_label');
    }

    public static function getModelLabel(): string
    {
        return __('admin.models.user.label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('admin.sections.user.user_info'))
                    ->description(__('admin.sections.user.user_info_desc'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('admin.form.name'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label(__('admin.form.email'))
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone_number')
                            ->label(__('admin.form.phone'))
                            ->required()
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('government_id')
                            ->label(__('admin.form.government_id'))
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make(__('admin.sections.user.auth'))
                    ->description(__('admin.sections.user.auth_desc'))
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->maxLength(255)
                            ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn($state) => filled($state))
                            ->label(__('admin.form.new_password'))
                            ->helperText(__('admin.form.new_password_helper')),

                        Forms\Components\Toggle::make('is_admin')
                            ->label(__('admin.form.is_admin'))
                            ->helperText(__('admin.form.is_admin_helper'))
                            ->default(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.table.name'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('admin.table.email'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone_number')
                    ->label(__('admin.table.phone'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('government_id')
                    ->label(__('admin.table.gov_id'))
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_admin')
                    ->label(__('admin.table.admin'))
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.table.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('resetPassword')
                    ->label(__('admin.table_actions.reset_password'))
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->form([
                        Forms\Components\TextInput::make('new_password')
                            ->label(__('admin.form.new_password_in_form'))
                            ->password()
                            ->required()
                            ->minLength(8),
                    ])
                    ->action(function (array $data, User $record): void {
                        $record->update([
                            'password' => Hash::make($data['new_password']),
                        ]);
                        Notification::make()
                            ->title(__('admin.notifications.password_reset_success'))
                            ->success()
                            ->send();
                    })
                    ->visible(fn() => auth()->user()?->is_admin),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Future: Relation managers like ReservationsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}