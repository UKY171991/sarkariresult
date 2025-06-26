<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmitCard;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdmitCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admitCards = AdmitCard::with('jobPost')->latest()->get();
        $jobPosts = JobPost::where('status', 'active')->orderBy('title')->get();
        
        return view('admin.admit-cards.index', compact('admitCards', 'jobPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobPosts = JobPost::where('status', 'active')->orderBy('title')->get();
        return view('admin.admit-cards.create', compact('jobPosts'));
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
        while (AdmitCard::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        AdmitCard::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Admit card created successfully!']);
        }

        return redirect()->route('admin.admit-cards.index')
            ->with('success', 'Admit card created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdmitCard $admitCard)
    {
        $admitCard->load('jobPost');
        return view('admin.admit-cards.show', compact('admitCard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdmitCard $admitCard)
    {
        $jobPosts = JobPost::where('status', 'active')->orderBy('title')->get();
        return view('admin.admit-cards.edit', compact('admitCard', 'jobPosts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdmitCard $admitCard)
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
        if ($validated['title'] !== $admitCard->title) {
            $validated['slug'] = Str::slug($validated['title']);
            
            // Ensure unique slug (excluding current record)
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (AdmitCard::where('slug', $validated['slug'])->where('id', '!=', $admitCard->id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        $admitCard->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Admit card updated successfully!']);
        }

        return redirect()->route('admin.admit-cards.index')
            ->with('success', 'Admit card updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdmitCard $admitCard)
    {
        $admitCard->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Admit card deleted successfully!']);
        }

        return redirect()->route('admin.admit-cards.index')
            ->with('success', 'Admit card deleted successfully.');
    }
}
