<?php

namespace App\Http\Controllers;

use App\Models\BusinessPermit;
use Illuminate\Http\Request;


class BusinessPermitController extends Controller
{
    public function showForm()
    {
        return view('User_Side_Screen.businesspermit');
    }

    public function submitApplication(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|in:sole_proprietorship,partnership,corporation,llc,others',
            'business_barangay' => 'required|string|max:255',
            'business_address' => 'required|string|max:255',
            'business_phone' => 'nullable|string|max:20',
            'business_email' => 'required|email|max:255',
            'owner_first_name' => 'required|string|max:255',
            'owner_last_name' => 'required|string|max:255',
            'owner_address' => 'required|string|max:255',
            'owner_phone' => 'required|string|max:20',
            'owner_email' => 'required|email|max:255',
            'business_activity' => 'required|string',
            'capitalization' => 'required|numeric|min:0',
            'declaration_consent' => 'required|accepted'
        ]);

        BusinessPermit::create($validated);

        return redirect()->route('businesspermit')->with('success', 'Application submitted successfully!');
    }

    public function adminIndex()
    {
        $applications = BusinessPermit::orderBy('created_at', 'desc')->paginate(15);
        return view('Components.Admin.business_permit.index', compact('applications'));
    }

    public function updateStatus(Request $request, BusinessPermit $application)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Status updated successfully');
    }
    
    public function showDetails(BusinessPermit $application)
    {
        return view('Components.Admin.business_permit.details', compact('application'));
    }
}