<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectDescription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectDescriptionSeeder​ extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               ProjectDescription::create([
            'description' => "The government proudly presents a collection of completed projects that embody progress, resilience, and service to the Filipino people. From modern infrastructure and safer roads to revitalized heritage sites and sustainable community spaces, these accomplishments reflect our unwavering commitment to national development and inclusive growth. Explore how each project contributes to a stronger, more connected, and culturally enriched Philippines."
        ]);
    }
}
