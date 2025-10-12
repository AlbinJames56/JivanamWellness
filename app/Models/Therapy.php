<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Therapy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'duration',
        'tag',
        'featured',
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
