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
use Filament\Tables\Actions\Action;

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
                    ->prefix('SAR')
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
        $whatsappUrl = fn($record) => $record->user?->phone_number
            ? 'https://wa.me/' . preg_replace('/\D+/', '', $record->user->phone_number)
              . '?text=' . urlencode(
                  "Hello {$record->user->name},\n\n"
                  . "Regarding your car reservation:\n"
                  . "- Car: {$record->car->name}\n"
                  . "- Pickup: {$record->pickup->name}\n"
                  . "- Drop-off: {$record->dropoff->name}\n"
                  . "- From: {$record->start_datetime->format('Y-m-d H:i')}\n"
                  . "- To: {$record->end_datetime->format('Y-m-d H:i')}\n\n"
                  . "Total Price: SAR{$record->total_price}\n\n"
                  . "Thank you!"
              )
            : null;

        return $table
            ->columns([
                TextColumn::make('user.name')->label('User')->sortable(),
                TextColumn::make('car.name')->label('Car'),
                TextColumn::make('pickup.name')->label('Pickup')->sortable(),
                TextColumn::make('dropoff.name')->label('Drop-off')->sortable(),
                TextColumn::make('start_datetime')->dateTime()->label('Start'),
                TextColumn::make('end_datetime')->dateTime()->label('End'),
                TextColumn::make('total_price')->money('sar', true)->sortable(),
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

                // WhatsApp button
                Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon(function () {
                        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" class="w-5 h-5">
    <path d="M380.9 97.1C339-6.6 243-24.4 164.2 29.9 84.5 84.3 58.3 197.7 96.1 293.3L24 488l195-72.9c95.6 37.8 209-11.3 263.4-90 54.3-78.8 36.5-174.8-97.5-217zM224 448c-45.9 0-91.7-12.2-131.8-35.3L48 464l52.3-44.2C70.2 404.2 48 377.6 48 352c0-96.9 78.7-176 176-176s176 79.1 176 176-79.1 176-176 176zm99.2-143.7c-3.2-1.6-18.9-9.3-21.8-10.4-2.9-1.1-5-1.6-7.1 1.6-2.1 3.2-8.1 10.4-9.9 12.6-1.8 2.1-3.7 2.4-6.8.8-18.6-9.3-30.7-16.6-43.1-37.5-3.2-5.6 3.2-5.2 9-17.2 1.1-2.1.5-3.9-.3-5.6-0.8-1.6-7.1-17.2-9.7-23.6-2.6-6.4-5.3-5.6-7.1-5.6-1.8 0-3.9 0-6-0.1-2.1-0.1-5.6.8-8.5 3.9-2.9 3.2-11.1 10.9-11.1 26.6 0 15.7 11.4 30.9 12.9 33.1 1.6 2.1 22.3 34 54.1 47.7 31.8 13.7 31.8 9.1 37.5 8.1 5.6-1 18.9-7.7 21.5-15.1 2.6-7.4 2.6-13.7 1.8-15.1-0.8-1.5-3-2.4-6.2-3.9z"/>
</svg>
SVG;
                    })
                    ->color('success')
                    ->url($whatsappUrl, shouldOpenInNewTab: true)
                    ->tooltip('Message customer on WhatsApp')
                    ->visible(fn ($record) => !empty($record->user?->phone_number)),
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
            'view'   => Pages\ViewReservation::route('/{record}'),
        ];
    }
}