<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Project;
use App\Models\Blogfeed;
use App\Models\NewsItem;
use App\Models\PageContent;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\ProjectDescription;

class ProjectController extends Controller
{
    public function index()//user side
    {
        $projects = Project::all();
        return view('Components.User.showallproject.showallproject', compact('projects'));
    }

    public function indexAdmin(Request $request){ //admin side on project_content
        $query = Project::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('site', 'like', "%{$search}%")
                ->orWhere('scope', 'like', "%{$search}%")
                ->orWhere('outcome', 'like', "%{$search}%");
            });
    }

        // Remove sorting by views and date, no sorting applied now

        $projects = $query->get();
        $description = ProjectDescription::first();
        $newsItems = NewsItem::all(); // Correctly fetch news items
        $pageContent = PageContent::pluck('value', 'key')->toArray();
        $contactMessages = ContactMessage::latest()->get();
        $blogfeeds = Blogfeed::all();
        session()->flash('activeAdminScreen', 'projects');

        return view('Components.Admin.Ad-Header.Ad-Header', compact('newsItems', 'request', 'contactMessages', 'blogfeeds', 'pageContent', 'projects', 'description'));
    }

    
    public function indexContent(){//admin side on project_cards
        $projects = Project::all();
        return view('Components.Admin.blog.projects.project_cards', compact('projects'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'site' => 'required|string|max:255',
            'scope' => 'required|string|max:255',
            'outcome' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'image_upload' => 'required|image|max:8192', // max 8MB
        ]);

        // Handle image upload
        if ($request->hasFile('image_upload')) {
            $path = $request->file('image_upload')->store('projects', 'public');
            $validated['image_url'] = $path;
        }

        // Create new project
        Project::create($validated);
        session()->flash('activeAdminScreen', 'projects');
        // Redirect back with success message
        return redirect()->back()->with('success', 'Project created successfully.');
    }

    public function destroy(Project $project)
    {
        // Delete the project image from storage if exists
        if ($project->image_url && \Storage::disk('public')->exists($project->image_url)) {
            \Storage::disk('public')->delete($project->image_url);
        }

        // Delete the project record
        $project->delete();
        session()->flash('activeAdminScreen', 'projects');
        // Redirect back with success message
        return redirect()->back()->with('success', 'Project deleted successfully.');
    }

    public function edit(Project $project)
    {
    // Return the view with the project data for editing
    session()->flash('activeAdminScreen', 'projects'); // Added this to set screen on entering edit view
    return view('Components.Admin.blog.projects.projEdit_modal', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
    // Validate incoming request data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'site' => 'required|string|max:255',
        'scope' => 'required|string|max:255',
        'outcome' => 'required|string|max:255',
        'url' => 'nullable|url|max:255',
        'image_upload' => 'nullable|image|max:8192', // max 8MB, optional on update
    ]);

    // Handle image upload if new image is provided
    if ($request->hasFile('image_upload')) {
        // Delete old image if exists
        if ($project->image_url && \Storage::disk('public')->exists($project->image_url)) {
            \Storage::disk('public')->delete($project->image_url);
        }
        $path = $request->file('image_upload')->store('projects', 'public');
        $validated['image_url'] = $path;
    }

    // Update project with validated data
    $project->update($validated);
    session()->flash('activeAdminScreen', 'projects');
    // Redirect back with success message
    return redirect()->route('admin.dashboard')->with('success', 'Project updated successfully.');
    }

}