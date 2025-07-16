<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log; // Don't forget to import Log

class AdminAnnouncementController extends Controller
{
    /**
     * Display a listing of the resource for the admin panel.
     */
    public function index()
    {
        // This method will just load the view; data is fetched via AJAX
        return view('Components.Admin.Content-Manager.announcement.announcement');
    }

    /**
     * Get announcements data as JSON for AJAX requests.
     */
    public function getAnnouncementsData()
    {
        try {
            $announcements = Announcement::orderBy('date', 'desc')->get();
            return response()->json($announcements);
        } catch (\Exception $e) {
            Log::error('Error fetching announcements: ' . $e->getMessage());
            return response()->json(['message' => 'Error fetching announcements.'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'requester_name' => 'required|string|max:255',
                'date' => 'required|date',
                'author' => 'required|string|max:255',
                'content' => 'required|string',
                'is_new' => 'boolean', // is_new is optional for 'add', will default to false if not provided or cast
                'category' => 'required|string|max:255',
            ]);

            // Set is_new default if not provided (for 'add' mode, it defaults to true in Alpine, but good to have a backend fallback)
            $validatedData['is_new'] = $validatedData['is_new'] ?? true;

            $announcement = Announcement::create($validatedData);

            return response()->json(['message' => 'Announcement created successfully!', 'announcement' => $announcement], 201);
        } catch (ValidationException $e) {
            Log::error('Validation Error creating announcement: ' . $e->getMessage(), ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation Error', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating announcement: ' . $e->getMessage());
            return response()->json(['message' => 'Error creating announcement: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'requester_name' => 'required|string|max:255',
                'date' => 'required|date',
                'author' => 'required|string|max:255',
                'content' => 'required|string',
                'is_new' => 'boolean',
                'category' => 'required|string|max:255',
            ]);

            $announcement->update($validatedData);

            return response()->json(['message' => 'Announcement updated successfully!', 'announcement' => $announcement]);
        } catch (ValidationException $e) {
            Log::error('Validation Error updating announcement (ID: ' . ($announcement->id ?? 'N/A') . '): ' . $e->getMessage(), ['errors' => $e->errors()]);
            return response()->json(['message' => 'Validation Error', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating announcement (ID: ' . ($announcement->id ?? 'N/A') . '): ' . $e->getMessage());
            return response()->json(['message' => 'Error updating announcement: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        try {
            $announcement->delete();
            return response()->json(['message' => 'Announcement deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting announcement (ID: ' . ($announcement->id ?? 'N/A') . '): ' . $e->getMessage());
            return response()->json(['message' => 'Error deleting announcement: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove multiple resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $request->validate([
                'ids' => 'required|array|min:1',
                'ids.*' => 'required|integer|exists:announcements,id',
            ]);

            $count = Announcement::whereIn('id', $request->ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Announcements deleted successfully',
                'count' => $count
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server Error: ' . $e->getMessage()
            ], 500);
        }
    }
}