<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactUsDetail;

class ContactUsDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactUsDetail::firstOrCreate(
            ['id' => 1], // Assuming a single record for contact details
            [
                // Storing phone number as a single string
                'phone_numbers' => '(63+) 910 495 8419',
                // Storing email address as a single string
                'email_addresses' => 'government@gmail.com',
                'contact_address' => 'Malacañang Complex, J.P. Laurel Sr. St., San Miguel, Manila, 1000 Metro Manila',
            ]
        );
    }
}
