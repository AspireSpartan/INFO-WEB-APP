<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage; // Import your ContactMessage model

class NotificationController extends Controller
{
    /**
     * Display a listing of the contact messages.
     * This method will be called when the /admin/notifications route is accessed.
     */
    public function index()
    {
        $contactMessages = ContactMessage::latest()->get(); // Fetch all messages, newest first
        // In a real application, consider pagination:
        // $contactMessages = ContactMessage::latest()->paginate(15);

        // This view will now be rendered by the main admin route, so it just returns the data
        // as part of the overall layout rendering process.
        return view('Components.Admin.notification.notification', compact('contactMessages'));
    }

    /**
     * Mark a specific message as read.
     */
    public function markAsRead(ContactMessage $message)
    {
        $message->update(['is_read' => true]);
        return response()->json(['status' => 'success', 'message' => 'Message marked as read.']);
    }

    /**
     * Delete a specific message.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return response()->json(['status' => 'success', 'message' => 'Message deleted.']);
    }

    /**
     * Get details of a single message (for a "View" modal/detail page).
     */
    public function show(ContactMessage $message)
    {
        // Optionally, mark as read when viewed
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        return response()->json(['message' => $message]);
    }
}