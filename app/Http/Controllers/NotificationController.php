<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage; 

class NotificationController extends Controller
{
    public function index()
    {
        $contactMessages = ContactMessage::latest()->get(); // Fetch all messages, newest first
        return view('Components.Admin.notification.notification', compact('contactMessages'));
    }


    public function markAsRead(ContactMessage $message)
    {
        $message->update(['is_read' => true]);
        return response()->json(['status' => 'success', 'message' => 'Message marked as read.']);
    }


    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return response()->json(['status' => 'success', 'message' => 'Message deleted.']);
    }

    public function show(ContactMessage $message)
    {
        // Optionally, mark as read when viewed
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        return response()->json(['message' => $message]);
    }
}