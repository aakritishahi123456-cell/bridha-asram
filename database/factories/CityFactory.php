<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->city();
        
        return [
            'name' => $name,
            'name_nepali' => $name, // In real scenario, this would be translated
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'description_nepali' => $this->faker->paragraph(),
            'coordinator_name' => $this->faker->name(),
            'coordinator_contact' => $this->faker->phoneNumber(),
            'coordinator_email' => $this->faker->safeEmail(),
            'address' => $this->faker->address(),
            'address_nepali' => $this->faker->address(),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the city is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}