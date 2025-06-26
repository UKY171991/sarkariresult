<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\JobPost;
use App\Models\AdmitCard;
use App\Models\AnswerKey;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_categories' => Category::count(),
            'total_jobs' => JobPost::count(),
            'active_jobs' => JobPost::where('status', 'active')->count(),
            'total_admit_cards' => AdmitCard::count(),
            'total_answer_keys' => AnswerKey::count(),
            'total_users' => User::count(),
        ];

        $latestJobs = JobPost::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestJobs'));
    }
}
