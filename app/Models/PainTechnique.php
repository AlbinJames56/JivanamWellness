<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PainTechnique extends Model
{
    use HasFactory, SoftDeletes;

    public const CATEGORIES = [
        'massage' => 'Massage',
        'detox' => 'Detox',
        'therapy' => 'Therapy',
         
    ];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'more_info',
        'image',
        'duration',
        'price',
        'price_currency',
        'category',     // keep for BC if still used
        'categories',   // new JSON column (array)
        'featured',
        'available',
        'benefits',
    ];

    protected $casts = [
        'benefits' => 'array',
        'featured' => 'boolean',
        'available' => 'boolean',
        'categories' => 'array', // important
    ];

    // helper to get readable labels
    public function getCategoriesLabelsAttribute(): string
    {
        $cats = $this->categories ?? [];
        if (empty($cats))
            return '';
        return collect($cats)
            ->map(fn($c) => self::CATEGORIES[$c] ?? $c)
            ->filter()
            ->implode(', ');
    }

    public static function categories(): array
    {
        return self::CATEGORIES;
    }
}
