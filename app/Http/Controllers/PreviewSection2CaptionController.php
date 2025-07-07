<?php

namespace App\Http\Controllers;

use App\Models\PreviewSection2Caption;
use Illuminate\Http\Request;

class PreviewSection2CaptionController extends Controller
{

    public function indexAdmin()
    {
        $caption = PreviewSection2Caption::value('caption');
        return view('Components.Admin.Ad-Header.Ad-Header', compact('caption'));
    }

    public function update(Request $request)
    {
        $request->validate(['caption' => 'required|string']);

        // Since there's only one caption, we can update it like this.
        // This will update the first record, or create one if it doesn't exist.
        $caption = PreviewSection2Caption::updateOrCreate(
            ['id' => 1], // Assuming the ID is always 1, or use a known condition
            ['caption' => $request->input('caption')]
        );

        return response()->json($caption);
    }
}
