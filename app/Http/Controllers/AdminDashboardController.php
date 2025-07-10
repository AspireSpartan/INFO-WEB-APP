<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Blogfeed;
use App\Models\NewsItem;
use App\Models\PageContent;
use App\Models\StrategicPlan;
use App\Models\ContactMessage;
use App\Models\PublicOfficial;
use App\Models\ProjectDescription;
use App\Models\PreviewSection2Logo;
use App\Models\PublicOfficialCaption;
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
        ));
    }
}