<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Show blog listing.
     */
    public function index(Request $request)
    {
        $q = trim($request->query('q', ''));
        $category = $request->query('category', 'all');

        // If you have an Eloquent Post model + posts table, use it.
        if (
            class_exists(\App\Models\Post::class) &&
            Schema::hasTable('posts')
        ) {
            $query = \App\Models\Post::query();

            if ($category !== 'all') {
                // adjust column name as needed
                $query->where('category', $category);
            }

            if ($q !== '') {
                $query->where(function ($b) use ($q) {
                    $b
                        ->where('title', 'like', "%{$q}%")
                        ->orWhere('excerpt', 'like', "%{$q}%")
                        ->orWhere('content', 'like', "%{$q}%");
                });
            }

            // You can switch to paginate() later if desired
            $posts = $query->orderBy('published_at', 'desc')->get();

            // Optional: map attributes to match blade keys (if you prefer arrays)
            // $posts = $posts->map(function($p){
            //     return [
            //         'title' => $p->title,
            //         'excerpt' => $p->excerpt,
            //         'image' => $p->image,
            //         'category' => $p->category,
            //         'date' => optional($p->published_at)->format('M j, Y'),
            //         'readTime' => ($p->read_time ?? ''),
            //         'author' => $p->author_name ?? ($p->author->name ?? 'Staff'),
            //         'authorAvatar' => $p->author_avatar ?? '',
            //     ];
            // });
        } else {
            // Fallback sample posts if no DB/model available
            $posts = collect([
                [
                    'title' =>
                        'Understanding Your Dosha: A Complete Guide to Ayurvedic Body Types',
                    'excerpt' =>
                        'Discover how knowing your unique dosha can transform your approach to health, nutrition, and lifestyle choices for optimal well-being. Learn the characteristics of Vata, Pitta, and Kapha constitutions.',
                    'image' =>
                        'https://images.unsplash.com/photo-1736748580995-1d5faa88ce4d?auto=format&fit=crop&w=1080&q=80',
                    'category' => 'Ayurvedic Basics',
                    'date' => 'Dec 15, 2024',
                    'readTime' => '8 min read',
                    'author' => 'Dr. Priya Sharma',
                    'authorAvatar' =>
                        'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&h=150&fit=crop&crop=face',
                ],
                // ... you can paste the rest of your sample posts here
            ]);

            // server-side filtering for fallback data
            $posts = $posts
                ->filter(function ($post) use ($category, $q) {
                    $catMatch =
                        $category === 'all' ||
                        ($post['category'] ?? '') === $category;
                    if ($q === '') {
                        return $catMatch;
                    }
                    $qL = mb_strtolower($q);
                    return $catMatch &&
                        (Str::contains(
                            mb_strtolower($post['title'] ?? ''),
                            $qL
                        ) ||
                            Str::contains(
                                mb_strtolower($post['excerpt'] ?? ''),
                                $qL
                            ) ||
                            Str::contains(
                                mb_strtolower($post['category'] ?? ''),
                                $qL
                            ));
                })
                ->values();
        }

        return view('pages.blog', compact('posts'));
    }
}
