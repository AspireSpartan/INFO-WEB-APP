<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUsOffer;

class AboutUsOfferSeeder extends Seeder
{
    public function run()
    {
        $offers = [
            [
                'title' => 'Cedula Request Made Easy',
                'description' => 'Apply for your community tax certificate online with just a few clicks.',
                'icon' => 'fas fa-id-card'
            ],
            [
                'title' => 'Barangay Clearance Anytime',
                'description' => 'Request, verify, and download your barangay clearance wherever you are.',
                'icon' => 'fas fa-file-signature'
            ],
            [
                'title' => 'Real-Time LGU News',
                'description' => 'Get updated with the latest ordinances, barangay announcements, and emergency bulletins.',
                'icon' => 'fas fa-newspaper'
            ],
            [
                'title' => 'Public Service Announcements',
                'description' => 'Stay informed about important public service announcements and events.',
                'icon' => 'fas fa-bullhorn'
            ],
            [
                'title' => 'Online Payment Options',
                'description' => 'Conveniently pay for various government services online.',
                'icon' => 'fas fa-money-bill-wave'
            ],
            [
                'title' => 'Community Feedback Portal',
                'description' => 'Share your feedback and suggestions to improve local services.',
                'icon' => 'fas fa-comments'
            ],
        ];
        foreach ($offers as $offer) {
            AboutUsOffer::create($offer);
        }
    }
}