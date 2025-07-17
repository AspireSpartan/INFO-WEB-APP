<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Developer;
use Illuminate\Support\Facades\Storage; // For image handling

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure the public storage link exists
        // php artisan storage:link
        if (!Storage::disk('public')->exists('jasper.jpg')) {
            // You would typically copy these images to storage/app/public
            // For seeding, you might manually place them or use a package like 'faker-image'
            // For demonstration, we'll assume these images are already in public/storage
            // Or you can use placeholder images if you don't have them locally.
            // Example for placeholder:
            // Storage::disk('public')->put('jasper.jpg', file_get_contents('https://placehold.co/700x700/cccccc/000000?text=Jasper'));
            // Storage::disk('public')->put('janpaul.jpg', file_get_contents('https://placehold.co/700x700/cccccc/000000?text=JanPaul'));
            // Storage::disk('public')->put('kerstan.jpg', file_get_contents('https://placehold.co/700x700/cccccc/000000?text=Kerstan'));
        }

        Developer::create([
            'name' => 'Jaspher Lawrence Siloy',
            'role' => 'Front-end Developer',
            'description' => 'Creates UI designs and transforms ideas into clean, responsive, and engaging user interfaces.',
            'image_url' => 'jasper.jpg', // Assuming image is in storage/app/public
            'social_links' => [
                ['icon' => 'fab fa-linkedin', 'url' => '#'],
                ['icon' => 'fas fa-globe', 'url' => '#'],
                ['icon' => 'fab fa-github', 'url' => '#'],
            ],
        ]);

        Developer::create([
            'name' => 'Jan Paul Bustillo',
            'role' => 'Lead Developer',
            'description' => 'Responsible for system architecture, backend integration, and performance optimization.',
            'image_url' => 'janpaul.jpg', // Assuming image is in storage/app/public
            'social_links' => [
                ['icon' => 'fab fa-github', 'url' => '#'],
                ['icon' => 'fab fa-medium', 'url' => '#'],
                ['icon' => 'fab fa-twitter', 'url' => '#'],
            ],
        ]);

        Developer::create([
            'name' => 'Kerstan Davide',
            'role' => 'Front-end Developer',
            'description' => 'Transforms complex requirements into intuitive, accessible, and visually appealing interfaces.',
            'image_url' => 'kerstan.jpg', // Assuming image is in storage/app/public
            'social_links' => [
                ['icon' => 'fab fa-dribbble', 'url' => '#'],
                ['icon' => 'fab fa-behance', 'url' => '#'],
                ['icon' => 'fab fa-instagram', 'url' => '#'],
            ],
        ]);
    }
}

