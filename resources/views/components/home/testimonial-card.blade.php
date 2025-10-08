@php
// Accept variables passed from the include
$name      = $name ?? '';
$location  = $location ?? '';
$avatar    = $avatar ?? '';
$rating    = $rating ?? 5;
$text      = $text ?? '';
$treatment = $treatment ?? null;
$isVideo   = $isVideo ?? false;
$videoThumbnail = $videoThumbnail ?? null;
@endphp

<div class="bg-card rounded-2xl border border-border p-6 shadow-sm hover:shadow-lg transition-all duration-300 h-full flex flex-col testimonial-item testimonial-card">
  @if($isVideo && $videoThumbnail)
    <div class="relative mb-6 rounded-lg overflow-hidden">
      <img src="{{ $videoThumbnail }}" alt="Video testimonial thumbnail" class="w-full h-48 object-cover" />
      <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
        <button class="rounded-full bg-white/20 backdrop-blur-sm border border-white/30 hover:bg-white/30 p-3">
          <!-- Play icon (inline SVG) -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white ml-1" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
        </button>
      </div>
    </div>
  @endif

  <div class="flex-1 space-y-4">
    <div class="flex items-center gap-1">
      @for ($i = 0; $i < 5; $i++)
        @if($i < $rating)
          <!-- Filled star -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.568L24 9.423l-6 5.854L19.335 24 12 19.771 4.665 24 6 15.277 0 9.423l8.332-1.268z"/></svg>
        @else
          <!-- Empty star -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.568L24 9.423l-6 5.854L19.335 24 12 19.771 4.665 24 6 15.277 0 9.423l8.332-1.268z"/></svg>
        @endif
      @endfor
    </div>

    <blockquote class="text-foreground leading-relaxed italic">
      "{{ $text }}"
    </blockquote>

    @if($treatment)
      <div class="text-sm text-primary font-medium bg-primary/10 rounded-full px-3 py-1 w-fit">
        {{ $treatment }}
      </div>
    @endif
  </div>

  <div class="flex items-center gap-3 pt-6 border-t border-border mt-6">
    <img src="{{ $avatar }}" alt="{{ $name }}" class="w-12 h-12 rounded-full object-cover" />
    <div>
      <div class="font-medium text-foreground">{{ $name }}</div>
      <div class="text-sm text-muted-foreground">{{ $location }}</div>
    </div>
  </div>
</div>
