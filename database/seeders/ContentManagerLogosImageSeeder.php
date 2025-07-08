<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentManagerLogosImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContentManagerLogosImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContentManagerLogosImage::create([
            'id' => 1,
            'image_path' => 'storage/Ph_flag.svg',
        ]);
        ContentManagerLogosImage::create([
            'id' => 2,
            'image_path' => 'storage/miniflag.svg',
        ]);
        ContentManagerLogosImage::create([
            'id' => 3,
            'image_path' => 'storage/Vision.svg',
        ]);
        ContentManagerLogosImage::create([
            'id' => 4,
            'image_path' => 'storage/Mission.svg',
        ]);
        ContentManagerLogosImage::create([
            'id' => 5,
            'image_path' => 'storage/goal.svg',
        ]);
        ContentManagerLogosImage::create([
            'id' => 6,
            'image_path' => 'storage/miniflagv2.svg',
        ]);
        ContentManagerLogosImage::create([
            'id' => 7,
            'image_path' => 'storage/CorDev_footer.svg',
        ]);
    }
}
