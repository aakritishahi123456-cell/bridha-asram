<?php

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'donor_name' => $this->faker->name(),
            'donor_email' => $this->faker->safeEmail(),
            'donor_phone' => $this->faker->phoneNumber(),
            'donor_address' => $this->faker->address(),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'currency' => 'NPR',
            'purpose' => $this->faker->randomElement(['homeless_care', 'elderly_care', 'general_fund', 'emergency_relief']),
            'payment_method' => $this->faker->randomElement(['esewa', 'khalti', 'bank_transfer', 'cash']),
            'transaction_id' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'payment_status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'receipt_number' => 'RCP-' . strtoupper($this->faker->bothify('########')),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the donation is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_status' => 'completed',
            'payment_completed_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ]);
    }

    /**
     * Indicate that the donation is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_status' => 'pending',
            'payment_completed_at' => null,
        ]);
    }
}