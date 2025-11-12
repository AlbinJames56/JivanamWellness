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
        'excerpt',
        'content',
        'image',
        'image_alt',
        'gallery', // json
        'duration',
        'tags',
        'featured',
        'price',
        'price_currency',
        'available',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'available' => 'boolean',
        'benefits' => 'array',
        'contraindications' => 'array',
        'gallery' => 'array',
        'tags' => 'array',
    ];

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
    public function getTagsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        return $value ?: [];
    }

}
