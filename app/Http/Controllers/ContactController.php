<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail; // Import your Mailable class
use App\Models\ContactMessage; // Ensure this is imported if you're saving to DB

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // 1. Validate the incoming request data using your original variable names
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message_description' => 'required|string', // Your original variable name for message content
        ]);

        // 2. Extract data using your original variable names
        $name = $validatedData['name'];
        $email = $validatedData['email'];
        $subject = $validatedData['subject'];
        $messageContent = $validatedData['message_description']; // Your original variable for content

        // 3. Send the email
        try {
            // Ensure your Mailable (ContactFormMail) constructor accepts these parameters correctly.
            // If it expects them individually, this is fine. If it expects an array, adjust accordingly.
            Mail::to('grocksilem@gmail.com')->send(new ContactFormMail($name, $email, $subject, $messageContent));

            // NEW: Save the message to the database
            // Map your form variables to the database column names
            ContactMessage::create([
                'user_name' => $name,             // Maps 'name' from form to 'user_name' in DB
                'user_email' => $email,           // Maps 'email' from form to 'user_email' in DB
                'subject' => $subject,
                'message' => $messageContent,     // Maps 'message_description' from form to 'message' in DB
                'is_read' => false,               // Default to unread for new messages
            ]);

            // 4. Redirect back with a success message and a notification flag
            return back()->with('success', 'Your message has been sent successfully!')
                          ->with('contactFormSuccess', true);
        } catch (\Exception $e) {
            // 5. Handle any errors during email sending or database saving
            \Log::error('Error sending contact form email or saving message: ' . $e->getMessage());
            return back()->with('error', 'There was an error sending your message. Please try again later.');
        }
    }
}
