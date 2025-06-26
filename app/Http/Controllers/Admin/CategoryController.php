<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Category created successfully!']);
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Category updated successfully!']);
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check if category has job posts
        if ($category->jobPosts()->count() > 0) {
            if (request()->ajax()) {
                return response()->json(['error' => true, 'message' => 'Cannot delete category with associated job posts.'], 409);
            }
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category with associated job posts.');
        }

        $category->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Category deleted successfully!']);
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
