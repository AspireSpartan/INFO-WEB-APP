<?php

namespace App\Http\Controllers;

use App\Models\AboutGovph;
use App\Models\GovphLink;
use Illuminate\Http\Request;

class AboutGovphController extends Controller
{
    public function index()
    {
        $aboutGovph = AboutGovph::first();
        $govphLinks = GovphLink::all();
        return view('Components.Admin.Ad-Header.Ad-Header', compact('aboutGovph', 'govphLinks'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'links' => 'present|array',
            'links.*.title' => 'required|string|max:255',
            'links.*.url' => 'required|url|max:255',
        ]);

        $aboutGovph = AboutGovph::firstOrCreate(['id' => 1]);
        $aboutGovph->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        // Delete old links and create new ones
        GovphLink::truncate();
        if (!empty($validated['links'])) {
            foreach ($validated['links'] as $linkData) {
                GovphLink::create($linkData);
            }
        }
        
        $updatedLinks = GovphLink::all();

        return response()->json([
            'message' => 'About GOVPH section updated successfully!',
            'aboutGovph' => $aboutGovph,
            'links' => $updatedLinks,
        ]);
    }
}
