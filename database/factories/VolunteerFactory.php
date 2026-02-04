<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Volunteer>
 */
class VolunteerFactory extends Factory
{
    protected $model = Volunteer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'city_id' => City::factory(),
            'full_name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'address' => $this->faker->address(),
            'occupation' => $this->faker->jobTitle(),
            'education' => $this->faker->randomElement(['High School', 'Bachelor', 'Master', 'PhD']),
            'skills' => $this->faker->sentence(),
            'availability' => $this->faker->sentence(),
            'motivation' => $this->faker->paragraph(),
            'experience' => $this->faker->optional()->paragraph(),
            'emergency_contact_name' => $this->faker->name(),
            'emergency_contact_phone' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected', 'inactive']),
        ];
    }

    /**
     * Indicate that the volunteer is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the volunteer is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'approved_by' => User::factory(),
            'approved_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ]);
    }
}