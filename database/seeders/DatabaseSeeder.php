<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $user->assignRole('Super Admin');

        $user = User::create([
            'name' => 'Khairul Akmal',
            'email' => 'akmal@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);

        $user->assignRole('Admin');

        $users = User::factory(3)->create();

        foreach ($users as $user) {
            $user->assignRole('User');
        }

        $categories = [
            'Personal',
            'Design',
            'Web',
            'Artificial Intelligence',
            'Dev Ops',
            'Machine Learning',
            'Others'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }

        $tags = [
            'Laravel',
            'PHP',
            'Javascript',
            'HTML',
            'CSS',
            'Java',
            'C',
            'C++',
            'C#'
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }

        Article::factory(30)->create();

        $tags = Tag::get();

        Article::all()->each(function ($article) use ($tags) {
            $article->tags()->sync(
                $tags->random(rand(1, 9))->pluck('id')
            );
        });
    }
}