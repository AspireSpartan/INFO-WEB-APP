<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KeepInTouch;

class KeepInTouchSeeder extends Seeder
{
    public function run()
    {
        $keepInTouch = KeepInTouch::create([
            'title' => 'Keep In Touch',
            'text_content' => 'This is the current "Keep In Touch" content. You can update it here.',
        ]);

        // Delete existing social links to avoid duplicates if re-seeding
        $keepInTouch->socialLinks()->delete();

        $keepInTouch->socialLinks()->createMany([
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/yourpage', 'icon' => 'fab fa-facebook-f'], // Example Font Awesome class
            ['platform' => 'Twitter', 'url' => 'https://twitter.com/yourhandle', 'icon' => 'fab fa-twitter'],   // Example Font Awesome class
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/in/yourprofile', 'icon' => 'fab fa-linkedin-in'], // Another example
        ]);
    }
}
