<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPost extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'organization',
        'total_posts',
        'location',
        'application_fee',
        'start_date',
        'end_date',
        'exam_date',
        'official_website',
        'notification_pdf',
        'application_link',
        'status',
        'is_featured',
        'views'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'exam_date' => 'date',
        'application_fee' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function admitCards(): HasMany
    {
        return $this->hasMany(AdmitCard::class);
    }

    public function answerKeys(): HasMany
    {
        return $this->hasMany(AnswerKey::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
