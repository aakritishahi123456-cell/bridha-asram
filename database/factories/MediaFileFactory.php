<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\MediaFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MediaFile>
 */
class MediaFileFactory extends Factory
{
    protected $model = MediaFile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mediaType = $this->faker->randomElement(['image', 'video', 'audio', 'document']);
        $filename = $this->faker->uuid() . '.' . $this->getExtensionForType($mediaType);
        
        return [
            'filename' => $filename,
            'original_filename' => $this->faker->word() . '.' . $this->getExtensionForType($mediaType),
            'file_path' => 'uploads/' . $filename,
            'mime_type' => $this->getMimeTypeForType($mediaType),
            'file_size' => $this->faker->numberBetween(1024, 10485760), // 1KB to 10MB
            'width' => $mediaType === 'image' ? $this->faker->numberBetween(100, 4000) : null,
            'height' => $mediaType === 'image' ? $this->faker->numberBetween(100, 3000) : null,
            'alt_text' => $this->faker->optional()->sentence(),
            'caption' => $this->faker->optional()->sentence(),
            'description' => $this->faker->optional()->paragraph(),
            'media_type' => $mediaType,
            'usage_type' => $this->faker->randomElement(['blog', 'event', 'gallery', 'program', 'city', 'general']),
            'collection_name' => $this->faker->optional()->word(),
            'is_optimized' => $this->faker->boolean(80),
            'is_public' => $this->faker->boolean(90),
            'sort_order' => $this->faker->numberBetween(1, 100),
            'uploaded_by' => User::factory(),
            'city_id' => $this->faker->optional()->randomElement([City::factory(), null]),
        ];
    }

    /**
     * Get file extension for media type.
     */
    private function getExtensionForType(string $type): string
    {
        return match($type) {
            'image' => $this->faker->randomElement(['jpg', 'png', 'gif', 'webp']),
            'video' => $this->faker->randomElement(['mp4', 'avi', 'mov']),
            'audio' => $this->faker->randomElement(['mp3', 'wav', 'ogg']),
            'document' => $this->faker->randomElement(['pdf', 'doc', 'docx', 'txt']),
            default => 'jpg',
        };
    }

    /**
     * Get MIME type for media type.
     */
    private function getMimeTypeForType(string $type): string
    {
        return match($type) {
            'image' => 'image/jpeg',
            'video' => 'video/mp4',
            'audio' => 'audio/mpeg',
            'document' => 'application/pdf',
            default => 'image/jpeg',
        };
    }

    /**
     * Indicate that the media file is an image.
     */
    public function image(): static
    {
        return $this->state(fn (array $attributes) => [
            'media_type' => 'image',
            'mime_type' => 'image/jpeg',
            'width' => $this->faker->numberBetween(100, 4000),
            'height' => $this->faker->numberBetween(100, 3000),
        ]);
    }
}