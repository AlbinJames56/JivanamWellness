@php
    use Illuminate\Support\Str;

    $blogPosts = $blogPosts ?? collect();

    if ($blogPosts instanceof \Illuminate\Support\Collection) {
        $blogPosts = $blogPosts->map(function ($p) {
            if (is_object($p)) {
                return [
                    'title' => $p->title ?? '',
                    'excerpt' => $p->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($p->content ?? ''), 140),
                    'image' => $p->image ? (Str::startsWith($p->image, ['http://', 'https://']) ? $p->image : asset('storage/' . ltrim($p->image, '/'))) : null,
                    'category' => $p->category ?? 'Uncategorized',
                    'date' => optional($p->published_at)->format('M d, Y'),
                    'readTime' => $p->read_time ?? $p->estimated_read_time ?? null,
                    'author' => $p->author_name ?? ($p->author?->name ?? 'Staff'),
                    'authorAvatar' => $p->author_avatar ? (Str::startsWith($p->author_avatar, ['http://', 'https://']) ? $p->author_avatar : asset('storage/' . ltrim($p->author_avatar, '/'))) : null,
                    'slug' => $p->slug ?? null,
                ];
            }
            return (array) $p;
        })->all();
    } elseif (is_array($blogPosts)) {
        // ok
    } else {
        $blogPosts = [];
    }
@endphp

<section id="blog" class="py-16 lg:py-24 bg-muted/30">
    <div class="max-w-[1100px] mx-auto px-5">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-16">
            <div class="space-y-6">
                <div class="flex items-center gap-4 justify-between">
                    <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Wellness Insights & Tips</h2>

                    <div>
                        <a href="{{ url('/blog') }}" class="btn-secondary inline-flex items-center gap-2 px-4 py-2">
                            View All Articles
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <p class="text-lg text-muted-foreground leading-relaxed">
                    Stay informed with the latest in Ayurvedic wisdom, practical health tips, and insights from our
                    experienced practitioners.
                </p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($blogPosts as $post)
                @php
                    // Build a post URL. If you have a named route change this accordingly.
                    $postUrl = !empty($post['slug']) ? url('/blog/' . ltrim($post['slug'], '/')) : url('/blog');
                @endphp

                @include('components.home.blog-card', [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'image' => $post['image'],
                    'category' => $post['category'],
                    'date' => $post['date'],
                    'readTime' => $post['readTime'],
                    'author' => $post['author'],
                    'authorAvatar' => $post['authorAvatar'],
                    'postUrl' => $postUrl,
                ])
            @endforeach
        </div>
    </div>
</section>
