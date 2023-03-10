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
        $title = rtrim(fake()->sentence(rand(3, 6)), '.');
        $slug = str()->slug($title);

        return [
            'category_id' => Category::get('id')->random(),
            'user_id' => User::get('id')->random(),
            'title' => $title,
            'slug' => $slug,
            'body' => fake()->paragraph(8)
        ];
    }
}