<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Completed = 'completed';
    case Canceled = 'canceled';
    case Overdue = 'overdue';

    // Optional: readable label for UI or API
    public function label(): string
    {
        return match($this) {
            self::Pending   => 'Pending',
            self::Confirmed => 'Confirmed',
            self::Completed => 'Completed',
            self::Canceled  => 'Canceled',
            self::Overdue   => 'Overdue', // Added Overdue label
        };
    }

    // Optional: color or badge style for frontend
    public function color(): string
    {
        return match($this) {
            self::Pending   => 'warning',
            self::Confirmed => 'info',
            self::Completed => 'success',
            self::Canceled  => 'danger',
            self::Overdue   => 'gray',
        };
    }
}