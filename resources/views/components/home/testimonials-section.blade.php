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
         
    ]);
} else {
   
}
@endphp

<section id="testimonials" class="py-16 lg:py-24 bg-background">
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
                            <div class="testimonial-item-wrapper p-0  h-50"  data-aos="fade-up"
                        data-aos-delay="{{ $loop->index * 80 }}"
                        data-aos-anchor-placement="top-bottom">
                       @include('components.home.testimonial-card', [
                            'name' => $testimonial['name'],
                            'location' => $testimonial['location'],
                            'avatar' => $testimonial['avatar'],
                            'rating' => $testimonial['rating'],
                            'text' => $testimonial['text'],
                            'treatment' => $testimonial['treatment'] ?? null,
                            'isVideo' => $testimonial['isVideo'] ?? false,
                            'video' => $testimonial['video'] ?? null,
                            'videoThumbnail' => $testimonial['videoThumbnail'] ?? null,
                        ])

                            </div>
                    @endforeach
                </div>
            </div>
 
            <!-- Navigation -->
            <div class="flex items-center justify-center gap-4 mt-8">
                <button id="testimonials-prev" class="rounded-full border border-border hover:bg-primary/10 p-2" data-aos="fade-up" data-aos-delay="120">
                    <!-- left chevron svg -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
             </button>

                <div id="testimonials-dots" class="flex gap-2"></div>

                <button id="testimonials-next" class="rounded-full border border-border hover:bg-primary/10 p-2" data-aos="fade-up" data-aos-delay="120">
                    <!-- right chevron svg -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                       </svg>
                </button>
            </div>
        </div> 
    </div> 



 <script>
 (function () {
  function pauseOtherInlineVideos(keepWrapper) {
    document.querySelectorAll('.testimonial-inline-video').forEach(v => {
      if (!keepWrapper || !keepWrapper.contains(v)) {
        try { v.pause(); } catch(e) {}
      }
    });
  }

  function createVideoElement(src, posterSrc) {
    const video = document.createElement('video');
    video.className = 'testimonial-inline-video absolute inset-0 w-full h-full object-cover';
    video.controls = true;
    video.playsInline = true;
    video.preload = 'none';
    video.setAttribute('playsinline', '');
    if (posterSrc) video.setAttribute('poster', posterSrc);
    // set src directly for reliability
    video.src = src;
    // ensure it visually overlays (absolute must be within relative wrapper)
    video.style.position = 'absolute';
    video.style.top = '0';
    video.style.left = '0';
    video.style.width = '100%';
    video.style.height = '100%';
    video.style.objectFit = 'cover';
    return video;
  }

  document.addEventListener('click', async function (e) {
    const playBtn = e.target.closest('.testimonial-video-play-btn');
    if (!playBtn) return;

    const wrapper = playBtn.closest('.testimonial-video-wrapper');
    if (!wrapper) return;

    const src = (wrapper.dataset.videoSrc || '').trim();
    if (!src) {
      console.warn('Missing data-video-src on testimonial wrapper', wrapper);
      return;
    }

    const posterEl = wrapper.querySelector('.testimonial-video-poster');
    const posterSrc = wrapper.dataset.videoThumb || (posterEl ? posterEl.src : '');

    // Pause other inline videos
    pauseOtherInlineVideos(wrapper);

    // hide play button (poster stays visible while attempting autoplay)
    playBtn.classList.add('hidden');

    // create absolute-position video element (so it overlays poster)
    const video = createVideoElement(src, posterSrc);

    // create a close button
    const closeBtn = document.createElement('button');
    closeBtn.type = 'button';
    closeBtn.className = 'testimonial-video-close absolute top-2 right-2 z-40 rounded-full bg-white/90 p-1 shadow';
    closeBtn.setAttribute('aria-label', 'Close video');
    closeBtn.textContent = '✕';

    // append video & close to wrapper (wrapper is positioned absolute/inset-0)
    wrapper.appendChild(video);
    wrapper.appendChild(closeBtn);

    // try to autoplay
    try {
      await video.play();
      // Autoplay started
    } catch (err) {
      // Autoplay blocked: show a manual overlay on top (tap to play)
      const manual = document.createElement('button');
      manual.type = 'button';
      manual.className = 'testimonial-manual-play absolute inset-0 flex items-center justify-center z-50';
      manual.setAttribute('aria-label', 'Tap to play video');
      manual.innerHTML = `<span class="rounded-full bg-white/90 p-3 shadow-md transform"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>`;
      wrapper.appendChild(manual);

      manual.addEventListener('click', async () => {
        try {
          await video.play();
          manual.remove();
        } catch (e) {
          console.warn('Playback failed after manual click', e);
        }
      }, { once: true });
    }

    const cleanup = () => {
      try { video.pause(); } catch (e) {}
      if (video.parentNode) video.parentNode.removeChild(video);
      if (closeBtn.parentNode) closeBtn.parentNode.removeChild(closeBtn);
      const manual = wrapper.querySelector('.testimonial-manual-play');
      if (manual && manual.parentNode) manual.parentNode.removeChild(manual);
      // restore play button
      playBtn.classList.remove('hidden');
    };

    closeBtn.addEventListener('click', cleanup);
    video.addEventListener('ended', cleanup);
  });

  // pause inline videos on pagehide
  window.addEventListener('pagehide', function () {
    document.querySelectorAll('.testimonial-inline-video').forEach(v => { try { v.pause(); } catch(e) {} });
  });
})();
        (function() {
            const track = document.getElementById('testimonials-slider');
            if (!track) return;

            const items = Array.from(track.querySelectorAll('.testimonial-item-wrapper'));
            const prevBtn = document.getElementById('testimonials-prev');
            const nextBtn = document.getElementById('testimonials-next');
            const dotsContainer = document.getElementById('testimonials-dots');

            let itemsPerView = 3;
            let pageCount = 1;
            let currentPage = 0;

            // Compute itemsPerView based on breakpoints
            function computeItemsPerView() {
                const w = window.innerWidth;
                if (w < 768) return 1;
                if (w < 1024) return 2;
                return 3;
            }

            // Apply widths to each testimonial item so exactly itemsPerView fit the container
            function applyItemSizing() {
                const containerWidth = track.parentElement.clientWidth || window.innerWidth;
                itemsPerView = computeItemsPerView();
                const itemWidth = Math.floor(containerWidth / itemsPerView) - ((itemsPerView - 1) * 16 / itemsPerView);
                // above subtracts some gap distribution; we'll also set min and max below
                items.forEach(itemWrapper => {
                    const card = itemWrapper.querySelector('.testimonial-item');
                    if (!card) return;
                    card.style.flex = `0 0 ${itemWidth}px`;
                    card.style.maxWidth = `${itemWidth}px`;
                    card.style.boxSizing = 'border-box';
                });

                pageCount = Math.max(1, Math.ceil(items.length / itemsPerView));
                buildDots();
                // ensure currentPage in range
                if (currentPage >= pageCount) currentPage = pageCount - 1;
                scrollToPage(currentPage, true);
            }

            // Build dots based on pageCount
            function buildDots() {
                if (!dotsContainer) return;
                dotsContainer.innerHTML = '';
                for (let i = 0; i < pageCount; i++) {
                    const btn = document.createElement('button');
                    btn.className = 'w-2 h-2 rounded-full transition-colors bg-border';
                    btn.dataset.index = i;
                    btn.addEventListener('click', () => scrollToPage(i));
                    dotsContainer.appendChild(btn);
                }
                updateDots();
            }

            function updateDots() {
                if (!dotsContainer) return;
                Array.from(dotsContainer.children).forEach((dot, i) => {
                    if (i === currentPage) {
                        dot.classList.remove('bg-border');
                        dot.classList.add('bg-primary');
                    } else {
                        dot.classList.remove('bg-primary');
                        dot.classList.add('bg-border');
                    }
                });
            }

            // Scroll to a page (0-based). instant = true uses immediate jump (no smooth)
            function scrollToPage(pageIndex, instant = false) {
                currentPage = Math.max(0, Math.min(pageIndex, pageCount - 1));
                const containerWidth = track.parentElement.clientWidth || window.innerWidth;
                const left = currentPage * containerWidth;
                track.scrollTo({
                    left,
                    behavior: instant ? 'auto' : 'smooth'
                });
                updateDots();
            }

            // Prev / Next handlers
            function nextPage() {
                scrollToPage((currentPage + 1) % pageCount);
            }

            function prevPage() {
                scrollToPage((currentPage - 1 + pageCount) % pageCount);
            }

            if (nextBtn) nextBtn.addEventListener('click', nextPage);
            if (prevBtn) prevBtn.addEventListener('click', prevPage);

            // Keep currentPage in sync while user scrolls (update on scroll)
            let scrollDebounce = null;
            track.addEventListener('scroll', () => {
             clearTimeout(scrollDebounce);
                scrollDebounce = setTimeout(() => {
                    const containerWidth = track.parentElement.clientWidth || window.innerWidth;
                    const scrolled = track.scrollLeft;
                    const page = Math.round(scrolled / containerWidth);
                    if (page !== currentPage) {
                        currentPage = page;
                        updateDots();
                    }
                         }, 80);
            });

            // Recalculate sizes on resize (debounced)
            let resizeTimer = null;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    applyItemSizing();
       }, 120);
            });

            // Initialize
            applyItemSizing();

        })();
    </script>

    <style>
    
        /* Horizontal scrolling track with native swipe and snap */
        #testimonials-slider {
            display: flex;
            gap: 1rem;
            /* horizontal gap between pages/children */
            overflow-x: auto;
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
