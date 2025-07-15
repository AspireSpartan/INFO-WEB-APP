<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityContent;
use App\Models\CommunityCarouselImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // For Str::startsWith, Str::after, Str::contains

class CommunityController extends Controller
{
    /**
     * Display the Community Admin page.
     * Fetches all static content and carousel images.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $communityContent = CommunityContent::pluck('content', 'key')->toArray();
        // Ensure all expected keys exist to prevent undefined index errors in Blade
        $communityContent = array_merge([
            'main_title_part1' => '',
            'main_title_part2' => '',
            'subtitle_paragraph' => '',
            'footer_text' => '',
        ], $communityContent);

        // Fetch carousel images ordered by the 'order' column
        $communityCarouselImages = CommunityCarouselImage::orderBy('order')->get();

        return view('Components.Admin.Community.AdminCommunityPage', compact('communityContent', 'communityCarouselImages'));
    }
    

    /**
     * Display the user-facing Community page.
     * Fetches all static content and carousel images.
     *
     * @return \Illuminate\View\View
     */
    public function showUserCommunity()
    {
        $content = CommunityContent::pluck('content', 'key')->toArray();
        // Ensure all expected keys exist to prevent undefined index errors in Blade
        $content = array_merge([
            'main_title_part1' => '',
            'main_title_part2' => '',
            'subtitle_paragraph' => '',
            'footer_text' => '',
        ], $content);

        $carouselImages = CommunityCarouselImage::orderBy('order')->get();

        return view('Users.CommunityPage', compact('content', 'carouselImages'));
    }

    /**
     * Update static community content.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Store a new carousel image.
     * Expects a file upload via multipart/form-data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeCarouselImage(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // For new uploads
            'id' => 'nullable|integer|exists:community_carousel_images,id', // For updates
            'order' => 'nullable|integer',
            'current_image_path' => 'nullable|string', // To retain existing image path
        ]);

        $image = null;
        if ($request->filled('id')) {
            $image = CommunityCarouselImage::find($request->id);
        }

        // If it's an update and no new image is provided, use the current_image_path
        $imagePathToSave = $image ? $image->image_path : null;

        if ($request->hasFile('image')) {
            // Handle new image upload
            $path = $request->file('image')->store('community_carousel', 'public');
            $imagePathToSave = 'storage/' . $path;
        } elseif ($request->filled('current_image_path') && $image) {
            // Retain the existing image path if no new image is uploaded
            $imagePathToSave = $request->current_image_path;

            // Optional: If you want to strip base URL parts if current_image_path is full URL
            // if (Str::startsWith($imagePathToSave, url('/'))) {
            //     $imagePathToSave = Str::after($imagePathToSave, url('/'));
            // }
            // if (Str::startsWith($imagePathToSave, '/storage/')) {
            //     // already in desired format
            // }
        }

        if (!$image) {
            $image = new CommunityCarouselImage();
            // Assign order for new images if not provided, e.g., last position
            $image->order = $request->input('order', CommunityCarouselImage::max('order') + 1);
        }

        $image->title = $request->input('title', '');
        $image->image_path = $imagePathToSave;
        $image->save();

        return response()->json(['message' => 'Image saved successfully.', 'data' => $image]);
    }

    /**
     * Update an existing carousel image's title or replace its image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCarouselImage(Request $request, $id)
    {
        $image = CommunityCarouselImage::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', // Allow updating image, max 2MB
        ]);

        if ($request->has('title')) {
            $image->title = $request->input('title');
        }

        if ($request->hasFile('image')) {
            // Delete old image if it exists and is stored locally
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

    /**
     * Delete a carousel image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Update the order of carousel images.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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