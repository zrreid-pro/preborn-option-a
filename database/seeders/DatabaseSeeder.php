<?php

namespace Database\Seeders;

use App\Models\Donor;
use App\Models\Campaign;
use App\Models\Donation;
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
        $this->call([
            DonorSeeder::class,
            CampaignSeeder::class,
            DonationSeeder::class
        ]);

        for ($i = 1; $i <= 3; $i++) {
            $totalRevenue = DB::table('donations')->where('campaign_id', $i)->sum('amount');

            $campaign = Campaign::find($i);

            $campaign->current_total = $totalRevenue;

            $campaign->save();
        }
    }
}
