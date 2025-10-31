<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Show blog listing with featured article + paginated grid.
     */
    public function index(Request $request)
    {
        $q = trim($request->query('q', ''));
        $selectedCategory = $request->query('category', 'all');

        // Base query for published articles
        $baseQuery = Article::query()
            ->where('published', true);

        // Apply category filter if provided and not 'all'
        if ($selectedCategory !== 'all' && $selectedCategory !== null && $selectedCategory !== '') {
            $baseQuery->where('category', $selectedCategory);
        }

        // Apply search on title/excerpt/content
        if ($q !== '') {
            $baseQuery->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%")
                    ->orWhere('content', 'like', "%{$q}%");
            });
        }

        // featured (most recent match)
        $featuredModel = (clone $baseQuery)->latest('published_at')->first();

        // pagination: exclude featured if present so featured doesn't repeat
        $listQuery = (clone $baseQuery);
        if ($featuredModel) {
            $listQuery->where('id', '<>', $featuredModel->id);
        }

        $perPage = 9;
        $paginated = $listQuery->orderByDesc('published_at')->paginate($perPage)->withQueryString();

        // categories list for filters (from published articles)
       if (Schema::hasColumn('articles', 'category')) {
    $categories = Article::query()
        ->where('published', true)
        ->pluck('category')
        ->filter()
        ->unique()
        ->values()
        ->all();
} else {
    $categories = []; // fallback: blade will show no category filters
}

        // transform helpers
        $transform = function (Article $a) {
            return [
                'id' => $a->id,
                'title' => $a->title,
                'excerpt' => $a->excerpt ?: Str::limit(strip_tags($a->content ?? ''), 140),
                'image' => $this->resolveImageUrl($a->image),
                'category' => $a->getAttribute('category') ?? 'Uncategorized',
                'date' => optional($a->published_at)->format('M d, Y'),
                'readTime' => $a->read_time ?? ($a->estimated_read_time ?? null),
               'author' => $a->getAttribute('author_name') ?? ($a->author?->name ?? 'Staff'),
'authorAvatar' => $this->resolveImageUrl($a->getAttribute('author_avatar') ?? null),
                'slug' => $a->slug,
            ];
        };

        $featured = $featuredModel ? $transform($featuredModel) : null;
        $posts = $paginated->getCollection()->map($transform);

        // pass paginated resource with transformed collection
        // replace collection inside paginator (so blade can still use links())
        $paginated->setCollection($posts);

        return view('pages.blog', [
            'featured' => $featured,
            'paginated' => $paginated,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'searchQuery' => $q,
        ]);
    }

    /**
     * Return URL for image stored on public disk or absolute URL or null.
     */
    private function resolveImageUrl(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        // absolute URL already
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        // If path exists on public disk
        if (Storage::disk('public')->exists(ltrim($path, '/'))) {
            return Storage::disk('public')->url(ltrim($path, '/'));
        }

        // fallback to /storage path (common)
        return asset('storage/' . ltrim($path, '/'));
    }
}
