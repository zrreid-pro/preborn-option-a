<?php

namespace Database\Factories;

use App\Enums\PaymentMethod;
use App\Models\Campaign;
use App\Models\Donor;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'method_enum' => fake()->randomElement([PaymentMethod::CARD, PaymentMethod::CHECK, PaymentMethod::CASH]),
            'received_at' => fake()->dateTimeBetween('-30 days'),
        ];
    }
}
