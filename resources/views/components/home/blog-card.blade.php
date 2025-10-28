@php
  // defensive defaults for props
  $title = $title ?? '';
  $excerpt = $excerpt ?? '';
  $image = $image ?? '';
  $category = $category ?? '';
  $date = $date ?? '';
  $readTime = $readTime ?? '';
  $author = $author ?? '';
  $authorAvatar = $authorAvatar ?? '';
  $postUrl = $postUrl ?? url('/blog');
@endphp

<article
  class="bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
  <a href="{{ $postUrl }}" class="block group" aria-label="Read article: {{ $title }}">
    <div class="relative">
      @if(!empty($image))
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-44 object-cover"
          onerror="this.style.display='none'; this.nextElementSibling && (this.nextElementSibling.style.display='flex')">
        {{-- fallback placeholder (hidden until image error) --}}
        <div
          class="w-full h-44 flex items-center justify-center bg-gradient-to-br from-primary/8 to-muted/8 text-muted-foreground"
          style="display:none">
          <i class="fa-solid fa-image fa-2x" aria-hidden="true"></i>
          <span class="sr-only">No image</span>
        </div>
      @else
        <div
          class="w-full h-44 flex items-center justify-center bg-gradient-to-br from-primary/8 to-muted/8 text-muted-foreground">
          <i class="fa-solid fa-image fa-2x" aria-hidden="true"></i>
          <span class="sr-only">No image</span>
        </div>
      @endif
    </div>

    <div class="p-6 space-y-4">
      <div class="flex items-center justify-between">
        <div class="text-sm text-muted-foreground">{{ $category }}</div>
        <div class="text-xs text-muted-foreground">{{ $date }} @if($readTime) · {{ $readTime }} @endif</div>
      </div>

      <h3 class="text-lg font-semibold text-foreground leading-snug group-hover:text-primary transition-colors">
        {{ $title }}
      </h3>

      <p class="text-sm text-muted-foreground leading-relaxed">
        {{ $excerpt }}
      </p>

      <div class="flex items-center justify-between pt-4 border-t border-border">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full overflow-hidden bg-muted/6 flex items-center justify-center flex-shrink-0">
            @if(!empty($authorAvatar))
              <img src="{{ $authorAvatar }}" alt="{{ $author }}" class="w-full h-full object-cover"
                onerror="this.style.display='none'; this.nextElementSibling && (this.nextElementSibling.style.display='flex')">
              <div class="author-fallback w-full h-full flex items-center justify-center text-muted-foreground"
                style="display:none">
                <i class="fa-solid fa-user fa-lg" aria-hidden="true"></i>
              </div>
            @else
              <div class="w-full h-full flex items-center justify-center text-muted-foreground">
                <i class="fa-solid fa-user fa-lg" aria-hidden="true"></i>
              </div>
            @endif
          </div>

          <div>
            <div class="text-sm font-medium text-foreground">{{ $author }}</div>
            @if($readTime)
              <div class="text-xs text-muted-foreground">{{ $readTime }} Min Read</div>
            @endif
          </div>
        </div>

        <a href="{{ $postUrl }}" class="btn-secondary inline-flex items-center gap-2">
          Read
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </a>
      </div>
    </div>
  </a>
</article>