<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function showNews()
    {
        $newsItems = NewsItem::orderBy('date', 'desc')->get(); // Fetch news items
        return view('Admin_Side_Screen.Admin-Dashboard', compact('newsItems'));
    }

}
