<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PreviewSection2Caption;

class PreviewSection2CaptionSeeder extends Seeder
{
    public function run()
    {
        PreviewSection2Caption::create([
            'caption' => 'Your initial caption here',
        ]);
    }
}