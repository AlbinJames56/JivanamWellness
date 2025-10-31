<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->where('published', true)
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        return view('pages.blog-index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();
        return view('components.blog.blog-show', compact('article'));
    }
}
