<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrategicPlan;
use App\Models\ContentManagerLogosImage;

class StrategicPlanController extends Controller
{
    public function index()
    {
        $contentMlogos = ContentManagerLogosImage::all();
        $strategicPlans = StrategicPlan::all();

        $vision = $strategicPlans->where('title', 'Vision')->first();
        $mission = $strategicPlans->where('title', 'Mission')->first();
        $goal = $strategicPlans->where('title', 'Goal')->first();

        $visionIcon = ContentManagerLogosImage::find(3);
        $missionIcon = ContentManagerLogosImage::find(4);
        $goalIcon = ContentManagerLogosImage::find(5);

        $vmgEditableContentData = [
            'vision' => [
                'icon' => $visionIcon ? asset($visionIcon->image_path) : null,
                'title' => $vision ? $vision->title : '',
                'paragraph' => $vision ? $vision->paragraph : '',
            ],
            'mission' => [
                'icon' => asset("storage/Mission.svg"),
                'title' => $mission ? $mission->title : '',
                'paragraph' => $mission ? $mission->paragraph : '',
            ],
            'goal' => [
                'icon' => asset("storage/goal.svg"),
                'title' => $goal ? $goal->title : '',
                'paragraph' => $goal ? $goal->paragraph : '',
            ],
        ];
        return view('Components.Admin.Ad-Header.Ad-Header', compact('strategicPlans', 'vmgEditableContentData', 'contentMlogos'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Vision,Mission,Goal',
            'title' => 'required|string|max:255',
            'paragraph' => 'required|string',
            'icon' => 'nullable|image|max:2048', // optional icon file
        ]);

        // Map type to fixed IDs
        $typeIdMap = [
            'Vision' => 1,
            'Mission' => 2,
            'Goal' => 3,
        ];

        $planId = $typeIdMap[$request->type] ?? null;

        if (!$planId) {
            return response()->json(['error' => 'Invalid strategic plan type.'], 400);
        }

        // Find by ID instead of title
        $plan = StrategicPlan::find($planId);
        if (!$plan) {
            return response()->json(['error' => 'Strategic plan not found.'], 404);
        }

        $plan->title = $request->title;
        $plan->paragraph = $request->paragraph;
        $plan->save();

        // Update icon if uploaded
        if ($request->hasFile('icon')) {
            $iconFile = $request->file('icon');
            $path = $iconFile->store('public/icons');

            $logoIdMap = [
                'Vision' => 3,
                'Mission' => 4,
                'Goal' => 5,
            ];
            $logoId = $logoIdMap[$request->type] ?? null;

            if ($logoId) {
                $logo = ContentManagerLogosImage::find($logoId);
                if ($logo) {
                    $logo->image_path = str_replace('public/', 'storage/', $path);
                    $logo->save();
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Strategic plan updated successfully.']);
    }
}

