@extends('layouts.app')
<style>
    .therapy-content {
        line-height: 1.75;
        color: inherit;
        max-width: none;
    }

    .therapy-content * {
        all: revert;
    }

    .therapy-content>*+* {
        margin-top: 1.25rem;
    }
</style>

@section('content')
    <div class="min-h-screen bg-background text-foreground">
        {{-- Reading progress bar --}}
        <div id="reading-progress"
            class="fixed top-0 left-0 h-1 bg-gradient-to-r from-primary to-secondary z-50 w-0 transition-all">
        </div>

        <div class="max-w-6xl mx-auto px-4 py-12">
            {{-- HERO Section --}}
            <header class="relative rounded-3xl overflow-hidden shadow-lg mb-8">
                <div class="relative h-72 md:h-96 lg:h-[520px]">
                    @if($article?->image)
                        <img src="{{ Storage::disk('public')->url($article->image) }}" alt="{{ $article->title }}"
                            class="w-full h-full object-cover transform transition-transform duration-700 ease-out will-change-transform"
                            style="transform-origin: center;" id="hero-image">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-primary/10 to-muted/10"></div>
                    @endif

                    {{-- dark overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-black/10"></div>

                    {{-- title block --}}
                    <div class="absolute left-4 right-4 bottom-6 md:bottom-10 md:left-10 md:right-auto">
                        <div
                            class="inline-block bg-white/6 backdrop-blur px-5 py-4 rounded-2xl border border-white/6 shadow-sm">
                            <div class="text-sm text-white/90">{{ optional($article->published_at)->format('M d, Y') }} ·
                                {{ $article->read_time ?? $article->estimated_read_time }} min read
                            </div>
                            <h1 class="text-2xl md:text-4xl font-extrabold leading-tight text-white mt-2">
                                {{ $article->title }}
                            </h1>
                            @if($article->excerpt)
                                <p class="text-sm text-white/90 mt-2  ">{{ $article->excerpt }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </header>
            {{-- Main layout: content + sidebar --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Content column --}}
                <main class="lg:col-span-2">
                    {{-- article content --}}
                    <article class="bg-white rounded-2xl shadow-sm border border-border overflow-hidden">
                        <div class="prose max-w-none prose-lg therapy-content p-6" id="article-content">
                            {{-- admin-supplied HTML --}}
                            {!! $safeContent !!}

                        </div>
                    </article>
                    {{-- related articles --}}
                    <section class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">You might also like</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @php
                                if (!isset($relatedArticles)) {
                                    $relatedArticles = \App\Models\Article::where('id', '<>', $article->id)
                                        ->where('published', true)
                                        ->latest('published_at')
                                        ->take(3)
                                        ->get();
                                }
                            @endphp

                            @foreach($relatedArticles as $r)
                                <a href="{{ route('articles.show', $r->slug) }}"
                                    class="block rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition">
                                    <div class="h-40 bg-gray-100 overflow-hidden">
                                        @if($r->image)
                                            <img src="{{ asset('storage/' . ltrim($r->image, '/')) }}" alt="{{ $r->title }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="p-4 bg-white">
                                        <div class="text-xs text-muted-foreground">
                                            {{ optional($r->published_at)->format('M d, Y') }} ·
                                            {{ $r->read_time ?? $r->estimated_read_time }} min
                                        </div>
                                        <h4 class="mt-2 font-semibold">{{ $r->title }}</h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </section>

                    {{-- CTA band --}}
                    <div class="mt-8 rounded-2xl bg-gradient-to-r from-primary to-secondary p-6 text-white shadow-lg">
                        <div class="flex flex-col md:flex-row items-center gap-4">
                            <div>
                                <h4 class="text-lg font-semibold">Ready to start your healing journey?</h4>
                                <p class="text-sm opacity-90">Book a consultation and get a personalised Ayurvedic plan.</p>
                            </div>
                            <div class="ml-auto" data-booking @if(isset($therapy)) data-treatment="{{ $therapy->slug }}"
                            @elseif(isset($article) && isset($article->therapy))
                                data-treatment="{{ $article->therapy->slug }}" @endif>
                                <a href="#booking" class="btn-white px-4 py-2 rounded-lg shadow">Book Now</a>
                            </div>

                        </div>
                    </div>
                </main>

                {{-- Sidebar (TOC + author + meta) --}}
                <aside class="lg:col-span-1 sticky top-20 self-start">
                    <div class="space-y-6">

                        {{-- Table of contents --}}
                        <div class="bg-card p-4 rounded-2xl border border-border">
                            <div class="flex items-center justify-between mb-3">
                                <div class="font-semibold">On this page</div>
                                <div class="text-xs text-muted-foreground">Quick nav</div>
                            </div>
                            <nav id="toc" class="text-sm text-muted-foreground space-y-2">
                                {{-- JS will populate TOC from headings inside article-content --}}
                                <div class="text-xs text-muted-foreground">Loading…</div>
                            </nav>
                        </div>

                        {{-- small author card --}}
                        <div class="bg-card p-4 rounded-2xl border border-border">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 rounded-full bg-muted/10 flex items-center justify-center text-muted-foreground font-medium">
                                    {{ strtoupper(substr($article->author_name ?? 'J', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-medium">{{ $article->author_name ?? 'Jivanam Wellness' }}</div>
                                    <div class="text-xs text-muted-foreground">
                                        {{ $article->author_bio ?? 'Ayurvedic Practitioner & Wellness Coach' }}
                                    </div>
                                </div>
                            </div>

                            <p class="text-sm text-muted-foreground mt-3">
                                {{ $article->author_note ?? 'We specialise in traditional Ayurvedic treatments combined with modern care.' }}
                            </p>

                            <div class="mt-3 flex gap-2">
                                <button href="#booking" id="open-booking-from-hero" data-booking data-source="blog-page"
                                    class="btn-primary px-3 py-2 text-sm">Book</button>
                                <a href="#" class="btn-secondary px-3 py-2 text-sm">Contact</a>
                            </div>
                        </div>

                        {{-- meta / tags small --}}
                        <div class="bg-card p-4 rounded-2xl border border-border text-sm text-muted-foreground">
                            <div><strong>Published:</strong> {{ optional($article->published_at)->format('M d, Y') }}</div>
                            <div class="mt-1"><strong>Read time:</strong>
                                {{ $article->read_time ?? $article->estimated_read_time }} min</div>
                            @if(!empty($article->category))
                                <div class="mt-1"><strong>Category:</strong> {{ $article->category }}</div>
                            @endif
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    {{-- Inline JS: progress, TOC, small hero parallax --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Reading progress
                const progress = document.getElementById('reading-progress');
                const articleContent = document.getElementById('article-content');

                function updateProgress() {
                    if (!articleContent) return;
                    const rect = articleContent.getBoundingClientRect();
                    const top = Math.max(0, -rect.top);
                    const height = rect.height - window.innerHeight + 200; // padding
                    const percent = height > 0 ? Math.min(100, Math.round((top / height) * 100)) : 100;
                    progress.style.width = percent + '%';
                }
                document.addEventListener('scroll', updateProgress, { passive: true });
                window.addEventListener('resize', updateProgress);
                updateProgress();

                // Build Table of Contents from H2/H3 inside content
                const toc = document.getElementById('toc');
                if (toc && articleContent) {
                    toc.innerHTML = '';
                    const headers = articleContent.querySelectorAll('h2, h3');
                    if (headers.length === 0) {
                        toc.innerHTML = '<div class="text-xs text-muted-foreground">No sections</div>';
                    } else {
                        headers.forEach((h, i) => {
                            const id = h.id || ('heading-' + i);
                            h.id = id;
                            const link = document.createElement('a');
                            link.href = '#' + id;
                            link.className = 'block hover:text-primary transition-colors';
                            link.textContent = (h.tagName === 'H2' ? '• ' : '— ') + h.textContent;
                            link.addEventListener('click', function (e) {
                                e.preventDefault();
                                document.querySelector('#' + id).scrollIntoView({ behavior: 'smooth', block: 'start' });
                            });
                            toc.appendChild(link);
                        });
                    }
                }

                // Hero subtle parallax on scroll
                const heroImage = document.getElementById('hero-image');
                if (heroImage) {
                    function heroParallax() {
                        const scrolled = window.scrollY;
                        heroImage.style.transform = 'translateY(' + (scrolled * 0.08) + 'px) scale(1.02)';
                    }
                    document.addEventListener('scroll', heroParallax, { passive: true });
                    heroParallax();
                }
            });
        </script>
    @endpush

@endsection