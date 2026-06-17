<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $projects = Project::orderBy('display_order', 'asc')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|string|in:completed,under-construction,upcoming',
            'description' => 'required|string',
            'image_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'location' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:255',
            'display_order' => 'required|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Project::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $validated['image_url'] = 'images/' . $fileName;
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in database.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|string|in:completed,under-construction,upcoming',
            'description' => 'required|string',
            'image_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'location' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:255',
            'display_order' => 'required|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Ensure unique slug (excluding self)
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Project::where('slug', $validated['slug'])->where('id', '!=', $project->id)->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $validated['image_url'] = 'images/' . $fileName;
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from database.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
