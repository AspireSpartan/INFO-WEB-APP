<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail; // Import your Mailable class
use App\Models\ContactMessage; // Ensure this is imported if you're saving to DB
use Illuminate\Support\Facades\Log; // For logging errors

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // 1. Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message_description' => 'required|string', // Your original variable name for message content
        ]);

        // 2. Extract data
        $name = $validatedData['name'];
        $email = $validatedData['email'];
        $subject = $validatedData['subject'];
        $messageContent = $validatedData['message_description']; // Your original variable for content

        $emailSentSuccessfully = false;
        $messageSavedSuccessfully = false;
        $returnMessage = '';

        // --- Attempt to send the email first ---
        try {
            // Ensure your Mailable (ContactFormMail) constructor accepts these parameters correctly.
            Mail::to('grocksilem@gmail.com')->send(new ContactFormMail($name, $email, $subject, $messageContent));
            $emailSentSuccessfully = true;
            Log::info('Contact form email sent successfully to grocksilem@gmail.com.');
        } catch (\Exception $e) {
            // Log the email sending failure, but don't stop the process
            Log::error('Failed to send contact form email via Mailtrap: ' . $e->getMessage());
            // You might want to check for specific Mailtrap errors here if needed,
            // e.g., by inspecting $e->getMessage() for "50 messages limit"
        }

        // --- Always attempt to save the message to the database ---
        try {
            ContactMessage::create([
                'user_name' => $name,                // Maps 'name' from form to 'user_name' in DB
                'user_email' => $email,              // Maps 'email' from form to 'user_email' in DB
                'subject' => $subject,
                'message' => $messageContent,        // Maps 'message_description' from form to 'message' in DB
                'is_read' => false,                  // Default to unread for new messages
            ]);
            $messageSavedSuccessfully = true;
            Log::info('Contact message saved to database successfully.');
        } catch (\Exception $e) {
            // Log the database saving failure
            Log::error('Failed to save contact message to database: ' . $e->getMessage());
        }

        // --- Construct the response message based on outcomes ---
        if ($emailSentSuccessfully && $messageSavedSuccessfully) {
            $returnMessage = 'Your message has been sent via email and saved. Thank you!';
            return back()->with('success', $returnMessage)->with('contactFormSuccess', true);
        } elseif (!$emailSentSuccessfully && $messageSavedSuccessfully) {
            $returnMessage = 'We could not send the email, but your message has been successfully saved to our records. We will get back to you soon!';
            // Use 'warning' or 'info' for this type of partial success, or keep 'success' if it's still a positive outcome for the user.
            return back()->with('warning', $returnMessage)->with('contactFormSuccess', true);
        } else { // Neither email sent nor message saved (this indicates a critical error)
            $returnMessage = 'There was a critical error processing your message. Please try again later or contact us directly.';
            return back()->with('error', $returnMessage);
        }
    }

    // Displays all messages in the admin view
    public function showNotifications()
    {
        $contactMessages = ContactMessage::latest()->get();
        return view('Components.Admin.notification.notification', compact('contactMessages'));
    }

    // Fetch a specific message for the modal via AJAX
    public function fetchMessage($id)
    {
        $message = ContactMessage::findOrFail($id);
        return response()->json(['message' => $message]);
    }

    // Mark a specific message as read
    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Message marked as read.'
        ]);
    }

    // Delete a specific message
    public function delete($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Message deleted successfully.'
        ]);
    }
}
