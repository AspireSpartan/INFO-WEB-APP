<?php

namespace Database\Seeders;

use App\Models\PublicOfficial;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PublicOfficialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PublicOfficial::insert([
            [
                'position' => 'Vice Mayor',
                'name' => 'Tomas Osmeña',
                'icon' => 'https://pbs.twimg.com/profile_images/1861961366/tommy_osmena_400x400.jpg',
                'picture' => 'https://pbs.twimg.com/profile_images/1861961366/tommy_osmena_400x400.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'Governor',
                'name' => 'Gwendolyn Garcia',
                'icon' => 'https://pdplaban.org.ph/wp-content/uploads/2024/01/Gwen-Garcia_.webp',
                'picture' => 'https://pdplaban.org.ph/wp-content/uploads/2024/01/Gwen-Garcia_.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'Mayor',
                'name' => 'Nestor Archival',
                'icon' => 'https://upload.wikimedia.org/wikipedia/commons/7/74/Nestor_Archival_2024.jpg',
                'picture' => 'https://upload.wikimedia.org/wikipedia/commons/7/74/Nestor_Archival_2024.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'Mayor',
                'name' => 'Michael Rama',
                'icon' => 'https://upload.wikimedia.org/wikipedia/commons/7/74/Nestor_Archival_2024.jpg',
                'picture' => 'https://upload.wikimedia.org/wikipedia/commons/7/74/Nestor_Archival_2024.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'Congressman',
                'name' => 'Raul Del Mar',
                'icon' => 'https://upload.wikimedia.org/wikipedia/commons/7/74/Nestor_Archival_2024.jpg',
                'picture' => 'https://pbs.twimg.com/profile_images/1861961366/tommy_osmena_400x400.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'position' => 'Board Member',
                'name' => 'Glenn Anthony Soco',
                'icon' => 'https://upload.wikimedia.org/wikipedia/commons/7/74/Nestor_Archival_2024.jpg',
                'picture' => 'https://pbs.twimg.com/profile_images/1861961366/tommy_osmena_400x400.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data as needed
        ]);
    }
}
