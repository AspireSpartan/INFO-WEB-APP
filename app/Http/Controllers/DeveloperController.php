<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DeveloperController extends Controller
{
    public function index()
    {
        // This method will be used to display the main page with developers
        $developers = Developer::all();
        return view('components.admin.about-us.section-4', compact('developers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
            'social_links' => 'nullable|json', // Expecting a JSON string
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('developers', 'public');
        }

        $developer = Developer::create([
            'name' => $request->name,
            'role' => $request->role,
            'description' => $request->description,
            'image_url' => $imagePath,
            'social_links' => json_decode($request->social_links, true), // Decode JSON string to array
        ]);

        return response()->json(['message' => 'Developer added successfully!', 'developer' => $developer], 201);
    }

    public function showUserAboutUs()
    {
        $developers = Developer::all();
        $communityContent = CommunityContent::pluck('content', 'key')->toArray();
        $section4Content = array_merge([
            'main_title_part1' => 'Meet',
            'main_title_part2' => 'The Developers Behind CoreDev',
            'subtitle_paragraph' => 'Our dedicated team built this platform with care, innovation, and community in mind. Each member brings unique expertise to create an exceptional experience.',
        ], $communityContent);


        return view('Components.User_Side_Screen.about-us', compact(
            'developers',
            'section4Content'
        ));
    }

    public function update(Request $request, Developer $developer)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'social_links' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = $developer->image_url;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('developers', 'public');
        }

        $developer->update([
            'name' => $request->name,
            'role' => $request->role,
            'description' => $request->description,
            'image_url' => $imagePath,
            'social_links' => json_decode($request->social_links, true),
        ]);

        return response()->json(['message' => 'Developer updated successfully!', 'developer' => $developer], 200);
    }

    public function destroy(Developer $developer)
    {
        // Delete image from storage
        if ($developer->image_url && Storage::disk('public')->exists($developer->image_url)) {
            Storage::disk('public')->delete($developer->image_url);
        }

        $developer->delete();

        return response()->json(['message' => 'Developer deleted successfully!'], 200);
    }
}

