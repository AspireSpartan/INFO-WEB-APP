<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Project;
use App\Models\Blogfeed;
use App\Models\NewsItem;
use App\Models\GovphLink;
use App\Models\AboutGovph;
use App\Models\FooterLogo;
use App\Models\FooterTitle;
use App\Models\KeepInTouch;
use App\Models\PageContent;
use Illuminate\Support\Str;
use App\Models\AboutUsOffer;
use App\Models\CedulaReport;
use Illuminate\Http\Request;
use App\Models\StrategicPlan;
use App\Models\BusinessPermit;
use App\Models\ContactMessage;
use App\Models\GovernmentLink;
use App\Models\PublicOfficial;
use App\Models\ContactUsDetail;
use App\Models\ReportedConcern;
use App\Models\CommunityContent;
use App\Models\ProjectDescription;
use App\Models\PreviewSection2Logo;
use App\Models\AboutUsContentManager;
use App\Models\ContactUsSectionTitle;
use App\Models\PublicOfficialCaption;
use App\Models\CommunityCarouselImage;
use App\Models\PreviewSection2Caption;
use Illuminate\Support\Facades\Storage;
use App\Models\ContentManagerLogosImage;
use App\Models\Developer;

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
        $publicOfficialCaption = PublicOfficialCaption::find(1);
        $officials = PublicOfficial::all();

        $strategicPlans = StrategicPlan::all();

        $vision = $strategicPlans->where('id', 1)->first();
        $mission = $strategicPlans->where('id', 2)->first();
        $goal = $strategicPlans->where('id', 3)->first();

        $visionIcon = ContentManagerLogosImage::find(3);
        $missionIcon = ContentManagerLogosImage::find(4);
        $goalIcon = ContentManagerLogosImage::find(5);
        $keepInTouch = KeepInTouch::with('socialLinks')->firstOrFail();
        $footerLogo = FooterLogo::first();
        $aboutGovph = AboutGovph::first();
        $govphLinks = GovphLink::all();
        $concerns = ReportedConcern::orderBy('created_at', 'desc')->paginate(15);
        $governmentlinks = GovernmentLink::all();
        $footertitle = FooterTitle::first();
        $communityContent = CommunityContent::pluck('content', 'key')->toArray();
        $communityContent = array_merge([
            'main_title_part1' => '',
            'main_title_part2' => '',
            'subtitle_paragraph' => '',
            'footer_text' => '',
        ], $communityContent);
        $communityCarouselImages = CommunityCarouselImage::orderBy('order')->get();
        $contentManager = AboutUsContentManager::pluck('content', 'key')->toArray();
        $contentOffer = AboutUsOffer::all();

        $vmgEditableContentData = [
            'vision' => [
                'icon' => $visionIcon ? asset($visionIcon->image_path) : asset('storage/Vision.svg'),
                'title' => $vision ? $vision->title : '',
                'paragraph' => $vision ? $vision->paragraph : '',
            ],
            'mission' => [
                'icon' => $missionIcon ? asset($missionIcon->image_path) : asset('storage/Mission.svg'),
                'title' => $mission ? $mission->title : '',
                'paragraph' => $mission ? $mission->paragraph : '',
            ],
            'goal' => [
                'icon' => $goalIcon ? asset($goalIcon->image_path) : asset('storage/goal.svg'),
                'title' => $goal ? $goal->title : '',
                'paragraph' => $goal ? $goal->paragraph : '',
            ],
        ];
        $reports = CedulaReport::orderBy('created_at', 'desc')->paginate(15);
        $applications = BusinessPermit::orderBy('created_at', 'desc')->paginate(15);
        $contactUsTitle = ContactUsSectionTitle::first();
        $contactUsDetails = ContactUsDetail::first();
        $developers = Developer::all();
        $initialContactUsData = [
            'contactUsTitle' => $contactUsTitle->title,
            // These are now single strings
            'phoneNumbers' => $contactUsDetails->phone_numbers,
            'emailAddresses' => $contactUsDetails->email_addresses,
            'contactAddress' => $contactUsDetails->contact_address,
        ];
        session()->flash('activeAdminScreen', 'projects');
        return view('Components.Admin.Ad-Header.Ad-Header', compact('newsItems', 'request', 'contactMessages', 'blogfeeds', 'pageContent', 'projects', 'description', 'logos', 'caption', 'contentMlogos', 'publicOfficialCaption',
         'officials','vmgEditableContentData', 'strategicPlans', 'reports', 'keepInTouch', 'footerLogo', 'aboutGovph', 'govphLinks', 'concerns', 'governmentlinks', 'footertitle', 'communityCarouselImages', 'communityContent', 'contentManager', 'contentOffer', 'contactUsTitle', 'contactUsDetails', 'initialContactUsData','applications', 'developers'));
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
