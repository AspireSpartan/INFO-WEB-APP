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

        $filipinoNewsSamples = [
            [
                'title' => 'Pagsisimula ng Bakuna sa mga Barangay sa Maynila',
                'author' => 'Juan Dela Cruz',
                'picture' => 'https://media.istockphoto.com/id/1973365581/vector/sample-ink-rubber-stamp.jpg?s=612x612&w=0&k=20&c=_m6hNbFtLdulg3LK5LRjJiH6boCb_gcxPvRLytIz0Ws=',
            ],
            [
                'title' => 'Bagyong Odette Nagdulot ng Malawakang Pagbaha sa Visayas',
                'author' => 'Maria Clara',
                'picture' => 'https://media.istockphoto.com/id/1973365581/vector/sample-ink-rubber-stamp.jpg?s=612x612&w=0&k=20&c=_m6hNbFtLdulg3LK5LRjJiH6boCb_gcxPvRLytIz0Ws=',
            ],
            [
                'title' => 'Pagdiriwang ng Araw ng Kalayaan sa Maynila',
                'author' => 'Jose Rizal',
                'picture' => 'https://media.istockphoto.com/id/1973365581/vector/sample-ink-rubber-stamp.jpg?s=612x612&w=0&k=20&c=_m6hNbFtLdulg3LK5LRjJiH6boCb_gcxPvRLytIz0Ws=',
            ],
            [
                'title' => 'Pagtaas ng Ekonomiya ng Pilipinas sa Ikalawang Quarter',
                'author' => 'Liza Soberano',
                'picture' => 'https://media.istockphoto.com/id/1973365581/vector/sample-ink-rubber-stamp.jpg?s=612x612&w=0&k=20&c=_m6hNbFtLdulg3LK5LRjJiH6boCb_gcxPvRLytIz0Ws=',
            ],
            [
                'title' => 'Pagsisimula ng Online Classes sa mga Paaralan sa Luzon',
                'author' => 'Anne Curtis',
                'picture' => 'https://media.istockphoto.com/id/1973365581/vector/sample-ink-rubber-stamp.jpg?s=612x612&w=0&k=20&c=_m6hNbFtLdulg3LK5LRjJiH6boCb_gcxPvRLytIz0Ws=',
            ],
        ];

        foreach ($filipinoNewsSamples as $news) {
            DB::connection('mysql')->table('news_items')->insert([
                'picture' => $news['picture'],
                'author' => $news['author'],
                'date' => $faker->date(),
                'title' => $news['title'],
                'sponsored' => $faker->boolean(20),
                'views' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
