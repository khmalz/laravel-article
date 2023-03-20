<?php

use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/all-articles');
});

Route::get('/about-me', function () {
    return view('about-me');
})->middleware(['auth', 'verified'])->name('about_me');

Route::get('all-articles', [ArticleController::class, 'allArticles'])->name('articles.all_articles');

Route::middleware('auth')->group(function () {
    Route::resource('articles', ArticleController::class)->middleware('role_or_permission:Super Admin|Admin|article_access');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('category', CategoryController::class)->middleware('permission:category_access');
    Route::resource('tag', TagController::class)->middleware('permission:tag_access');
});

require __DIR__ . '/auth.php';