<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PreviewSection2Logo;

class PreviewSection2LogoSeeder extends Seeder
{
    public function run()
    {
        PreviewSection2Logo::insert([
            ['logo' => 'sampling.jpg'],
            ['logo' => 'sampling.jpg'],
            ['logo' => 'sampling.jpg'],
        ]);
    }
}