<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\View\View;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('articles.user.articles', ['articles' => Article::where('user_id', auth()->user()->id)->latest()->get()]);
    }

    /**
     * Display a listing of the resource.
     */
    public function allArticles(): View
    {
        return view('articles.all-articles', ['articles' => Article::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('articles.create', ["categories" => Category::get(), "tags" => Tag::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request): RedirectResponse
    {
        $article = Article::create($request->validated());
        $article->tags()->attach($request->tags);

        return to_route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View
    {
        return view('articles.detail', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): View
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update($request->validated());
        $article->tags()->sync($request->tags);

        return to_route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->tags()->detach();
        $article->delete();

        return to_route('articles.index');

    }
}