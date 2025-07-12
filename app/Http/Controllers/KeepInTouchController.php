<?php

namespace App\Http\Controllers;

use App\Models\KeepInTouch;
use Illuminate\Http\Request;

class KeepInTouchController extends Controller
{
    public function edit()
    {
        $keepInTouch = KeepInTouch::with('socialLinks')->firstOrFail();
        return view('Components.Admin.Ad-Header.Ad-Header', compact('keepInTouch'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'text_content' => 'required|string',
            'social_links' => 'array',
            'social_links.*.platform' => 'required|string|max:255',
            'social_links.*.url' => 'required|url|max:255',
        ]);

        $keepInTouch = KeepInTouch::firstOrFail();
        $keepInTouch->update([
            'title' => $data['title'],
            'text_content' => $data['text_content'],
        ]);

        // Sync social links
        $keepInTouch->socialLinks()->delete();
        foreach ($data['social_links'] as $link) {
            $keepInTouch->socialLinks()->create($link);
        }

        // Return updated data as JSON for frontend
        return response()->json([
            'message' => 'Keep In Touch section updated successfully!',
            'keepInTouch' => [
                'title' => $keepInTouch->title,
                'text_content' => $keepInTouch->text_content,
                'social_links' => $keepInTouch->socialLinks()->get(['platform', 'url']),
            ]
        ]);
    }
}
