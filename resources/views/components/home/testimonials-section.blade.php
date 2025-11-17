@php
    // Accept $testimonials passed from controller. Provide fallback sample only if empty.
    $testimonials = $testimonials ?? collect();

    if ($testimonials->isEmpty()) {
        // Fallback array (your existing sample) — keep for local dev
        $testimonials = collect([
            [
                'name' => 'Sarah Johnson',
                'location' => 'San Francisco, CA',
                'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b169b037?w=150&h=150&fit=crop&crop=face',
                'rating' => 5,
                'text' => 'The Panchakarma treatment completely transformed my health...',
                'treatment' => 'Panchakarma Detox',
            ],
            // ... rest of your sample items ...
        ]);
    } else {
        // If $testimonials is a collection of models, normalize it to an array of arrays
        $testimonials = $testimonials->map(function ($t) {
            if (is_object($t)) {
                return [
                    'name' => $t->name ?? ($t->author_name ?? 'Anonymous'),
                    'location' => $t->location ?? null,
                    'avatar' => $t->avatar ? (Str::startsWith($t->avatar, ['http://', 'https://']) ? $t->avatar : asset('storage/' . ltrim($t->avatar, '/'))) : null,
                    'rating' => $t->rating ?? null,
                    'text' => $t->text ?? $t->message ?? '',
                    'treatment' => $t->treatment ?? null,
                    'isVideo' => (bool) ($t->is_video ?? false),
                    'videoThumbnail' => $t->video_thumbnail ?? null,
                ];
            }
            return (array) $t;
        });
    }
@endphp

<section id="testimonials" class="pb-16 lg:pb-24 bg-background">
    <div class="max-w-[1100px] mx-auto px-5">
        <div class="text-center space-y-6 mb-16">
            <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">What Our Patients Say</h2>
            <p class="text-lg text-muted-foreground   mx-auto leading-relaxed">
                 Hear from those who trusted Ayurveda to bring back their health, energy, and peace of mind.
            </p>
        </div>

        <div class="relative">
            <!-- Slider container -->
            <div class="overflow-hidden">
                <div id="testimonials-slider" class="testimonials-slider  ">
                    @foreach ($testimonials as $testimonial)
                        <div class="testimonial-item-wrapper p-0  h-50">
                            @include('components.home.testimonial-card', [
                                'name' => $testimonial['name'],
                                'location' => $testimonial['location'],
                                'avatar' => $testimonial['avatar'],
                                'rating' => $testimonial['rating'],
                                'text' => $testimonial['text'],
                                'treatment' => $testimonial['treatment'] ?? null,
                                'isVideo' => $testimonial['isVideo'] ?? false,
                                'videoThumbnail' => $testimonial['videoThumbnail'] ?? null,
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
 
            <!-- Navigation -->
            <div class="flex items-center justify-center gap-4 mt-8">
                <button id="testimonials-prev" class="rounded-full border border-border hover:bg-primary/10 p-2">
                    <!-- left chevron svg -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
             </button>

                <div id="testimonials-dots" class="flex gap-2"></div>

                <button id="testimonials-next" class="rounded-full border border-border hover:bg-primary/10 p-2">
                    <!-- right chevron svg -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                       </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Carousel JS: groups items into pages client-side so it's responsive (1/2/3 per page) --}}
    <!-- Replace previous carousel JS + CSS with this -->
   <script>
document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('testimonials-slider');
    if (!track) return;

    const prevBtn = document.getElementById('testimonials-prev');
    const nextBtn = document.getElementById('testimonials-next');
    const dotsContainer = document.getElementById('testimonials-dots');
    let items = Array.from(track.querySelectorAll('.testimonial-item-wrapper'));
    let itemsPerView = 3;
    let pageCount = 1;
    let currentPage = 0;
    let resizeTimer = null;

    // read computed gap (fallback to 16px)
    function getGap() {
        const gapValue = getComputedStyle(track).gap;
        if (!gapValue) return 16;
        // gapValue like "1rem" or "16px", convert px if needed:
        if (gapValue.endsWith('px')) return parseFloat(gapValue);
        // create a temporary element to compute rem/em to px if needed
        const div = document.createElement('div');
        div.style.width = gapValue;
        div.style.position = 'absolute';
        document.body.appendChild(div);
        const px = div.getBoundingClientRect().width || 16;
        document.body.removeChild(div);
        return px;
    }

    function computeItemsPerView() {
        const w = window.innerWidth;
        if (w < 768) return 1;
        if (w < 1024) return 2;
        return 3;
    }

    function applyItemSizing() {
        items = Array.from(track.querySelectorAll('.testimonial-item-wrapper'));
        itemsPerView = computeItemsPerView();
        const containerWidth = track.parentElement.clientWidth || window.innerWidth;
        const gap = getGap();
        // calculate width available for items after gap space between them
        const totalGapsWidth = (itemsPerView - 1) * gap;
        const itemWidth = Math.floor((containerWidth - totalGapsWidth) / itemsPerView);

        items.forEach(wrapper => {
            // set wrapper basis so it doesn't shrink; this controls visible width
            wrapper.style.flex = `0 0 ${itemWidth}px`;
            wrapper.style.maxWidth = `${itemWidth}px`;
            wrapper.style.boxSizing = 'border-box';
            // ensure inner card fills wrapper
            const card = wrapper.querySelector('.testimonial-item');
            if (card) card.style.width = '100%';
        });

        pageCount = Math.max(1, Math.ceil(items.length / itemsPerView));
        if (currentPage >= pageCount) currentPage = pageCount - 1;
        buildDots();
        // use instant true to jump to valid spot on layout changes
        scrollToPage(currentPage, true);
    }

    function buildDots() {
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        for (let i = 0; i < pageCount; i++) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'w-2 h-2 rounded-full transition-colors bg-border';
            btn.dataset.index = i;
            btn.addEventListener('click', function () {
                scrollToPage(i);
            });
            dotsContainer.appendChild(btn);
        }
        updateDots();
    }

    function updateDots() {
        if (!dotsContainer) return;
        Array.from(dotsContainer.children).forEach((dot, i) => {
            dot.classList.toggle('bg-primary', i === currentPage);
            dot.classList.toggle('bg-border', i !== currentPage);
        });
    }

    // compute precise left offset by summing item widths + gaps of preceding items
    function computeLeftForPage(pageIndex) {
        const gap = getGap();
        const startItem = pageIndex * itemsPerView;
        let left = 0;
        for (let i = 0; i < startItem && i < items.length; i++) {
            const w = items[i].getBoundingClientRect().width || items[i].offsetWidth;
            left += w;
            // add gap between items (but not after last)
            left += gap;
        }
        // clamp within max scroll width
        const maxLeft = track.scrollWidth - (track.parentElement.clientWidth || window.innerWidth);
        return Math.max(0, Math.min(left, maxLeft));
    }

    function scrollToPage(pageIndex, instant = false) {
        currentPage = Math.max(0, Math.min(pageIndex, pageCount - 1));
        const left = computeLeftForPage(currentPage);
        // smooth behavior; browsers obey `scroll-behavior: smooth` too
        track.scrollTo({ left, behavior: instant ? 'auto' : 'smooth' });
        updateDots();
    }

    function nextPage() {
        scrollToPage((currentPage + 1) % pageCount);
    }
    function prevPage() {
        scrollToPage((currentPage - 1 + pageCount) % pageCount);
    }

    if (nextBtn) nextBtn.addEventListener('click', nextPage);
    if (prevBtn) prevBtn.addEventListener('click', prevPage);

    // Keep currentPage in sync while user scrolls (debounced)
    let scrollDebounce = null;
    track.addEventListener('scroll', () => {
        clearTimeout(scrollDebounce);
        scrollDebounce = setTimeout(() => {
            const containerWidth = track.parentElement.clientWidth || window.innerWidth;
            const scrolled = track.scrollLeft;
            const page = Math.round(scrolled / containerWidth);
            if (page !== currentPage) {
                currentPage = Math.max(0, Math.min(page, pageCount - 1));
                updateDots();
            }
        }, 80);
    });

    // apply sizing after images load (images can alter heights/widths)
    function addImageListeners() {
        const imgs = Array.from(track.querySelectorAll('img'));
        let remaining = imgs.length;
        if (!remaining) {
            applyItemSizing();
            return;
        }
        imgs.forEach(img => {
            // if already complete, decrement without adding listener
            if (img.complete) {
                remaining--;
                if (remaining === 0) applyItemSizing();
                return;
            }
            img.addEventListener('load', () => {
                remaining--;
                if (remaining === 0) applyItemSizing();
            });
            img.addEventListener('error', () => {
                remaining--;
                if (remaining === 0) applyItemSizing();
            });
        });
        // fallback: ensure sizing after short delay even if some images never fire
        setTimeout(() => applyItemSizing(), 300);
    }

    // debounce resize
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            applyItemSizing();
        }, 120);
    });

    // initial init
    addImageListeners();

    // Expose a debugging method if you want to call from console
    window.__testimonialsDebug = {
        itemsCount: () => items.length,
        itemsPerView: () => itemsPerView,
        pageCount: () => pageCount,
        currentPage: () => currentPage,
        recompute: () => applyItemSizing()
    };
});
</script>

    <style>
        /* Horizontal scrolling track with native swipe and snap */
        #testimonials-slider {
            display: flex;
            gap: 1rem;
            /* horizontal gap between pages/children */
            overflow-x: auto;
             scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            /* Firefox */
            padding-bottom: 1px;
            /* prevent some browsers from showing small gap */
        }

        /* hide scrollbar for WebKit browsers */
        #testimonials-slider::-webkit-scrollbar {
            display: none;
        }

        /* Each wrapper must not shrink */
        .testimonial-item-wrapper,
        .testimonial-item-wrapper-clone {
            flex: 0 0 auto;
            scroll-snap-align: start;
        }

        /* The inner card will be sized by JS (flex-basis) but keep layout inside the card */
        .testimonial-item {
            display: flex;
            flex-direction: column;
            height: 100%;
            scroll-snap-align: start;
            /* fallback caps in case JS hasn't run yet */
            max-width: 100%;
            box-sizing: border-box;
            
        }

        /* Optional: center content vertically if you'd like same-height cards */
        .testimonial-item .p-6 {
            /* your card has p-6 area; adjust if different */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Dots container spacing */
        #testimonials-dots {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Ensure images behave */
        .testimonial-item img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Accessibility: show outline when navigating via keyboard */
        #testimonials-prev:focus,
        #testimonials-next:focus,
        #testimonials-dots button:focus {
            outline: 2px solid rgba(36, 121, 22, 0.25);
            outline-offset: 4px;
        }
    </style>

</section>
