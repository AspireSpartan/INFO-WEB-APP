<?php

namespace App\Http\Controllers;

use App\Models\PreviewSection2Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PreviewSection2LogoController extends Controller
{

    public function indexAdmin()
    {
        $logos = PreviewSection2Logo::select('id', 'logo')->get()->map(function ($logo) {
            if (!Str::startsWith($logo->logo, 'storage/')) {
                $logo->logo = 'storage/' . $logo->logo;
            }
            return $logo;
        });

        return view('Components.Admin.Ad-Header.Ad-Header', compact('logos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store the file in storage/app/public/logos using the 'public' disk explicitly
        $path = $request->file('logo')->store('logos', 'public');

        // Save the path relative to 'storage' URL (prefix with 'storage/')
        $logo = PreviewSection2Logo::create([
            'logo' => 'storage/' . $path
        ]);

        return response()->json($logo, 201);
    }

    public function destroy($id)
    {
        $logo = PreviewSection2Logo::findOrFail($id);
        
        // Convert stored logo path back to storage path for deletion
        $path = str_replace('storage/', '', $logo->logo);

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $logo->delete();

        return response()->json(null, 204);
    }

    public function update(Request $request, $id)
    {
        $logo = PreviewSection2Logo::findOrFail($id);
        $logo->update($request->only('logo'));
        return response()->json($logo);
    }
}
