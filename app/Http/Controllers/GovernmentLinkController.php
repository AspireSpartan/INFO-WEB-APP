<?php

namespace App\Http\Controllers;

use App\Models\GovernmentLink;
use Illuminate\Http\Request;

class GovernmentLinkController extends Controller
{
    public function index()
    {
        return GovernmentLink::all();
    }
    public function indexDisplay()
    {
        $governmentlinks = GovernmentLink::all();
        return view('Components.Admin.Ad-Header.Ad-Header', compact('governmentlinks'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'links' => 'present|array',
            'links.*.title' => 'required|string|max:255',
            'links.*.url' => 'required|url',
        ]);

        GovernmentLink::truncate();

        foreach ($validated['links'] as $linkData) {
            GovernmentLink::create($linkData);
        }

        return response()->json(GovernmentLink::all());
    }
}
