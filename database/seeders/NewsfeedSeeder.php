<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Newsfeed; // Import your Newsfeed model
use Illuminate\Support\Facades\Storage; // For handling dummy images

class NewsfeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyImagePath1 = 'news_images/dummy_news_image_1.jpg';
        $dummyIconPath1 = 'news_icons/dummy_icon_1.png';
        $dummyImagePath2 = 'news_images/dummy_news_image_2.jpg';
        $dummyIconPath2 = 'news_icons/dummy_icon_2.png';

        // --- Faker for randomized data only ---
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 9; $i++) {
            Newsfeed::create([
                'title' => $faker->sentence(5),
                'content' => $faker->paragraph(3),
                'image_path' => $faker->boolean(70) ? $dummyImagePath1 : $dummyImagePath2,
                'icon_path' => $faker->boolean(70) ? $dummyIconPath1 : $dummyIconPath2,
                'published_at' => $faker->date(),
                'author' => $faker->name(),
                'authortitle' => $faker->jobTitle(),
            ]);
        }
    }
}
