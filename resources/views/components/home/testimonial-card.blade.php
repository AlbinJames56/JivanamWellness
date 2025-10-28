@php
  // Accept variables passed from the include (defensive defaults)
  $name = $name ?? '';
  $location = $location ?? '';
  $avatar = $avatar ?? '';
  $rating = (int) ($rating ?? 5);
  $text = $text ?? '';
  $treatment = $treatment ?? null;
  $isVideo = (bool) ($isVideo ?? false);
  $videoThumbnail = $videoThumbnail ?? null;
@endphp

<div
  class="bg-card rounded-2xl border border-border p-6 shadow-sm hover:shadow-lg transition-all duration-300 h-full flex flex-col testimonial-item testimonial-card">
  {{-- Video thumbnail (if any) --}}
  @if($isVideo && $videoThumbnail)
    <div class="relative mb-6 rounded-lg overflow-hidden">
      <img src="{{ $videoThumbnail }}" alt="Video testimonial thumbnail" class="w-full h-48 object-cover" />
      <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
        <button class="rounded-full bg-white/20 backdrop-blur-sm border border-white/30 hover:bg-white/30 p-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white ml-1" viewBox="0 0 24 24" fill="currentColor">
            <path d="M8 5v14l11-7z" />
          </svg>
        </button>
      </div>
    </div>
  @endif

  <div class="flex-1 space-y-4">
    {{-- Rating --}}
    <div class="flex items-center gap-1">
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

    {{-- Quote --}}
    <blockquote class="text-foreground leading-relaxed italic">
      "{{ $text }}"
    </blockquote>

    {{-- Treatment badge --}}
    @if($treatment)
      <div class="text-sm text-primary font-medium bg-primary/10 rounded-full px-3 py-1 w-fit">
        {{ $treatment }}
      </div>
    @endif
  </div>

  {{-- Footer: avatar + name --}}
  <div class="flex items-center gap-3 pt-6 border-t border-border mt-6">
    {{-- Avatar container: image (if available) else FontAwesome icon (with onerror fallback) --}}
    <div class="w-12 h-12 rounded-full overflow-hidden bg-muted/6 flex items-center justify-center flex-shrink-0"
      aria-hidden="true">
      {{-- If avatar provided, show image and have a JS onerror fallback to reveal the icon --}}
      @if(!empty($avatar))
        <img src="{{ $avatar }}" alt="{{ $name }}" class="w-full h-full object-cover" onerror="
              this.style.display = 'none';
              const fallback = this.parentNode.querySelector('.avatar-fallback');
              if (fallback) fallback.style.display = 'flex';
            " />
        {{-- hidden by default when avatar exists; visible if image fails --}}
        <div class="avatar-fallback w-full h-full flex items-center justify-center text-muted-foreground"
          style="display:none">
          <i class="fa-solid fa-user fa-lg" aria-hidden="true"></i>
        </div>
      @else
        {{-- No avatar set: show icon directly --}}
        <div class="w-full h-full flex items-center justify-center text-muted-foreground">
          <i class="fa-solid fa-user fa-lg" aria-hidden="true"></i>
        </div>
      @endif
    </div>

    <div>
      <div class="font-medium text-foreground">{{ $name }}</div>
      <div class="text-sm text-muted-foreground">{{ $location }}</div>
    </div>
  </div>
</div>