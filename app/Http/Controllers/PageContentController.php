<?php

namespace App\Http\Controllers;

        use App\Models\PageContent;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Storage;
        use Illuminate\Support\Facades\Log;

        class PageContentController extends Controller
        {

            public function show()
            {
                $contents = PageContent::all()->pluck('value', 'key')->toArray();
                Log::info('PageContentController@show: Fetched content', $contents);
                return response()->json($contents);
            }

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
                    $value = $path; 
                }

                $pageContent = PageContent::updateOrCreate(['key' => $key], ['value' => $value]);

                Log::info('PageContentController@update: Content saved to DB:', ['key' => $key, 'value' => $value]);

                return response()->json(['key' => $key, 'value' => $value]);
            }

            public function index() 
            {
                $pageContent = PageContent::pluck('value', 'key')->toArray();
                return view('Components.Admin.Ad-Header.Ad-Header', compact('pageContent'));
            }
        }
        