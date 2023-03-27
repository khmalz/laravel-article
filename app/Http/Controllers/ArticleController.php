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
        $search = $request->q;
        $articles = Article::query();

        if (!empty($search)) {
            $keywords = explode(' ', $search);
            foreach ($keywords as $keyword) {
                if (strpos($keyword, 'title:') === 0) {
                    $titleKeyword = substr($keyword, 6);
                    $articles->where(function ($query) use ($titleKeyword) {
                        $query->where('title', 'like', "%$titleKeyword%");
                    });
                } elseif (strpos($keyword, 'body:') === 0) {
                    $bodyKeyword = substr($keyword, 6);
                    $articles->where(function ($query) use ($bodyKeyword) {
                        $query->where('body', 'like', "%$bodyKeyword%");
                    });
                } elseif (strpos($keyword, 'category:') === 0) {
                    $categoryKeyword = substr($keyword, 9);
                    $articles->whereHas('category', function ($query) use ($categoryKeyword) {
                        $query->where('name', 'like', "%$categoryKeyword%");
                    });
                } elseif (strpos($keyword, 'tag:') === 0) {
                    $tagKeyword = substr($keyword, 4);
                    $articles->whereHas('tags', function ($query) use ($tagKeyword) {
                        $query->where('name', 'like', "%$tagKeyword%");
                    });
                } else {
                    $articles->where(function ($query) use ($keyword) {
                        $query->where('title', 'like', "%$keyword%")
                            ->orWhere('body', 'like', "%$keyword%")
                            ->orWhereHas(
                                'category',
                                function ($query) use ($keyword) {
                                    $query->where('name', 'like', "%$keyword%");
                                }
                            )
                            ->orWhereHas(
                                'tags',
                                function ($query) use ($keyword) {
                                    $query->where('name', 'like', "%$keyword%");
                                }
                            );
                    });
                }
            }
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