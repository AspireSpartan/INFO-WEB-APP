<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller to handle user-facing announcements.
 */
class AnnouncementController extends Controller
{
    public function index(): View
    {
        // Fetch announcements with pagination for a full-page view
        $announcements = Announcement::orderBy('date', 'desc')->paginate(9); 
        
        // Get all unique categories for filtering
        $categories = array_merge(['All'], Announcement::select('category')->distinct()->pluck('category')->toArray());

        // Return a view (you would need to create this blade file)
        return view('user_side_screen.announcements_index', [
            'announcements' => $announcements,
            'categories' => $categories
        ]);
    }
}
