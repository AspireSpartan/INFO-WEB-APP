<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project; // Make sure to import your Project model
use Faker\Factory as Faker; // Import Faker

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define your initial 5 specific project items
        $initialProjects = [
            [
                'title' => 'Highway Development for Rural Connectivity',
                'site' => 'Southern Tagalog - Eastern Mindanao Highway Segment (Phase 3)',
                'scope' => 'Construction of 30 km modern highway with bike lanes and pedestrian sidewalks.',
                'outcome' => 'Reduced travel time by 40%; improved economic access for over 120,000 residents.',
                'image_url' => 'https://via.placeholder.com/320x608/D3D3D3/000000?text=Road+Image+1',
                'url' => '/projects/1',
            ],
            [
                'title' => 'Urban Flood Control and Drainage System',
                'site' => 'Metro Manila - Pasig River Basin',
                'scope' => 'Installation of modern drainage and flood control infrastructure.',
                'outcome' => 'Significantly reduced flooding incidents during rainy seasons.',
                'image_url' => 'https://via.placeholder.com/320x608/D3D3D3/000000?text=Flood+Control',
                'url' => '/projects/2',
            ],
            [
                'title' => 'Heritage Site Restoration',
                'site' => 'Intramuros, Manila',
                'scope' => 'Restoration and preservation of historical buildings and landmarks.',
                'outcome' => 'Revitalized cultural heritage and increased tourism.',
                'image_url' => 'https://via.placeholder.com/320x608/D3D3D3/000000?text=Heritage+Site',
                'url' => '/projects/3',
            ],
            [
                'title' => 'Community Park Development',
                'site' => 'Cebu City',
                'scope' => 'Creation of sustainable green spaces and recreational facilities.',
                'outcome' => 'Enhanced community well-being and environmental quality.',
                'image_url' => 'https://via.placeholder.com/320x608/D3D3D3/000000?text=Community+Park',
                'url' => '/projects/4',
            ],
            [
                'title' => 'Renewable Energy Installation',
                'site' => 'Palawan Solar Farm',
                'scope' => 'Installation of solar panels to provide clean energy.',
                'outcome' => 'Reduced carbon footprint and increased energy independence.',
                'image_url' => 'https://via.placeholder.com/320x608/D3D3D3/000000?text=Solar+Energy',
                'url' => '/projects/5',
            ],
        ];

        // Seed the initial 5 specific projects
        foreach ($initialProjects as $index => $projectData) {
            Project::create($projectData);
        }

        // --- Optional: Seed additional random projects using Faker ---
        // Change this number to seed more random projects after the initial 5.
        // Set to 0 if you only want the initial 5.
        $additionalProjectsCount = 5; // Example: Add 5 more random projects

        for ($i = 0; $i < $additionalProjectsCount; $i++) {
            Project::create([
                'title' => $faker->sentence(rand(5, 10)),
                'site' => $faker->city() . ', ' . $faker->stateAbbr(),
                'scope' => $faker->paragraph(rand(2, 5)),
                'outcome' => $faker->paragraph(rand(2, 5)),
                'image_url' => $faker->imageUrl(320, 608, 'abstract', true, 'Project ' . ($i + 6)), // Dynamic placeholder text
                'url' => '/projects/' . (count($initialProjects) + $i + 1), // Continue URL numbering
            ]);
        }
    }
}
