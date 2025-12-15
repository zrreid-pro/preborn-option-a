<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Enums\CampaignStatus;
use App\Http\Controllers\CampaignController;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Campaign::create([
            'name' => 'Old Campaign',
            'goal_amount' => 500,
            'starts_at' => fake()->dateTimeBetween('-40 days', '-30 days'),
            'ends_at' => fake()->dateTimeBetween('-20 days', '-10 days')
        ]);

        Campaign::factory()->count(3)->create();

        // Status isn't fillable so they need to be set here to start
        $campaigns = Campaign::all();
        foreach($campaigns as $campaign) {
            if(CampaignController::isActiveWindow($campaign->starts_at, $campaign->ends_at)) {
                $campaign->status = CampaignStatus::ACTIVE;
            } else {
                $campaign->status = CampaignStatus::INACTIVE;
            }
            $campaign->save();
        }        
    }
}
