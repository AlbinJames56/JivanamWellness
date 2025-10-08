@php
// Props with defaults
$title = $title ?? '';
$excerpt = $excerpt ?? '';
$image = $image ?? '';
$category = $category ?? '';
$date = $date ?? '';
$readTime = $readTime ?? '';
$author = $author ?? '';
$authorAvatar = $authorAvatar ?? '';
@endphp

<article class="bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
  <div class="relative">
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-44 object-cover" />
  </div>

  <div class="p-6 space-y-4">
    <div class="flex items-center justify-between">
      <div class="text-sm text-muted-foreground">{{ $category }}</div>
      <div class="text-xs text-muted-foreground">{{ $date }} · {{ $readTime }}</div>
    </div>

    <h3 class="text-lg font-semibold text-foreground leading-snug">
      {{ $title }}
    </h3>

    <p class="text-sm text-muted-foreground leading-relaxed">
      {{ $excerpt }}
    </p>

    <div class="flex items-center justify-between pt-4 border-t border-border">
      <div class="flex items-center gap-3">
        <img src="{{ $authorAvatar }}" alt="{{ $author }}" class="w-10 h-10 rounded-full object-cover" />
        <div>
          <div class="text-sm font-medium text-foreground">{{ $author }}</div>
          <div class="text-xs text-muted-foreground">{{ $readTime }}</div>
        </div>
      </div>

      <a href="{{ url('/blog') }}" class="btn-secondary inline-flex items-center gap-2">
        Read
        <!-- ArrowRight SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
      </a>
    </div>
  </div>
</article>
