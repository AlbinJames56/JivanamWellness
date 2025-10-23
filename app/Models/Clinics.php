<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinics extends Model
{
    /** @use HasFactory<\Database\Factories\ClinicsFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'address',
        'city',
        'hours',
        'phone',
        'image',
        'is_open',
        'specialties',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'specialties' => 'array',
    ];

    // Optional helper
    public function getPrimarySpecialtyAttribute()
    {
        return is_array($this->specialties) && count($this->specialties)
            ? $this->specialties[0]
            : null;
    }
}
