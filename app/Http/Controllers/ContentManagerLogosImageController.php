<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentManagerLogosImage;
use Illuminate\Support\Facades\Storage;

class ContentManagerLogosImageController extends Controller
{

    public function indexAdmin()
    {
        $contentMlogos = ContentManagerLogosImage::all();

        // Fetch all logos with ids 1 to 7
        $logos = ContentManagerLogosImage::whereIn('id', range(1, 7))->get()->keyBy('id');

        return view('Components.Admin.Ad-Header.Ad-Header', compact('contentMlogos'))
            ->with([
                'phFlagPath' => isset($logos[1]) ? asset('storage/' . str_replace('icons/', 'icons/', $logos[1]->image_path)) : null,
                'miniFIconPath' => isset($logos[2]) ? asset('storage/' . str_replace('icons/', 'icons/', $logos[2]->image_path)) : asset('storage/miniflag.svg'),
                'visionIconPath' => isset($logos[3]) ? asset('storage/' . str_replace('icons/', 'icons/', $logos[3]->image_path)) : asset('storage/Vision.svg'),
                'missionIconPath' => isset($logos[4]) ? asset('storage/' . str_replace('icons/', 'icons/', $logos[4]->image_path)) : asset('storage/Mission.svg'),
                'goalIconPath' => isset($logos[5]) ? asset('storage/' . str_replace('icons/', 'icons/', $logos[5]->image_path)) : asset('storage/goal.svg'),
                'miniFlagPath' => isset($logos[6]) ? asset('storage/' . str_replace('icons/', 'icons/', $logos[6]->image_path)) : asset('storage/miniflagv2.svg'),
                'mainIconPath' => isset($logos[7]) ? asset('storage/' . str_replace('icons/', 'icons/', $logos[7]->image_path)) : asset('storage/CorDev_footer.svg'),
            ]);
    }

    public function update(Request $request)
    {
    try {
            $request->validate([
                'id' => 'required|integer|exists:content_manager_logos_images,id',
                'icon' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $logo = ContentManagerLogosImage::find($request->id);
            if (!$logo) {
                return response()->json(['error' => 'Logo not found.'], 404);
            }

            $iconFile = $request->file('icon');
            $path = $iconFile->store('icons', 'public');

            $logo->image_path = 'storage/' . $path;
            $logo->save();

            return response()->json(['success' => true, 'message' => 'Icon updated successfully.', 'image_path' => asset($logo->image_path)]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
}
