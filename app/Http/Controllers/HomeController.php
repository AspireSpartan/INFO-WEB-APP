<?php

namespace App\Http\Controllers;

use App\Models\Newsfeed;

class HomeController extends Controller
{
    public function index()
    {
        $newsfeeds = Newsfeed::all();
        return view('home', compact('newsfeeds'));
    }

}