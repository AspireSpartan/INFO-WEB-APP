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

        $keepInTouch->socialLinks()->createMany([
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/yourpage'],
            ['platform' => 'Twitter', 'url' => 'https://twitter.com/yourhandle'],
        ]);
    }
}
