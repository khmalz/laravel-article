<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        abort_if(request()->user()->hasRole('Super Admin'), 404);

        return view('articles.user.articles', ['articles' => Article::where('user_id', auth()->user()->id)->latest()->get()]);
    }

    /**
     * Display a listing of the resource.
     */
    public function allArticles(Request $request): View
    {
        $q = $request->q;
        $categoryQ = $request->category;
        $tagsQ = $request->tags;

        $articles = Article::where(function (Builder $query) use ($q) {
            $query->where('title', 'like', "%$q%")
                ->orWhere('body', 'like', "%$q%");
        });

        if ($categoryQ) {
            $articles->whereHas('category', function (Builder $query) use ($categoryQ) {
                $query->where('name', $categoryQ);
            });
        }

        if ($tagsQ) {
            $articles->whereHas('tags', function (Builder $query) use ($tagsQ) {
                $query->whereIn('name', $tagsQ);
            }, "=", count($tagsQ));
        }

        $articles = $articles->latest()->get();
        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.all-articles', compact('articles', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        abort_if(request()->user()->hasRole('Super Admin'), 404);

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

        if ($request->user()->hasRole('Super Admin')) {
            return to_route('articles.all_articles');
        }

        return to_route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->tags()->detach();
        $article->delete();

        if (request()->user()->hasRole('Super Admin')) {
            return to_route('articles.all_articles');
        }

        return to_route('articles.index');

    }
}