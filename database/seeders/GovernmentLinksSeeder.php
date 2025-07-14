<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GovernmentLink;

class GovernmentLinksSeeder extends Seeder
{
    public function run()
    {
        $links = [
            ['title' => 'Office of the President', 'url' => 'https://op.gov.ph/'],
            ['title' => 'Office of the Vice-President', 'url' => 'https://ovp.gov.ph/'],
            ['title' => 'Senate of the Philippines', 'url' => 'https://senate.gov.ph/'],
            ['title' => 'House of Representatives', 'url' => 'https://congress.gov.ph/'],
            ['title' => 'Supreme Court', 'url' => 'https://sc.judiciary.gov.ph/'],
            ['title' => 'Court of Appeals', 'url' => 'https://ca.judiciary.gov.ph/'],
            ['title' => 'Sandiganbayan', 'url' => 'https://sb.judiciary.gov.ph/'],
        ];

        foreach ($links as $link) {
            GovernmentLink::create($link);
        }
    }
}