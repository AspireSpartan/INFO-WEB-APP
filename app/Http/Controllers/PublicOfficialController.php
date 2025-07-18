<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicOfficial;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage; // Make sure this is imported

class PublicOfficialController extends Controller
{
    public function index()
    {
        $officials = PublicOfficial::all();

        $publicOfficialCaption = [
            'title' => 'Meet Our Esteemed<br>Public Officials',
            'caption' => 'Dedicated to serving the community with integrity and commitment, our public officials work tirelessly to ensure progress and well-being for all citizens.',
            'titleColor' => '#000000'
        ];

        $logos = [
            (object)['id' => 1, 'image_path' => 'https://placehold.co/100x100/FF0000/FFFFFF?text=Logo1'],
            (object)['id' => 6, 'image_path' => 'https://placehold.co/736x256/0000FF/FFFFFF?text=Flag']
        ];

        return view('publicofficials', compact('officials', 'publicOfficialCaption', 'logos'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ensure picture is required
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Store files in the 'developers' folder on the 'public' disk
            if ($request->hasFile('picture')) {
                $validatedData['picture'] = $request->file('picture')->store('developers', 'public');
            }
            if ($request->hasFile('icon')) {
                $validatedData['icon'] = $request->file('icon')->store('developers', 'public');
            }

            $official = PublicOfficial::create($validatedData);

            return response()->json([
                'message' => 'Official added successfully!',
                'data' => $official
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to add official: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, PublicOfficial $publicOfficial)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Handle picture update
            if ($request->hasFile('picture')) {
                // Delete old picture if it exists and is not an external URL
                if ($publicOfficial->picture && !filter_var($publicOfficial->picture, FILTER_VALIDATE_URL)) {
                    // Check if the old path contains 'public/' or 'developers/'
                    $oldPath = str_replace('public/', '', $publicOfficial->picture); // For old 'public/...' paths
                    $oldPath = str_replace('officials/pictures/', '', $oldPath); // For previous 'officials/pictures' paths
                    // Now $oldPath should be like 'developers/filename.jpg' or 'filename.png'
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $validatedData['picture'] = $request->file('picture')->store('developers', 'public');
            } else {
                // If no new picture and it was not explicitely cleared, retain the old one
                $validatedData['picture'] = $publicOfficial->picture;
            }

            // Handle icon update
            if ($request->hasFile('icon')) {
                // Delete old icon if it exists and is not an external URL
                if ($publicOfficial->icon && !filter_var($publicOfficial->icon, FILTER_VALIDATE_URL)) {
                    $oldPath = str_replace('public/', '', $publicOfficial->icon); // For old 'public/...' paths
                    $oldPath = str_replace('officials/icons/', '', $oldPath); // For previous 'officials/icons' paths
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $validatedData['icon'] = $request->file('icon')->store('developers', 'public');
            } elseif ($request->input('icon_cleared') === '1') {
                // If icon was explicitly cleared, delete old one if exists
                if ($publicOfficial->icon && !filter_var($publicOfficial->icon, FILTER_VALIDATE_URL)) {
                    $oldPath = str_replace('public/', '', $publicOfficial->icon);
                    $oldPath = str_replace('officials/icons/', '', $oldPath);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $validatedData['icon'] = null; // Set icon to null
            } else {
                // If no new icon and not cleared, retain the old one
                $validatedData['icon'] = $publicOfficial->icon;
            }

            $publicOfficial->update($validatedData);

            return response()->json([
                'message' => 'Official updated successfully!',
                'data' => $publicOfficial // Return the updated official data, including new image paths
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update official: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(PublicOfficial $publicOfficial)
    {
        try {
            // Delete associated picture and icon files from storage
            if ($publicOfficial->picture && !filter_var($publicOfficial->picture, FILTER_VALIDATE_URL)) {
                $picturePath = str_replace('public/', '', $publicOfficial->picture);
                $picturePath = str_replace('officials/pictures/', '', $picturePath);
                if (Storage::disk('public')->exists($picturePath)) {
                    Storage::disk('public')->delete($picturePath);
                }
            }
            if ($publicOfficial->icon && !filter_var($publicOfficial->icon, FILTER_VALIDATE_URL)) {
                $iconPath = str_replace('public/', '', $publicOfficial->icon);
                $iconPath = str_replace('officials/icons/', '', $iconPath);
                if (Storage::disk('public')->exists($iconPath)) {
                    Storage::disk('public')->delete($iconPath);
                }
            }

            $publicOfficial->delete();

            return response()->json([
                'message' => 'Official deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete official: ' . $e->getMessage()
            ], 500);
        }
    }
}