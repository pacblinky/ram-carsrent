<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'location_id',
        'start_datetime',
        'end_datetime',
        'total_price',
        'status'
    ];

    protected $casts = [
    'start_datetime' => 'datetime',
    'end_datetime' => 'datetime',
    'status' => 'boolean'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // Automatically calculate total price (optional)
    protected static function booted()
    {
        static::saving(function ($reservation) {
            if ($reservation->car && $reservation->start_date && $reservation->end_date) {
                $days = now()
                    ->parse($reservation->start_date)
                    ->diffInDays(now()->parse($reservation->end_date)) ?: 1;

                $reservation->total_price = $reservation->car->price_per_day * $days;
            }
        });
    }
}
