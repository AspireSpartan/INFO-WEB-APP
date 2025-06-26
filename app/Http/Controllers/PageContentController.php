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
                    'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                ]);

                $key = $request->input('key');
                $value = $request->input('value');
                $file = $request->file('file');

                if ($request->hasFile('file')) {
                    Log::info('PageContentController@update: File detected for key: ' . $key); 
                    $path = $file->store('page_images', 'public');
                    $value = asset('storage/' . $path);
                    Log::info('PageContentController@update: File stored at: ' . $path . ', generated URL (using asset()): ' . $value); 
                } else {
                    Log::info('PageContentController@update: No new file uploaded for key: ' . $key . ', using provided value: ' . ($value ?? 'NULL (empty value)'));
                }

                $pageContent = PageContent::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );

                Log::info('PageContentController@update: Content saved to DB:', ['key' => $pageContent->key, 'value' => $pageContent->value]);

                return response()->json([
                    'message' => 'Content updated successfully!',
                    'key' => $pageContent->key,
                    'value' => $pageContent->value
                ]);
            }

            public function index() // Or whatever your method name is, e.g., 'showDashboard', 'manage'
            {
                // Fetch all page content from the database and pluck into an associative array
                $pageContent = PageContent::pluck('value', 'key')->toArray();

                // Return the admin dashboard view, passing the $pageContent array
                // Make sure this path ('Admin_Side_Screen.Admin-Dashboard') matches how you call the view in your route
                return view('Admin_Side_Screen.Admin-Dashboard', compact('pageContent'));
            }
            // The initializeDefaultContent() method has been removed and moved to PageContentSeeder.php
        }
        