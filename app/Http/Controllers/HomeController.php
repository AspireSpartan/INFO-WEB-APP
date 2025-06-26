<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use App\Models\SectionBanner;
use App\Models\ContactMessage;
use App\Models\Blogfeed; //this is the Blogfeed Model present that is present in my project

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

    //public function bannerEditIndex() // Corrected to provide all necessary dashboard data
    //{
        // Fetch all data required by Admin_Side_Screen.Admin-Dashboard.blade.php
    //    $sectionBanner = SectionBanner::first();
    //    $newsItems = NewsItem::orderBy('created_at', 'desc')->get(); 
    //    $contactMessages = ContactMessage::orderBy('created_at', 'desc')->get(); 
    //    $blogfeeds = Blogfeed::all(); 

    //    return view('Admin_Side_Screen.Admin-Dashboard', compact('sectionBanner', 'newsItems', 'contactMessages', 'blogfeeds'));
    //}

}
