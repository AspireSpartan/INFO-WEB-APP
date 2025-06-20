<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsItem;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Added for logging

class NewsController extends Controller
{
    /**
     * Display a listing of the news items (for admin dashboard).
     * This function now serves as the index for news items in the admin area.
     */

    /*public function index()
    {
        $newsItems = NewsItem::orderBy('date', 'desc')->get();
        return view('Admin_Side_Screen.Admin-Dashboard', compact('newsItems'));
    }*/

    /* this area is the filtering, search, sorting, checkboxes, and the delete all button. */
        public function index(Request $request)
    {
        $query = NewsItem::query();

        // --- Search Functionality ---
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('author', 'like', '%' . $searchTerm . '%')
                ->orWhere('url', 'like', '%' . $searchTerm . '%');
            });
        }

        // --- Filter by Sponsored Functionality ---
        if ($request->has('sponsored_filter') && $request->input('sponsored_filter') != 'all') {
            if ($request->input('sponsored_filter') == 'sponsored') {
                $query->where('sponsored', true);
            } elseif ($request->input('sponsored_filter') == 'non-sponsored') {
                $query->where('sponsored', false);
            }
        }

        // --- Sort By Functionality ---
        $sortBy = $request->input('sort_by', 'date_desc'); // Default sort: date (newest)
        switch ($sortBy) {
            case 'date_asc':
                $query->orderBy('date', 'asc');
                break;
            case 'views_desc':
                $query->orderBy('views', 'desc');
                break;
            case 'views_asc':
                $query->orderBy('views', 'asc');
                break;
            case 'date_desc': // Default case
            default:
                $query->orderBy('date', 'desc');
                break;
        }

        $newsItems = $query->get();

        // <--- IMPORTANT ADDITION/MODIFICATION HERE ---
        $contactMessages = ContactMessage::latest()->get(); // Fetch contact messages

        return view('Admin_Side_Screen.Admin-Dashboard', compact('newsItems', 'request', 'contactMessages')); // Pass them to the view
        // <--- END IMPORTANT ADDITION/MODIFICATION ---
    }


            /**
         * Remove multiple specified news items from storage.
         */
    public function bulkDestroy(Request $request)
    {
        // The JavaScript sends 'ids[]', so validate and get 'ids'
        $request->validate([
            'ids' => 'required|array', // Expect 'ids'
            'ids.*' => 'exists:news_items,id',
        ]);

        $newsItemIds = $request->input('ids'); // Get 'ids'

        if (empty($newsItemIds)) {
            // This case should be caught by the client-side alert or validation,
            // but as a fallback, ensure we don't proceed with an empty array.
            return redirect()->route('admin.dashboard')->with('error', 'No news items selected for deletion.');
        }

        foreach ($newsItemIds as $id) {
            $newsItem = NewsItem::find($id);
            if ($newsItem) {
                // Delete associated image from storage
                if ($newsItem->picture && Storage::disk('public')->exists($newsItem->picture)) {
                    Storage::disk('public')->delete($newsItem->picture);
                    Log::info('Image deleted during bulk news item destruction: ' . $newsItem->picture);
                }
                $newsItem->delete();
                Log::info('News item deleted during bulk operation: ' . $id);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Selected news items deleted successfully!');
    }
        

    /**
     * Show the form for creating a new news item.
     * (You might need a dedicated view for this, or it can be part of the Admin-Dashboard view)
     */
    public function create()
    {
        // If you have a separate form for creating news items, return that view here.
        // For now, assuming creation happens on the Admin-Dashboard itself.
        return view('Admin_Side_Screen.Admin-Dashboard');
    }

    /**
     * Store a newly created news item in storage.
     */
    public function store(Request $request)
    {
        // Log the request data for debugging
        Log::info('News item store request:', $request->all());

        // Validate the incoming request data
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8242880', // Adjusted max size to 8MB based on your recollection (8049MB is too large for typical uploads, so I'm using 8MB as a more realistic interpretation of '8049MB')
            'author' => 'required|string|max:255',
            'date' => 'required|date', // Changed from 'current_date' to 'date' to match your schema
            'title' => 'required|string|max:255', // Increased max length for title, 50 characters might be too short. Adjust as needed.
            'url' => 'required|url',
            'sponsored' => 'boolean', // 'required' is not necessary if it's a checkbox that might not be checked. If it always has a default, it's fine.
            'views' => 'nullable|integer|min:0', // Added 'views' as nullable integer
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('news_images', 'public'); // Store in 'news_images' directory
                $validatedData['picture'] = $imagePath;
                Log::info('Image uploaded successfully: ' . $imagePath);
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                return redirect()->back()->withInput()->withErrors(['image' => 'Failed to upload image. Please try again.']);
            }
        } else {
            Log::warning('No image file found in the request.');
            return redirect()->back()->withInput()->withErrors(['image' => 'Image file is required.']);
        }

        // Add default for sponsored if not present (e.g., if checkbox is not checked)
        $validatedData['sponsored'] = $request->has('sponsored'); // This will set it to true if present, false otherwise

        // Default views to 0 if not provided
        $validatedData['views'] = $validatedData['views'] ?? 0;

        try {
            // Create and save the news item
            NewsItem::create($validatedData);
            Log::info('News item created successfully.', $validatedData);
            return redirect()->back()->with('success', 'News item uploaded successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create news item: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to save news item. Please try again.']);
        }
    }

    /**
     * Display the specified news item.
     */
    public function show(NewsItem $newsItem) // Using route model binding
    {
        return view('User_Side_Screen.single_news', compact('newsItem')); // Assuming you have a view for a single news item
    }

    /**
     * Show the form for editing the specified news item.
     */
    public function edit($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        return view('Components.Admin.edit.edit', compact('newsItem')); // Assuming you have a news.edit view
    }

    /**
     * Update the specified news item in storage.
     */
    public function update(Request $request, $id)
    {
        $newsItem = NewsItem::findOrFail($id);

        // Validate the incoming request data for update
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', // Increased max length
            'author' => 'required|string|max:255',
            'date' => 'required|date', // Changed from 'current_date' to 'date'
            'url' => 'required|url',
            'sponsored' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8242880', // Adjusted max size
            'views' => 'nullable|integer|min:0', // Added 'views' as nullable integer
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($newsItem->picture && Storage::disk('public')->exists($newsItem->picture)) {
                Storage::disk('public')->delete($newsItem->picture);
                Log::info('Old image deleted: ' . $newsItem->picture);
            }
            // Store new image
            try {
                $validatedData['picture'] = $request->file('image')->store('news_images', 'public');
                Log::info('New image uploaded: ' . $validatedData['picture']);
            } catch (\Exception $e) {
                Log::error('Image update failed: ' . $e->getMessage());
                return redirect()->back()->withInput()->withErrors(['image' => 'Failed to upload new image.']);
            }
        } else {
            // If no new image is uploaded, retain the old one
            $validatedData['picture'] = $newsItem->picture;
        }

        // Add default for sponsored if not present
        $validatedData['sponsored'] = $request->has('sponsored');

        // Default views to 0 if not provided
        $validatedData['views'] = $validatedData['views'] ?? $newsItem->views; // Keep existing views if not provided

        try {
            // Update the news item
            $newsItem->update($validatedData);
            Log::info('News item updated successfully.', $validatedData);
            return redirect()->route('news.index')->with('success', 'News item updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update news item: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update news item. Please try again.']);
        }
    }

    /**
     * Remove the specified news item from storage.
     */
    public function destroy($id)
    {
        $newsItem = NewsItem::findOrFail($id);

        // Delete associated image from storage
        if ($newsItem->picture && Storage::disk('public')->exists($newsItem->picture)) {
            Storage::disk('public')->delete($newsItem->picture);
            Log::info('Image deleted during news item destruction: ' . $newsItem->picture);
        }

        $newsItem->delete();
        Log::info('News item deleted: ' . $id);
        return redirect()->route('news.index')->with('success', 'News item deleted successfully!');
    }

        /**
     * Increment the views count for a specific news item.
     *
     * @param  \App\Models\NewsItem  $newsItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function incrementViews(NewsItem  $newsItem)
    {
        // Increment the views column
        //$newsItem = NewsItem::findOrFail($id);
        $newsItem->increment('views');

        // You can return the updated views count or just a success message
        return response()->json([
            'success' => true,
            'message' => 'View count incremented successfully.',
            'views' => $newsItem->views // Return the new views count
        ]);
    }
}