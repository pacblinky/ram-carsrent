<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'brand_id',
        'category',
        'fuel_type',
        'transmission',
        'number_of_seats',
        'number_of_doors',
        'quantity', // Added quantity to fillable
        'price_per_day',
        'location_id', 
        'description', 
        'is_available',
        'images'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'images' => 'array'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function getImageUrlsAttribute()
    {
        return collect($this->images)->map(fn ($img) => asset('storage/' . $img));
    }
}