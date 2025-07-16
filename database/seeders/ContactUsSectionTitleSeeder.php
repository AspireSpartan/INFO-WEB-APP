<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactUsSectionTitle;

class ContactUsSectionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactUsSectionTitle::firstOrCreate(
            ['id' => 1], // Assuming a single record for the title
            ['title' => 'Contact Us!'] // Default title from your blade file 
        );
    }
}