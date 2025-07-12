<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GovphLink;

class GovphLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GovphLink::create(['title' => 'GOV.PH', 'url' => 'https://www.gov.ph/']);
        GovphLink::create(['title' => 'Open Data Portal', 'url' => 'https://data.gov.ph/']);
        GovphLink::create(['title' => 'Official Gazette', 'url' => 'https://www.officialgazette.gov.ph/']);
    }
}