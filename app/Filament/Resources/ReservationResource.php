<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationLabel = 'Reservations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Select::make('car_id')
                    ->label('Car')
                    ->relationship('car', 'name')
                    ->searchable()
                    ->required(),

                Select::make('pickup_location_id')
                    ->label('Pickup Location')
                    ->relationship('pickup', 'name')
                    ->searchable()
                    ->required(),

                Select::make('dropoff_location_id')
                    ->label('Drop-off Location')
                    ->relationship('dropoff', 'name')
                    ->searchable()
                    ->required(),

                DateTimePicker::make('start_datetime')
                    ->label('Start Date & Time')
                    ->required(),

                DateTimePicker::make('end_datetime')
                    ->label('End Date & Time')
                    ->required(),

                TextInput::make('total_price')
                    ->label('Total Price')
                    ->numeric()
                    ->prefix('$')
                    ->disabled()
                    ->dehydrated(false)
                    ->helperText('Automatically calculated when saved'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending'    => 'Pending',
                        'confirmed'  => 'Confirmed',
                        'completed'  => 'Completed',
                        'canceled'   => 'Canceled',
                        'overdue'    => 'Overdue',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User')->sortable(),
                TextColumn::make('car.name')->label('Car'),
                TextColumn::make('pickup.name')->label('Pickup')->sortable(),
                TextColumn::make('dropoff.name')->label('Drop-off')->sortable(),
                TextColumn::make('start_datetime')->dateTime()->label('Start'),
                TextColumn::make('end_datetime')->dateTime()->label('End'),
                TextColumn::make('total_price')->money('usd', true)->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info'    => 'confirmed',
                        'success' => 'completed',
                        'danger'  => 'canceled',
                        'gray'    => 'overdue',
                    ]),
            ])
            ->defaultSort('start_datetime', 'desc')
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
            'index'  => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit'   => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}