<?php

namespace App\Http\Controllers;

use App\Models\Blogfeed; //this is the Blogfeed Model present that is present in my project
use Illuminate\Http\Request;
use App\Models\SectionBanner;

class HomeController extends Controller
{

    public function index()
    {
        $sectionBanner = SectionBanner::first();

        // Pass the data to your home view
        return view('User_Side_Screen.home', compact('sectionBanner'));
    }


    public function blogIndex()
    {
        $sectionBanner = SectionBanner::first();
        // Fetch data relevant to the blog page
        // Ensure the variable name matches what your view expects ($blogfeeds)
        $blogfeeds = Blogfeed::orderBy('created_at', 'desc')->get(); // Or .take(5)->get() if you only want 5

        return view('User_Side_Screen.blog', compact('blogfeeds', 'sectionBanner'));
    }

}
