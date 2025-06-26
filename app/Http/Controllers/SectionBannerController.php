<?php

namespace App\Http\Controllers;

use Carbon\Carbon; // For handling dates
use App\Models\SectionBanner; // Don't forget to import the SectionBanner model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // For file storage operations
use Illuminate\Support\Facades\Validator; // For manual validation in store/update

class SectionBannerController extends Controller
{
    /**
     * Display a listing of the resource (all section banners).
     * This method fetches all banner records and passes them to a view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all section banner records from the database, ordered by creation date
        $sectionBanners = SectionBanner::orderBy('created_at', 'desc')->get();

        // You'll likely want to integrate this into your admin dashboard.
        // For demonstration, we'll return a basic view.
        // You might need to pass other dashboard data here (e.g., newsItems, contactMessages)
        // if this view is part of your main admin layout.
        return view('admin.section_banners.index', compact('sectionBanners'));
    }

    /**
     * Show the form for creating a new resource (new section banner).
     * This method simply returns the view containing the form for creating a new banner.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Return the view for creating a new section banner
        // This view will contain the form for user input
        return view('admin.section_banners.create');
    }

    /**
     * Store a newly created resource in storage (a new section banner).
     * This method handles form submission for creating a new banner,
     * including validation, file uploads, and saving to the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        // Use Validator facade for manual validation to handle redirect with input/errors
        $validator = Validator::make($request->all(), [
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8049', // Max 8MB
            'header1'          => 'nullable|string|max:255',
            'header2'          => 'nullable|string|max:255',
            'header3'          => 'nullable|string|max:255',
            'header4'          => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'barangay'         => 'nullable|integer',
            'residents'        => 'nullable|integer',
            'projects'         => 'nullable|integer',
            'yrs_service'      => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get validated data
        $validatedData = $validator->validated();

        // Create a new SectionBanner instance
        $sectionBanner = new SectionBanner();

        // 2. Handle background image upload
        if ($request->hasFile('background_image')) {
            // Store the new image and get its path relative to the 'public' disk
            $sectionBanner->background_image = $request->file('background_image')->store('banner_images', 'public');
        } else {
            // Set null if no image is uploaded
            $sectionBanner->background_image = null;
        }

        // 3. Assign other validated data to the new SectionBanner record
        $sectionBanner->fill($validatedData); // Use fill for mass assignment of other fields

        // Save the new banner record to the database
        $sectionBanner->save();

        // 4. Redirect with a success message to the index page
        return redirect()->route('section_banners.index')->with('success', 'Section Banner created successfully!');
    }

    /**
     * Display the specified resource (a single section banner).
     * This method uses Route Model Binding to automatically fetch the SectionBanner instance.
     *
     * @param  \App\Models\SectionBanner  $sectionBanner
     * @return \Illuminate\View\View
     */
    public function show(SectionBanner $sectionBanner)
    {
        // Return the 'admin.section_banners.show' view with the specific sectionBanner data.
        return view('admin.section_banners.show', compact('sectionBanner'));
    }

    /**
     * Show the form for editing the specified resource (existing section banner).
     * This method retrieves an existing banner and passes it to an edit form view.
     * It uses Route Model Binding for cleaner code.
     *
     * @param  \App\Models\SectionBanner  $sectionBanner
     * @return \Illuminate\View\View
     */
    public function edit(SectionBanner $sectionBanner)
    {
        // Pass the sectionBanner instance to the 'admin.section_banners.edit' view
        return view('admin.section_banners.edit', compact('sectionBanner'));
    }

    /**
     * Update the specified resource in storage (an existing section banner).
     * This method handles the form submission for updating a banner,
     * including validation, file uploads (replacing old ones), and updating the database.
     * It uses Route Model Binding.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SectionBanner  $sectionBanner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SectionBanner $sectionBanner)
    {
        // 1. Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8049', // Max 8MB
            'header1'          => 'nullable|string|max:255',
            'header2'          => 'nullable|string|max:255',
            'header3'          => 'nullable|string|max:255',
            'header4'          => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'barangay'         => 'nullable|integer',
            'residents'        => 'nullable|integer',
            'projects'         => 'nullable|integer',
            'yrs_service'      => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        // 2. Handle background image update
        if ($request->hasFile('background_image')) {
            // Delete old image if it exists before uploading new one
            if ($sectionBanner->background_image) {
                Storage::disk('public')->delete($sectionBanner->background_image);
            }
            // Store the new image
            $sectionBanner->background_image = $request->file('background_image')->store('banner_images', 'public');
        }
        // If no new image is uploaded, the old one remains.
        // If you want to allow clearing an image, you'd add a checkbox and check for it.

        // 3. Update other fields. Use fill to update all validated data at once.
        $sectionBanner->fill($validatedData);

        // Save the changes to the database
        $sectionBanner->save();

        // 4. Redirect with a success message to the index page
        return redirect()->route('section_banners.index')->with('success', 'Section Banner updated successfully!');
    }

    /**
     * Remove the specified resource from storage (a section banner).
     * This method handles deleting a banner, including its associated image file.
     * It uses Route Model Binding.
     *
     * @param  \App\Models\SectionBanner  $sectionBanner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SectionBanner $sectionBanner)
    {
        // 1. Delete associated background image file from storage
        if ($sectionBanner->background_image && Storage::disk('public')->exists($sectionBanner->background_image)) {
            Storage::disk('public')->delete($sectionBanner->background_image);
        }

        // 2. Delete the section banner record from the database
        $sectionBanner->delete();

        // 3. Redirect with a success message to the index page
        return redirect()->route('section_banners.index')->with('success', 'Section Banner deleted successfully!');
    }
}
