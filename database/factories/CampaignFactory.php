<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'goal_amount' => 500,
            'current_total' => 0,
            'starts_at' => fake()->dateTimeBetween('-60 days', '-40 days'),
            'ends_at' => fake()->dateTimeBetween('now', '+3 months')
        ];
    }
}
