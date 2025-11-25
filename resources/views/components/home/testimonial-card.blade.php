@php
  // Accept variables passed from the include (defensive defaults)
  $name = $name ?? '';
  $location = $location ?? '';
  $avatar = $avatar ?? '';
  $rating = (int) ($rating ?? 5);
  // Removed $text usage per request
  $treatment = $treatment ?? null;
  $isVideo = (bool) ($isVideo ?? false);
  $videoThumbnail = $videoThumbnail ?? null;
  $video = $video ?? null;
@endphp

<div
  class="bg-card rounded-2xl border border-border p-6 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col h-80 md:h-96 testimonial-item testimonial-card"
  style="overflow: hidden; -webkit-overflow-scrolling: touch;">

  {{-- Header: rating on the top --}}
  <div class="flex-1 items-start justify-between gap-3 mb-3">
    <div class="flex items-center gap-2">
      {{-- Rating chips --}}
      <div class="flex items-center gap-1" aria-hidden="true">
        @for ($i = 0; $i < 5; $i++)
          @if($i < $rating)
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 .587l3.668 7.568L24 9.423l-6 5.854L19.335 24 12 19.771 4.665 24 6 15.277 0 9.423l8.332-1.268z" />
            </svg>
          @else
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 .587l3.668 7.568L24 9.423l-6 5.854L19.335 24 12 19.771 4.665 24 6 15.277 0 9.423l8.332-1.268z" />
            </svg>
          @endif
        @endfor
      </div>
    </div>

     
  </div>

  {{-- Media area (poster + inline video overlay). fixed height so text area visually matches --}}
  @if($isVideo && !empty($video))
    <div class="relative mb-4 rounded-lg overflow-hidden testimonial-video-wrapper h-48 md:h-52"
         data-video-src="{{ $video }}"
         data-video-thumb="{{ $videoThumbnail ?? '' }}">
      {{-- poster (fills the wrapper) --}}
      <img
        src="{{ $videoThumbnail ?? asset('images/default-video-thumb.jpg') }}"
        alt="Video thumbnail"
        class="w-full h-full object-cover testimonial-video-poster block" />

      {{-- play button overlay centered (covers the same area) --}}
      <button type="button"
              class="absolute inset-0 flex items-center justify-center group testimonial-video-play-btn"
              aria-label="Play testimonial video by {{ $name }}">
        <span class="rounded-full bg-white/90 p-3 shadow-md transform group-hover:scale-105 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="currentColor">
            <path d="M8 5v14l11-7z" />
          </svg>
        </span>
      </button>

      {{-- close button placeholder (will be injected by JS when video plays) --}}
    </div>
  @else
    {{-- Non-video placeholder visual: keep same height to keep cards consistent --}}
    <div class="mb-4 rounded-lg overflow-hidden h-48 md:h-52 bg-neutral-50 flex items-center justify-center text-muted-foreground">
      <blockquote class="text-foreground leading-relaxed italic  mb-4" tabindex="0"
      style="max-height:240px; overflow-y:auto; -webkit-overflow-scrolling:touch; white-space:pre-wrap; padding-right:6px;">
      "{{ $text }}"
    </blockquote>
    </div>
  @endif

  {{-- Content area: treatment badge and any other small meta; we removed quote text as requested --}}
  <div class="flex-1 flex flex-col justify-between">
    <div>
      @if($treatment)
        <div class="inline-block text-sm text-primary font-medium bg-primary/10 rounded-full px-3 py-[0.25rem] w-fit mb-2">
          {{ $treatment }}
        </div>
      @endif
    </div>

    {{-- Footer: avatar + small meta (kept at bottom) --}}
    <div class="flex items-center gap-3 pt-4 border-t border-border">
      @php
        $initialHexColors = [
          '#059669','#ef4444','#4f46e5','#ca8a04','#ec4899',
          '#0ea5e9','#84cc16','#7c3aed','#f97316','#c026d3',
        ];
        $trimmedName = trim((string) $name);
        $initial = $trimmedName !== '' ? mb_strtoupper(mb_substr($trimmedName, 0, 1)) : '?';
        $colorIndex = $trimmedName !== '' ? (int) (crc32($trimmedName) % count($initialHexColors)) : 0;
        $bgHex = $initialHexColors[$colorIndex];
      @endphp

      <div class="w-12 h-12 relative rounded-full overflow-hidden flex-shrink-0" aria-hidden="false" aria-label="{{ $name ?: 'User' }}">
        <div class="absolute inset-0 flex items-center justify-center text-white font-medium text-lg" style="background: {{ $bgHex }};">
          {{ $initial }}
        </div>

        @if(!empty($avatar))
          <img src="{{ $avatar }}" alt="{{ $name ?: 'User avatar' }}" class="absolute inset-0 w-full h-full object-cover"
               onerror="this.style.display='none';" onload="this.style.opacity=1;" style="opacity:0; transition:opacity .18s ease-in;" />
        @endif
      </div>

      <div>
        <div class="font-medium text-foreground">{{ $name }}</div>
        <div class="text-sm text-muted-foreground">{{ $location }}</div>
      </div>
    </div>
  </div>
</div>

{{-- Inline script: ensure this block only appears once per page. It is defensive. --}}
<script>
(function () {
  // Delegated click handler for play buttons
  document.addEventListener('click', async function (e) {
    const playBtn = e.target.closest('.testimonial-video-play-btn');
    if (!playBtn) return;

    const wrapper = playBtn.closest('.testimonial-video-wrapper');
    if (!wrapper) return;

    const src = (wrapper.dataset.videoSrc || '').trim();
    if (!src) return console.warn('testimonial video missing src');

    // check poster element and hide poster
    const poster = wrapper.querySelector('.testimonial-video-poster');
    if (poster) poster.classList.add('hidden');
    playBtn.classList.add('hidden');

    // pause any other inline videos
    document.querySelectorAll('.testimonial-inline-video').forEach(v => {
      if (!wrapper.contains(v)) try{ v.pause(); }catch(e){}
    });

    // create absolutely positioned video (fills wrapper)
    const video = document.createElement('video');
    video.className = 'testimonial-inline-video absolute inset-0 w-full h-full object-cover';
    video.controls = true;
    video.playsInline = true;
    video.preload = 'metadata';
    // set poster only if present
    const posterSrc = wrapper.dataset.videoThumb || '';
    if (posterSrc) video.setAttribute('poster', posterSrc);

    // set src
    // Setting video.src is fine; using <source> is also acceptable, but direct src simplifies.
    video.src = src;

    // close button
    const closeBtn = document.createElement('button');
    closeBtn.type = 'button';
    closeBtn.className = 'testimonial-video-close absolute top-2 right-2 z-40 rounded-full bg-white/90 p-1 shadow';
    closeBtn.setAttribute('aria-label', 'Close video');
    closeBtn.textContent = '✕';

    // append video and close button inside wrapper (positioned absolute)
    wrapper.appendChild(video);
    wrapper.appendChild(closeBtn);

    // try to play. If blocked, create a manual overlay
    try {
      await video.play();
    } catch (err) {
      // autoplay blocked — show a manual overlay play icon on top (simple)
      const manual = document.createElement('button');
      manual.type = 'button';
      manual.className = 'absolute inset-0 flex items-center justify-center z-50 testimonial-manual-play';
      manual.setAttribute('aria-label','Tap to play');
      manual.innerHTML = '<span class="rounded-full bg-white/90 p-3 shadow-md"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>';
      wrapper.appendChild(manual);

      manual.addEventListener('click', async () => {
        try {
          await video.play();
          manual.remove();
        } catch (e2) {
          console.warn('Playback failed:', e2);
        }
      }, { once: true });
    }

    const cleanup = () => {
      try { video.pause(); } catch(e) {}
      if (video.parentNode) video.parentNode.removeChild(video);
      if (closeBtn.parentNode) closeBtn.parentNode.removeChild(closeBtn);
      const manual = wrapper.querySelector('.testimonial-manual-play');
      if (manual && manual.parentNode) manual.parentNode.removeChild(manual);
      if (poster) poster.classList.remove('hidden');
      playBtn.classList.remove('hidden');
    };

    closeBtn.addEventListener('click', cleanup);
    video.addEventListener('ended', cleanup);
  });
})();
</script>

<style>
/* Ensure video inside wrapper overlays poster perfectly */
.testimonial-video-wrapper { position: relative; }
.testimonial-inline-video { object-fit: cover; }
/* small responsive tweak to keep consistent heights if needed */
@media (min-width: 768px) {
  .testimonial-video-wrapper { height: 13rem; } /* md:h-52 (approx) */
  .testimonial-item { min-height: 24rem; } /* md:h-96 equivalent */
}
</style>
