<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsfeed;
use Illuminate\Support\Facades\Storage; // Import the Storage facade

class NewsfeedController extends Controller
{
    /**
     * Show the form for editing the specified newsfeed.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $newsfeed = Newsfeed::findOrFail($id);
        return view('newsfeeds.edit', compact('newsfeed'));
    }

    /**
     * Update the specified newsfeed in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $newsfeed = Newsfeed::findOrFail($id);

        // 1. Validate the incoming request data
        // Ensure that the file input names (image_path, icon_path) match what's in your form
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'author' => 'required|string|max:255',
            'authortitle' => 'nullable|string|max:255', // Uncomment if you add authortitle to DB schema
            'image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Allow images, max 2MB
            'icon_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',  // Allow images, max 500KB
        ]);

        // 2. Handle main image upload
        if ($request->hasFile('image_upload')) {
            // Delete old image if it exists and is not a placeholder/external URL
            if ($newsfeed->image_path && Storage::disk('public')->exists($newsfeed->image_path)) {
                Storage::disk('public')->delete($newsfeed->image_path);
            }
            // Store the new image and get its path relative to the 'public' disk
            $validatedData['image_path'] = $request->file('image_upload')->store('news_images', 'public');
        } else {
            // If no new image is uploaded, retain the old path from the database
            $validatedData['image_path'] = $newsfeed->image_path;
        }

        // 3. Handle mini icon upload
        if ($request->hasFile('icon_upload')) {
            // Delete old icon if it exists
            if ($newsfeed->icon_path && Storage::disk('public')->exists($newsfeed->icon_path)) {
                Storage::disk('public')->delete($newsfeed->icon_path);
            }
            // Store the new icon
            $validatedData['icon_path'] = $request->file('icon_upload')->store('news_icons', 'public');
        } else {
            // If no new icon is uploaded, retain the old path from the database
            $validatedData['icon_path'] = $newsfeed->icon_path;
        }

        // 4. Update the Newsfeed record with all validated data
        // Ensure you remove the 'image_upload' and 'icon_upload' keys
        // from validatedData before passing to update() if you named your DB columns differently.
        // Or, explicitly assign:
        $newsfeed->title = $validatedData['title'];
        $newsfeed->content = $validatedData['content'];
        $newsfeed->published_at = $validatedData['published_at'];
        $newsfeed->author = $validatedData['author'];
        $newsfeed->authortitle = $validatedData['authortitle'];
        $newsfeed->image_path = $validatedData['image_path'];
        $newsfeed->icon_path = $validatedData['icon_path'];

        $newsfeed->save();

        // 5. Redirect back or to a specific route
        return redirect()->route('newsfeeds.index')->with('success', 'Newsfeed updated successfully!');
        // Or redirect back to the edit page: return back()->with('success', 'Newsfeed updated successfully!');
    }

    /**
     * Display a listing of the newsfeeds.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $newsfeeds = Newsfeed::all();
        return view('home', compact('newsfeeds'));
    }
}
