<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            DonorSeeder::class,
            CampaignSeeder::class,
            DonationSeeder::class
        ]);

        $numCampaigns = Campaign::count();

        // Calculate the starting current_total of the initial seeded Donations
        for ($i = 1; $i <= $numCampaigns; $i++) {
            $totalRevenue = Donation::where('campaign_id', $i)->sum('amount');

            $campaign = Campaign::find($i);

            $campaign->current_total = $totalRevenue;

            $campaign->save();
        }
    }
}
