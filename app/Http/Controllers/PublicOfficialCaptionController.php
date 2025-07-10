<?php

namespace App\Http\Controllers;

use App\Models\PublicOfficialCaption;
use Illuminate\Http\Request;

class PublicOfficialCaptionController extends Controller
{
    public function index()
    {
        $publicOfficialCaption = PublicOfficialCaption::find(1);
        return view('Components.Admin.Content-Manager.teamdev.teamdev', compact('publicOfficialCaption'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'caption' => 'required|string',
        ]);

        $caption = PublicOfficialCaption::findOrFail(1); // assuming id=1
        $caption->update($validated);

        return response()->json([
            'message' => 'Public Official Caption updated successfully',
            'data' => $caption,
        ]);
    }
}
