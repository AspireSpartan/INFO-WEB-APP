<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Crucial for debugging

class PageContentController extends Controller
{
    /**
     * Display all page content.
     * This will return all key-value pairs stored in the database.
     */
    public function show()
    {
        // Fetch all key-value pairs from the page_contents table
        $contents = PageContent::all()->pluck('value', 'key')->toArray();
        Log::info('PageContentController@show: Fetched content', $contents); // Debug log
        return response()->json($contents);
    }

    /**
     * Update specified page content.
     * Handles both text and image updates.
     */
    public function update(Request $request)
    {
        Log::info('PageContentController@update: Request received', $request->all()); // Log ALL incoming request data

        // Validate the incoming request data
        // Updated validation to allow various image types including SVG, and increased max size to 5MB
        $request->validate([
            'key' => 'required|string',
            'value' => 'nullable|string', // For text content or image URL string
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // Allows more image types, 5MB max
        ]);

        $key = $request->input('key');
        $value = $request->input('value'); // Initialize with potential incoming 'value' (for text/no new file)
        $file = $request->file('file');

        // Check if a file was uploaded for this request
        if ($request->hasFile('file')) { // Using hasFile() is more robust for checking presence
            Log::info('PageContentController@update: File detected for key: ' . $key); 
            $path = $file->store('page_images', 'public'); // Store image in 'storage/app/public/page_images'
            $value = asset('storage/' . $path); // Use asset() to generate public URL
            Log::info('PageContentController@update: File stored at: ' . $path . ', generated URL (using asset()): ' . $value); 
        } else {
            Log::info('PageContentController@update: No new file uploaded for key: ' . $key . ', using provided value: ' . ($value ?? 'NULL (empty value)'));
        }

        // Find the content by key, or create it if it doesn't exist
        $pageContent = PageContent::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Log::info('PageContentController@update: Content saved to DB:', ['key' => $pageContent->key, 'value' => $pageContent->value]);

        // Return the updated content, or the new image URL if applicable
        return response()->json([
            'message' => 'Content updated successfully!',
            'key' => $pageContent->key,
            'value' => $pageContent->value // This will be the new image URL if uploaded
        ]);
    }

    /**
     * Initialize default content in the database if it doesn't exist.
     * This can be called once, e.g., after migration or via a seeder.
     */
    public function initializeDefaultContent()
    {
        $defaultContents = [
            'hero-subtitle-1' => '“DRIVEN BY INNOVATION',
            'hero-main-title' => 'Local Government Unit',
            'hero-paragraph' => 'Serving the community with <span class="text-amber-400">transparency</span>, <span class="text-amber-400">Integrity</span>, <br class="hidden sm:inline"/>and <span class="text-amber-400">commitment</span>.',
            'hero-subtitle-2' => '<span class="inline-block transform rotate-90 scale-x-[-1] text-2xl relative top-1 right-1">/</span>BREAKING BOUNDARIES',
            'footer-paragraph' => 'Local Government Units (LGUs) in the Philippines play a vital role in implementing national policies at the grassroots level while addressing the specific needs of their communities. These units, which include provinces, cities, municipalities, and barangays, are granted autonomy under the Local Government Code of 1991. LGUs are responsible for delivering basic services such as health care, education, infrastructure, and disaster response. They are also tasked with promoting local development through planning, budgeting, and legislation. Despite challenges like limited resources and political interference, many LGUs have successfully launched innovative programs to uplift their constituents and promote inclusive growth.',
            'main-container-bg' => asset('storage/LGU_bg.png'), // Using local image path
            // Add statistics variables
            'stat-1-number' => '24',
            'stat-1-label' => 'Barangay',
            'stat-2-number' => '1500+',
            'stat-2-label' => 'Residents',
            'stat-3-number' => '120+',
            'stat-3-label' => 'Public Projects',
            'stat-4-number' => '75',
            'stat-4-label' => 'Years of Service',
        ];

        foreach ($defaultContents as $key => $value) {
            PageContent::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        Log::info('PageContentController@initializeDefaultContent: Default content initialized.');
        return response()->json(['message' => 'Default content initialized successfully!']);
    }
}
