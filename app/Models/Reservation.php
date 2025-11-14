<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ReservationStatus;
use Carbon\Carbon;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'pickup_location_id',
        'dropoff_location_id',
        'start_datetime',
        'end_datetime',
        'total_price',
        'status',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime'   => 'datetime',
        'status'         => ReservationStatus::class, // pending/confirmed/completed/canceled/overdue
    ];

    public function user()     { return $this->belongsTo(User::class); }
    public function car()      { return $this->belongsTo(Car::class); }
    public function pickup()   { return $this->belongsTo(Location::class, 'pickup_location_id'); }
    public function dropoff()  { return $this->belongsTo(Location::class, 'dropoff_location_id'); }

    protected static function booted()
    {
        static::saving(function ($reservation) {
            if ($reservation->car_id && $reservation->start_datetime && $reservation->end_datetime) {
                $car   = Car::find($reservation->car_id);
                $start = Carbon::parse($reservation->start_datetime);
                $end   = Carbon::parse($reservation->end_datetime);
                $days  = max(1, ceil($start->diffInMinutes($end) / 1440));

                if ($car) {
                    $reservation->total_price = $car->price_per_day * $days;
                }
            }
        });
    }
}