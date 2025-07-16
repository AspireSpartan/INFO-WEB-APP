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
use App\Models\AboutUsOffer;
use App\Models\Announcement;
use App\Models\StrategicPlan;
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
use App\Models\ContentManagerLogosImage;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pageContent = PageContent::pluck('value', 'key')->toArray();
        $newsItems = NewsItem::all();
        $contactMessages = ContactMessage::all();
        $blogfeeds = Blogfeed::all();
        $projects = Project::all();
        $description = ProjectDescription::first();
        $logos = PreviewSection2Logo::select('id', 'logo')->get();
        $caption = PreviewSection2Caption::value('caption');
        $contentMlogos = ContentManagerLogosImage::all();
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
        $announcements = Announcement::orderBy('date', 'desc')->get(); 

        return view('Components.Admin.Ad-Header.Ad-Header', compact(
            'newsItems',
            'contactMessages',
            'blogfeeds',
            'pageContent',
            'projects',
            'description',
            'logos',
            'caption',
            'contentMlogos',
            'strategicPlans',
            'vmgEditableContentData',
            'publicOfficialCaption',
            'officials',
            'keepInTouch',
            'footerLogo',
            'aboutGovph', 
            'govphLinks',
            'contentManager',      
            'contentOffer',
            'concerns',
            'governmentlinks',
            'footertitle',
            'communityContent',
            'communityCarouselImages',
            'announcements',
            'contactUsTitle', 
            'contactUsDetails',
            'initialContactUsData'
        ));
    }
}
