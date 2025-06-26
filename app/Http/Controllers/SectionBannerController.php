<?php

namespace App\Http\Controllers;

use Carbon\Carbon; 
use App\Models\SectionBanner; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // For logging
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
    // app/Http/Controllers/SectionBannerController.php

    public function index()
    {
        // Retrieve the single latest (or the one you want to edit by default) section banner.
        // If you only ever have ONE main banner to edit, `first()` is sufficient.
        // orderBy('created_at', 'desc') ensures you get the newest if there are multiple.
        $sectionBanner = SectionBanner::orderBy('created_at', 'desc')->first();

        // IMPORTANT: If no banner exists yet, create a new empty SectionBanner model.
        // This prevents errors when the form tries to access properties on a null object.
        if (!$sectionBanner) {
            $sectionBanner = new SectionBanner(); // Create an empty model instance
        }

        // Now, pass this single SectionBanner model object to your view.
        return view('admin.section_banners.index', compact('sectionBanner'));
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
    public function update(Request $request, SectionBanner $section_banner) // Using $section_banner for route model binding
    {
        // Check if it's an in-place edit request from the banner component
        if ($request->has('field_name')) { // Only check for field_name, as 'value' might be a file
            $fieldName = $request->input('field_name');

            // Validate the field name to prevent mass assignment vulnerabilities
            $allowedFields = [
                'background_image', // Add background_image to allowed fields
                'header1', 'header2', 'header3', 'header4', 'description',
                'barangay', 'residents', 'projects', 'yrs_service'
            ];

            if (!in_array($fieldName, $allowedFields)) {
                Log::warning("Attempted to update disallowed field: {$fieldName}", ['user_id' => auth()->id() ?? 'guest']);
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Invalid field for update.'], 400);
                }
                abort(400, 'Invalid field for update.');
            }

            try {
                if ($fieldName === 'background_image') {
                    // Handle image upload specifically
                    if ($request->hasFile('value')) { // 'value' is the name of the file input
                        // Delete old image if it exists
                        if ($section_banner->background_image) {
                            Storage::disk('public')->delete($section_banner->background_image);
                        }
                        $imagePath = $request->file('value')->store('banner_images', 'public'); // Store under 'banner_images'
                        $section_banner->background_image = $imagePath;
                    } else {
                        // If no file uploaded but 'background_image' was the field, allow clearing if desired
                        // For now, if no new file is selected, old one remains.
                        // To allow clearing, you'd need a checkbox in the modal.
                    }
                } else {
                    // Handle non-file fields
                    $newValue = $request->input('value');

                    // Specific validation for number fields if not handled by Alpine for some reason
                    if (in_array($fieldName, ['barangay', 'residents', 'projects', 'yrs_service'])) {
                        $request->validate([
                            'value' => 'nullable|integer|min:0',
                        ]);
                    } else {
                        $request->validate([
                            'value' => 'nullable|string|max:255',
                        ]);
                    }
                    $section_banner->{$fieldName} = $newValue;
                }

                $section_banner->save();

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => true, 'message' => 'Banner field updated successfully.', 'newValue' => $section_banner->{$fieldName}]);
                }
                return redirect()->back()->with('success', 'Banner field updated successfully.');

            } catch (\Exception $e) {
                Log::error("Error updating banner field '{$fieldName}': " . $e->getMessage(), ['exception' => $e]);
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'Failed to update banner field. ' . $e->getMessage()], 500);
                }
                return redirect()->back()->with('error', 'Failed to update banner field.');
            }
        }

        // --- Original form submission handling (if you still have a full edit form) ---
        // Keep this if you have a separate full edit form that submits to this method
        // Otherwise, you can remove this entire block if all edits are in-place.
        $request->validate([
            'header1' => 'nullable|string|max:255',
            'header2' => 'nullable|string|max:255',
            'header3' => 'nullable|string|max:255',
            'header4' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'barangay' => 'nullable|integer|min:0',
            'residents' => 'nullable|integer|min:0',
            'projects' => 'nullable|integer|min:0',
            'yrs_service' => 'nullable|integer|min:0',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        if ($request->hasFile('background_image')) {
            if ($section_banner->background_image) {
                Storage::disk('public')->delete($section_banner->background_image);
            }
            $imagePath = $request->file('background_image')->store('section_banners', 'public');
            $section_banner->background_image = $imagePath;
        }

        $section_banner->update($request->except(['_token', '_method', 'background_image']));
        $section_banner->save();

        return redirect()->route('admin.section-banners.index')->with('success', 'Section Banner updated successfully.');
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

    public function showAdminDashboard()
    {
        // Fetch the latest banner here, similar to your SectionBannerController@index
        $sectionBanner = SectionBanner::orderBy('created_at', 'desc')->first();

        if (!$sectionBanner) {
            $sectionBanner = new SectionBanner();
        }

        // Pass the single $sectionBanner to your dashboard view
        return view('Admin_Side_Screen.Admin-Dashboard', compact('sectionBanner'));
    }

    public function updateBackgroundImage(Request $request, $id)
{
    $sectionBanner = SectionBanner::findOrFail($id);

    if ($request->hasFile('background_image')) {
        $path = $request->file('background_image')->store('section_banners', 'public');
        $sectionBanner->background_image = $path;
        $sectionBanner->save();
    }

    return redirect()->back()->with('success', 'Background image updated.');
}

}
