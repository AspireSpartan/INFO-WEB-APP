<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PublicOfficialCaption;

class PublicOfficialCaptionSeeder extends Seeder
{
    public function run()
    {
        PublicOfficialCaption::create([
            'title' => 'Meet the faces Behind the Structures',
            'caption' => 'Honoring the Minds Behind the Milestones Behind every successful project is a team of visionary leaders and committed public servants who turn blueprints into lasting impact. Meet the dedicated governors who have championed development, guided progress, and ensured that every structure stands as a symbol of service, innovation, and hope for the Filipino people.',
            'titleColor' => '#123456' // Added titleColor field with a sample color value
        ]);
    }
}
