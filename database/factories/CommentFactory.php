<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->text(),
            'likes' => fake()->numberBetween(0,1000),
            'user_id' => fake()->numberBetween(1,2),
            'post_id' => fake()->numberBetween(1,2),
        ];
    }
}
