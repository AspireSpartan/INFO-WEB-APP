<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectDescription;

class ProjectDescriptionController extends Controller
{
    public function show()
    {
        $description = ProjectDescription::first();
        return view('Components.User.showallproject.showallproject', compact('description'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $description = ProjectDescription::first();
        if (!$description) {
            $description = new ProjectDescription();
        }
        $description->description = $request->description;
        $description->save();

        return redirect()->back()->with('success', 'Project description updated.');
    }
}
