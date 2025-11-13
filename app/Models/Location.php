<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'google_maps_link',
        'google_maps_embed'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
