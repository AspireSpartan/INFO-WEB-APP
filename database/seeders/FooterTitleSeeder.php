<?php

namespace Database\Seeders;

use App\Models\FooterTitle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FooterTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FooterTitle::create([
            'government_links_title' => 'GOVERNMENT LINKS',
        ]);
    }
}
