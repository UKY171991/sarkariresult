<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\JobPost;
use App\Models\AdmitCard;
use App\Models\AnswerKey;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $latestJobs = JobPost::with('category')
            ->where('status', 'active')
            ->latest()
            ->take(10)
            ->get();

        $featuredJobs = JobPost::with('category')
            ->where('status', 'active')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $latestAdmitCards = AdmitCard::with('jobPost')
            ->where('status', 'active')
            ->latest()
            ->take(5)
            ->get();

        $latestAnswerKeys = AnswerKey::with('jobPost')
            ->where('status', 'active')
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact(
            'categories',
            'latestJobs',
            'featuredJobs',
            'latestAdmitCards',
            'latestAnswerKeys'
        ));
    }
}
