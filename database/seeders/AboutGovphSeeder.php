<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutGovph;

class AboutGovphSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutGovph::create([
            'title' => 'About GOVPH',
            'description' => 'GOV.PH (Government of the Republic of the Philippines) serves as the official online gateway to information and services of the Philippine Government. It is a comprehensive platform providing access to various government agencies, programs, and initiatives.',
        ]);
    }
}