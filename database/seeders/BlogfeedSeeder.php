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
        $faker = Faker::create();

        $filipinoBlogs = [
            [
                'title' => 'Pag-unlad ng Agrikultura sa Pilipinas',
                'content' => 'Tinalakay sa blog na ito ang mga bagong teknolohiya at programa na nagpapalago sa sektor ng agrikultura sa bansa.',
            ],
            [
                'title' => 'Kultura at Tradisyon ng mga Pilipino',
                'content' => 'Isang malalim na pagtingin sa mga makukulay na tradisyon at kultura na bumubuo sa pagkakakilanlan ng Pilipinas.',
            ],
            [
                'title' => 'Epekto ng Teknolohiya sa Kabataan',
                'content' => 'Pagsusuri kung paano binabago ng makabagong teknolohiya ang pamumuhay at pag-aaral ng mga kabataan sa Pilipinas.',
            ],
            [
                'title' => 'Pagpapahalaga sa Kalikasan at Kapaligiran',
                'content' => 'Mga hakbang at inisyatibo para mapanatili ang kalinisan at kagandahan ng kalikasan sa bansa.',
            ],
            [
                'title' => 'Paglalakbay sa mga Sikretong Destinasyon ng Pilipinas',
                'content' => 'Isang gabay sa mga hindi pa gaanong kilalang lugar na dapat bisitahin sa Pilipinas.',
            ],
        ];

        $externalImageUrl = 'https://media.istockphoto.com/id/1973365581/vector/sample-ink-rubber-stamp.jpg?s=612x612&w=0&k=20&c=_m6hNbFtLdulg3LK5LRjJiH6boCb_gcxPvRLytIz0Ws=';

        foreach ($filipinoBlogs as $blog) {
            Blogfeed::create([
                'title' => $blog['title'],
                'content' => $blog['content'],
                'image_path' => $externalImageUrl,
                'icon_path' => $faker->boolean(70) ? 'blog_icons/dummy_icon_blog_1.png' : null,
                'published_at' => $faker->date(),
                'author' => $faker->name(),
                'authortitle' => $faker->jobTitle(),
            ]);
        }
    }
}