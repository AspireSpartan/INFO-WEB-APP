<?php

namespace App\Http\Controllers;

use App\Models\PublicOfficialCaption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicOfficialCaptionController extends Controller
{
    public function index()
    {
        $publicOfficialCaption = PublicOfficialCaption::find(1);
        return view('Components.Admin.Ad-Header.Ad-Header', compact('publicOfficialCaption'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'caption' => 'required|string',
            'titleColor' => 'nullable|string',
        ]);

        $caption = PublicOfficialCaption::findOrFail(1);
        $caption->update([
            'title' => $validated['title'],
            'caption' => $validated['caption'],
            'titleColor' => $validated['titleColor'] ?? '#000000',
        ]);

        return response()->json([
            'message' => 'Public Official Caption updated successfully',
            'data' => $caption,
        ]);
    }
}
