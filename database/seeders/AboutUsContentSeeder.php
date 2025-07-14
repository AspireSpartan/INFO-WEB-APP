<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUsContentManager;

class AboutUsContentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['key' => 'heroTitle', 'content' => 'About Us'],
            ['key' => 'heroSubtitle', 'content' => 'Serving the Community with Efficiency, Transparency, and Care'],
            ['key' => 'heroImage', 'content' => 'https://placehold.co/1200x600/0A2647/FFFFFF?text=Team+Picture'],
            ['key' => 'introTitlePart1', 'content' => 'Introduction'],
            ['key' => 'introTitlePart2', 'content' => ' to Your Trusted LGU Services Hub!'],
            ['key' => 'introParagraph1', 'content' => 'At [LGUConnect], we believe in accessible and convenient public service. Our platform bridges the gap between citizens and local government units by offering fast, secure, and transparent digital services.'],
            ['key' => 'introParagraph2', 'content' => 'We are committed to simplifying the way you access essential documents and updates—so you can focus on what matters most.'],
        ];
        foreach ($data as $item) {
            AboutUsContentManager::updateOrCreate(['key' => $item['key']], $item);
        }
    }
}