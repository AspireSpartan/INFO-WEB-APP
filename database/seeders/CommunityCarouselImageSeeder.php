<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CommunityCarouselImage;

class CommunityCarouselImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // You can replace these with your actual image URLs or local paths
        CommunityCarouselImage::create([
            'title' => 'MATAZAC',
            'image_path' => 'https://images.unsplash.com/photo-1543269865-cbf427effbad?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80',
            'order' => 1,
        ]);

        CommunityCarouselImage::create([
            'title' => 'NANGLATIYON',
            'image_path' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80',
            'order' => 2,
        ]);

        CommunityCarouselImage::create([
            'title' => 'JULIANA',
            'image_path' => 'https://images.unsplash.com/photo-1568992687947-868a62a9f521?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80',
            'order' => 3,
        ]);

        CommunityCarouselImage::create([
            'title' => 'SALVIN',
            'image_path' => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80',
            'order' => 4,
        ]);

        // Additional Seed Entries
        CommunityCarouselImage::create([
            'title' => 'ALYSSA',
            'image_path' => 'https://images.unsplash.com/photo-1508921912186-1d1a45ebb3c1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80',
            'order' => 5,
        ]);

        CommunityCarouselImage::create([
            'title' => 'DALEON',
            'image_path' => 'https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80',
            'order' => 6,
        ]);

        CommunityCarouselImage::create([
            'title' => 'KAREM',
            'image_path' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80',
            'order' => 7,
        ]);

        CommunityCarouselImage::create([
            'title' => 'TREVOR',
            'image_path' => 'https://images.unsplash.com/photo-1556740749-887f6717d7e4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&h=500&q=80',
            'order' => 8,
        ]);
    }
}
