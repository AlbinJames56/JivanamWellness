<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Therapy extends Model
{
    use HasFactory, SoftDeletes;

    // canonical categories used for navigation and grouping
    public const CATEGORIES = [
        'massage' => 'Massage',
        'detox' => 'Detox',
        'therapy' => 'Therapy',
    ];

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
        'categories', // <-- added
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
        'categories' => 'array', // <-- added
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

    /**
     * Return human-readable labels for the categories array.
     */
    public function getCategoriesLabelsAttribute(): string
    {
        $cats = $this->categories ?? [];
        if (empty($cats)) {
            return '';
        }

        return collect($cats)
            ->map(fn($c) => self::CATEGORIES[$c] ?? $c)
            ->filter()
            ->implode(', ');
    }

    /**
     * Return categories list for forms / selects.
     */
    public static function categories(): array
    {
        return self::CATEGORIES;
    }
}
