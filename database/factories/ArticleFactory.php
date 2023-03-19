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
            'category_id' => Category::get('id')->random(),
            'user_id' => User::get('id')->skip(1)->random(),
            'title' => rtrim(fake()->sentence(rand(3, 6)), '.'),
            'body' => fake()->paragraph(8)
        ];
    }
}