<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnswerKey extends Model
{
    protected $fillable = [
        'job_post_id',
        'title',
        'slug',
        'description',
        'organization',
        'exam_date',
        'download_link',
        'official_website',
        'instructions',
        'status',
        'downloads'
    ];

    protected $casts = [
        'exam_date' => 'date',
    ];

    public function jobPost(): BelongsTo
    {
        return $this->belongsTo(JobPost::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function incrementDownloads()
    {
        $this->increment('downloads');
    }
}
