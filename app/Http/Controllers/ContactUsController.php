<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUsSectionTitle;
use App\Models\ContactUsDetail;

class ContactUsController extends Controller
{
    /**
     * Fetch all contact us data.
     */
    public function Indexshow()
    {
        $contactUsTitle = ContactUsSectionTitle::first();
        $contactUsDetails = ContactUsDetail::first();

        // Provide default values if no records exist (important for first-time load)
        if (!$contactUsTitle) {
            $contactUsTitle = new ContactUsSectionTitle(['title' => 'CONTACT US!']);
        }
        if (!$contactUsDetails) {
            $contactUsDetails = new ContactUsDetail([
                // Fallback for phone numbers as a single string
                'phone_numbers' => '(63+) 910 495 8419',
                // Fallback for email addresses as a single string
                'email_addresses' => 'government@gmail.com',
                'contact_address' => 'Malacañang Complex, J.P. Laurel Sr. St., San Miguel, Manila, 1000 Metro Manila',
            ]);
        }

        $initialContactUsData = [
            'contactUsTitle' => $contactUsTitle->title,
            // These are now single strings
            'phoneNumbers' => $contactUsDetails->phone_numbers,
            'emailAddresses' => $contactUsDetails->email_addresses,
            'contactAddress' => $contactUsDetails->contact_address,
        ];

        // Assuming this method returns a view that includes the footer
        // You might need to adjust 'Components.Admin.Ad-Header.Ad-Header' to your actual view path
        return view('Components.Admin.Ad-Header.Ad-Header', compact('contactUsTitle', 'contactUsDetails', 'initialContactUsData'));
    }

    /**
     * Update the contact us data.
     */
    public function update(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'contactUsTitle' => 'required|string|max:255',
                // Validate phoneNumbers and emailAddresses as single strings
                'phoneNumbers' => 'nullable|string|max:255',
                'emailAddresses' => 'nullable|email|max:255', // Use 'email' rule for email format validation
                'contactAddress' => 'nullable|string',
            ]);

            // Update Section Title
            // Use firstOrNew and save to ensure update or create without issues
            $contactUsTitle = ContactUsSectionTitle::firstOrNew(['id' => 1]);
            $contactUsTitle->title = $validatedData['contactUsTitle']; // Use validated data
            $contactUsTitle->save();

            // Update Contact Details
            // Use firstOrNew and save to ensure update or create without issues
            $contactUsDetails = ContactUsDetail::firstOrNew(['id' => 1]);
            $contactUsDetails->phone_numbers = $validatedData['phoneNumbers']; // Use validated data
            $contactUsDetails->email_addresses = $validatedData['emailAddresses']; // Use validated data
            $contactUsDetails->contact_address = $validatedData['contactAddress']; // Use validated data
            $contactUsDetails->save();

            return response()->json(['message' => 'Contact Us information updated successfully!'], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $e->errors()
            ], 422); // Unprocessable Entity
        } catch (\Exception $e) {
            // Catch any other unexpected errors
            return response()->json([
                'message' => 'An error occurred while updating contact information.',
                'error' => $e->getMessage()
            ], 500); // Internal Server Error
        }
    }
}
