<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement; // Don't forget to import the model

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Announcement::create([
            'title' => 'Cedula Request',
            'requester_name' => 'Juan Dela Cruz',
            'date' => '2025-07-08',
            'author' => 'Barangay Hall',
            'content' => 'Your Cedula request has been approved and is ready for pick-up at the Barangay Hall during office hours. Please bring a valid ID.',
            'is_new' => true,
            'category' => 'Cedula Request',
        ]);

        Announcement::create([
            'title' => 'Barangay Clearance Request',
            'requester_name' => 'Maria Santos',
            'date' => '2025-07-07',
            'author' => 'Barangay Hall',
            'content' => 'Your Barangay Clearance request is now processed. It can be claimed at the Barangay Hall. Ensure all fees are settled upon claiming.',
            'is_new' => true,
            'category' => 'Barangay Clearance Request',
        ]);

        Announcement::create([
            'title' => 'Website Maintenance Advisory',
            'requester_name' => 'Admin Team',
            'date' => '2025-07-06',
            'author' => 'Website Administration',
            'content' => 'Our website will undergo scheduled maintenance on July 10, 2025, from 10:00 PM to 2:00 AM. Services may be temporarily unavailable during this period. We apologize for any inconvenience.',
            'is_new' => true,
            'category' => 'Website Update',
        ]);

        Announcement::create([
            'title' => 'Business Permit Application',
            'requester_name' => 'Pedro Reyes',
            'date' => '2025-06-20',
            'author' => 'Business Permits Office',
            'content' => 'Your Business Permit application is under review. You will be notified once it is approved or if further documents are needed.',
            'is_new' => false,
            'category' => 'Business Permit Request',
        ]);

        Announcement::create([
            'title' => 'Report Concern: Streetlight Outage',
            'requester_name' => 'Anna Lim',
            'date' => '2025-06-15',
            'author' => 'Engineering Department',
            'content' => 'Your report regarding the streetlight outage on Maple Street has been received and scheduled for repair within 3-5 business days.',
            'is_new' => false,
            'category' => 'Report Concern',
        ]);

        Announcement::create([
            'title' => 'Cedula Request',
            'requester_name' => 'Jose Rizal',
            'date' => '2025-05-10',
            'author' => 'Barangay Hall',
            'content' => 'Your Cedula request from May 10, 2025, is ready for claiming at the Barangay Hall. Please present your reference number.',
            'is_new' => false,
            'category' => 'Cedula Request',
        ]);

        Announcement::create([
            'title' => 'Barangay Clearance Request',
            'requester_name' => 'Elena Cruz',
            'date' => '2025-04-25',
            'author' => 'Barangay Hall',
            'content' => 'Your Barangay Clearance request from April 25, 2025, has been processed and is available for pick-up.',
            'is_new' => false,
            'category' => 'Barangay Clearance Request',
        ]);
    }
}