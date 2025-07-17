<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutUsSection4Content;

class AboutUsSection4ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUsSection4Content::firstOrCreate(
            ['key' => 'main_title_part1'],
            ['content' => 'Meet']
        );

        AboutUsSection4Content::firstOrCreate(
            ['key' => 'main_title_part2'],
            ['content' => 'The Developers Behind CoreDev']
        );

        AboutUsSection4Content::firstOrCreate(
            ['key' => 'subtitle_paragraph'],
            ['content' => 'Our dedicated team built this platform with care, innovation, and community in mind. Each member brings unique expertise to create an exceptional experience.']
        );
    }
}

