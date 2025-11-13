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

    public static function getNavigationGroup(): ?string
    {
        return __('admin.navigation.management');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.models.reservation.navigation_label');
    }

    // --- ADDED METHODS ---
    public static function getModelLabel(): string
    {
        return __('admin.models.reservation.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.models.reservation.plural_label');
    }
    // --- END OF ADDED METHODS ---

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label(__('admin.form.user'))
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Select::make('car_id')
                    ->label(__('admin.form.car'))
                    ->relationship('car', 'name')
                    ->searchable()
                    ->required(),

                Select::make('pickup_location_id')
                    ->label(__('admin.form.pickup_location'))
                    ->relationship('pickup', 'name')
                    ->searchable()
                    ->required(),

                Select::make('dropoff_location_id')
                    ->label(__('admin.form.dropoff_location'))
                    ->relationship('dropoff', 'name')
                    ->searchable()
                    ->required(),

                DateTimePicker::make('start_datetime')
                    ->label(__('admin.form.start_datetime'))
                    ->required(),

                DateTimePicker::make('end_datetime')
                    ->label(__('admin.form.end_datetime'))
                    ->required(),

                TextInput::make('total_price')
                    ->label(__('admin.form.total_price'))
                    ->numeric()
                    ->prefix('SAR')
                    ->disabled()
                    ->dehydrated(false)
                    ->helperText(__('admin.form.total_price_helper')),

                Select::make('status')
                    ->label(__('admin.form.status'))
                    ->options(__('admin.form.options.status'))
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
                TextColumn::make('user.name')
                    ->label(__('admin.table.user'))
                    ->sortable(),
                TextColumn::make('car.name')
                    ->label(__('admin.table.car')),
                TextColumn::make('pickup.name')
                    ->label(__('admin.table.pickup'))
                    ->sortable(),
                TextColumn::make('dropoff.name')
                    ->label(__('admin.table.dropoff'))
                    ->sortable(),
                TextColumn::make('start_datetime')
                    ->dateTime()
                    ->label(__('admin.table.start')),
                TextColumn::make('end_datetime')
                    ->dateTime()
                    ->label(__('admin.table.end')),
                TextColumn::make('total_price')
                    ->money('sar', true)
                    ->label(__('admin.table.total_price'))
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label(__('admin.table.status'))
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
                    ->label(__('admin.table_actions.whatsapp'))
                    ->icon(function () {
                        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" class="w-5 h-5">
    <path d="M380.9 97.1C339-6.6 243-24.4 164.2 29.9 84.5 84.3 58.3 197.7 96.1 293.3L24 488l195-72.9c95.6 37.8 209-11.3 263.4-90 54.3-78.8 36.5-174.8-97.5-217zM224 448c-45.9 0-91.7-12.2-131.8-35.3L48 464l52.3-44.2C70.2 404.2 48 377.6 48 352c0-96.9 78.7-176 176-176s176 79.1 176 176-79.1 176-176 176zm99.2-143.7c-3.2-1.6-18.9-9.3-21.8-10.4-2.9-1.1-5-1.6-7.1 1.6-2.1 3.2-8.1 10.4-9.9 12.6-1.8 2.1-3.7 2.4-6.8.8-18.6-9.3-30.7-16.6-43.1-37.5-3.2-5.6 3.2-5.2 9-17.2 1.1-2.1.5-3.9-.3-5.6-0.8-1.6-7.1-17.2-9.7-23.6-2.6-6.4-5.3-5.6-7.1-5.6-1.8 0-3.9 0-6-0.1-2.1-0.1-5.6.8-8.5 3.9-2.9 3.2-11.1 10.9-11.1 26.6 0 15.7 11.4 30.9 12.9 33.1 1.6 2.1 22.3 34 54.1 47.7 31.8 13.7 31.8 9.1 37.5 8.1 5.6-1 18.9-7.7 21.5-15.1 2.6-7.4 2.6-13.7 1.8-15.1-0.8-1.5-3-2.4-6.2-3.9z"/>
</svg>
SVG;
                    })
                    ->color('success')
                    ->url($whatsappUrl, shouldOpenInNewTab: true)
                    ->tooltip(__('admin.table_actions.whatsapp_tooltip'))
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