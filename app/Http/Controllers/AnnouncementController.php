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
    /**
     * Display a dedicated page listing all announcements.
     *
     * This can be used for a future "View All Announcements" page.
     * For the component on the homepage, data is supplied via the Component Class.
     *
     * @return View
     */
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
