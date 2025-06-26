<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\JobPost;
use App\Models\AdmitCard;
use App\Models\AnswerKey;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $jobs = JobPost::with('category')
            ->where('status', 'active');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $jobs->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('organization', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Apply category filter
        if ($request->filled('category_id')) {
            $jobs->where('category_id', $request->category_id);
        }

        // Apply location filter
        if ($request->filled('location')) {
            $jobs->where('location', 'like', "%{$request->location}%");
        }

        // Apply date filter
        if ($request->filled('posted_within')) {
            $days = $request->posted_within;
            if ($days !== 'all') {
                $jobs->where('created_at', '>=', now()->subDays($days));
            }
        }

        // Apply sorting
        $sortBy = $request->get('sort_by', 'latest');
        switch ($sortBy) {
            case 'title':
                $jobs->orderBy('title');
                break;
            case 'end_date':
                $jobs->orderBy('end_date');
                break;
            case 'views':
                $jobs->orderBy('views', 'desc');
                break;
            default:
                $jobs->latest();
        }

        $jobs = $jobs->paginate(20)->withQueryString();

        return view('jobs.index', compact('categories', 'jobs'));
    }

    public function category(Category $category)
    {
        $jobs = JobPost::with('category')
            ->where('category_id', $category->id)
            ->where('status', 'active')
            ->latest()
            ->paginate(20);

        return view('jobs.category', compact('category', 'jobs'));
    }

    public function categories()
    {
        $categories = Category::where('is_active', true)
            ->withCount(['jobPosts' => function($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('sort_order')
            ->get();

        return view('jobs.categories', compact('categories'));
    }

    public function show(JobPost $jobPost)
    {
        $jobPost->incrementViews();
        $jobPost->load('category', 'admitCards', 'answerKeys');

        $relatedJobs = JobPost::where('category_id', $jobPost->category_id)
            ->where('id', '!=', $jobPost->id)
            ->where('status', 'active')
            ->latest()
            ->take(5)
            ->get();

        return view('jobs.show', compact('jobPost', 'relatedJobs'));
    }

    public function admitCards()
    {
        $admitCards = AdmitCard::with('jobPost')
            ->where('status', 'active')
            ->latest()
            ->paginate(20);

        return view('admit-cards', compact('admitCards'));
    }

    public function answerKeys()
    {
        $answerKeys = AnswerKey::with('jobPost')
            ->where('status', 'active')
            ->latest()
            ->paginate(20);

        return view('answer-keys', compact('answerKeys'));
    }

    public function latestJobs()
    {
        $categories = Category::where('is_active', true)
            ->withCount('jobPosts')
            ->orderBy('sort_order')
            ->get();
            
        $jobs = JobPost::with('category')
            ->where('status', 'active')
            ->latest()
            ->paginate(20);

        return view('latest-jobs', compact('jobs', 'categories'));
    }

    public function results()
    {
        $jobs = JobPost::with('category')
            ->where('status', 'active')
            ->latest()
            ->paginate(20);

        return view('results', compact('jobs'));
    }

    public function search(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $jobs = collect();
        
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            
            $jobs = JobPost::with('category')
                ->where('status', 'active')
                ->where(function($query) use ($searchTerm) {
                    $query->where('title', 'like', "%{$searchTerm}%")
                          ->orWhere('organization', 'like', "%{$searchTerm}%")
                          ->orWhere('description', 'like', "%{$searchTerm}%")
                          ->orWhere('location', 'like', "%{$searchTerm}%");
                })
                ->latest()
                ->paginate(20)
                ->withQueryString();
        }

        return view('jobs.search', compact('categories', 'jobs'));
    }
}
