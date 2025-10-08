{{-- resources/views/pages/blog.blade.php --}}
@extends('layouts.app')

@section('content')
@php
    // If controller provides $posts, use that. Otherwise fallback to sample data below.
    if (!isset($posts) || empty($posts)) {
        $posts = collect([
            [
                'title' => 'Understanding Your Dosha: A Complete Guide to Ayurvedic Body Types',
                'excerpt' => 'Discover how knowing your unique dosha can transform your approach to health, nutrition, and lifestyle choices for optimal well-being. Learn the characteristics of Vata, Pitta, and Kapha constitutions.',
                'image' => 'https://images.unsplash.com/photo-1736748580995-1d5faa88ce4d?auto=format&fit=crop&w=1080&q=80',
                'category' => 'Ayurvedic Basics',
                'date' => 'Dec 15, 2024',
                'readTime' => '8 min read',
                'author' => 'Dr. Priya Sharma',
                'authorAvatar' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&h=150&fit=crop&crop=face'
            ],
            [
                'title' => 'The Healing Power of Panchakarma: Ancient Detox for Modern Life',
                'excerpt' => 'Learn how this comprehensive cleansing process can help reset your body and mind, addressing everything from stress to chronic health issues. Discover the five actions of Panchakarma.',
                'image' => 'https://images.unsplash.com/photo-1757689314932-bec6e9c39e51?auto=format&fit=crop&w=1080&q=80',
                'category' => 'Treatments',
                'date' => 'Dec 12, 2024',
                'readTime' => '12 min read',
                'author' => 'Dr. Rajesh Patel',
                'authorAvatar' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=150&h=150&fit=crop&crop=face'
            ],
            [
                'title' => 'Ayurvedic Nutrition: Eating According to Your Constitution',
                'excerpt' => 'Explore how food can be medicine when chosen according to your dosha, seasonal changes, and current state of health. Practical meal planning tips included.',
                'image' => 'https://images.unsplash.com/photo-1589548234057-881a5d872453?auto=format&fit=crop&w=1080&q=80',
                'category' => 'Nutrition',
                'date' => 'Dec 10, 2024',
                'readTime' => '6 min read',
                'author' => 'Dr. Ananya Krishnan',
                'authorAvatar' => 'https://images.unsplash.com/photo-1594824804732-ca8db7531c5e?w=150&h=150&fit=crop&crop=face'
            ],
            [
                'title' => 'Seasonal Wellness: Adapting Your Routine to Nature\'s Rhythms',
                'excerpt' => 'Learn how to align your daily and seasonal routines with natural cycles for optimal health. Discover specific practices for each season and dosha combination.',
                'image' => 'https://images.unsplash.com/photo-1667199021925-5778681d0406?auto=format&fit=crop&w=1080&q=80',
                'category' => 'Lifestyle',
                'date' => 'Dec 8, 2024',
                'readTime' => '10 min read',
                'author' => 'Dr. Vikram Singh',
                'authorAvatar' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=150&h=150&fit=crop&crop=face'
            ],
            [
                'title' => 'Meditation and Mindfulness in Ayurvedic Practice',
                'excerpt' => 'Discover the role of meditation in Ayurvedic healing and learn specific techniques suited to your dosha. Includes guided practices for beginners and advanced practitioners.',
                'image' => 'https://images.unsplash.com/photo-1730701878011-a423ec61c328?auto=format&fit=crop&w=1080&q=80',
                'category' => 'Mental Health',
                'date' => 'Dec 5, 2024',
                'readTime' => '7 min read',
                'author' => 'Dr. Meera Gupta',
                'authorAvatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&h=150&fit=crop&crop=face'
            ],
            [
                'title' => 'Herbal Medicine: Nature\'s Pharmacy for Modern Ailments',
                'excerpt' => 'Explore the vast world of Ayurvedic herbs and their therapeutic properties. Learn about common herbs, their uses, and how to incorporate them safely into your wellness routine.',
                'image' => 'https://images.unsplash.com/photo-1736748580995-1d5faa88ce4d?auto=format&fit=crop&w=1080&q=80',
                'category' => 'Treatments',
                'date' => 'Dec 3, 2024',
                'readTime' => '9 min read',
                'author' => 'Dr. Priya Sharma',
                'authorAvatar' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&h=150&fit=crop&crop=face'
            ],
            [
                'title' => 'Stress Management Through Ayurvedic Principles',
                'excerpt' => 'Understand how stress affects different doshas and learn personalized techniques for managing stress naturally. Includes breathing exercises, lifestyle tips, and herbal support.',
                'image' => 'https://images.unsplash.com/photo-1589548234057-881a5d872453?auto=format&fit=crop&w=1080&q=80',
                'category' => 'Mental Health',
                'date' => 'Nov 30, 2024',
                'readTime' => '8 min read',
                'author' => 'Dr. Rajesh Patel',
                'authorAvatar' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=150&h=150&fit=crop&crop=face'
            ],
            [
                'title' => 'Women\'s Health and Ayurveda: A Holistic Approach',
                'excerpt' => 'Explore how Ayurveda addresses women\'s health concerns throughout different life stages. From menstrual health to menopause, discover natural solutions.',
                'image' => 'https://images.unsplash.com/photo-1757689314932-bec6e9c39e51?auto=format&fit=crop&w=1080&q=80',
                'category' => 'Women\'s Health',
                'date' => 'Nov 28, 2024',
                'readTime' => '11 min read',
                'author' => 'Dr. Ananya Krishnan',
                'authorAvatar' => 'https://images.unsplash.com/photo-1594824804732-ca8db7531c5e?w=150&h=150&fit=crop&crop=face'
            ],
            [
                'title' => 'The Science Behind Ayurvedic Massage Therapies',
                'excerpt' => 'Understand the therapeutic benefits of traditional Ayurvedic massage techniques. Learn about different oils, pressure points, and how massage supports overall health.',
                'image' => 'https://images.unsplash.com/photo-1730701878011-a423ec61c328?auto=format&fit=crop&w=1080&q=80',
                'category' => 'Treatments',
                'date' => 'Nov 25, 2024',
                'readTime' => '6 min read',
                'author' => 'Dr. Vikram Singh',
                'authorAvatar' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=150&h=150&fit=crop&crop=face'
            ],
        ]);
    } else {
        // ensure $posts is a collection for convenience
        $posts = is_iterable($posts) ? collect($posts) : collect([]);
    }

    // request inputs for filtering (GET)
    $selectedCategory = request('category', 'all');
    $searchQuery = trim(request('q', ''));

    // categories (unique from data)
    $categories = $posts->pluck('category')->filter()->unique()->values()->all();
    array_unshift($categories, 'all');

    // filtering logic
    $filtered = $posts->filter(function ($post) use ($selectedCategory, $searchQuery) {
        $catMatch = $selectedCategory === 'all' || ($post['category'] ?? '') === $selectedCategory;
        if ($searchQuery === '') {
            return $catMatch;
        }
        $q = mb_strtolower($searchQuery);
        $title = mb_strtolower($post['title'] ?? '');
        $excerpt = mb_strtolower($post['excerpt'] ?? '');
        $category = mb_strtolower($post['category'] ?? '');
        return $catMatch && (str_contains($title, $q) || str_contains($excerpt, $q) || str_contains($category, $q));
    })->values();

    // featured article is first filtered item (if any)
    $featured = $filtered->first();
    $otherPosts = $filtered->slice(1);
@endphp

<div class="pt-24 pb-16">
  <div class="max-w-[1100px] mx-auto px-5">
    {{-- Header --}}
    <div class="text-center space-y-6 mb-12">
      <h1 class="text-4xl lg:text-5xl font-semibold text-foreground">Wellness Knowledge Center</h1>
      <p class="text-lg text-muted-foreground  mx-auto leading-relaxed">
        Explore our comprehensive collection of articles on Ayurvedic wisdom, health tips, and practical guidance for natural wellness.
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
          <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="6" stroke-width="1.5"/><path d="M21 21l-4.35-4.35" stroke-width="1.5" stroke-linecap="round"/></svg>
          <input type="text" name="q" value="{{ old('q', $searchQuery) }}" placeholder="Search articles, topics, or authors..." class="pl-10 w-full rounded-lg border border-border px-3 py-2" />
        </div>

        <div class="flex items-center">
          <label for="category-select" class="sr-only">Category</label>
          <select id="category-select" name="category" class="w-full rounded-lg border border-border px-3 py-2">
            <option value="all" @selected($selectedCategory === 'all')>All Categories</option>
            @foreach(array_filter($categories, fn($c) => $c !== 'all') as $c)
              <option value="{{ $c }}" @selected($selectedCategory === $c)>{{ $c }}</option>
            @endforeach
          </select>
        </div>

        <div class="text-sm text-muted-foreground flex items-center justify-center md:justify-end">
          {{-- BookOpen icon --}}
          <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M3 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14H5a2 2 0 0 1-2-2V5z"/></svg>
          <span>{{ $filtered->count() }} article{{ $filtered->count() !== 1 ? 's' : '' }} found</span>
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
              <span class="inline-block badge-accent bg-primary text-white w-fit px-3 py-1 rounded-full">Featured Article</span>
              <h2 class="text-2xl lg:text-3xl font-semibold text-foreground">{{ $featured['title'] }}</h2>
              <p class="text-muted-foreground leading-relaxed">{{ $featured['excerpt'] }}</p>
              <div class="flex items-center gap-4 text-sm text-muted-foreground">
                <span>{{ $featured['date'] ?? '' }}</span>
                <span>{{ $featured['readTime'] ?? '' }}</span>
                <span>By {{ $featured['author'] ?? 'Staff' }}</span>
              </div>
              <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary/90">Read Full Article
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 12h14M13 5l7 7-7 7" stroke-width="1.5" stroke-linecap="round"/></svg>
              </a>
            </div>

            <div class="order-first lg:order-last">
              <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}" class="w-full h-64 lg:h-80 object-cover rounded-xl" />
            </div>
          </div>
        </div>
      </div>
    @endif

    {{-- Articles grid (skip featured) --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse($otherPosts as $post)
        <article class="card hover:shadow-md transition-shadow">
          <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-44 object-cover rounded-t-lg" />
          <div class="p-5">
            <div class="flex items-center justify-between mb-3">
              <span class="text-xs bg-primary/5 text-primary px-2 py-1 rounded-full">{{ $post['category'] }}</span>
              <span class="text-xs text-muted-foreground">{{ $post['date'] }}</span>
            </div>
            <h3 class="font-semibold text-foreground mb-2">{{ $post['title'] }}</h3>
            <p class="text-sm text-muted-foreground leading-relaxed mb-4">{{ \Illuminate\Support\Str::limit($post['excerpt'], 120) }}</p>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <img src="{{ $post['authorAvatar'] }}" alt="{{ $post['author'] }}" class="w-8 h-8 rounded-full object-cover" />
                <div class="text-sm">
                  <div class="font-medium text-foreground">{{ $post['author'] }}</div>
                  <div class="text-xs text-muted-foreground">{{ $post['readTime'] }}</div>
                </div>
              </div>
              <a href="#" class="inline-flex items-center gap-2 text-primary hover:translate-x-1 transition-transform">
                Read
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M13 5l7 7-7 7M5 12h14" stroke-width="1.5" stroke-linecap="round"/></svg>
              </a>
            </div>
          </div>
        </article>
      @empty
        <div class="md:col-span-2 lg:col-span-3 text-center py-16">
          <div class="  mx-auto space-y-4">
            {{-- book icon --}}
            <svg class="w-12 h-12 text-muted-foreground mx-auto" viewBox="0 0 24 24" fill="currentColor"><path d="M3 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14H5a2 2 0 0 1-2-2V5z"/></svg>
            <h3 class="text-xl font-medium text-foreground">No articles found</h3>
            <p class="text-muted-foreground">Try adjusting your search terms or browse all categories.</p>
            <a href="{{ url()->current() }}" class="btn-primary inline-flex items-center gap-2">Show All Articles</a>
          </div>
        </div>
      @endforelse
    </div>

    {{-- Load more placeholder (if you will implement pagination later) --}}
    @if($filtered->count() > 9)
      <div class="text-center mt-12">
        <a href="#" class="btn-secondary inline-flex items-center px-6 py-2 rounded-xl">Load More Articles</a>
      </div>
    @endif
  </div>
</div>
@endsection
