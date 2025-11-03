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
            
            if ($reservation->car_id && $reservation->start_datetime && $reservation->end_datetime) {
                
                $car = Car::find($reservation->car_id);
                $start = Carbon::parse($reservation->start_datetime);
                $end = Carbon::parse($reservation->end_datetime);
                
                // Calculate duration in total minutes
                $minutes = $start->diffInMinutes($end);
                
                // Convert minutes to days, rounding up.
                // (24 hours * 60 minutes = 1440 minutes per day)
                $days = ceil($minutes / 1440);

                // Ensure a minimum of 1 day rental
                if ($days <= 0) {
                    $days = 1;
                }

                if ($car) {
                    $reservation->total_price = $car->price_per_day * $days;
                }
            }
        });
    }
}
