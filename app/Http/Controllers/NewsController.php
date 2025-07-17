<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Log; // Added for logging
use App\Models\News; 
use App\Models\Developer; // Ensure this is imported if you're using it in the controller

class NewsController extends Controller
{
    /**
     * Display a listing of the news items (for admin dashboard).
     * This function now serves as the index for news items in the admin area.
     */

    public function index(Request $request)
    {
        $newsItems = NewsItem::query()
            ->search($request->input('search'))
            ->filterBySponsored($request->input('sponsored_filter', 'all'))
            ->sortBy($request->input('sort_by', 'date_desc'))
            ->get();

        $projects = Project::all();
        $description = ProjectDescription::first();
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

        $footerLogo = FooterLogo::first();
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
        $reports = CedulaReport::orderBy('created_at', 'desc')->paginate(15);
        $applications = BusinessPermit::orderBy('created_at', 'desc')->paginate(15);
        return view('Components.Admin.Ad-Header.Ad-Header', compact('newsItems', 'request', 'contactMessages', 'blogfeeds', 'pageContent', 'projects', 'description', 'logos', 'caption', 'contentMlogos', 'publicOfficialCaption', 'officials', 'strategicPlans', 'vmgEditableContentData', 'keepInTouch' , 'aboutGovph' , 'footerLogo', 'govphLinks',
         'concerns', 'governmentlinks', 'footertitle', 'communityCarouselImages', 'communityContent', 'contentManager', 'contentOffer','reports','contactUsTitle','contactUsDetails','initialContactUsData','applications', 'developers'));
    }

    /**
     * Remove multiple specified news items from storage.
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array', // Expect 'ids'
            'ids.*' => 'exists:news_items,id',
        ]);

        $newsItemIds = $request->input('ids'); // Get 'ids'

        if (empty($newsItemIds)) {
            // Redirect to news index and keep on news screen
            return redirect()->route('news.index')
                             ->with('error', 'No news items selected for deletion.')
                             ->with('activeAdminScreen', 'news');
        }

        foreach ($newsItemIds as $id) {
            $newsItem = NewsItem::find($id);
            if ($newsItem) {
                // Delete associated image from storage
                if ($newsItem->picture && Storage::disk('public')->exists($newsItem->picture)) {
                    Storage::disk('public')->delete($newsItem->picture);
                    Log::info('Image deleted during bulk news item destruction: ' . $newsItem->picture);
                }
                $newsItem->delete();
                Log::info('News item deleted during bulk operation: ' . $id);
            }
        }

        // Redirect to news index and keep on news screen
        return redirect()->route('news.index')
                         ->with('success', 'Selected news items deleted successfully!')
                         ->with('activeAdminScreen', 'news');
    }

    /**
     * Show the form for creating a new news item.
     * This method redirects to the news index with a flag to open the create modal.
     */
    public function create()
    {
        // Redirect to news index, flag to show create modal, and set active screen to 'news'
        // CHANGED: showCreateNewsModal to showUploadModal to match your existing modal component
        return redirect()->route('news.index')
                         ->with('showUploadModal', true) // Flag to open the existing upload modal
                         ->with('activeAdminScreen', 'news'); // Ensure 'news' screen is active
    }

    /**
     * Store a newly created news item in storage.
     */
    public function store(Request $request)
    {
        Log::info('News item store request:', $request->all());

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8242880', // Max 8MB
            'author' => 'required|string|max:255',
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'sponsored' => 'boolean',
            'views' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('news_images', 'public');
                $validatedData['picture'] = $imagePath;
                Log::info('Image uploaded successfully: ' . $imagePath);
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                // CHANGED: showCreateNewsModal to showUploadModal for error redirect
                return redirect()->back()
                                 ->withInput()
                                 ->withErrors(['image' => 'Failed to upload image. Please try again.'])
                                 ->with('showUploadModal', true) // Re-open the existing upload modal on error
                                 ->with('activeAdminScreen', 'news'); // Keep on news screen
            }
        } else {
            Log::warning('No image file found in the request.');
            // CHANGED: showCreateNewsModal to showUploadModal for error redirect
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['image' => 'Image file is required.'])
                             ->with('showUploadModal', true) // Re-open the existing upload modal on error
                             ->with('activeAdminScreen', 'news'); // Keep on news screen
        }

        $validatedData['sponsored'] = $request->has('sponsored');
        $validatedData['views'] = $validatedData['views'] ?? 0;

        try {
            NewsItem::create($validatedData);
            Log::info('News item created successfully.', $validatedData);
            // Redirect to news index and keep on news screen
            return redirect()->route('news.index')
                             ->with('success', 'News item uploaded successfully!')
                             ->with('activeAdminScreen', 'news');
        } catch (\Exception $e) {
            Log::error('Failed to create news item: ' . $e->getMessage());
            // CHANGED: showCreateNewsModal to showUploadModal for error redirect
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['error' => 'Failed to save news item. Please try again.'])
                             ->with('showUploadModal', true) // Re-open the existing upload modal on error
                             ->with('activeAdminScreen', 'news'); // Keep on news screen
        }
    }

    /**
     * Display the specified news item (for public view).
     */
    

    /**
     * Show the form for editing the specified news item.
     */
    public function edit($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        // Ensure 'news' screen is active if refreshed or returning from edit
        session()->flash('activeAdminScreen', 'news');
        return view('Components.Admin.edit.edit', compact('newsItem')); // Assuming this is your news edit view
    }

    /**
     * Update the specified news item in storage.
     */
    public function update(Request $request, $id)
    {
        $newsItem = NewsItem::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date' => 'required|date',
            'url' => 'required|url',
            'sponsored' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8242880', // Max 8MB
            'views' => 'nullable|integer|min:0',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($newsItem->picture && Storage::disk('public')->exists($newsItem->picture)) {
                Storage::disk('public')->delete($newsItem->picture);
                Log::info('Old image deleted: ' . $newsItem->picture);
            }
            // Store new image
            try {
                $validatedData['picture'] = $request->file('image')->store('news_images', 'public');
                Log::info('New image uploaded: ' . $validatedData['picture']);
            } catch (\Exception $e) {
                Log::error('Image update failed: ' . $e->getMessage());
                return redirect()->back()
                                 ->withInput()
                                 ->withErrors(['image' => 'Failed to upload new image.'])
                                 ->with('activeAdminScreen', 'news'); // Keep on news screen
            }
        } else {
            // If no new image is uploaded, retain the old one
            $validatedData['picture'] = $newsItem->picture;
        }

        $validatedData['sponsored'] = $request->has('sponsored');
        $validatedData['views'] = $validatedData['views'] ?? $newsItem->views;

        try {
            $newsItem->update($validatedData);
            Log::info('News item updated successfully.', $validatedData);
            // Redirect to news index and keep on news screen
            return redirect()->route('news.index')
                             ->with('success', 'News item updated successfully!')
                             ->with('activeAdminScreen', 'news');
        } catch (\Exception $e) {
            Log::error('Failed to update news item: ' . $e->getMessage());
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['error' => 'Failed to update news item. Please try again.'])
                             ->with('activeAdminScreen', 'news'); // Keep on news screen
        }
    }

    /**
     * Remove the specified news item from storage.
     */
    public function destroy($id)
    {
        $newsItem = NewsItem::findOrFail($id);

        // Delete associated image from storage
        if ($newsItem->picture && Storage::disk('public')->exists($newsItem->picture)) {
            Storage::disk('public')->delete($newsItem->picture);
            Log::info('Image deleted during news item destruction: ' . $newsItem->picture);
        }

        $newsItem->delete();
        Log::info('News item deleted: ' . $id);
        // Redirect to news index and keep on news screen
        return redirect()->route('news.index')
                         ->with('success', 'News item deleted successfully!')
                         ->with('activeAdminScreen', 'news');
    }

    /**
     * Increment the views count for a specific news item.
     *
     * @param  \App\Models\NewsItem  $newsItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function incrementViews(NewsItem $newsItem)
    {
        $newsItem->increment('views');

        return response()->json([
            'success' => true,
            'message' => 'View count incremented successfully.',
            'views' => $newsItem->views // Return the new views count
        ]);
    }
}
