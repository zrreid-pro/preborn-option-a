<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campaign;

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
            'current_total' => 0,
            'starts_at' => fake()->dateTimeBetween('-40 days', '-30 days'),
            'ends_at' => fake()->dateTimeBetween('-20 days', '-10 days')
        ]);

        Campaign::factory()->count(3)->create();

        
    }
}
