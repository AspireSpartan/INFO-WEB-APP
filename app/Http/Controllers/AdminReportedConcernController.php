<?php

namespace App\Http\Controllers;

use App\Models\ReportedConcern;
use Illuminate\Http\Request;

class AdminReportedConcernController extends Controller
{
    /**
     * Display a listing of reported concerns.
     */
    public function index()
    {
        $concerns = ReportedConcern::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.reportedconcerns.index', compact('concerns'));
    }

    /**
     * Show the form for editing the specified concern.
     */
    public function edit($id)
    {
        $concern = ReportedConcern::findOrFail($id);
        return view('admin.reportedconcerns.edit', compact('concern'));
    }

    /**
     * Update the specified concern in storage.
     */
    public function update(Request $request, $id)
    {
        $concern = ReportedConcern::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
            'action' => 'required|in:normal,priority,urgent',
        ]);

        $concern->status = $request->status === 'working' ? 'in_progress' : $request->status;
        $concern->action = $request->action;
        $concern->save();

        return redirect()->route('admin.reportedconcerns.index')->with('success', 'Concern updated successfully.');
    }

    /**
     * Remove the specified concern from storage.
     */
    public function destroy($id)
    {
        $concern = ReportedConcern::findOrFail($id);
        $concern->delete();

        return redirect()->route('admin.reportedconcerns.index')->with('success', 'Concern deleted successfully.');
    }
}