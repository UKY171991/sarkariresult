<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnswerKey;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnswerKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answerKeys = AnswerKey::with('jobPost')->latest()->get();
        $jobPosts = JobPost::where('status', 'active')->orderBy('title')->get();
        
        return view('admin.answer-keys.index', compact('answerKeys', 'jobPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobPosts = JobPost::where('status', 'active')->orderBy('title')->get();
        return view('admin.answer-keys.create', compact('jobPosts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_post_id' => 'required|exists:job_posts,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'organization' => 'required|string|max:255',
            'exam_date' => 'nullable|date',
            'download_link' => 'required|url',
            'official_website' => 'nullable|url',
            'instructions' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (AnswerKey::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        AnswerKey::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Answer key created successfully!']);
        }

        return redirect()->route('admin.answer-keys.index')
            ->with('success', 'Answer key created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnswerKey $answerKey)
    {
        $answerKey->load('jobPost');
        return view('admin.answer-keys.show', compact('answerKey'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnswerKey $answerKey)
    {
        $jobPosts = JobPost::where('status', 'active')->orderBy('title')->get();
        return view('admin.answer-keys.edit', compact('answerKey', 'jobPosts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnswerKey $answerKey)
    {
        $validated = $request->validate([
            'job_post_id' => 'required|exists:job_posts,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'organization' => 'required|string|max:255',
            'exam_date' => 'nullable|date',
            'download_link' => 'required|url',
            'official_website' => 'nullable|url',
            'instructions' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        // Only update slug if title changed
        if ($validated['title'] !== $answerKey->title) {
            $validated['slug'] = Str::slug($validated['title']);
            
            // Ensure unique slug (excluding current record)
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (AnswerKey::where('slug', $validated['slug'])->where('id', '!=', $answerKey->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        $answerKey->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Answer key updated successfully!']);
        }

        return redirect()->route('admin.answer-keys.index')
            ->with('success', 'Answer key updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnswerKey $answerKey)
    {
        $answerKey->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Answer key deleted successfully!']);
        }

        return redirect()->route('admin.answer-keys.index')
            ->with('success', 'Answer key deleted successfully.');
    }
}
