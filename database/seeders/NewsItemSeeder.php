<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            DB::connection('mysql')->table('news_items')->insert([
                'picture' => 'https://media.istockphoto.com/id/1973365581/vector/sample-ink-rubber-stamp.jpg?s=612x612&w=0&k=20&c=_m6hNbFtLdulg3LK5LRjJiH6boCb_gcxPvRLytIz0Ws=', // All records will use 0.jpg
                'author' => $faker->name(),
                'date' => $faker->date(),
                'title' => $faker->sentence(6),
                'sponsored' => $faker->boolean(20), // 20% chance to be sponsored
                'views' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
