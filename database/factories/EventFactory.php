<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Event;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        $startDate = $this->faker->dateTimeBetween('now', '+6 months');
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraphs(3, true),
            'start_date' => $startDate,
            'end_date' => $this->faker->optional()->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s') . ' +1 week'),
            'venue' => $this->faker->company() . ' Hall',
            'venue_address' => $this->faker->address(),
            'max_participants' => $this->faker->optional()->numberBetween(10, 200),
            'current_participants' => $this->faker->numberBetween(0, 50),
            'registration_fee' => $this->faker->randomFloat(2, 0, 1000),
            'requires_registration' => $this->faker->boolean(70),
            'registration_deadline' => $this->faker->optional()->dateTimeBetween('now', $startDate),
            'contact_person' => $this->faker->name(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->safeEmail(),
            'status' => $this->faker->randomElement(['draft', 'published', 'ongoing', 'completed', 'cancelled']),
            'event_type' => $this->faker->randomElement(['workshop', 'seminar', 'community_service', 'fundraising', 'awareness', 'other']),
            'is_featured' => $this->faker->boolean(20),
            'city_id' => City::factory(),
            'program_id' => Program::factory(),
            'created_by' => User::factory(),
        ];
    }

    /**
     * Indicate that the event is upcoming.
     */
    public function upcoming(): static
    {
        return $this->state(fn (array $attributes) => [
            'start_date' => $this->faker->dateTimeBetween('+1 day', '+6 months'),
            'status' => 'published',
        ]);
    }

    /**
     * Indicate that the event is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}