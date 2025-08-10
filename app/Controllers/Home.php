<?php

namespace App\Controllers;

use App\Models\PostModel;

class Home extends BaseController
{
    public function index(): string
    {
        $postModel = new PostModel();
        $data = [
            'title' => 'Sarkari Portal',
            'jobs' => $postModel->getLatestByCategory('job', 10),
            'results' => $postModel->getLatestByCategory('result', 10),
            'admit_cards' => $postModel->getLatestByCategory('admit_card', 10),
        ];

        return view('home/index', $data);
    }
}
