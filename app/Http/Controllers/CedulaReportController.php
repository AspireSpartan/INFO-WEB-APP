<?php

namespace App\Http\Controllers;

use App\Models\CedulaReport;
use Illuminate\Http\Request;

class CedulaReportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'barangay' => 'required|string|max:255',
            'residential_address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'citizenship' => 'required|string|max:255',
            'civil_status' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'gross_annual_income' => 'required|numeric|min:0',
            'community_tax_due' => 'required|numeric|min:0',
            'cedula_declaration_consent' => 'required|accepted'
        ]);

        $validated['status'] = 'pending';
        $validated['cedula_declaration_consent'] = $request->has('cedula_declaration_consent');
        CedulaReport::create($validated);

        return back()->with('success', 'Your cedula application has been submitted successfully!');
    }
    
    public function update(Request $request, CedulaReport $cedulaReport)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,done,rejected'
        ]);

        $cedulaReport->update($validated);

        return back()->with('success', 'Cedula status updated successfully!');
    }

    public function index()
    {
        $reports = CedulaReport::orderBy('created_at', 'desc')->paginate(15);
        
        return view('Components.Admin.CedulaReports.index', compact('reports'));
    }
}