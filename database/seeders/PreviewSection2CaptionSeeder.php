<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PreviewSection2Caption;

class PreviewSection2CaptionSeeder extends Seeder
{
    public function run()
    {
        PreviewSection2Caption::create([
            'caption' => 'This is the initial default caption for the preview section 2. It is designed to be a significantly longer paragraph than a typical string field would allow, demonstrating the capability of the updated database column to store extensive text. This text can provide a detailed overview or an introductory message to your users.',
        ]);
    }
}