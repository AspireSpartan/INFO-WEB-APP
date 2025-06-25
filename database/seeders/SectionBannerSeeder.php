<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SectionBanner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; // Import the File facade

class SectionBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourceImagePath = storage_path('app/public/LGU_bg.png');
        $destinationPath = null;

        // Ensure the source image exists before attempting to copy
        if (File::exists($sourceImagePath)) { // Use the File facade here
            $destinationDirectory = 'banner_images';
            $imageFileName = 'LGU_bg.png';

            $destinationPath = Storage::disk('public')->putFileAs(
                $destinationDirectory,
                new \Symfony\Component\HttpFoundation\File\File($sourceImagePath), // Correctly instantiate the File object
                $imageFileName
            );
            $this->command->info("Image LGU_bg.png copied to: " . $destinationPath);
        } else {
            $this->command->warn("LGU_bg.png not found at " . $sourceImagePath . ". Section Banner background_image will be null.");
        }

        // Check if a SectionBanner already exists to prevent duplicate entries
        if (SectionBanner::count() === 0) {
            SectionBanner::create([
                'background_image' => $destinationPath, // Use the stored path
                'header1'          => 'Welcome to',
                'header2'          => 'Our Barangay Name',
                'header3'          => 'A Progressive Community',
                'header4'          => 'Serving the People of Cebu',
                'description'      => 'A brief description of our vibrant community and its commitment to public service and development. We strive for excellence and foster unity among residents.',
                'barangay'         => 123,
                'residents'        => 54321,
                'projects'         => 45,
                'yrs_service'      => 10,
            ]);
            $this->command->info('SectionBanner seeded successfully!');
        } else {
            $this->command->info('SectionBanner already exists. Skipping seeding.');
        }
    }
}