<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blogfeed; // Import your Blogfeed model
use Illuminate\Support\Facades\Storage; // For handling dummy images
use Faker\Factory as Faker; // Import Faker factory

class BlogfeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This method populates the 'blogfeed' table with dummy data.
     */
    public function run(): void
    {
        // Define paths for dummy images/icons.
        // Ensure these paths match where you intend to store dummy images or exist virtually.
        // It's good practice to have some placeholder images in public/storage/blog_images/
        // and public/storage/blog_icons/ for these to work visually in development.
        $dummyImagePath1 = 'blog_images/dummy_blog_image_1.jpg';
        $dummyIconPath1 = 'blog_icons/dummy_icon_blog_1.png';

        // Initialize Faker for generating random data
        $faker = Faker::create();

        // Create 9 dummy blog posts
        for ($i = 0; $i < 9; $i++) {
            Blogfeed::create([ // Changed Newsfeed to Blogfeed
                'title' => $faker->sentence(5),
                'content' => $faker->paragraph(rand(3, 7)), // More varied paragraph length
                // Assign dummy image paths. These files need to exist in storage/app/public/blog_images
                // or you'll need to disable image validation when seeding.
                'image_path' => $faker->boolean(70) ? $dummyImagePath1 : null,
                'icon_path' => $faker->boolean(70) ? $dummyIconPath1 : null,
                'published_at' => $faker->date(),
                'author' => $faker->name(),
                'authortitle' => $faker->jobTitle(),
            ]);
        }
    }
}