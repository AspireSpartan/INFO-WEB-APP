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

        $phFlag = ContentManagerLogosImage::find(1);
        $miniFIconPath = ContentManagerLogosImage::find(2);
        $visionIcon = ContentManagerLogosImage::find(3);
        $missionIcon = ContentManagerLogosImage::find(4);
        $goalIcon = ContentManagerLogosImage::find(5);
        $miniFlagPath = ContentManagerLogosImage::find(6);
        $mainIcon = ContentManagerLogosImage::find(7);

        return view('Components.Admin.Ad-Header.Ad-Header', compact('contentMlogos'))//storage/Ph_flag.svg
            ->with([
                'phFlagPath' => $phFlag ? $phFlag->image_path : 'storage/Ph_flag.svg',
                'miniFIconPath' => $miniFIcon ? $miniFIcon->image_path : 'storage/miniflag.svg',
                'visionIconPath' => $visionIcon ? $visionIcon->image_path : 'storage/Vision.svg',
                'missionIconPath' => $missionIcon ? $missionIcon->image_path : 'storage/Mission.svg',
                'goalIconPath' => $goalIcon ? $goalIcon->image_path : 'storage/goal.svg',
                'miniFlagPath' => $miniFlag ? $miniFlag->image_path : 'storage/miniflagv2.svg',
                'mainIconPath' => $mainIcon ? $mainIcon->image_path : 'storage/CorDev_footer.svg',
            ]);
    }

    public function create()
    {
        return view('admin.content_manager_logos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('content_manager_logos', 'public');

        ContentManagerLogosImage::create([
            'image_path' => $path,
        ]);

        return redirect()->route('content_manager_logos.index')->with('success', 'contentMlogos image uploaded successfully.');
    }

    public function destroy($id)
    {
        $contentMlogos = ContentManagerLogosImage::findOrFail($id);

        if (Storage::disk('public')->exists($contentMlogos->image_path)) {
            Storage::disk('public')->delete($contentMlogos->image_path);
        }

        $contentMlogos->delete();

        return redirect()->route('content_manager_logos.index')->with('success', 'contentMlogos image deleted successfully.');
    }
}
