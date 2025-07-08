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
        $vmgEditableContentData = [
            'vision' => [
                'icon' => asset($visionIconPath ?? "storage/Vision.svg"),
                'title' => $strategicPlans->where('type', 'vision')->first()->title,
                'paragraph' => $strategicPlans->where('type', 'vision')->first()->paragraph,
            ],
            'mission' => [
                'icon' => asset($missionIconPath ?? "storage/Mission.svg"),
                'title' => $strategicPlans->where('type', 'mission')->first()->title,
                'paragraph' => $strategicPlans->where('type', 'mission')->first()->paragraph,
            ],
            'goal' => [
                'icon' => asset($goalIconPath ?? "storage/goal.svg"),
                'title' => $strategicPlans->where('type', 'goal')->first()->title,
                'paragraph' => $strategicPlans->where('type', 'goal')->first()->paragraph,
            ],
        ];
        return view('components.admin.content-manager.3goals.3goals', compact('strategicPlans', 'vmgEditableContentData', 'contentMlogos'));
    }
}

