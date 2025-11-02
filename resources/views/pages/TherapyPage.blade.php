{{-- resources\views\pages\TherapyPage.blade.php --}}
@extends('layouts.app')

@section('content')
            @php
    // Keep local fallbacks only when controller didn't pass data
    if (!isset($testimonials)) {
        $testimonials = collect([
            [
                'name' => 'Priya Sharma',
                'location' => 'Bangalore',
                'rating' => 5,
                'text' => 'The Panchakarma detox program transformed my health completely...',
                'therapy' => 'Panchakarma Detox',
            ],
        ]);
    }

    if (!isset($faqs)) {
        $faqs = [
            ['q' => 'What is Ayurvedic therapy?', 'a' => 'Ayurvedic therapy involves traditional healing treatments...'],
            ['q' => 'How long does a session take?', 'a' => 'Sessions typically last 60-90 minutes...'],
        ];
    }

    // Ensure categories exist for filtering
    if (!isset($categories)) {
        $categories = ['Detox', 'Relaxation', 'Therapeutic'];
    }
    $therapyCollection = collect($therapies ?? []);
            @endphp

            <div class="min-h-screen bg-background text-foreground">
                {{-- HERO SECTION --}}
                <section class="relative py-16 lg:py-24 bg-gradient-to-br from-muted/30 to-background" aria-labelledby="hero-heading">
                    <div class="max-w-[1100px] mx-auto px-5 text-center">
                        <div class="inline-block bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-semibold mb-4">
                            Authentic Healing Therapies
                        </div>

                        <h1 id="hero-heading" class="text-4xl lg:text-5xl xl:text-6xl font-semibold leading-tight mb-4">
                            Discover Ancient <span class="text-primary">Ayurvedic Therapies</span>
                        </h1>

                        <p class="text-xl text-muted-foreground leading-relaxed mx-auto mb-6  ">
                            Experience time-tested treatments designed to restore balance, eliminate toxins, and promote natural healing.
                        </p>

                        <div class="mt-6">
                <button type="button" class="btn-primary inline-flex items-center gap-2" id="open-booking-from-hero" data-booking
                    data-source="therapy-page">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                    <rect x="3" y="5" width="18" height="16" rx="2" ry="2" stroke-width="1.5" />
                                    <path stroke-width="1.5" d="M16 3v4M8 3v4M3 11h18" />
                                </svg>
                               Start Your Healing Journey
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                    <path d="M5 12h14M12 5l7 7-7 7" stroke-width="1.5" />
                                </svg>
                              
</button>
                        </div>
                    </div>
                </section>

                {{-- INTRO SECTION --}}
                <section class="py-16 lg:py-24" aria-labelledby="intro-heading">
                    <div class="max-w-[1100px] mx-auto px-5">
                        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                            <div class="order-2 lg:order-1">
                                <img 
                                    src="https://images.unsplash.com/photo-1667199021925-5778681d0406?q=80&w=1080"
                                    alt="Ayurvedic therapy session showing traditional healing techniques"
                                    class="w-full h-[400px] lg:h-[500px] object-cover rounded-3xl shadow-xl"
                                    loading="lazy"
                                />
                            </div>

                            <div class="order-1 lg:order-2 space-y-6">
                                <h2 id="intro-heading" class="text-3xl lg:text-4xl font-semibold">Holistic Healing Through Ancient Wisdom</h2>

                                <div class="text-muted-foreground leading-relaxed space-y-4">
                                    <p>Our therapeutic treatments are rooted in 5,000 years of Ayurvedic tradition, carefully adapted for modern wellness needs. Each therapy is designed to address not just symptoms, but the root causes of imbalance.</p>
                                    <p>From deep detoxification through Panchakarma to gentle healing massages, our comprehensive range of therapies offers natural solutions for physical, mental, and emotional wellbeing.</p>
                                </div>

                                <div class="grid grid-cols-3 gap-4 pt-4" role="list" aria-label="Therapy benefits">
                                    <div class="text-center" role="listitem">
                                        <div class="bg-primary/10 rounded-full p-3 w-fit mx-auto mb-2" aria-hidden="true">
                                            <svg class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-medium text-foreground">Natural</div>
                                        <div class="text-xs text-muted-foreground">100% Herbal</div>
                                    </div>
                                    <div class="text-center" role="listitem">
                                        <div class="bg-primary/10 rounded-full p-3 w-fit mx-auto mb-2" aria-hidden="true">
                                            <svg class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-medium text-foreground">Gentle</div>
                                        <div class="text-xs text-muted-foreground">Non-invasive</div>
                                    </div>
                                    <div class="text-center" role="listitem">
                                        <div class="bg-primary/10 rounded-full p-3 w-fit mx-auto mb-2" aria-hidden="true">
                                            <svg class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-medium text-foreground">Effective</div>
                                        <div class="text-xs text-muted-foreground">Proven Results</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- FILTERS SECTION --}}
                <section class="py-8 mx-auto px-4 sm:px-6 lg:px-8" aria-labelledby="filters-heading">
                    <div class="max-w-[1100px] mx-auto">
                        <h2 id="filters-heading" class="sr-only">Therapy Filters</h2>
                        <div class="flex flex-col sm:flex-row items-center gap-4 justify-between">
                            <div class="flex items-center gap-3">
                                <label for="filterCategory" class="sr-only">Filter by category</label>
                                <select id="filterCategory" class="border border-border rounded-lg px-3 py-2 bg-background min-w-[150px]">
                                    <option value="all">All Categories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ \Illuminate\Support\Str::slug(strtolower($cat)) }}">{{ $cat }}</option>
                                    @endforeach
                                </select>

                                <label for="filterDuration" class="sr-only">Filter by duration</label>
                                <select id="filterDuration" class="border border-border rounded-lg px-3 py-2 bg-background min-w-[150px]">
                                    <option value="all">All Durations</option>
                                    <option value="short">Up to 30 mins</option>
                                    <option value="mid">31 - 60 mins</option>
                                    <option value="long">60+ mins</option>
                                </select>
                            </div>

                            <div class="flex gap-3">
                                <button id="therapyReset" type="button" class="btn-secondary">Reset Filters</button>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- THERAPIES GRID --}}
                <section class="py-16 lg:py-24 mx-auto px-4 sm:px-6 lg:px-8" aria-labelledby="therapies-heading">
                    <div class="max-w-[1100px] mx-auto">
                        <div class="text-center space-y-4 mb-12">
                            <h2 id="therapies-heading" class="text-3xl lg:text-4xl font-semibold">Our Therapeutic Treatments</h2>
                            <p class="text-lg text-muted-foreground mx-auto  ">
                                Choose from our comprehensive range of authentic Ayurvedic therapies, each designed to target specific health concerns and wellness goals.
                            </p>
                        </div>

                        <div id="therapiesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" role="list" aria-label="List of therapies">
                            @forelse ($therapyCollection as $therapy)
                                @php
        $cat = is_object($therapy) ? ($therapy->category ?? '') : ($therapy['category'] ?? '');
        $catSlug = \Illuminate\Support\Str::slug(strtolower($cat));
        $durationRaw = is_object($therapy) ? ($therapy->duration ?? '') : ($therapy['duration'] ?? '');
        preg_match('/\d+/', (string) $durationRaw, $m);
        $durationInt = isset($m[0]) ? (int) $m[0] : null;
                                @endphp

                                <div class="therapy-card-wrap" 
                                     data-category="{{ $catSlug }}" 
                                     data-duration="{{ $durationInt ?? '' }}"
                                     role="listitem">
                                    <x-therapy.therapy-card :therapy="$therapy" />
                                </div>
                            @empty
                                <div class="col-span-full text-center text-muted-foreground py-8">
                                    No therapies available at the moment. Please check back later.
                                </div>
                            @endforelse
                        </div>

                        <div id="therapiesNoResults" class="text-center text-muted-foreground mt-8 hidden" aria-live="polite">
                            No therapies match your selected filters. Try adjusting your criteria.
                        </div>
                    </div>
                </section>

                {{-- TESTIMONIALS --}}
                <section class="py-16 lg:py-24 bg-muted/30 mx-auto px-4 sm:px-6 lg:px-8" aria-labelledby="testimonials-heading">
                    <div class="max-w-[1100px] mx-auto">
                        <div class="text-center mb-12">
                            <h2 id="testimonials-heading" class="text-3xl lg:text-4xl font-semibold">What Our Patients Say</h2>
                            <p class="text-lg text-muted-foreground mx-auto ">
                                Real stories from people who have experienced the transformative power of Ayurvedic healing.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex gap-2">
                                    <button id="test-prev" class="rounded-full border border-border p-2 hover:bg-primary/10 transition-colors" aria-label="Previous testimonial">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button id="test-next" class="rounded-full border border-border p-2 hover:bg-primary/10 transition-colors" aria-label="Next testimonial">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>

                                <div id="test-dots" class="flex gap-2" role="tablist" aria-label="Testimonial navigation"></div>
                            </div>

                            <div id="testimonials" class="testimonials-snap overflow-x-auto no-scrollbar flex gap-6 pb-4" role="region" aria-label="Testimonials carousel">
                                @forelse ($testimonials as $index => $t)
                                    @php
        $therapyName = optional($t->therapy)->title ?? ($t->therapy ?? ($t['therapy'] ?? ''));
        $rating = $t->rating ?? ($t['rating'] ?? 0);
        $avatar = $t->avatar ?? ($t['avatar'] ?? null);
        $hasAvatar = !empty($avatar);

        if ($hasAvatar) {
            $avatar = trim($avatar);
            $isUrl = preg_match('/^(http(s)?:)?\\/\\//', $avatar) || str_starts_with($avatar, '/');
            $avatarSrc = $isUrl ? $avatar : asset('storage/' . ltrim($avatar, '/'));
        }
                                    @endphp

                                    <article class="testimonial-card bg-card rounded-2xl border border-border p-6 max-w-3xl flex-shrink-0" role="tabpanel" aria-labelledby="testimonial-{{ $index }}">
                                        @if($hasAvatar)
                                            <div class="flex items-start gap-4">
                                                <img src="{{ $avatarSrc }}" alt="{{ $t->name ?? 'Patient avatar' }}" loading="lazy" class="w-14 h-14 rounded-full object-cover flex-shrink-0" />
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between">
                                                        <div class="text-sm font-medium" id="testimonial-{{ $index }}">{{ $t->name ?? ($t['name'] ?? '') }}</div>
                                                        <div class="text-xs text-muted-foreground">{{ $t->location ?? ($t['location'] ?? '') }}</div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <div class="flex items-center gap-1 mb-2" aria-label="Rating: {{ $rating }} out of 5 stars">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                <svg class="w-4 h-4 {{ $i < $rating ? 'text-yellow-400' : 'text-gray-300' }}" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                                    <path d="M12 .587l3.668 7.568L24 9.423l-6 5.854L19.335 24 12 19.771 4.665 24 6 15.277 0 9.423l8.332-1.268z" />
                                                                </svg>
                                                            @endfor
                                                        </div>
                                                        <blockquote class="italic text-foreground leading-relaxed">
                                                            "{{ $t->text ?? ($t['text'] ?? '') }}"
                                                        </blockquote>
                                                        <div class="mt-3 text-xs text-primary font-medium bg-primary/10 inline-block px-3 py-1 rounded-full">
                                                            {{ $therapyName }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div>
                                                <div class="flex items-start gap-4">
                                                    <div class="w-14 h-14 rounded-full bg-muted/10 flex items-center justify-center text-muted-foreground font-medium flex-shrink-0" aria-hidden="true">
                                                        {{ strtoupper(substr($t->name ?? ($t['name'] ?? 'A'), 0, 1)) }}
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="flex items-center justify-between">
                                                            <div class="text-sm font-medium" id="testimonial-{{ $index }}">{{ $t->name ?? ($t['name'] ?? '') }}</div>
                                                            <div class="text-xs text-muted-foreground">{{ $t->location ?? ($t['location'] ?? '') }}</div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <div class="flex items-center gap-1 mb-2" aria-label="Rating: {{ $rating }} out of 5 stars">
                                                                @for ($i = 0; $i < 5; $i++)
                                                                    <svg class="w-4 h-4 {{ $i < $rating ? 'text-yellow-400' : 'text-gray-300' }}" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                                        <path d="M12 .587l3.668 7.568L24 9.423l-6 5.854L19.335 24 12 19.771 4.665 24 6 15.277 0 9.423l8.332-1.268z" />
                                                                    </svg>
                                                                @endfor
                                                            </div>
                                                            <blockquote class="italic text-foreground leading-relaxed">
                                                                "{{ $t->text ?? ($t['text'] ?? '') }}"
                                                            </blockquote>
                                                            <div class="mt-3 text-xs text-primary font-medium bg-primary/10 inline-block px-3 py-1 rounded-full">
                                                                {{ $therapyName }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </article>
                                @empty
                                    <div class="text-muted-foreground text-center w-full py-8">No testimonials available yet.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                {{-- CTA SECTION --}}
                <x-contact.BookFreeConsultation />

                {{-- FAQ SECTION --}}
                <section class="py-16 lg:py-24 mx-auto px-4 sm:px-6 lg:px-8" aria-labelledby="faq-heading">
                    <div class="max-w-[900px] mx-auto">
                        <h2 id="faq-heading" class="text-3xl lg:text-4xl font-semibold text-center mb-6">Frequently Asked Questions</h2>

                        <div class="space-y-3" role="list">
                            @foreach ($faqs as $i => $f)
                                <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }" class="border border-border rounded-lg overflow-hidden" role="listitem">
                                    <button 
                                        @click="open = !open" 
                                        class="w-full flex items-center justify-between px-4 py-3 bg-card hover:bg-muted/30 transition-colors text-left"
                                        :aria-expanded="open"
                                        aria-controls="faq-{{ $i }}"
                                    >
                                        <div class="font-medium">{{ $f['q'] }}</div>
                                        <div class="text-muted-foreground text-lg font-semibold" x-text="open ? '−' : '+'"></div>
                                    </button>
                                    <div 
                                        x-show="open" 
                                        x-cloak 
                                        id="faq-{{ $i }}"
                                        class="px-4 py-4 bg-white/50 text-muted-foreground"
                                    >
                                        {!! nl2br(e($f['a'])) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
@endsection

@push('scripts')
<script>
    // Scroll to booking function
    function scrollToBooking() {
        const target = document.querySelector('#booking');
        if (!target) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return;
        }

        if (!target.hasAttribute('tabindex')) {
            target.setAttribute('tabindex', '-1');
        }

        target.scrollIntoView({ behavior: 'smooth', block: 'start' });

        setTimeout(() => {
            try { 
                target.focus({ preventScroll: true }); 
            } catch (e) { /* ignore */ }
        }, 450);
    }

    // Handle hash navigation on page load
    document.addEventListener('DOMContentLoaded', () => {
        if (window.location.hash === '#booking') {
            setTimeout(() => {
                const target = document.querySelector('#booking');
                if (target) {
                    if (!target.hasAttribute('tabindex')) target.setAttribute('tabindex', '-1');
                    target.focus({ preventScroll: true });
                }
            }, 250);
        }

        // Add click event to scroll button
        const scrollButton = document.getElementById('scroll-to-booking');
        if (scrollButton) {
            scrollButton.addEventListener('click', (e) => {
                e.preventDefault();
                scrollToBooking();
            });
        }
    });

    // Therapy filtering functionality
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('filterCategory');
        const durationSelect = document.getElementById('filterDuration');
        const resetBtn = document.getElementById('therapyReset');
        const grid = document.getElementById('therapiesGrid');
        const noResults = document.getElementById('therapiesNoResults');

        if (!grid) return;

        function applyFilters() {
            const cat = (categorySelect?.value || 'all').toString();
            const dur = (durationSelect?.value || 'all').toString();
            const cards = Array.from(grid.querySelectorAll('.therapy-card-wrap'));
            let visibleCount = 0;

            cards.forEach(card => {
                const c = (card.dataset.category || '').toString();
                const d = parseInt(card.dataset.duration) || NaN;
                let ok = true;

                // Category filter
                if (cat !== 'all' && c !== cat) ok = false;

                // Duration filter
                if (ok && dur !== 'all') {
                    if (dur === 'short') {
                        if (!(Number.isFinite(d) && d <= 30)) ok = false;
                    } else if (dur === 'mid') {
                        if (!(Number.isFinite(d) && d > 30 && d <= 60)) ok = false;
                    } else if (dur === 'long') {
                        if (!(Number.isFinite(d) && d > 60)) ok = false;
                    }
                }

                card.style.display = ok ? '' : 'none';
                if (ok) visibleCount++;
            });

            // Show/hide no results message
            if (noResults) {
                noResults.classList.toggle('hidden', visibleCount > 0);
                grid.classList.toggle('hidden', visibleCount === 0);
            }
        }

        // Event listeners
        if (categorySelect) categorySelect.addEventListener('change', applyFilters);
        if (durationSelect) durationSelect.addEventListener('change', applyFilters);

        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                if (categorySelect) categorySelect.value = 'all';
                if (durationSelect) durationSelect.value = 'all';
                applyFilters();
            });
        }

        // Initialize filters
        applyFilters();
    });

    // Testimonials carousel functionality
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('testimonials');
        if (!container) return;
        
        const prev = document.getElementById('test-prev');
        const next = document.getElementById('test-next');
        const dots = document.getElementById('test-dots');
        const cards = Array.from(container.querySelectorAll('.testimonial-card'));

        function itemsPerView() {
            const w = window.innerWidth;
            if (w < 768) return 1;
            if (w < 1024) return 2;
            return 3;
        }

        function buildDots() {
            if (!dots) return;
            
            dots.innerHTML = '';
            const pages = Math.ceil(cards.length / itemsPerView());
            
            for (let i = 0; i < pages; i++) {
                const btn = document.createElement('button');
                btn.className = 'w-2 h-2 rounded-full transition-colors bg-border';
                btn.setAttribute('role', 'tab');
                btn.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
                btn.dataset.index = i;
                btn.addEventListener('click', () => scrollToPage(i));
                dots.appendChild(btn);
            }
            updateDots();
        }

        function scrollToPage(i) {
            const per = itemsPerView();
            const index = i * per;
            const target = cards[Math.min(index, cards.length - 1)];
            
            if (target) {
                container.scrollTo({
                    left: target.offsetLeft - (container.clientWidth - target.clientWidth) / 2,
                    behavior: 'smooth'
                });
            }
            updateDots();
        }

        function updateDots() {
            if (!dots) return;
            
            const per = itemsPerView();
            let active = 0;
            let minDiff = Infinity;
            
            cards.forEach((c, idx) => {
                const center = c.offsetLeft + c.offsetWidth / 2 - container.scrollLeft;
                const diff = Math.abs(center - container.clientWidth / 2);
                if (diff < minDiff) {
                    minDiff = diff;
                    active = Math.floor(idx / per);
                }
            });
            
            Array.from(dots.children).forEach((d, i) => {
                const isActive = i === active;
                d.classList.toggle('bg-primary', isActive);
                d.classList.toggle('bg-border', !isActive);
                d.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });
        }

        if (prev && next) {
            prev.addEventListener('click', () => {
                container.scrollBy({
                    left: -container.clientWidth,
                    behavior: 'smooth'
                });
            });
            
            next.addEventListener('click', () => {
                container.scrollBy({
                    left: container.clientWidth,
                    behavior: 'smooth'
                });
            });
        }

        // Rebuild dots on resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                buildDots();
            }, 120);
        });

        container.addEventListener('scroll', () => {
            window.requestAnimationFrame(updateDots);
        });

        // Initialize
        buildDots();
    });
</script>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .testimonials-snap {
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }
    .testimonial-card {
        scroll-snap-align: center;
    }
    @media (min-width: 768px) {
        .testimonial-card {
            min-width: 48%;
        }
    }
    @media (min-width: 1024px) {
        .testimonial-card {
            min-width: 32%;
        }
    }
    [x-cloak] {
        display: none !important;
    }
</style>
@endpush