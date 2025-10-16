<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'read_time',
        'published',
        'published_at',
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // optional: compute read time if not provided (approx 200 wpm)
    public function getEstimatedReadTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content ?? ''));
        return (int) max(1, ceil($words / 200));
    }
}
