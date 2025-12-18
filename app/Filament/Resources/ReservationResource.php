<?php

namespace App\Filament\Resources;

use App\Enums\ReservationStatus;
use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\Action;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Carbon;

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

    public static function getModelLabel(): string
    {
        return __('admin.models.reservation.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.models.reservation.plural_label');
    }

    public static function calculateTotal(Get $get, Set $set): void
    {
        $carId = $get('car_id');
        $start = $get('start_datetime');
        $end = $get('end_datetime');
        $withDriver = $get('with_driver');

        if (!$carId || !$start || !$end) {
            return;
        }

        $car = Car::find($carId);
        if (!$car) return;

        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);

        if ($endDate->lessThanOrEqualTo($startDate)) {
            return; 
        }

        // Calculate duration in days (rounding up partial days to 1)
        // Adjust logic here if you charge by hour
        $days = $startDate->diffInDays($endDate) ?: 1; 

        $total = $days * $car->price_per_day;

        if ($withDriver) {
            $total += ($days * $car->driver_price_per_day);
        }

        $set('total_price', $total);
    }

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
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::calculateTotal($get, $set)),

                Toggle::make('with_driver')
                    ->label(__('admin.form.with_driver'))
                    ->default(false)
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::calculateTotal($get, $set)),

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
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::calculateTotal($get, $set)),

                DateTimePicker::make('end_datetime')
                    ->label(__('admin.form.end_datetime'))
                    ->required()
                    ->afterOrEqual('start_datetime')
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::calculateTotal($get, $set)),

                TextInput::make('total_price')
                    ->label(__('admin.form.total_price'))
                    ->numeric()
                    ->prefix('SAR')
                    ->readOnly()
                    ->dehydrated() // Ensures the calculated value is saved to DB
                    ->helperText(__('admin.form.total_price_helper')),

                Select::make('status')
                    ->label(__('admin.form.status'))
                    ->options([
                        ReservationStatus::Pending->value   => __('admin.form.options.status.pending'),
                        ReservationStatus::Confirmed->value => __('admin.form.options.status.confirmed'),
                        ReservationStatus::Completed->value => __('admin.form.options.status.completed'),
                        ReservationStatus::Canceled->value  => __('admin.form.options.status.canceled'),
                        ReservationStatus::Overdue->value   => __('admin.form.options.status.overdue'),
                    ])
                    ->default(ReservationStatus::Pending->value)
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
                    . "- To: {$record->end_datetime->format('Y-m-d H:i')}\n"
                    . ($record->with_driver ? "- With Driver: Yes\n" : "")
                    . "\nTotal Price: SAR{$record->total_price}\n\n"
                    . "Thank you!"
                )
            : null;

        return $table
            ->columns([
                TextColumn::make('id')
                    ->label("#")
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label(__('admin.table.user'))
                    ->sortable(),

                TextColumn::make('car.name')
                    ->label(__('admin.table.car')),

                IconColumn::make('with_driver')
                    ->label(__('admin.table.with_driver'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('pickup.name')
                    ->label(__('admin.table.pickup'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('dropoff.name')
                    ->label(__('admin.table.dropoff'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('start_datetime')
                    ->label(__('admin.table.start'))
                    ->dateTime('Y-m-d h:i A')
                    ->sortable(),

                TextColumn::make('end_datetime')
                    ->label(__('admin.table.end'))
                    ->dateTime('Y-m-d h:i A')
                    ->sortable(),

                TextColumn::make('total_price')
                    ->money('sar', true)
                    ->label(__('admin.table.total_price'))
                    ->sortable(),

                SelectColumn::make('status')
                    ->label(__('admin.table.status'))
                    ->options([
                        ReservationStatus::Pending->value   => __('admin.form.options.status.pending'),
                        ReservationStatus::Confirmed->value => __('admin.form.options.status.confirmed'),
                        ReservationStatus::Completed->value => __('admin.form.options.status.completed'),
                        ReservationStatus::Canceled->value  => __('admin.form.options.status.canceled'),
                        ReservationStatus::Overdue->value   => __('admin.form.options.status.overdue'),
                    ])
                    ->selectablePlaceholder(false)
                    ->sortable(),
                
                TextColumn::make('status_badge')
                    ->label("")
                    ->badge()
                    ->state(fn ($record) => $record->status)
                    ->formatStateUsing(fn ($state) => match ($state) {
                        ReservationStatus::Pending   => __('admin.form.options.status.pending'),
                        ReservationStatus::Confirmed => __('admin.form.options.status.confirmed'),
                        ReservationStatus::Completed => __('admin.form.options.status.completed'),
                        ReservationStatus::Canceled  => __('admin.form.options.status.canceled'),
                        ReservationStatus::Overdue   => __('admin.form.options.status.overdue'),
                        default => $state,
                    })
                    ->color(fn (ReservationStatus $state) => $state->color()),
            ])
            ->defaultSort('start_datetime', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('admin.table.status'))
                    ->options([
                        ReservationStatus::Pending->value   => __('admin.form.options.status.pending'),
                        ReservationStatus::Confirmed->value => __('admin.form.options.status.confirmed'),
                        ReservationStatus::Completed->value => __('admin.form.options.status.completed'),
                        ReservationStatus::Canceled->value  => __('admin.form.options.status.canceled'),
                        ReservationStatus::Overdue->value   => __('admin.form.options.status.overdue'),
                    ])
                    ->multiple(),
                // Added Date Filter for better management
                Tables\Filters\Filter::make('start_datetime')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('From Date'),
                        Forms\Components\DatePicker::make('until')->label('To Date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($query, $date) => $query->whereDate('start_datetime', '>=', $date))
                            ->when($data['until'], fn ($query, $date) => $query->whereDate('start_datetime', '<=', $date));
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

                Action::make('whatsapp')
                    ->label(__('admin.table_actions.whatsapp'))
                    ->icon('heroicon-o-chat-bubble-left-ellipsis') // Simplified icon or use your SVG
                    ->color('success')
                    ->url($whatsappUrl, shouldOpenInNewTab: true)
                    ->tooltip(__('admin.table_actions.whatsapp_tooltip'))
                    ->visible(fn ($record) => !empty($record->user?->phone_number)),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make(__('admin.models.reservation.label'))
                    ->columns(2)
                    ->schema([
                        TextEntry::make('id')
                            ->label("#"),
                        
                        TextEntry::make('status')
                            ->label(__('admin.table.status'))
                            ->badge()
                            ->color(fn (ReservationStatus $state): string => match ($state) {
                                ReservationStatus::Pending => 'warning',
                                ReservationStatus::Confirmed => 'success',
                                ReservationStatus::Completed => 'success',
                                ReservationStatus::Canceled => 'danger',
                                ReservationStatus::Overdue => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('start_datetime')
                            ->label(__('admin.table.start'))
                            ->dateTime('Y-m-d h:i A'),
                            
                        TextEntry::make('end_datetime')
                            ->label(__('admin.table.end'))
                            ->dateTime('Y-m-d h:i A'),
                            
                        TextEntry::make('pickup.name')
                            ->label(__('admin.table.pickup')),
                            
                        TextEntry::make('dropoff.name')
                            ->label(__('admin.table.dropoff')),
                            
                        IconEntry::make('with_driver')
                            ->label(__('admin.table.with_driver'))
                            ->boolean(),
                            
                        TextEntry::make('total_price')
                            ->label(__('admin.table.total_price'))
                            ->money('sar'),
                    ]),
                
                Section::make(__('admin.form.car'))
                    ->columns(2)
                    ->schema([
                        TextEntry::make('car.name')
                            ->label(__('admin.form.name')),
                        TextEntry::make('car.brand.name')
                            ->label(__('admin.form.brand')),
                    ]),
                    
                Section::make(__('admin.form.user'))
                    ->columns(2)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label(__('admin.form.name')),
                        TextEntry::make('user.email')
                            ->label(__('admin.form.email')),
                        TextEntry::make('user.phone_number')
                            ->label(__('admin.form.phone')),
                        TextEntry::make('user.gov_id')
                            ->label(__('admin.form.government_id')),
                    ]),
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