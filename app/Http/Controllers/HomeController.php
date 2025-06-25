<?php

namespace App\Http\Controllers;

use App\Models\SectionBanner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch the first section banner record
        // You might want a specific one or the most recent, depending on your needs.
        $sectionBanner = SectionBanner::first();

        // Pass the data to your welcome view
        return view('User_Side_Screen.home', compact('sectionBanner'));
    }
}
