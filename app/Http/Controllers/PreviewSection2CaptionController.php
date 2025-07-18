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


        $caption = PreviewSection2Caption::updateOrCreate(
            ['id' => 1],
            ['caption' => $request->input('caption')]
        );

        return response()->json($caption);
    }
}
