<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityContent;
use App\Models\CommunityCarouselImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 

class CommunityController extends Controller
{
    public function index()
    {
        $communityContent = CommunityContent::pluck('content', 'key')->toArray();
        $communityContent = array_merge([
            'main_title_part1' => '',
            'main_title_part2' => '',
            'subtitle_paragraph' => '',
            'footer_text' => '',
        ], $communityContent);

        $communityCarouselImages = CommunityCarouselImage::orderBy('order')->get();

        return view('Components.Admin.Community.AdminCommunityPage', compact('communityContent', 'communityCarouselImages'));
    }
    

    public function showUserCommunity()
    {
        $content = CommunityContent::pluck('content', 'key')->toArray();
        $content = array_merge([
            'main_title_part1' => '',
            'main_title_part2' => '',
            'subtitle_paragraph' => '',
            'footer_text' => '',
        ], $content);

        $carouselImages = CommunityCarouselImage::orderBy('order')->get();

        return view('Users.CommunityPage', compact('content', 'carouselImages'));
    }

    public function updateContent(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        CommunityContent::updateOrCreate(
            ['key' => $request->key],
            ['content' => $request->content]
        );

        return response()->json(['message' => 'Content updated successfully.']);
    }

    public function storeCarouselImage(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'id' => 'nullable|integer|exists:community_carousel_images,id', 
            'order' => 'nullable|integer',
            'current_image_path' => 'nullable|string', 
        ]);

        $image = null;
        if ($request->filled('id')) {
            $image = CommunityCarouselImage::find($request->id);
        }

        $imagePathToSave = $image ? $image->image_path : null;

        if ($request->hasFile('image')) {
            // Handle new image upload
            $path = $request->file('image')->store('community_carousel', 'public');
            $imagePathToSave = 'storage/' . $path;
        } elseif ($request->filled('current_image_path') && $image) {
            // Retain the existing image path if no new image is uploaded
            $imagePathToSave = $request->current_image_path;
        }

        if (!$image) {
            $image = new CommunityCarouselImage();
            $image->order = $request->input('order', CommunityCarouselImage::max('order') + 1);
        }

        $image->title = $request->input('title', '');
        $image->image_path = $imagePathToSave;
        $image->save();

        return response()->json(['message' => 'Image saved successfully.', 'data' => $image]);
    }

    public function updateCarouselImage(Request $request, $id)
    {
        $image = CommunityCarouselImage::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', 
        ]);

        if ($request->has('title')) {
            $image->title = $request->input('title');
        }

        if ($request->hasFile('image')) {
            if ($image->image_path && Str::contains($image->image_path, '/storage/')) {
                $oldFilePath = Str::after($image->image_path, '/storage/');
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
            }
            $imagePath = $request->file('image')->store('carousel_images', 'public');
            $image->image_path = 'storage/' . $imagePath;
        }

        $image->save();

        return response()->json(['message' => 'Image updated successfully.', 'data' => $image]);
    }

    public function deleteCarouselImage($id)
    {
        $image = CommunityCarouselImage::findOrFail($id);

        // Delete the associated image file from storage if it's a locally stored image URL
        if ($image->image_path && Str::contains($image->image_path, '/storage/')) {
            $filePath = Str::after($image->image_path, '/storage/');
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        $image->delete();
        return response()->json(['message' => 'Image deleted successfully.']);
    }

    public function updateImageOrder(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|integer|exists:community_carousel_images,id',
            'images.*.order' => 'required|integer',
        ]);

        foreach ($request->images as $img) {
            CommunityCarouselImage::where('id', $img['id'])->update(['order' => $img['order']]);
        }

        return response()->json(['message' => 'Image order updated successfully.']);
    }
}