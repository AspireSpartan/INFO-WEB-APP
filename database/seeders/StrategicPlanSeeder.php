<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StrategicPlan;

class StrategicPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StrategicPlan::create([
            'title' => 'Vision',
            'paragraph' => 'A digitally connected and responsive local government that ensures inclusive participation, promotes transparency, and delivers high-quality public services for a better, sustainable community.',
        ]);

        StrategicPlan::create([
            'title' => 'Mission',
            'paragraph' => 'To provide transparent, accessible, and efficient digital services that empower citizens, support local development, and strengthen public trust through innovative governance and community engagement.',
        ]);

        StrategicPlan::create([
            'title' => 'Goal',
            'paragraph' => 'To create a centralized digital platform that enhances public service delivery, promotes transparency, and fosters active citizen participation in local governance.',
        ]);
    }
}
