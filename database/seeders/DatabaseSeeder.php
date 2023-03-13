<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Khairul Akmal',
            'email' => 'akmal@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Category::create([
            'name' => 'Design',
            'slug' => 'design'
        ]);

        Category::create([
            'name' => 'Web',
            'slug' => 'web'
        ]);

        Category::create([
            'name' => 'Artificial Intelligence',
            'slug' => 'artificial-intelligence'
        ]);

        Category::create([
            'name' => 'Dev Ops',
            'slug' => 'dev-ops'
        ]);

        Category::create([
            'name' => 'Machine Learning',
            'slug' => 'machine-learning'
        ]);

        Category::create([
            'name' => 'Others',
            'slug' => 'others'
        ]);

        Tag::create([
            'name' => 'Laravel',
            'slug' => 'laravel'
        ]);

        Tag::create([
            'name' => 'PHP',
            'slug' => 'php'
        ]);

        Tag::create([
            'name' => 'Javascript',
            'slug' => 'javascript'
        ]);

        Tag::create([
            'name' => 'HTML',
            'slug' => 'html'
        ]);

        Tag::create([
            'name' => 'CSS',
            'slug' => 'css'
        ]);

        Tag::create([
            'name' => 'Java',
            'slug' => 'java'
        ]);

        Tag::create([
            'name' => 'C',
            'slug' => 'c'
        ]);

        Tag::create([
            'name' => 'C++',
            'slug' => 'cplusplus'
        ]);

        Tag::create([
            'name' => 'C#',
            'slug' => 'csharp'
        ]);

        Article::factory(30)->create();

        $tags = Tag::get();

        Article::all()->each(function ($article) use ($tags) {
            $article->tags()->sync(
                $tags->random(rand(1, 9))->pluck('id')
            );
        });
    }
}