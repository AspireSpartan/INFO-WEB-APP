<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FooterLogo;
use Illuminate\Support\Facades\Storage;

class FooterLogoController extends Controller
{
    public function index()
    {
        $footerLogo = FooterLogo::first();
        return view('Components.Admin.Ad-Header.Ad-Header', compact('footerLogo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'required|file|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $footerLogo = FooterLogo::firstOrCreate([]);

        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($footerLogo->logo_path && Storage::disk('public')->exists($footerLogo->logo_path)) {
                Storage::disk('public')->delete($footerLogo->logo_path);
            }

            // Store the new logo and get its path
            $path = $request->file('logo')->store('logosFooter', 'public');
            $footerLogo->logo_path = $path;
            $footerLogo->save();

            return response()->json([
                'success' => true,
                'message' => 'Logo updated successfully.',
                'logo_path' => Storage::url($path) // Return the full URL
            ]);
        }

        return response()->json(['message' => 'No logo file provided.'], 422);
    }
}
