<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReportedConcern;
use Illuminate\Http\Request;

class ReportedConcernController extends Controller
{
    public function index()
    {
        $concerns = ReportedConcern::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.reported_concerns.index', compact('concerns'));
    }

    public function updateStatus(Request $request, ReportedConcern $concern)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        $concern->update($validatedData);

        return redirect()->back()->with('success', 'Concern status updated successfully.');
    }
}
