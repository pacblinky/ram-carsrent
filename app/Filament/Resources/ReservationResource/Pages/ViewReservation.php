<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use App\Enums\ReservationStatus;

class ViewReservation extends ViewRecord
{
    protected static string $resource = ReservationResource::class;

    protected function getHeaderActions(): array
    {
        $whatsappUrl = fn() => $this->record->user?->phone_number
            ? 'https://wa.me/' . preg_replace('/\D+/', '', $this->record->user->phone_number)
              . '?text=' . urlencode(
                  "Hello {$this->record->user->name},\n\n"
                  . "Regarding your car reservation:\n"
                  . "- Car: {$this->record->car->name}\n"
                  . "- Pickup: {$this->record->pickup->name}\n"
                  . "- Drop-off: {$this->record->dropoff->name}\n"
                  . "- From: {$this->record->start_datetime->format('Y-m-d H:i')}\n"
                  . "- To: {$this->record->end_datetime->format('Y-m-d H:i')}\n\n"
                  . "Total Price: SAR{$this->record->total_price}\n\n"
                  . "Thank you!"
              )
            : null;

        return [
            // Custom Edit Action for Status Only
            EditAction::make('update_status')
                ->label(__('admin.form.status'))
                ->icon('heroicon-m-pencil-square')
                ->form([
                    Select::make('status')
                        ->label(__('admin.form.status'))
                        ->options([
                            ReservationStatus::Pending->value   => __('admin.form.options.status.pending'),
                            ReservationStatus::Confirmed->value => __('admin.form.options.status.confirmed'),
                            ReservationStatus::Completed->value => __('admin.form.options.status.completed'),
                            ReservationStatus::Canceled->value  => __('admin.form.options.status.canceled'),
                            ReservationStatus::Overdue->value   => __('admin.form.options.status.overdue'),
                        ])
                        ->required(),
                ]),

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
                ->visible(fn() => !empty($this->record->user?->phone_number)),
        ];
    }
}