<?php

namespace App\Http\Controllers;

use App\Models\FooterTitle;
use Illuminate\Http\Request;

class FooterTitleController extends Controller
{
    public function index()
    {
        $footertitle = FooterTitle::first();
        return view('Components.Admin.Ad-Header.Ad-Header', compact('footertitle'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'government_links_title' => 'required|string|max:255',
        ]);

        $title = FooterTitle::first();
        if ($title) {
            $title->update(['government_links_title' => $request->government_links_title]);
        } else {
            $title = FooterTitle::create(['government_links_title' => $request->government_links_title]);
        }

        return response()->json($title);
    }
}
