<?php

namespace Database\Seeders;

use App\Models\FooterLogo;
use Illuminate\Database\Seeder;

class FooterLogoSeeder extends Seeder
{
    public function run()
    {
        FooterLogo::create([
            'logo_path' => 'CorDev_footer.svg',
        ]);
    }
}