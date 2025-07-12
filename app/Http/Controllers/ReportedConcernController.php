<?php

namespace App\Http\Controllers;

use App\Models\ReportedConcern;
use Illuminate\Http\Request;

class ReportedConcernController extends Controller
{
    public function store(Request $request)
    {
        // Validation logic here
        $validatedData = $request->validate([
            'reporter_name' => 'required|string|max:255',
            'reporter_email' => 'required|email|max:255',
            'reporter_phone' => 'required|string|max:20',
            'reporter_address' => 'required|string|max:255',
            'concern_date' => 'required|date',
            'concern_time' => 'required|date_format:H:i',
            'concern_barangay' => 'required|string|max:255',
            'concern_barangay_details' => 'required|string|max:255',
            'concern_description' => 'required|string',
        ]);

        // Add status field with default value
        $validatedData['status'] = 'pending';

        // Create new ReportedConcern
        ReportedConcern::create($validatedData);

        return redirect()->back()->with('success', 'Your concern has been reported successfully.');
    }
}