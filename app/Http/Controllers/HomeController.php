<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Blogfeed;
use App\Models\NewsItem;
use Illuminate\Http\Request;
use App\Models\SectionBanner;
use App\Models\ProjectDescription;
use App\Models\PageContent; 


class HomeController extends Controller
{
    /**
     * Show the application's user-facing home dashboard.
     * This method fetches all content from the 'page_contents' table
     * and passes it to the home view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::all();
        $projects->transform(function ($project) {
           
            if (str_contains($project->image_url, 'storage/')) {
                $project->image_url = asset($project->image_url);
            } else {
                
                $project->image_url = asset('storage/' . $project->image_url);
            }
            return $project;
        });
        $newsItems = NewsItem::orderBy('date', 'desc')->get();
        $pageContent = PageContent::all()->pluck('value', 'key')->toArray();
        $description = ProjectDescription::first();

        if (empty($pageContent)) {
            $pageContent = [
                'hero-subtitle-1' => '“DRIVEN BY INNOVATION',
                'hero-main-title' => 'Local Government Unit',
                'hero-paragraph' => 'Serving the community with <span class="text-amber-400">transparency</span>, <span class="text-amber-400">Integrity</span>, <br class="hidden sm:inline"/>and <span class="text-amber-400">commitment</span>.',
                'hero-subtitle-2' => '<span class="inline-block transform rotate-90 scale-x-[-1] text-2xl relative top-1 right-1">/</span>BREAKING BOUNDARIES',
                'main-container-bg' => asset('storage/LGU_bg.png'), // Default image path
                'stat-1-number' => '24',
                'stat-1-label' => 'Barangay',
                'stat-2-number' => '1500+',
                'stat-2-label' => 'Residents',
                'stat-3-number' => '120+',
                'stat-3-label' => 'Public Projects',
                'stat-4-number' => '75',
                'stat-4-label' => 'Years of Service',
                'footer-paragraph' => 'Local Government Units (LGUs) in the Philippines play a vital role in implementing national policies at the grassroots level while addressing the specific needs of their communities. These units, which include provinces, cities, municipalities, and barangays, are granted autonomy under the Local Government Code of 1991. LGUs are responsible for delivering basic services such as health care, education, infrastructure, and disaster response. They are also tasked with promoting local development through planning, budgeting, and legislation. Despite challenges like limited resources and political interference, many LGUs have successfully launched innovative programs to uplift their constituents and promote inclusive growth.',
            ];
        }

        // Pass all necessary data to the home view

        return view('User_Side_Screen.home', compact('pageContent', 'newsItems', 'projects', 'description')); // Pass the pageContent array
    }

    /**
     * Show the application's blog page.
     * This method fetches data relevant to the blog page.
     *
     * @return \Illuminate\View\View
     */
    public function blogIndex()
    {
        // Fetch data relevant to the blog page
        $blogfeeds = Blogfeed::orderBy('created_at', 'desc')->get();
        $pageContent = PageContent::all()->pluck('value', 'key')->toArray();


        return view('User_Side_Screen.blog', compact('blogfeeds', 'pageContent'));

    }
}
