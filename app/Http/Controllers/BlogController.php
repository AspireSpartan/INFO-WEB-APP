<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
use Illuminate\Support\Facades\Validator;
use App\Models\Developer;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource (all blog posts).
     * This method fetches all blog posts and passes them to a view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
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
        $contactUsTitle = ContactUsSectionTitle::first(); 
        $contactUsDetails = ContactUsDetail::first();
        $initialContactUsData = [
            'contactUsTitle' => $contactUsTitle->title,
            // These are now single strings
            'phoneNumbers' => $contactUsDetails->phone_numbers,
            'emailAddresses' => $contactUsDetails->email_addresses,
            'contactAddress' => $contactUsDetails->contact_address,
        ];
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

        $publicOfficialCaption = PublicOfficialCaption::find(1);
        $officials = PublicOfficial::all();
        $projects = Project::all();
        $description = ProjectDescription::first();
        $pageContent = PageContent::pluck('value', 'key')->toArray();
        $blogfeeds = Blogfeed::orderBy('published_at', 'desc')->get();
        $newsItems = NewsItem::orderBy('date', 'desc')->get();
        $contactMessages = ContactMessage::all(); // Or filter if you only need unread messages
        $isViewportPresent = request()->has('viewport'); // Adjust this condition as needed
        $logos = PreviewSection2Logo::select('id', 'logo')->get()->map(function ($logo) {
            if (!Str::startsWith($logo->logo, 'storage/')) {
                $logo->logo = 'storage/' . $logo->logo;
            }
            return $logo;
        });
        $caption = PreviewSection2Caption::value('caption');
        $contentMlogos = ContentManagerLogosImage::all();
        if ($isViewportPresent) {
            return view('Components.Admin.blog.blog_content', compact('blogfeeds'));
        }
        $reports = CedulaReport::orderBy('created_at', 'desc')->paginate(15);
        $developers = Developer::all();
        $applications = BusinessPermit::orderBy('created_at', 'desc')->paginate(15);
        return view('Components.Admin.Ad-Header.Ad-Header', compact('blogfeeds', 'newsItems', 'contactMessages', 'pageContent', 'projects', 'description', 'logos', 'caption', 'contentMlogos', 'publicOfficialCaption', 'officials', 'strategicPlans', 'vmgEditableContentData', 'keepInTouch', 'footerLogo', 'aboutGovph', 'govphLinks', 'concerns', 'governmentlinks', 'footertitle',
         'communityCarouselImages', 'communityContent', 'contentManager', 'contentOffer','contactUsTitle', 'contactUsDetails', 'initialContactUsData', 'reports', 'applications', 'developers'));
    }

    /**
     * Show the form for creating a new resource (new blog post).
     * This method simply returns the view containing the form for creating a new blog post.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        // Redirect to index, flag to show create modal, and set active screen to 'blog'
        return redirect()->route('blogs.index')
                        ->with('showCreateBlogModal', true)
                        ->with('activeAdminScreen', 'Blog'); // Added this line
    }

    /**
     * Store a newly created resource in storage (a new blog post).
     * This method handles the form submission for creating a new blog post,
     * including validation, file uploads, and saving to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Use the Validator facade for manual validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'author' => 'required|string|max:255',
            'authortitle' => 'nullable|string|max:255',
            'image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8049', // Max 8MB
            'icon_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:999',   // Max 999KB
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Redirect back with validation errors, old input, and the flag to reopen the modal
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput()
                             ->with('showCreateBlogModal', true)
                             ->with('activeAdminScreen', 'Blog'); // Added this line for error redirect
        }

        // If validation passes, get the validated data
        $validatedData = $validator->validated();

        $blogfeed = new Blogfeed();

        if ($request->hasFile('image_upload')) {
            $blogfeed->image_path = $request->file('image_upload')->store('blog_images', 'public');
        } else {
            $blogfeed->image_path = null;
        }

        if ($request->hasFile('icon_upload')) {
            $blogfeed->icon_path = $request->file('icon_upload')->store('blog_icons', 'public');
        } else {
            $blogfeed->icon_path = null;
        }

        // Use $validatedData to assign values
        $blogfeed->title = $validatedData['title'];
        $blogfeed->content = $validatedData['content'];
        $blogfeed->published_at = Carbon::parse($validatedData['published_at'])->format('Y-m-d H:i:s'); // Ensure correct date format
        $blogfeed->author = $validatedData['author'];
        $blogfeed->authortitle = $validatedData['authortitle'];

        $blogfeed->save();

        // Redirect back to the blog index and show success, and close the modal
        return redirect()->route('blogs.index')
                        ->with('success', 'Blog post created successfully!')
                        ->with('activeAdminScreen', 'Blog'); // Added this line
    }

    public function show(Blogfeed $blogfeed)
    {
        // This view path might also need adjustment if it's not directly in resources/views/blogs/show.blade.php
        return view('blogs.show', compact('blogfeed')); //currently this line works even if i didn't add these next lines.
    }

    /**
     * Show the form for editing the specified resource (existing blog post).
     * This method retrieves an existing blog post and passes it to an edit form view.
     * It uses Route Model Binding for cleaner code.
     *
     * @param  \App\Models\Blogfeed  $blogfeed
     * @return \Illuminate\View\View
     */
    public function edit(Blogfeed $blogfeed)
    {
        // This path should be correct based on your previous input
        // When going to the edit view, also flash the active screen so a refresh returns to blog view
        session()->flash('activeAdminScreen', 'Blog'); // Added this to set screen on entering edit view
        return view('Components.Admin.blog.edit', compact('blogfeed'));
    }

    /**
     * Update the specified resource in storage (an existing blog post).
     * This method handles the form submission for updating a blog post,
     * including validation, file uploads (replacing old ones), and updating the database.
     * It uses Route Model Binding.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogfeed  $blogfeed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Blogfeed $blogfeed)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'authortitle' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8049', // Max 8MB
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:999',   // Max 999KB
            'published_at' => 'required|date',
        ]);

        $data = $request->except(['_token', '_method', 'image', 'icon']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists before uploading new one
            if ($blogfeed->image_path) {
                Storage::disk('public')->delete($blogfeed->image_path);
            }
            $data['image_path'] = $request->file('image')->store('blog_images', 'public');
        }

        // Handle icon upload
        if ($request->hasFile('icon')) {
            // Delete old icon if it exists before uploading new one
            if ($blogfeed->icon_path) {
                Storage::disk('public')->delete($blogfeed->icon_path);
            }
            $data['icon_path'] = $request->file('icon')->store('blog_icons', 'public');
        }

        // Format published_at to database-friendly format (assuming DATETIME/TIMESTAMP column)
        if ($request->has('published_at')) {
            $data['published_at'] = Carbon::parse($request->input('published_at'))->format('Y-m-d H:i:s');
        }

        $blogfeed->update($data);

        // Redirect back to the blog index and show success message, setting the active screen
        return redirect()->route('blogs.index')
                        ->with('success', 'Blog post updated successfully!')
                        ->with('activeAdminScreen', 'Blog'); // Added this line
    }

    /**
     * Remove the specified resource from storage (a blog post).
     * This method handles deleting a blog post, including its associated image files.
     * It uses Route Model Binding.
     *
     * @param  \App\Models\Blogfeed  $blogfeed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Blogfeed $blogfeed)
    {
        // 1. Delete associated image files from storage
        if ($blogfeed->image_path && Storage::disk('public')->exists($blogfeed->image_path)) {
            Storage::disk('public')->delete($blogfeed->image_path);
        }
        if ($blogfeed->icon_path && Storage::disk('public')->exists($blogfeed->icon_path)) {
            Storage::disk('public')->delete($blogfeed->icon_path);
        }

        // 2. Delete the blog post record from the database
        $blogfeed->delete();

        // 3. Redirect with a success message, ensuring the 'blog' screen is active
        return redirect()->route('blogs.index')
                        ->with('success', 'Blog post deleted successfully!')
                        ->with('activeAdminScreen', 'Blog'); // Added this line
    }
}
