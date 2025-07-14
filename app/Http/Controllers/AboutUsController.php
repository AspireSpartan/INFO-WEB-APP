<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUsContentManager;
use App\Models\AboutUsOffer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // For Str::startsWith, Str::after, and Str::contains

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
        $contentManager = AboutUsContentManager::pluck('content', 'key')->toArray(); // [cite: 10]
        // Ensure all expected keys exist to prevent undefined index errors in Blade
        $contentManager = array_merge([
            'heroTitle' => '',
            'heroSubtitle' => '',
            'heroImage' => '', // Consider a default placeholder image if none exists
            'introTitlePart1' => '',
            'introTitlePart2' => '', // [cite: 11, 12]
            'introParagraph1' => '',
            'introParagraph2' => '',
        ], $contentManager);
        $contentOffer = AboutUsOffer::all(); // [cite: 13]
        return view('Components.Admin.Ad-Header.Ad-Header', compact('contentManager', 'contentOffer'));
    }

    /**
     * Display the user-facing About Us page.
     * Fetches all static content and dynamic offers from the database.
     *
     * @return \Illuminate\View\View
     */
    public function showUserAboutUs()
    {
        $contentManager = AboutUsContentManager::pluck('content', 'key')->toArray(); // [cite: 15]
        $contentManager = array_merge([
            'heroTitle' => '',
            'heroSubtitle' => '',
            'heroImage' => '', // Consider a default placeholder image if none exists
            'introTitlePart1' => '',
            'introTitlePart2' => '',
            'introParagraph1' => '',
            'introParagraph2' => '', // [cite: 17]
        ], $contentManager);
        $contentOffer = AboutUsOffer::all(); // [cite: 18]
        return view('User_Side_Screen.about-us', compact('contentManager', 'contentOffer'));
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
        $content = AboutUsContentManager::updateOrCreate( // [cite: 20]
            ['key' => $request->key],
            ['content' => $request->content]
        );
        return response()->json(['message' => 'Content updated successfully.', 'data' => $content]); // [cite: 21]
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
            'icon' => 'nullable|string', // Will be Base64 string for new uploads or URL for existing
        ]);

        $offer = null;
        $iconData = $request->input('icon'); // This holds the current icon value from frontend [cite: 24]
        $newIconPath = null; // This will store the final URL path to be saved in DB

        // Determine if it's an existing offer or a new one
        if ($request->filled('id') && $request->id !== 0 && $request->id !== null) {
            $offer = AboutUsOffer::find($request->id); // [cite: 24]
            if (!$offer) {
                return response()->json(['message' => 'Offer not found.', 'data' => null], 404); // [cite: 25]
            }
        }

        // Handle Base64 image upload
        if ($iconData && Str::startsWith($iconData, 'data:image/')) {
            list($type, $base64String) = explode(';', $iconData); // [cite: 27]
            list(, $base64String) = explode(',', $base64String); // [cite: 28]

            $decodedImage = base64_decode($base64String);

            // Extract file extension from MIME type (e.g., 'jpeg', 'png', 'gif')
            preg_match('/data:image\/(.*?);/', $type, $matches); // [cite: 29]
            $extension = $matches[1] ?? 'png'; // Default to png if type not found [cite: 29]

            $fileName = 'offers/icon_' . time() . '_' . uniqid() . '.' . $extension; // [cite: 30]

            Storage::disk('public')->put($fileName, $decodedImage);
            $newIconPath = Storage::disk('public')->url($fileName); // Get public URL [cite: 31]

            // If updating an existing offer and the old icon was a locally stored file, delete it
            if ($offer && $offer->icon && Str::contains($offer->icon, '/storage/')) {
                $oldFilePath = Str::after($offer->icon, '/storage/'); // [cite: 32]
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath); // [cite: 33]
                }
            }
        } elseif ($offer && $iconData && $iconData === $offer->icon && Str::contains($iconData, '/storage/')) {
            // Existing offer, icon data sent is the same as current stored, and it's a local file URL
            $newIconPath = $iconData;
        } elseif ($offer && ($iconData === null || $iconData === '')) {
            // Existing offer, icon is being cleared. Delete old file if it was one.
            if ($offer->icon && Str::contains($offer->icon, '/storage/')) {
                $oldFilePath = Str::after($offer->icon, '/storage/'); // [cite: 41]
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath); // [cite: 42]
                }
            }
            $newIconPath = null; // Set to null in DB [cite: 43]
        } elseif (!$offer && ($iconData === null || $iconData === '')) {
            // New offer with no icon initially provided
            $newIconPath = null;
        } else {
            // This handles cases where an existing icon URL is sent back, but not a new Base64 string
            // and ensures only valid URLs are passed or it's cleared.
            // If the iconData is not a Base64 string but not empty, and not a local storage URL,
            // we should treat it as an attempt to set a non-local-image, which is now disallowed.
            // However, if it's an existing local storage URL, we keep it.
            if ($offer && $iconData && Str::contains($iconData, '/storage/')) {
                $newIconPath = $iconData;
            } else {
                // For any other unexpected string or non-local URL, default to null or handle error
                $newIconPath = null; // [cite: 45]
            }
        }

        // Prepare data for creation/update
        $data = $request->except('icon'); // Exclude the raw icon data from $request->all() [cite: 46]
        $data['icon'] = $newIconPath; // Use the processed newIconPath [cite: 47]

        if ($offer) {
            // Update existing offer
            $offer->update($data); // [cite: 48]
            $message = 'Offer updated successfully.'; // [cite: 48]
        } else {
            // Create new offer
            $offer = AboutUsOffer::create($data); // [cite: 49]
            $message = 'Offer added successfully.'; // [cite: 49]
        }

        return response()->json(['message' => $message, 'data' => $offer]); // [cite: 50]
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
        $offer = AboutUsOffer::findOrFail($id); // [cite: 52]

        // Delete the associated icon file from storage if it's a locally stored image URL
        if ($offer->icon && Str::contains($offer->icon, '/storage/')) {
            $filePath = Str::after($offer->icon, '/storage/'); // Get path relative to storage/app/public [cite: 53]
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath); // [cite: 54]
            }
        }

        $offer->delete(); // [cite: 55]
        return response()->json(['message' => 'Offer deleted successfully.']); // [cite: 55]
    }

    /**
     * Returns all About Us offers as JSON.
     * This is a new method to support the Alpine.js frontend logic for offer comparison.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOffersJson()
    {
        return response()->json(AboutUsOffer::all()); // [cite: 58]
    }
}