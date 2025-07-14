<?php

namespace App\Http\Controllers;

use App\Models\ReportedConcern;
use Illuminate\Http\Request;

class AdminReportedConcernController extends Controller
{
    public function index()
    {
        $concerns = ReportedConcern::orderBy('created_at', 'desc')->paginate(15);
        return view('Components.Admin.reported_concerns.index', compact('concerns'));
    }

    public function edit($id)
    {
        $concern = ReportedConcern::findOrFail($id);
        return view('Components.Admin.reported_concerns.edit', compact('concern'));
    }

    public function update(Request $request, $id)
    {
        $concern = ReportedConcern::findOrFail($id);

        if ($request->input('action') === 'delete') {
            $concern->delete();
            return redirect('/admin?screen=reported_concerns')->with('success', 'Concern deleted successfully.');
        }

        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
            'action' => 'required|in:normal,priority,urgent',
        ]);

        $concern->status = $request->status;
        $concern->action = $request->action;
        $concern->save();

        return redirect('/admin?screen=reported_concerns')->with('success', 'Concern updated successfully.');
    }

    
    public function store(Request $request)
    {
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

        $validatedData['status'] = 'pending';

        ReportedConcern::create($validatedData);

        return redirect()->back()->with('success', 'Your concern has been reported successfully.');
    }
}