<?php

namespace Database\Seeders;

use App\Models\User; // Ensure User model is imported
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call the PageContentSeeder to populate static page content (like banner texts, stats)
        $this->call(PageContentSeeder::class);
        $this->call(BlogfeedSeeder::class);
        $this->call(NewsItemSeeder::class);
        $this->call(ProjectSeeder::class);

        // Your existing User factory call is retained here
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // You can add other seeders here if you have them, e.g.:
        // $this->call(OtherSeeder::class);
    }
}
