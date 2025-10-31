{{-- resources/views/pages/blog.blade.php --}}
@extends('layouts.app')

@section('content')
    @php
        // Request inputs
        $searchQuery = $searchQuery ?? request('q', '');
        $selectedCategory = $selectedCategory ?? request('category', 'all');

        // If controller provided $paginated (LengthAwarePaginator) and $featured, use them.
        // If not, try to use any $posts sample you already defined; otherwise fall back safely.
        $featured = $featured ?? null;

        // Determine paginated count robustly:
        if (isset($paginated) && $paginated instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $paginatedCount = ($paginated->total() ?? $paginated->count());
        } elseif (isset($paginated) && is_iterable($paginated)) {
            // controller may pass a collection or array
            $paginatedCount = is_countable($paginated) ? count($paginated) : 0;
        } elseif (isset($posts) && is_iterable($posts)) {
            // fallback: posts collection/array - count everything except featured
            $postsCollection = collect($posts);
            $paginatedCount = max(0, $postsCollection->count() - ($featured ? 1 : 0));
            // create a basic paginator for the template to iterate over if needed
            $perPage = 9;
            $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
                $postsCollection->slice($featured ? 1 : 0, $perPage)->values(),
                $paginatedCount,
                $perPage,
                1,
                ['path' => url()->current()]
            );
        } else {
            // no data at all — empty paginator so loops won't break
            $paginated = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 9, 1, ['path' => url()->current()]);
            $paginatedCount = 0;
        }

        // Ensure $categories exists and add 'all' option at front
        $categories = $categories ?? (isset($posts) && is_iterable($posts) ? collect($posts)->pluck('category')->filter()->unique()->values()->all() : []);
        if (!in_array('all', $categories)) {
            array_unshift($categories, 'all');
        }

        // Finally total matches (featured + paginator total)
        $totalMatches = ($paginatedCount ?? 0) + ($featured ? 1 : 0);

        // Ensure other small fallbacks used in the blade
        $searchQuery = $searchQuery ?? '';
        $selectedCategory = $selectedCategory ?? 'all';
    @endphp



    <div class="pt-24 pb-16">
        <div class="max-w-[1100px] mx-auto px-5">
            {{-- Header --}}
            <div class="text-center space-y-6 mb-12">
                <h1 class="text-4xl lg:text-5xl font-semibold text-foreground">Wellness Knowledge Center</h1>
                <p class="text-lg text-muted-foreground  mx-auto leading-relaxed">
                    Explore our comprehensive collection of articles on Ayurvedic wisdom, health tips, and practical
                    guidance for natural wellness.
                </p>
            </div>

            {{-- Categories (buttons use GET links) --}}
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                @foreach($categories as $category)
                    @php
                        $isActive = ($selectedCategory === $category) || ($category === 'all' && $selectedCategory === 'all');
                        $label = $category === 'all' ? 'All Articles' : $category;
                        // build link preserving query q
                        $link = url()->current() . '?category=' . urlencode($category);
                        if ($searchQuery !== '') {
                            $link .= '&q=' . urlencode($searchQuery);
                        }
                    @endphp
                    <a href="{{ $link }}"
                        class="inline-flex items-center px-3 py-1.5 rounded-xl border transition-colors {{ $isActive ? 'bg-primary text-white' : 'bg-primary/5 text-foreground hover:bg-primary/10 hover:text-primary' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- Search/filter box --}}
            <form method="GET" action="{{ url()->current() }}" class="bg-card rounded-2xl border border-border p-6 mb-8">
                <div class="grid md:grid-cols-3 gap-4 items-center">
                    <div class="relative md:col-span-2">
                        {{-- Search icon (inline SVG) --}}
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11" cy="11" r="6" stroke-width="1.5" />
                            <path d="M21 21l-4.35-4.35" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <input type="text" name="q" value="{{ old('q', $searchQuery) }}"
                            placeholder="Search articles, topics, or authors..."
                            class="pl-10 w-full rounded-lg border border-border px-3 py-2" />
                    </div>

                    <div class="flex items-center">
                        <label for="category-select" class="sr-only">Category</label>
                        <select id="category-select" name="category"
                            class="w-full rounded-lg border border-border px-3 py-2">
                            <option value="all" @selected($selectedCategory === 'all')>All Categories</option>
                            @foreach(array_filter($categories, fn($c) => $c !== 'all') as $c)
                                <option value="{{ $c }}" @selected($selectedCategory === $c)>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-sm text-muted-foreground flex items-center justify-center md:justify-end">
                        {{-- BookOpen icon --}}
                        <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14H5a2 2 0 0 1-2-2V5z" />
                        </svg>
                        <span>{{ $totalMatches }} article{{ $totalMatches !== 1 ? 's' : '' }} found</span>

                    </div>

                    {{-- Submit button row for smaller screens --}}
                    <div class="md:col-span-3 text-right mt-3 md:mt-0">
                        <button type="submit" class="btn-primary">Search</button>
                    </div>
                </div>
            </form>

            {{-- Featured Article --}}
            @if($featured)
                <div class="mb-12">
                    <div class="bg-gradient-to-r from-primary/10 to-accent/10 rounded-2xl p-8 border border-border">
                        <div class="grid lg:grid-cols-2 gap-8 items-center">
                            <div class="space-y-6">
                                <span
                                    class="inline-block badge-accent bg-primary text-white w-fit px-3 py-1 rounded-full">Featured
                                    Article</span>
                                <h2 class="text-2xl lg:text-3xl font-semibold text-foreground">{{ $featured['title'] }}</h2>
                                <p class="text-muted-foreground leading-relaxed">{{ $featured['excerpt'] }}</p>
                                <div class="flex items-center gap-4 text-sm text-muted-foreground">
                                    <span>{{ $featured['date'] ?? '' }}</span>
                                    <span>{{ $featured['readTime'] ?? '' }}</span>
                                    <span>By {{ $featured['author'] ?? 'Staff' }}</span>
                                </div>
                                <a href="{{ route('articles.show', $featured['slug']) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/90">
                                    Read Full Article
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M5 12h14M13 5l7 7-7 7" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </a>
                            </div>

                            <div class="order-first lg:order-last">
                                @if($featured['image'])
                                    <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}"
                                        class="w-full h-64 lg:h-80 object-cover rounded-xl" />
                                @else
                                    <div class="w-full h-64 lg:h-80 bg-muted/10 rounded-xl"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Articles grid (skip featured) --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($paginated as $post)

                    <article class="card hover:shadow-md transition-shadow">
                        <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}"
                            class="w-full h-44 object-cover rounded-t-lg" />
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs bg-primary/5 text-primary px-2 py-1 rounded-full">
                                    {{ $post['category'] ?? 'Uncategorized' }}
                                </span>

                                <span class="text-xs text-muted-foreground">{{ $post['date'] }}</span>
                            </div>
                            <h3 class="font-semibold text-foreground mb-2">{{ $post['title'] }}</h3>
                            <p class="text-sm text-muted-foreground leading-relaxed mb-4">
                                {{ \Illuminate\Support\Str::limit($post['excerpt'], 120) }}
                            </p>
                            <div class="flex items-center justify-between">
                                {{-- <div class="flex items-center gap-3">
                                    <img src="{{ $post['authorAvatar'] }}" alt="{{ $post['author'] }}"
                                        class="w-8 h-8 rounded-full object-cover" />
                                    <div class="text-sm">
                                        <div class="font-medium text-foreground">{{ $post['author'] }}</div>
                                        <div class="text-xs text-muted-foreground">{{ $post['readTime'] }}</div>
                                    </div> --}}
                                </div>

                                <a href="{{ route('articles.show', $post['slug']) }}"
                                    class="inline-flex items-center gap-2 text-primary hover:translate-x-1 transition-transform">
                                    Read
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M13 5l7 7-7 7M5 12h14" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 text-center py-16">
                        <div class="  mx-auto space-y-4">
                            {{-- book icon --}}
                            <svg class="w-12 h-12 text-muted-foreground mx-auto" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14H5a2 2 0 0 1-2-2V5z" />
                            </svg>
                            <h3 class="text-xl font-medium text-foreground">No articles found</h3>
                            <p class="text-muted-foreground">Try adjusting your search terms or browse all categories.</p>
                            <a href="{{ url()->current() }}" class="btn-primary inline-flex items-center gap-2">Show All
                                Articles</a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Load more placeholder (if you will implement pagination later) --}}
            @if($totalMatches > 9)
                <div class="text-center mt-12">
                    <a href="#" class="btn-secondary inline-flex items-center px-6 py-2 rounded-xl">Load More Articles</a>
                </div>
            @endif
        </div>
    </div>
@endsection
