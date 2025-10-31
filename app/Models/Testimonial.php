<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'location',
        'rating',
        'text',
        'therapy_id',
        'avatar',
    ];

    public function therapy()
    {
        return $this->belongsTo(Therapy::class);
    }
}
