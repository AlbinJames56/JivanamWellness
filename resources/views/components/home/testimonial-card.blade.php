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
  class="bg-card rounded-2xl border border-border p-6 shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col h-80 md:h-96 testimonial-item testimonial-card"
  style="overflow: hidden; -webkit-overflow-scrolling: touch;">
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

  <div class="flex-1 min-h-0  ">
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
    <blockquote class="text-foreground leading-relaxed italic  mb-4" tabindex="0"
      style="max-height:180px; overflow-y:auto; -webkit-overflow-scrolling:touch; white-space:pre-wrap; padding-right:6px;">
      "{{ $text }}"
    </blockquote>

    {{-- Treatment badge --}}
    @if($treatment)
      <div class="text-sm text-primary font-medium bg-primary/10 rounded-full px-3 pb-1 w-fit ">
        {{ $treatment }}
      </div>
    @endif
  </div>

  {{-- Footer: avatar + name --}}
  <div class="flex items-center gap-3 pt-6 border-t border-border ">
    @php
      // Inline hex palette (guaranteed to render). Adjust colors as you like.
      $initialHexColors = [
        '#059669', // emerald-600
        '#ef4444', // rose-500
        '#4f46e5', // indigo-600
        '#ca8a04', // yellow-600 (darker)
        '#ec4899', // pink-500
        '#0ea5e9', // sky-500
        '#84cc16', // lime-600
        '#7c3aed', // violet-600
        '#f97316', // orange-500
        '#c026d3', // fuchsia-600
      ];

      $trimmedName = trim((string) $name);
      $initial = $trimmedName !== '' ? mb_strtoupper(mb_substr($trimmedName, 0, 1)) : '?';
      $colorIndex = $trimmedName !== '' ? (int) (crc32($trimmedName) % count($initialHexColors)) : 0;
      $bgHex = $initialHexColors[$colorIndex];
    @endphp

    <div class="w-12 h-12 relative rounded-full overflow-hidden flex-shrink-0" aria-hidden="false"
      aria-label="{{ $name ?: 'User' }}">
      {{-- Initial layer: always present; inline background ensures color is visible --}}
      <div class="absolute inset-0 flex items-center justify-center text-white font-medium text-lg"
        style="background: {{ $bgHex }};">
        {{ $initial }}
      </div>

      {{-- Avatar image overlays the initial. If it fails to load, hide it to reveal the initial. --}}
      @if(!empty($avatar))
        <img src="{{ $avatar }}" alt="{{ $name ?: 'User avatar' }}" class="absolute inset-0 w-full h-full object-cover"
          onerror="this.style.display='none';" onload="this.style.opacity=1;"
          style="opacity:0; transition:opacity .18s ease-in;" />
      @endif
    </div>


    <div>
      <div class="font-medium text-foreground">{{ $name }}</div>
      <div class="text-sm text-muted-foreground">{{ $location }}</div>
    </div>
  </div>
</div>