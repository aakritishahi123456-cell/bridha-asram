<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(3);
        
        return [
            'title' => $title,
            'title_nepali' => $title, // In real scenario, this would be translated
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraphs(3, true),
            'description_nepali' => $this->faker->paragraphs(3, true),
            'objectives' => $this->faker->paragraphs(2, true),
            'objectives_nepali' => $this->faker->paragraphs(2, true),
            'sort_order' => $this->faker->numberBetween(1, 10),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the program is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}