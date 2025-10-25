<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    /** @use HasFactory<\Database\Factories\TeamMemberFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'title',
        'specialization',
        'experience',
        'bio',
        'image',
        'featured',
        'sort_order',
        'active',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
