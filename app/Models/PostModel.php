<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'title',
        'slug',
        'category',
        'external_url',
        'status',
        'published_at',
        'summary',
    ];

    protected $useSoftDeletes = false;

    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'slug' => 'required|min_length[3]|max_length[255]|is_unique[posts.slug,id,{id}]',
        'category' => 'required|in_list[job,result,admit_card,answer_key,syllabus]',
    'external_url' => 'permit_empty|valid_url',
        'status' => 'required|in_list[draft,published]',
        'published_at' => 'permit_empty|valid_date[Y-m-d H:i:s]'
    ];

    public function getLatestByCategory(string $category, int $limit = 25): array
    {
        return $this->where('category', $category)
            ->where('status', 'published')
            ->orderBy('published_at', 'DESC')
            ->findAll($limit);
    }
}
