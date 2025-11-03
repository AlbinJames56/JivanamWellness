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

        $raw = (string) ($article->content ?? '');

        $containsHtml = $raw !== strip_tags($raw);

        if (!$containsHtml) {
            try {
                if (class_exists(\Parsedown::class)) {
                    $parser = new \Parsedown();
                    $parser->setUrlsLinked(true);
                    $html = $parser->text($raw);
                } else {
                    $html = nl2br(e($raw));
                }
            } catch (\Throwable $e) {
                $html = nl2br(e($raw));
            }
        } else {
            $html = $raw;
        }

        // SANITIZE HTML (same purifier fallback logic)
        $allowed = '<p><br><strong><b><em><i><ul><ol><li><h1><h2><h3><h4><a><img><blockquote><pre><code>';
        $clean = strip_tags($html, $allowed);

        $clean = preg_replace('/(<[a-z][^>]*?)\s+on[a-z]+\s*=\s*(["\']).*?\2/si', '$1', $clean);
        $clean = preg_replace_callback('/<(a|img)[^>]+>/i', function ($m) {
            return preg_replace('/(href|src)\s*=\s*(["\'])(javascript:).*?\2/si', '$1=$2#$2', $m[0]);
        }, $clean);

        return view('components.blog.blog-show', [
            'article' => $article,
            'safeContent' => $clean,
        ]);
    }

}
