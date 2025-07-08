<?php
//app\Http\Controllers\ProjectController.php
namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Project;
use App\Models\Blogfeed;
use App\Models\NewsItem;
use App\Models\PageContent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\ProjectDescription;
use App\Models\PreviewSection2Logo;
use App\Models\PreviewSection2Caption;
use Illuminate\Support\Facades\Storage;
use App\Models\ContentManagerLogosImage;

class ProjectController extends Controller
{
public function index() // user side
{
    $projects = Project::all(); 

    $projects->transform(function ($project) {
        if (Str::startsWith($project->image_url, 'storage/')) {
            $project->image_url = asset($project->image_url);
        } else {
            $project->image_url = asset('storage/' . $project->image_url);
        }
        return $project;
    });

    return view('Components.User.showallproject.showallproject', compact('projects'));
}

    public function indexAdmin(Request $request){ //admin side on project_content
        $projects = Project::query()
            ->search($request->input('search'))
            ->get();

        $description = ProjectDescription::first();
        $newsItems = NewsItem::all(); // Correctly fetch news items
        $pageContent = PageContent::pluck('value', 'key')->toArray();
        $contactMessages = ContactMessage::latest()->get();
        $blogfeeds = Blogfeed::all();
        $logos = PreviewSection2Logo::select('id', 'logo')->get()->map(function ($logo) {
            if (!Str::startsWith($logo->logo, 'storage/')) {
                $logo->logo = 'storage/' . $logo->logo;
            }
            return $logo;
        });
        $caption = PreviewSection2Caption::value('caption');
        $contentMlogos = ContentManagerLogosImage::all();
        
        session()->flash('activeAdminScreen', 'projects');
        return view('Components.Admin.Ad-Header.Ad-Header', compact('newsItems', 'request', 'contactMessages', 'blogfeeds', 'pageContent', 'projects', 'description', 'logos', 'caption', 'contentMlogos'));
    }

    
    public function indexContent(){//admin side on project_cards
        $projects = Project::all();
        return view('Components.Admin.blog.projects.project_cards', compact('projects'));
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'site' => 'required|string|max:255',
        'scope' => 'required|string|max:255',
        'outcome' => 'required|string|max:255',
        'url' => 'nullable|url|max:255',
        'image_upload' => 'required|image|max:8192',
    ]);

    if ($request->hasFile('image_upload')) {
        $path = $request->file('image_upload')->store('projects_images', 'public'); // changed here
        $validated['image_url'] = $path;
    }

    Project::create($validated);
    session()->flash('activeAdminScreen', 'projects');
    return redirect()->back()->with('success', 'Project created successfully.');
    }

    public function destroy(Project $project)
    {
        // Delete the project image from storage if exists
        if ($project->image_url && Storage::disk('public')->exists($project->image_url)) {
            Storage::disk('public')->delete($project->image_url);
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
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'site' => 'required|string|max:255',
        'scope' => 'required|string|max:255',
        'outcome' => 'required|string|max:255',
        'url' => 'nullable|url|max:255',
        'image_upload' => 'nullable|image|max:8192',
    ]);

    if ($request->hasFile('image_upload')) {
        if ($project->image_url && Storage::disk('public')->exists($project->image_url)) {
            Storage::disk('public')->delete($project->image_url);
        }
        $path = $request->file('image_upload')->store('projects_images', 'public'); // changed here
        $validated['image_url'] = $path;
    }

    $project->update($validated);
    session()->flash('activeAdminScreen', 'projects');
    return redirect()->route('admin.dashboard')->with('success', 'Project updated successfully.');
    }

}
