<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapEmbed extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'embed_code',
        'location_name', 
        'google_maps_link',
        'sort_order',
    ];
}
