<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\ImpactMetric;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImpactMetric>
 */
class ImpactMetricFactory extends Factory
{
    protected $model = ImpactMetric::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $metricNames = [
            'People Served' => 'individuals',
            'Meals Provided' => 'meals',
            'Shelter Nights' => 'nights',
            'Medical Checkups' => 'checkups',
            'Training Sessions' => 'sessions',
            'Volunteers Active' => 'volunteers',
        ];

        $metricName = $this->faker->randomElement(array_keys($metricNames));
        $unit = $metricNames[$metricName];

        return [
            'metric_name' => $metricName,
            'metric_value' => $this->faker->numberBetween(1, 10000),
            'metric_unit' => $unit,
            'description' => $this->faker->sentence(),
            'city_id' => $this->faker->optional()->randomElement([City::factory(), null]),
            'program_id' => $this->faker->optional()->randomElement([Program::factory(), null]),
            'recorded_date' => $this->faker->date(),
            'metric_type' => $this->faker->randomElement(['cumulative', 'periodic', 'current']),
            'is_featured' => $this->faker->boolean(30),
            'display_order' => $this->faker->numberBetween(1, 10),
            'recorded_by' => User::factory(),
        ];
    }

    /**
     * Indicate that the metric is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}