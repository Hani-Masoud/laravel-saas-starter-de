<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;
    // Define mass-assignable attributes explicitly
    protected $fillable = [
        'name',
        'country_code',
        'latitude',
        'longitude',
        'sort_order',
        'is_enabled',
    ];

    // Defines inverse relationship to country
    public function country()
    {
        // If using custom key (iso_code):
        return $this->belongsTo(Country::class, 'country_code', 'iso_code');
    }

}
