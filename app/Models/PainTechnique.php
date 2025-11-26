<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PainTechnique extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'more_info',
        'image',
        'duration',
        'price',
        'price_currency',
        'featured',
        'available',
        'benefits',
    ];

    protected $casts = [
        'benefits' => 'array',
        'featured' => 'boolean',
        'available' => 'boolean',
    ];

    // (no categories related helpers here anymore)
}
