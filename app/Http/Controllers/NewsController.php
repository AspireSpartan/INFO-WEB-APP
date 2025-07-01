<?php

namespace App\Http\Controllers;

use App\Models\News; // This might be an old model, ensure you're using NewsItem if it's the primary one
use App\Models\Blogfeed;
use App\Models\NewsItem;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Added for logging

class NewsController extends Controller
{
    /**
     * Display a listing of the news items (for admin dashboard).
     * This function now serves as the index for news items in the admin area.
     */
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

        $contactMessages = ContactMessage::latest()->get(); // Fetch contact messages
        $blogfeeds = Blogfeed::all();

        // This method just loads the view with data. The active screen logic is in Ad-Header.blade.php
        return view('Components.Admin.Ad-Header.Ad-Header', compact('newsItems', 'request', 'contactMessages', 'blogfeeds'));
    }

    /**
     * Remove multiple specified news items from storage.
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array', // Expect 'ids'
            'ids.*' => 'exists:news_items,id',
        ]);

        $newsItemIds = $request->input('ids'); // Get 'ids'

        if (empty($newsItemIds)) {
            // Redirect to news index and keep on news screen
            return redirect()->route('news.index')
                             ->with('error', 'No news items selected for deletion.')
                             ->with('activeAdminScreen', 'news');
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

        // Redirect to news index and keep on news screen
        return redirect()->route('news.index')
                         ->with('success', 'Selected news items deleted successfully!')
                         ->with('activeAdminScreen', 'news');
    }

    /**
     * Show the form for creating a new news item.
     * This method redirects to the news index with a flag to open the create modal.
     */
    public function create()
    {
        // Redirect to news index, flag to show create modal, and set active screen to 'news'
        // CHANGED: showCreateNewsModal to showUploadModal to match your existing modal component
        return redirect()->route('news.index')
                         ->with('showUploadModal', true) // Flag to open the existing upload modal
                         ->with('activeAdminScreen', 'news'); // Ensure 'news' screen is active
    }

    /**
     * Store a newly created news item in storage.
     */
    public function store(Request $request)
    {
        Log::info('News item store request:', $request->all());

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8242880', // Max 8MB
            'author' => 'required|string|max:255',
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'sponsored' => 'boolean',
            'views' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('news_images', 'public');
                $validatedData['picture'] = $imagePath;
                Log::info('Image uploaded successfully: ' . $imagePath);
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                // CHANGED: showCreateNewsModal to showUploadModal for error redirect
                return redirect()->back()
                                 ->withInput()
                                 ->withErrors(['image' => 'Failed to upload image. Please try again.'])
                                 ->with('showUploadModal', true) // Re-open the existing upload modal on error
                                 ->with('activeAdminScreen', 'news'); // Keep on news screen
            }
        } else {
            Log::warning('No image file found in the request.');
            // CHANGED: showCreateNewsModal to showUploadModal for error redirect
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['image' => 'Image file is required.'])
                             ->with('showUploadModal', true) // Re-open the existing upload modal on error
                             ->with('activeAdminScreen', 'news'); // Keep on news screen
        }

        $validatedData['sponsored'] = $request->has('sponsored');
        $validatedData['views'] = $validatedData['views'] ?? 0;

        try {
            NewsItem::create($validatedData);
            Log::info('News item created successfully.', $validatedData);
            // Redirect to news index and keep on news screen
            return redirect()->route('news.index')
                             ->with('success', 'News item uploaded successfully!')
                             ->with('activeAdminScreen', 'news');
        } catch (\Exception $e) {
            Log::error('Failed to create news item: ' . $e->getMessage());
            // CHANGED: showCreateNewsModal to showUploadModal for error redirect
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['error' => 'Failed to save news item. Please try again.'])
                             ->with('showUploadModal', true) // Re-open the existing upload modal on error
                             ->with('activeAdminScreen', 'news'); // Keep on news screen
        }
    }

    /**
     * Display the specified news item (for public view).
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
        // Ensure 'news' screen is active if refreshed or returning from edit
        session()->flash('activeAdminScreen', 'news');
        return view('Components.Admin.edit.edit', compact('newsItem')); // Assuming this is your news edit view
    }

    /**
     * Update the specified news item in storage.
     */
    public function update(Request $request, $id)
    {
        $newsItem = NewsItem::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date' => 'required|date',
            'url' => 'required|url',
            'sponsored' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8242880', // Max 8MB
            'views' => 'nullable|integer|min:0',
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
                return redirect()->back()
                                 ->withInput()
                                 ->withErrors(['image' => 'Failed to upload new image.'])
                                 ->with('activeAdminScreen', 'news'); // Keep on news screen
            }
        } else {
            // If no new image is uploaded, retain the old one
            $validatedData['picture'] = $newsItem->picture;
        }

        $validatedData['sponsored'] = $request->has('sponsored');
        $validatedData['views'] = $validatedData['views'] ?? $newsItem->views;

        try {
            $newsItem->update($validatedData);
            Log::info('News item updated successfully.', $validatedData);
            // Redirect to news index and keep on news screen
            return redirect()->route('news.index')
                             ->with('success', 'News item updated successfully!')
                             ->with('activeAdminScreen', 'news');
        } catch (\Exception $e) {
            Log::error('Failed to update news item: ' . $e->getMessage());
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['error' => 'Failed to update news item. Please try again.'])
                             ->with('activeAdminScreen', 'news'); // Keep on news screen
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
        // Redirect to news index and keep on news screen
        return redirect()->route('news.index')
                         ->with('success', 'News item deleted successfully!')
                         ->with('activeAdminScreen', 'news');
    }

    /**
     * Increment the views count for a specific news item.
     *
     * @param  \App\Models\NewsItem  $newsItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function incrementViews(NewsItem $newsItem)
    {
        $newsItem->increment('views');

        return response()->json([
            'success' => true,
            'message' => 'View count incremented successfully.',
            'views' => $newsItem->views // Return the new views count
        ]);
    }
}
