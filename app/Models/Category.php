<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function jobPosts(): HasMany
    {
        return $this->hasMany(JobPost::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
