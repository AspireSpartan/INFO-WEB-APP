<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PageContent; // Import your PageContent model
use Illuminate\Support\Facades\Storage; // This import is not strictly needed if not using Storage::url directly here

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultContents = [
            'hero-subtitle-1' => '“DRIVEN BY INNOVATION',
            'hero-main-title' => 'Local Government Unit',
            'hero-paragraph' => 'Serving the community with <span class="text-amber-400">transparency</span>, <span class="text-amber-400">Integrity</span>, <br class="hidden sm:inline"/>and <span class="text-amber-400">commitment</span>.',
            'hero-subtitle-2' => '<span class="inline-block transform rotate-90 scale-x-[-1] text-2xl relative top-1 right-1">/</span>BREAKING BOUNDARIES',
            'footer-paragraph' => 'Local Government Units (LGUs) in the Philippines play a vital role in implementing national policies at the grassroots level while addressing the specific needs of their communities. These units, which include provinces, cities, municipalities, and barangays, are granted autonomy under the Local Government Code of 1991. LGUs are responsible for delivering basic services such as health care, education, infrastructure, and disaster response. They are also tasked with promoting local development through planning, budgeting, and legislation. Despite challenges like limited resources and political interference, many LGUs have successfully launched innovative programs to uplift their constituents and promote inclusive growth.',
            // IMPORTANT: Store only the relative path within the 'storage/app/public' directory.
            // The asset() helper will be used in Blade/Controllers to form the full public URL.
            'main-container-bg' => 'LGU_bg.png', 
            'stat-1-number' => '24',
            'stat-1-label' => 'Barangay',
            'stat-2-number' => '1500+',
            'stat-2-label' => 'Residents',
            'stat-3-number' => '120+',
            'stat-3-label' => 'Public Projects',
            'stat-4-number' => '75',
            'stat-4-label' => 'Years of Service',
        ];

        foreach ($defaultContents as $key => $value) {
            PageContent::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        $this->command->info('PageContent seeded successfully!'); // Output to console
    }
}
