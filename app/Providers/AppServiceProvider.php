<?php

namespace App\Providers;

use App\Models\Article;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'layouts.navigation',
            function ($view) {
                $view->with('articleId', Article::where('slug', last(request()->segments()))->value('user_id'));
            }
        );
    }
}
