<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Project;
use App\Models\Blogfeed;
use App\Models\NewsItem;
use App\Models\PageContent;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\ProjectDescription;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource (all blog posts).
     * This method fetches all blog posts and passes them to a view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::all();
        $description = ProjectDescription::first();
        $pageContent = PageContent::pluck('value', 'key')->toArray();
        $blogfeeds = Blogfeed::orderBy('published_at', 'desc')->get();
        $newsItems = NewsItem::orderBy('date', 'desc')->get();
        $contactMessages = ContactMessage::all(); // Or filter if you only need unread messages
        $isViewportPresent = request()->has('viewport'); // Adjust this condition as needed

        if ($isViewportPresent) {
            return view('Components.Admin.blog.blog_content', compact('blogfeeds'));
        }
        return view('Components.Admin.Ad-Header.Ad-Header', compact('blogfeeds', 'newsItems', 'contactMessages', 'pageContent', 'projects', 'description'));
    }

    /**
     * Show the form for creating a new resource (new blog post).
     * This method simply returns the view containing the form for creating a new blog post.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        // Redirect to index, flag to show create modal, and set active screen to 'blog'
        return redirect()->route('blogs.index')
                        ->with('showCreateBlogModal', true)
                        ->with('activeAdminScreen', 'blog'); // Added this line
    }

    /**
     * Store a newly created resource in storage (a new blog post).
     * This method handles the form submission for creating a new blog post,
     * including validation, file uploads, and saving to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Use the Validator facade for manual validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'author' => 'required|string|max:255',
            'authortitle' => 'nullable|string|max:255',
            'image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8049', // Max 8MB
            'icon_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:999',   // Max 999KB
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Redirect back with validation errors, old input, and the flag to reopen the modal
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput()
                             ->with('showCreateBlogModal', true)
                             ->with('activeAdminScreen', 'blog'); // Added this line for error redirect
        }

        // If validation passes, get the validated data
        $validatedData = $validator->validated();

        $blogfeed = new Blogfeed();

        if ($request->hasFile('image_upload')) {
            $blogfeed->image_path = $request->file('image_upload')->store('blog_images', 'public');
        } else {
            $blogfeed->image_path = null;
        }

        if ($request->hasFile('icon_upload')) {
            $blogfeed->icon_path = $request->file('icon_upload')->store('blog_icons', 'public');
        } else {
            $blogfeed->icon_path = null;
        }

        // Use $validatedData to assign values
        $blogfeed->title = $validatedData['title'];
        $blogfeed->content = $validatedData['content'];
        $blogfeed->published_at = Carbon::parse($validatedData['published_at'])->format('Y-m-d H:i:s'); // Ensure correct date format
        $blogfeed->author = $validatedData['author'];
        $blogfeed->authortitle = $validatedData['authortitle'];

        $blogfeed->save();

        // Redirect back to the blog index and show success, and close the modal
        return redirect()->route('blogs.index')
                        ->with('success', 'Blog post created successfully!')
                        ->with('activeAdminScreen', 'blog'); // Added this line
    }

    public function show(Blogfeed $blogfeed)
    {
        // This view path might also need adjustment if it's not directly in resources/views/blogs/show.blade.php
        return view('blogs.show', compact('blogfeed')); //currently this line works even if i didn't add these next lines.
    }

    /**
     * Show the form for editing the specified resource (existing blog post).
     * This method retrieves an existing blog post and passes it to an edit form view.
     * It uses Route Model Binding for cleaner code.
     *
     * @param  \App\Models\Blogfeed  $blogfeed
     * @return \Illuminate\View\View
     */
    public function edit(Blogfeed $blogfeed)
    {
        // This path should be correct based on your previous input
        // When going to the edit view, also flash the active screen so a refresh returns to blog view
        session()->flash('activeAdminScreen', 'blog'); // Added this to set screen on entering edit view
        return view('Components.Admin.blog.edit', compact('blogfeed'));
    }

    /**
     * Update the specified resource in storage (an existing blog post).
     * This method handles the form submission for updating a blog post,
     * including validation, file uploads (replacing old ones), and updating the database.
     * It uses Route Model Binding.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogfeed  $blogfeed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Blogfeed $blogfeed)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'authortitle' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8049', // Max 8MB
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:999',   // Max 999KB
            'published_at' => 'required|date',
        ]);

        $data = $request->except(['_token', '_method', 'image', 'icon']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists before uploading new one
            if ($blogfeed->image_path) {
                Storage::disk('public')->delete($blogfeed->image_path);
            }
            $data['image_path'] = $request->file('image')->store('blog_images', 'public');
        }

        // Handle icon upload
        if ($request->hasFile('icon')) {
            // Delete old icon if it exists before uploading new one
            if ($blogfeed->icon_path) {
                Storage::disk('public')->delete($blogfeed->icon_path);
            }
            $data['icon_path'] = $request->file('icon')->store('blog_icons', 'public');
        }

        // Format published_at to database-friendly format (assuming DATETIME/TIMESTAMP column)
        if ($request->has('published_at')) {
            $data['published_at'] = Carbon::parse($request->input('published_at'))->format('Y-m-d H:i:s');
        }

        $blogfeed->update($data);

        // Redirect back to the blog index and show success message, setting the active screen
        return redirect()->route('blogs.index')
                        ->with('success', 'Blog post updated successfully!')
                        ->with('activeAdminScreen', 'blog'); // Added this line
    }

    /**
     * Remove the specified resource from storage (a blog post).
     * This method handles deleting a blog post, including its associated image files.
     * It uses Route Model Binding.
     *
     * @param  \App\Models\Blogfeed  $blogfeed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Blogfeed $blogfeed)
    {
        // 1. Delete associated image files from storage
        if ($blogfeed->image_path && Storage::disk('public')->exists($blogfeed->image_path)) {
            Storage::disk('public')->delete($blogfeed->image_path);
        }
        if ($blogfeed->icon_path && Storage::disk('public')->exists($blogfeed->icon_path)) {
            Storage::disk('public')->delete($blogfeed->icon_path);
        }

        // 2. Delete the blog post record from the database
        $blogfeed->delete();

        // 3. Redirect with a success message, ensuring the 'blog' screen is active
        return redirect()->route('blogs.index')
                        ->with('success', 'Blog post deleted successfully!')
                        ->with('activeAdminScreen', 'blog'); // Added this line
    }
}
