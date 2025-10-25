@props([
    'title',
    'description' => null,
    'image' => null,
    'duration' => null,
    'featured' => false,
    // prefer passing the model (so we can use ->slug), otherwise pass 'slug' string in 'model'
    'model' => null,
])

@php
    // resolve link target: prefer route('therapies.show', $slug) if a slug is available
    $slug = null;
    if ($model instanceof \Illuminate\Database\Eloquent\Model) {
        $slug = $model->slug ?? null;
    } elseif (is_array($model) && isset($model['slug'])) {
        $slug = $model['slug'];
    } elseif (is_string($model)) {
        $slug = $model;
    }

    $detailUrl = $slug ? route('treatments.show', $slug) : '#';
@endphp

<div class="group bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300
    {{ $featured ? 'ring-2 ring-primary/20 scale-[1.02]' : 'hover:scale-[1.02]' }} flex flex-col h-full">

    {{-- Image --}}
    @if ($image)
        <div class="relative">
            <img src="{{ $image }}" alt="{{ $title }}"
                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" />

            @if ($featured)
                <span class="absolute top-3 left-3 bg-primary text-white text-xs font-medium px-2 py-1 rounded-md">
                    Most Popular
                </span>
            @endif

            @if ($duration)
                {{-- duration badge with FontAwesome clock (if loaded) else inline SVG fallback --}}
                <span class="absolute top-3 right-3 bg-white/90 text-foreground text-xs font-medium px-2 py-1 rounded-md flex items-center gap-1">
                    @if(config('app.env') && false)
                        {{-- developer-only placeholder to show how to detect FA (left intentionally false) --}}
                    @endif

                    {{-- Prefer FA icon if it's available on the page --}}
                    <i class="fa fa-clock-o" aria-hidden="true" style="font-size:0.8rem;"></i>

                    {{-- Inline tiny SVG fallback (will render in addition to FA if FA missing; harmless) --}}
                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M12 6v6l4 2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="12" cy="12" r="9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span class="ml-1">{{ $duration }}</span>
                </span>
            @endif
        </div>
    @endif

    {{-- Card Content --}}
    <div class="p-6 flex-1 flex flex-col">
        <div class="space-y-3">
            <h3 class="text-xl font-semibold text-foreground group-hover:text-primary transition-colors">
                {{ $title }}
            </h3>
            @if($description)
                <p class="text-muted-foreground leading-relaxed">
                    {{ \Illuminate\Support\Str::limit($description, 140) }}
                </p>
            @endif
        </div>

        {{-- Spacer so footer always sits at bottom --}}
        <div class="mt-4 flex-1"></div>

        {{-- Fixed footer area: fixed height, aligned bottom --}}
        <div class="pt-4 border-t border-border flex items-center justify-between" style="height:56px; min-height:56px;">
            <div class="text-sm text-muted-foreground">
                {{-- Optional small meta or tag spot; kept intentionally empty so price is not shown --}}
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ $detailUrl }}" class="inline-flex items-center text-primary hover:bg-primary/10 px-3 py-2 rounded-md transition">
    Read more
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <a href="#booking" class="btn-secondary px-3 py-2 rounded-md">Book</a>
            </div>
        </div>
    </div>
</div>
