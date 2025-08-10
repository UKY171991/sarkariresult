<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\I18n\Time;

class Posts extends BaseController
{
    public function index(): string
    {
        $model = new PostModel();
        $posts = $model->orderBy('id', 'DESC')->findAll(50);
        return view('admin/posts/index', ['title' => 'Posts', 'posts' => $posts]);
    }

    public function create()
    {
        $model = new PostModel();
        if ($this->request->getMethod() === 'post') {
            $data = $this->getFormData();
            if ($model->save($data)) {
                return redirect()->to('/admin/posts')->with('message', 'Post created');
            }
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
        return view('admin/posts/form', ['title' => 'Create Post']);
    }

    public function edit(int $id)
    {
        $model = new PostModel();
        $post = $model->find($id);
        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Post not found');
        }
        if ($this->request->getMethod() === 'post') {
            $data = $this->getFormData();
            $data['id'] = $id;
            if ($model->save($data)) {
                return redirect()->to('/admin/posts')->with('message', 'Post updated');
            }
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
        return view('admin/posts/form', ['title' => 'Edit Post', 'post' => $post]);
    }

    public function delete(int $id)
    {
        $model = new PostModel();
        $model->delete($id);
        return redirect()->to('/admin/posts')->with('message', 'Post deleted');
    }

    private function getFormData(): array
    {
        $title = trim((string) $this->request->getPost('title'));
        $slug = trim((string) $this->request->getPost('slug'));
        if ($slug === '') {
            $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $title));
        }
        $published = $this->request->getPost('status') === 'published';
        return [
            'title' => $title,
            'slug' => $slug,
            'summary' => (string) $this->request->getPost('summary'),
            'category' => (string) $this->request->getPost('category'),
            'external_url' => (string) $this->request->getPost('external_url'),
            'status' => $published ? 'published' : 'draft',
            'published_at' => $published ? (string) ($this->request->getPost('published_at') ?: Time::now()->toDateTimeString()) : null,
        ];
    }
}
