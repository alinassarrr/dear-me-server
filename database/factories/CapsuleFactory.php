<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Capsule>
 */
class CapsuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "user_id"=> 1,
            "mood_id"=> fake()->numberBetween(1,5),
            "title"=> fake()-> realText(12),
            'message' =>fake()->realTextBetween(80,150),
            'emoji' => fake()->randomElement(['😊', '😢', '🎉', '🤔', '❤️', '🔥']),
            'tags' => json_encode(fake()->randomElement([['abc','2025'],['123','2024']]), JSON_UNESCAPED_UNICODE),
            'security' => fake()->randomElement(['private', 'public', 'unlisted']),
            'surprise'=>0,
            'image_path' => fake()->filePath(), 
            'audio_path' => null, 
            'file_path' => null,
            'reveal_at'=>now(),
        ];
    }
}
