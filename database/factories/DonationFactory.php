<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Donor;
use App\Models\Campaign;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'donor_id' => Donor::inRandomOrder()->first()->id,
            'campaign_id' => Campaign::inRandomOrder()->first()->id,
            'amount' => fake()->numberBetween(1, 5),
            'method_enum' => fake()->numberBetween(1, 3),
            'received_at' => fake()->dateTimeBetween('-30 days')
        ];
    }
}
