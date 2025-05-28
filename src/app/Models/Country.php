<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;

    protected $primaryKey = 'iso_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'iso_code',
        'name_de',
        'name_en',
        'sort_order',
        'is_enabled',
    ]; //  Allow mass
    public function cities(){
        // If using custom key (iso_code)
        return $this->hasMany(City::class, 'country_code', 'iso_code');
    }
    public function getTranslatedNameAttribute(): string
    {
        $locale = app()->getLocale();
        return $this->{"name_" . $locale} ?? $this->name_de;
    }

}
