<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->pluck('id')->first(),
            'user_id' => User::oldest()->skip(2)->inRandomOrder()->pluck('id')->first(),
            'title' => rtrim(fake()->sentence(rand(3, 6)), '.'),
            'body' => fake()->paragraph(8)
        ];
    }
}