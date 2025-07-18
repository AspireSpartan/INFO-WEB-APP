<?php

namespace App\Http\Controllers;

use App\Models\KeepInTouch;
use Illuminate\Http\Request;

class KeepInTouchController extends Controller
{
    public function edit()
    {

        $keepInTouch = KeepInTouch::with(['socialLinks' => function($query) {
            $query->select('id', 'platform', 'url', 'icon'); 
        }])->firstOrFail();
        return view('Components.Admin.Ad-Header.Ad-Header', compact('keepInTouch'));
    }

    public function update(Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'text_content' => 'required|string',
                'social_links' => 'array',
                'social_links.*.platform' => 'required|string|max:255',
                'social_links.*.url' => 'required|url|max:255',
                'social_links.*.icon' => 'nullable|string|max:255', 
            ]);

            $keepInTouch = KeepInTouch::firstOrFail();
            $keepInTouch->update([
                'title' => $data['title'],
                'text_content' => $data['text_content'],
            ]);

            $keepInTouch->socialLinks()->delete();
            foreach ($data['social_links'] as $link) {
                $keepInTouch->socialLinks()->create($link);
            }

            // Return updated data as JSON for frontend, including the icon
            return response()->json([
                'message' => 'Keep In Touch section updated successfully!',
                'keepInTouch' => [
                    'title' => $keepInTouch->title,
                    'text_content' => $keepInTouch->text_content,
                    // Ensure social_links includes the 'icon' when returned
                    'social_links' => $keepInTouch->socialLinks()->get(['id', 'platform', 'url', 'icon']),
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating Keep In Touch information.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
