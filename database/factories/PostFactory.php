<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            'title' => fake()->realTextBetween(15, 30),
            'body' => fake()->realTextBetween(500, 1200, 2),
            'views' => fake()->numberBetween(1, 1000),
            'published' => now(),
            'category_id' => Category::find(random_int(1, Category::count())),
            'user_id' => User::find(random_int(1, User::count())),
        ];
    }
}
