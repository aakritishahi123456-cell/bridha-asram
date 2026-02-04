<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventRegistration>
 */
class EventRegistrationFactory extends Factory
{
    protected $model = EventRegistration::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'user_id' => $this->faker->optional()->randomElement([User::factory(), null]),
            'participant_name' => $this->faker->name(),
            'participant_email' => $this->faker->safeEmail(),
            'participant_phone' => $this->faker->phoneNumber(),
            'participant_address' => $this->faker->address(),
            'date_of_birth' => $this->faker->optional()->date('Y-m-d', '-18 years'),
            'gender' => $this->faker->optional()->randomElement(['male', 'female', 'other']),
            'occupation' => $this->faker->optional()->jobTitle(),
            'special_requirements' => $this->faker->optional()->sentence(),
            'motivation' => $this->faker->optional()->paragraph(),
            'status' => $this->faker->randomElement(['registered', 'confirmed', 'attended', 'cancelled']),
            'registered_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'payment_amount' => $this->faker->randomFloat(2, 0, 500),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'refunded']),
        ];
    }

    /**
     * Indicate that the registration is confirmed.
     */
    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'confirmed',
            'confirmed_at' => $this->faker->dateTimeBetween($attributes['registered_at'] ?? '-1 month', 'now'),
        ]);
    }
}