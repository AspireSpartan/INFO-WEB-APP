<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUsContentManager;
use App\Models\AboutUsOffer;
use App\Models\CommunityContent; // Import the CommunityContent model
use App\Models\CommunityCarouselImage; // Import the CommunityCarouselImage model
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutUsController extends Controller
{
    /**
     * Display the About Us administration page.
     * Fetches all static content and dynamic offers from the database.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contentManager = AboutUsContentManager::pluck('content', 'key')->toArray();
        $contentManager = array_merge([
            'heroTitle' => '',
            'heroSubtitle' => '',
            'heroImage' => '',
            'introTitlePart1' => '',
            'introTitlePart2' => '',
            'introParagraph1' => '',
            'introParagraph2' => '',
        ], $contentManager);
        $contentOffer = AboutUsOffer::all();
        return view('Components.Admin.Ad-Header.Ad-Header', compact('contentManager', 'contentOffer'));
    }

    /**
     * Display the user-facing About Us page.
     * Fetches all static content and dynamic offers from the database,
     * including community content and carousel images for section-3.
     *
     * @return \Illuminate\View\View
     */
    public function showUserAboutUs()
    {
        $contentManager = AboutUsContentManager::pluck('content', 'key')->toArray();
        $contentManager = array_merge([
            'heroTitle' => '',
            'heroSubtitle' => '',
            'heroImage' => '',
            'introTitlePart1' => '',
            'introTitlePart2' => '',
            'introParagraph1' => '',
            'introParagraph2' => '',
        ], $contentManager);
        $contentOffer = AboutUsOffer::all();

        // Fetch static content for the "Community at Work" section (from CommunityContent model)
        $communityContent = CommunityContent::pluck('content', 'key')->toArray();
        $communityContent = array_merge([
            'main_title_part1' => 'Community',
            'main_title_part2' => ' at Work',
            'subtitle_paragraph' => 'We work hand-in-hand with barangay officials and municipal departments to ensure streamlined digital services and community development.',
            'footer_text' => 'Building stronger communities through collaboration and innovation since 2023',
        ], $communityContent);

        // Fetch carousel images ordered by the 'order' column (from CommunityCarouselImage model)
        $carouselImages = CommunityCarouselImage::orderBy('order')->get();

        return view('User_Side_Screen.about-us', compact('contentManager', 'contentOffer', 'communityContent', 'carouselImages'));
    }

    /**
     * Store or update a piece of About Us content.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateContent(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
        $content = AboutUsContentManager::updateOrCreate(
            ['key' => $request->key],
            ['content' => $request->content]
        );
        return response()->json(['message' => 'Content updated successfully.', 'data' => $content]);
    }

    /**
     * Store a new About Us offer or update an existing one.
     * This function is modified to only accept image uploads (Base64 strings) for icons.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeOffer(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);

        $offer = null;
        $iconData = $request->input('icon');
        $newIconPath = null;

        if ($request->filled('id') && $request->id !== 0 && $request->id !== null) {
            $offer = AboutUsOffer::find($request->id);
            if (!$offer) {
                return response()->json(['message' => 'Offer not found.', 'data' => null], 404);
            }
        }

        if ($iconData && Str::startsWith($iconData, 'data:image/')) {
            list($type, $base64String) = explode(';', $iconData);
            list(, $base64String) = explode(',', $base64String);

            $decodedImage = base64_decode($base64String);

            preg_match('/data:image\/(.*?);/', $type, $matches);
            $extension = $matches[1] ?? 'png';

            $fileName = 'offers/icon_' . time() . '_' . uniqid() . '.' . $extension;

            Storage::disk('public')->put($fileName, $decodedImage);
            $newIconPath = Storage::disk('public')->url($fileName);

            if ($offer && $offer->icon && Str::contains($offer->icon, '/storage/')) {
                $oldFilePath = Str::after($offer->icon, '/storage/');
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
            }
        } elseif ($offer && $iconData && $iconData === $offer->icon && Str::contains($iconData, '/storage/')) {
            $newIconPath = $iconData;
        } elseif ($offer && ($iconData === null || $iconData === '')) {
            if ($offer->icon && Str::contains($offer->icon, '/storage/')) {
                $oldFilePath = Str::after($offer->icon, '/storage/');
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
            }
            $newIconPath = null;
        } elseif (!$offer && ($iconData === null || $iconData === '')) {
            $newIconPath = null;
        } else {
            if ($offer && $iconData && Str::contains($iconData, '/storage/')) {
                $newIconPath = $iconData;
            } else {
                $newIconPath = null;
            }
        }

        $data = $request->except('icon');
        $data['icon'] = $newIconPath;

        if ($offer) {
            $offer->update($data);
            $message = 'Offer updated successfully.';
        } else {
            $offer = AboutUsOffer::create($data);
            $message = 'Offer added successfully.';
        }

        return response()->json(['message' => $message, 'data' => $offer]);
    }

    /**
     * Delete an About Us offer.
     * This function is modified to only consider locally stored image files for deletion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOffer($id)
    {
        $offer = AboutUsOffer::findOrFail($id);

        if ($offer->icon && Str::contains($offer->icon, '/storage/')) {
            $filePath = Str::after($offer->icon, '/storage/');
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        $offer->delete();
        return response()->json(['message' => 'Offer deleted successfully.']);
    }

    /**
     * Returns all About Us offers as JSON.
     * This is a new method to support the Alpine.js frontend logic for offer comparison.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOffersJson()
    {
        return response()->json(AboutUsOffer::all());
    }
}