<?php

namespace App\Controllers;

use App\Models\PostModel;

class Category extends BaseController
{
    public function index(string $slug): string
    {
        $map = [
            'exam-result' => 'result',
            'admit-card' => 'admit_card',
            'top-online-form' => 'job',
            'answer-keys' => 'answer_key',
            'syllabus' => 'syllabus',
            'admission-form' => 'job',
            'document-verification' => 'job',
            'diploma-iti' => 'job',
            'b-tech-m-tech' => 'job',
            'hot-job' => 'job',
        ];
        $category = $map[$slug] ?? null;
        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Unknown category");
        }
        $model = new PostModel();
        $posts = $model->where('category', $category)->where('status', 'published')->orderBy('published_at','DESC')->findAll(100);
        return view('category/index', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'posts' => $posts,
        ]);
    }
}
