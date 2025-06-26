<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobPosts = JobPost::with('category')->latest()->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.job-posts.index', compact('jobPosts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.job-posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'organization' => 'required|string|max:255',
            'total_posts' => 'nullable|integer|min:1',
            'location' => 'nullable|string|max:255',
            'application_fee' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'exam_date' => 'nullable|date',
            'official_website' => 'nullable|url',
            'notification_pdf' => 'nullable|url',
            'application_link' => 'nullable|url',
            'status' => 'required|in:active,inactive,expired',
            'is_featured' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (JobPost::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        JobPost::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Job post created successfully!']);
        }

        return redirect()->route('admin.job-posts.index')
            ->with('success', 'Job post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $jobPost)
    {
        $jobPost->load('category', 'admitCards', 'answerKeys');
        return view('admin.job-posts.show', compact('jobPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $jobPost)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.job-posts.edit', compact('jobPost', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPost $jobPost)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'organization' => 'required|string|max:255',
            'total_posts' => 'nullable|integer|min:1',
            'location' => 'nullable|string|max:255',
            'application_fee' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'exam_date' => 'nullable|date',
            'official_website' => 'nullable|url',
            'notification_pdf' => 'nullable|url',
            'application_link' => 'nullable|url',
            'status' => 'required|in:active,inactive,expired',
            'is_featured' => 'boolean'
        ]);

        // Only update slug if title changed
        if ($validated['title'] !== $jobPost->title) {
            $validated['slug'] = Str::slug($validated['title']);
            
            // Ensure unique slug (excluding current record)
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (JobPost::where('slug', $validated['slug'])->where('id', '!=', $jobPost->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        $jobPost->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Job post updated successfully!']);
        }

        return redirect()->route('admin.job-posts.index')
            ->with('success', 'Job post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $jobPost)
    {
        $jobPost->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Job post deleted successfully!']);
        }

        return redirect()->route('admin.job-posts.index')
            ->with('success', 'Job post deleted successfully.');
    }
}
