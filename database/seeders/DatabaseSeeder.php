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
        $this->call(ProjectDescriptionSeeder​::class);
        $this->call(ProjectSeeder::class);
        $this->call(PreviewSection2CaptionSeeder::class);
        $this->call(PreviewSection2LogoSeeder::class);
        $this->call(ContentManagerLogosImageSeeder::class);
        $this->call(StrategicPlanSeeder::class);
        $this->call(PublicOfficialCaptionSeeder::class);
        $this->call(PublicOfficialsTableSeeder::class);
        $this->call(KeepInTouchSeeder::class);
        $this->call(FooterLogoSeeder::class);
        $this->call(AboutGovphSeeder::class);
        $this->call(GovphLinkSeeder::class);
        $this->call([
            AboutUsContentSeeder::class,
            AboutUsOfferSeeder::class,
            GovernmentLinksSeeder::class,
            FooterTitleSeeder::class,
        ]);
        $this->call([
            CommunityContentSeeder::class,
            CommunityCarouselImageSeeder::class,
        ]);

        // Your existing User factory call is retained here
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // You can add other seeders here if you have them, e.g.:
        // $this->call(OtherSeeder::class);
    }
}
