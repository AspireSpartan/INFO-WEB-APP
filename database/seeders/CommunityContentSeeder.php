<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CommunityContent;

class CommunityContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommunityContent::create([
            'key' => 'main_title_part1',
            'content' => 'Community',
        ]);

        CommunityContent::create([
            'key' => 'main_title_part2',
            'content' => ' at Work',
        ]);

        CommunityContent::create([
            'key' => 'subtitle_paragraph',
            'content' => 'We work hand-in-hand with barangay officials and municipal departments to ensure streamlined digital services and community development.',
        ]);

        CommunityContent::create([
            'key' => 'footer_text',
            'content' => 'Building stronger communities through <span class="text-[#ff6347] font-semibold">collaboration</span> and <span class="text-[#ff6347] font-semibold">innovation</span> since 2023',
        ]);
    }
}