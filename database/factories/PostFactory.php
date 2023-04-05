<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'     => fake()->sentence(),
            'excerpt'   => fake()->paragraph(),
            'content'   => fake()->text(300),
            'status'    => fake()->randomElement(['publish', 'draft', 'future', 'pending', 'trash', 'rejected']),
            'user_id'   => 1
        ];
    }
}
