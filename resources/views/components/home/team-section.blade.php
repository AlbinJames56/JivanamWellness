<section id="team" class="py-16   bg-background">
    <div class="max-w-[1100px] mx-auto px-5">
        <div class="text-center space-y-6 mb-12">
            <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Our Expert Therapists</h2>
            <p class="text-lg text-muted-foreground mx-auto leading-relaxed  ">
                Meet the experienced practitioners who guide our therapies and personalised care plans.
            </p>
        </div>

        <div class="relative">
            <div class="overflow-hidden">
                <!-- Horizontal track -->
                <div id="team-slider" class="team-slider flex gap-6 overflow-x-auto scroll-snap-x">
                    @forelse($teamMembers as $member)
                        <div class="team-item-wrapper p-0">
                            @include('components.home.team-card', ['m' => $member])
                        </div>
                    @empty
                        <div class="col-span-full text-center text-muted-foreground">
                            Team information will be available soon.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Nav -->
            <div class="flex items-center justify-center gap-4 mt-8">
                <button id="team-prev" type="button" class="rounded-full border border-border hover:bg-primary/10 p-2"
                    aria-label="Previous team">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div id="team-dots" class="flex gap-2"></div>

                <button id="team-next" type="button" class="rounded-full border border-border hover:bg-primary/10 p-2"
                    aria-label="Next team">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</section>
<style>
    /* track */
    #team-slider {
        display: flex;
        gap: 1.5rem;
        /* same as gap-6 (24px) in Tailwind; adjust if you want different spacing */
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        /* firefox */
        padding-bottom: 1px;
    }

    #team-slider::-webkit-scrollbar {
        display: none;
    }

    .team-item-wrapper {
        flex: 0 0 auto;
        scroll-snap-align: start;
        box-sizing: border-box;
    }

    /* smooth programmatic scroll */
    #team-slider {
        scroll-behavior: smooth;
    }

    /* focus outlines for accessibility */
    #team-prev:focus,
    #team-next:focus,
    #team-dots button:focus {
        outline: 2px solid rgba(36, 121, 22, 0.25);
        outline-offset: 4px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const track = document.getElementById('team-slider');
        if (!track) return;

        const prevBtn = document.getElementById('team-prev');
        const nextBtn = document.getElementById('team-next');
        const dotsContainer = document.getElementById('team-dots');
        let items = Array.from(track.querySelectorAll('.team-item-wrapper'));
        let itemsPerView = 3;
        let pageCount = 1;
        let currentPage = 0;
        let resizeTimer = null;

        function getGapPx() {
            const gapValue = getComputedStyle(track).gap || getComputedStyle(track).columnGap || '24px';
            if (gapValue.endsWith('px')) return parseFloat(gapValue);
            // compute with temporary element for other units
            const el = document.createElement('div');
            el.style.width = gapValue;
            el.style.position = 'absolute';
            document.body.appendChild(el);
            const px = el.getBoundingClientRect().width || 24;
            document.body.removeChild(el);
            return px;
        }

        function computeItemsPerView() {
            const w = window.innerWidth;
            if (w < 768) return 1;
            if (w < 1024) return 2;
            return 3;
        }

        function applyItemSizing() {
            items = Array.from(track.querySelectorAll('.team-item-wrapper'));
            itemsPerView = computeItemsPerView();
            const containerWidth = track.parentElement.clientWidth || window.innerWidth;
            const gap = getGapPx();
            const totalGapsWidth = (itemsPerView - 1) * gap;
            const itemWidth = Math.floor((containerWidth - totalGapsWidth) / itemsPerView);

            items.forEach(wrapper => {
                wrapper.style.flex = `0 0 ${itemWidth}px`;
                wrapper.style.maxWidth = `${itemWidth}px`;
                wrapper.style.boxSizing = 'border-box';
            });

            pageCount = Math.max(1, Math.ceil(items.length / itemsPerView));
            if (currentPage >= pageCount) currentPage = pageCount - 1;
            buildDots();
            scrollToPage(currentPage, true);
        }

        function buildDots() {
            if (!dotsContainer) return;
            dotsContainer.innerHTML = '';
            for (let i = 0; i < pageCount; i++) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'w-2 h-2 rounded-full transition-colors';
                btn.dataset.index = i;
                btn.addEventListener('click', () => scrollToPage(i));
                btn.setAttribute('aria-label', 'Go to page ' + (i + 1));
                dotsContainer.appendChild(btn);
            }
            updateDots();
        }

        function updateDots() {
            if (!dotsContainer) return;
            Array.from(dotsContainer.children).forEach((dot, i) => {
                if (i === currentPage) {
                    dot.classList.add('bg-primary');
                    dot.classList.remove('bg-border');
                } else {
                    dot.classList.remove('bg-primary');
                    dot.classList.add('bg-border');
                }
            });
        }

        function computeLeftForPage(pageIndex) {
            const gap = getGapPx();
            const startItem = pageIndex * itemsPerView;
            let left = 0;
            for (let i = 0; i < startItem && i < items.length; i++) {
                const w = items[i].getBoundingClientRect().width || items[i].offsetWidth;
                left += w + gap;
            }
            const maxLeft = track.scrollWidth - (track.parentElement.clientWidth || window.innerWidth);
            return Math.max(0, Math.min(left, maxLeft));
        }

        function scrollToPage(pageIndex, instant = false) {
            currentPage = Math.max(0, Math.min(pageIndex, pageCount - 1));
            const left = computeLeftForPage(currentPage);
            track.scrollTo({ left, behavior: instant ? 'auto' : 'smooth' });
            updateDots();
        }

        function nextPage() { scrollToPage((currentPage + 1) % pageCount); }
        function prevPage() { scrollToPage((currentPage - 1 + pageCount) % pageCount); }

        if (nextBtn) nextBtn.addEventListener('click', nextPage);
        if (prevBtn) prevBtn.addEventListener('click', prevPage);

        // sync currentPage while user scrolls
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

        // images: wait for them to load, then size
        function addImageListeners() {
            const imgs = Array.from(track.querySelectorAll('img'));
            let remaining = imgs.length;
            if (!remaining) {
                applyItemSizing();
                return;
            }
            imgs.forEach(img => {
                if (img.complete) { remaining--; if (remaining === 0) applyItemSizing(); return; }
                img.addEventListener('load', () => { remaining--; if (remaining === 0) applyItemSizing(); });
                img.addEventListener('error', () => { remaining--; if (remaining === 0) applyItemSizing(); });
            });
            setTimeout(() => applyItemSizing(), 300); // fallback
        }

        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => applyItemSizing(), 120);
        });

        // init
        addImageListeners();

        // debugging helper
        window.__teamCarousel = { itemsCount: () => items.length, itemsPerView: () => itemsPerView, pageCount: () => pageCount, currentPage: () => currentPage, recompute: () => applyItemSizing() };
    });
</script>