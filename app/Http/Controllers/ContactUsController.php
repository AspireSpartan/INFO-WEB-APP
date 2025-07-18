<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUsSectionTitle;
use App\Models\ContactUsDetail;

class ContactUsController extends Controller
{

    public function Indexshow()
    {
        $contactUsTitle = ContactUsSectionTitle::first();
        $contactUsDetails = ContactUsDetail::first();

        if (!$contactUsTitle) {
            $contactUsTitle = new ContactUsSectionTitle(['title' => 'CONTACT US!']);
        }
        if (!$contactUsDetails) {
            $contactUsDetails = new ContactUsDetail([
                'phone_numbers' => '(63+) 910 495 8419',
                'email_addresses' => 'government@gmail.com',
                'contact_address' => 'Malacañang Complex, J.P. Laurel Sr. St., San Miguel, Manila, 1000 Metro Manila',
            ]);
        }

        $initialContactUsData = [
            'contactUsTitle' => $contactUsTitle->title,
            'phoneNumbers' => $contactUsDetails->phone_numbers,
            'emailAddresses' => $contactUsDetails->email_addresses,
            'contactAddress' => $contactUsDetails->contact_address,
        ];

        return view('Components.Admin.Ad-Header.Ad-Header', compact('contactUsTitle', 'contactUsDetails', 'initialContactUsData'));
    }

    public function update(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'contactUsTitle' => 'required|string|max:255',
                'phoneNumbers' => 'nullable|string|max:255',
                'emailAddresses' => 'nullable|email|max:255', 
                'contactAddress' => 'nullable|string',
            ]);

            $contactUsTitle = ContactUsSectionTitle::firstOrNew(['id' => 1]);
            $contactUsTitle->title = $validatedData['contactUsTitle']; 
            $contactUsTitle->save();

            $contactUsDetails = ContactUsDetail::firstOrNew(['id' => 1]);
            $contactUsDetails->phone_numbers = $validatedData['phoneNumbers']; 
            $contactUsDetails->email_addresses = $validatedData['emailAddresses']; 
            $contactUsDetails->contact_address = $validatedData['contactAddress']; 
            $contactUsDetails->save();

            return response()->json(['message' => 'Contact Us information updated successfully!'], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $e->errors()
            ], 422); 
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'An error occurred while updating contact information.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
