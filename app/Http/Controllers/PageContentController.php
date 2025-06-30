<?php

namespace App\Http\Controllers;

        use App\Models\PageContent;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Storage;
        use Illuminate\Support\Facades\Log;

        class PageContentController extends Controller
        {
            /**
             * Display all page content.
             * This will return all key-value pairs stored in the database.
             */
            public function show()
            {
                $contents = PageContent::all()->pluck('value', 'key')->toArray();
                Log::info('PageContentController@show: Fetched content', $contents);
                return response()->json($contents);
            }

            /**
             * Update specified page content.
             * Handles both text and image updates.
             */
            public function update(Request $request)
            {
                Log::info('PageContentController@update: Request received', $request->all());

                $request->validate([
                    'key' => 'required|string',
                    'value' => 'nullable|string',
                    'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:10120',
                ]);

                $key = $request->input('key');
                $value = $request->input('value');

                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $path = $file->store('page_images', 'public');
                    $value = $path; // Only 'page_images/filename.png'
                }

                $pageContent = PageContent::updateOrCreate(['key' => $key], ['value' => $value]);

                Log::info('PageContentController@update: Content saved to DB:', ['key' => $key, 'value' => $value]);

                return response()->json(['key' => $key, 'value' => $value]);
            }

            public function index() // Or whatever your method name is, e.g., 'showDashboard', 'manage'
            {
                // Fetch all page content from the database and pluck into an associative array
                $pageContent = PageContent::pluck('value', 'key')->toArray();

                // Return the admin dashboard view, passing the $pageContent array
                // Make sure this path ('Admin_Side_Screen.Admin-Dashboard') matches how you call the view in your route
                return view('Components.Admin.Ad-Header.Ad-Header', compact('pageContent'));
            }
            // The initializeDefaultContent() method has been removed and moved to PageContentSeeder.php
        }
        