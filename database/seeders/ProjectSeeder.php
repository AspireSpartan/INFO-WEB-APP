<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project; // Make sure to import your Project model
use Faker\Factory as Faker; // Import Faker

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $imagePath = '/storage/sampling.jpg'; // Use this for all image_url fields

        $initialProjects = [
            [
                'title' => 'Highway Development for Rural Connectivity',
                'site' => 'Southern Tagalog - Eastern Mindanao Highway Segment (Phase 3)',
                'scope' => 'Construction of 30 km modern highway with bike lanes and pedestrian sidewalks.',
                'outcome' => 'Reduced travel time by 40%; improved economic access for over 120,000 residents.',
                'image_url' => $imagePath,
                'url' => '/projects/1',
            ],
            [
                'title' => 'Urban Flood Control and Drainage System',
                'site' => 'Metro Manila - Pasig River Basin',
                'scope' => 'Installation of modern drainage and flood control infrastructure.',
                'outcome' => 'Significantly reduced flooding incidents during rainy seasons.',
                'image_url' => $imagePath,
                'url' => '/projects/2',
            ],
            [
                'title' => 'Heritage Site Restoration',
                'site' => 'Intramuros, Manila',
                'scope' => 'Restoration and preservation of historical buildings and landmarks.',
                'outcome' => 'Revitalized cultural heritage and increased tourism.',
                'image_url' => $imagePath,
                'url' => '/projects/3',
            ],
            [
                'title' => 'Community Park Development',
                'site' => 'Cebu City',
                'scope' => 'Creation of sustainable green spaces and recreational facilities.',
                'outcome' => 'Enhanced community well-being and environmental quality.',
                'image_url' => $imagePath,
                'url' => '/projects/4',
            ],
            [
                'title' => 'Renewable Energy Installation',
                'site' => 'Palawan Solar Farm',
                'scope' => 'Installation of solar panels to provide clean energy.',
                'outcome' => 'Reduced carbon footprint and increased energy independence.',
                'image_url' => $imagePath,
                'url' => '/projects/5',
            ],
        ];

        foreach ($initialProjects as $projectData) {
            Project::create($projectData);
        }

        $additionalProjectsCount = 5;

        for ($i = 0; $i < $additionalProjectsCount; $i++) {
            Project::create([
                'title' => $faker->sentence(rand(5, 10)),
                'site' => $faker->city() . ', ' . $faker->stateAbbr(),
                'scope' => $faker->paragraph(rand(2, 5)),
                'outcome' => $faker->paragraph(rand(2, 5)),
                'image_url' => $imagePath,
                'url' => '/projects/' . (count($initialProjects) + $i + 1),
            ]);
        }
    }
}
