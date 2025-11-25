{{-- resources/views/components/Therapy/therapy-card.blade.php --}}
@props(['therapy'])

@php
    // Normalize tags to a plain PHP array of strings
    $rawTags = $therapy->tags ?? [];
    if ($rawTags instanceof \Illuminate\Support\Collection) {
        $tags = $rawTags->all();
    } elseif (is_string($rawTags)) {
        // Split on commas/semicolons/pipes, trim, and drop empties
        $tags = array_values(array_filter(array_map(
            fn($t) => trim($t),
            preg_split('/[,;|]+/', $rawTags)
        )));
    } elseif (is_array($rawTags)) {
        $tags = array_values(array_filter(array_map('trim', $rawTags)));
    } else {
        $tags = [];
    }
    $shortDuration = $therapy->duration ?? '';
    if (Str::contains($shortDuration, '(')) {
        // Trim text before the first '(' to remove extra details
        $shortDuration = trim(Str::before($shortDuration, '('));
    }
@endphp

<article
    class="bg-card border border-border rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition group flex flex-col h-full">
    {{-- Media --}}
    <div class="relative h-44 sm:h-56 bg-muted/10 flex items-center justify-center overflow-hidden">
        @php
            $image = $therapy->image ?? null;
            $imageSrc = $image
                ? (preg_match('/^(http(s)?:)?\/\//', trim($image)) ? trim($image) : asset('storage/' . ltrim($image, '/')))
                : null;
        @endphp

        @if($imageSrc)
            <img src="{{ $imageSrc }}" alt="{{ $therapy->image_alt ?? $therapy->title ?? 'Therapy image' }}" loading="lazy"
                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300" />
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-primary/80" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2v20M4 8h16M4 16h16" />
                </svg>
            </div>
        @endif

        {{-- tags badges (overlay top-left) --}}
        @if (count($tags))
            <div class="absolute left-3 top-3 z-30 flex flex-wrap gap-2 max-w-[72%]">
                @foreach ($tags as $singleTag)
                    <span
                        class="text-xs leading-tight px-2 py-0.5 border rounded-full border-emerald-500 bg-white/90   text-foreground whitespace-nowrap   shadow-sm  ">
                        {{ $singleTag }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- duration badge (overlay bottom-right) --}}
        @if(!empty($shortDuration))
            <div
                class="absolute right-3 bottom-3 z-30 border rounded-full border-emerald-500 bg-white/90 text-xs px-2 py-1">
                {{ $shortDuration }}
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="p-5 space-y-3 flex-1 flex flex-col">
        <div class="flex items-center justify-between">
            <div class="text-xs text-muted-foreground">
                {{ optional($therapy->updated_at)->format('M d, Y') ?? '' }}
            </div>
        </div>

        <h3 class="text-lg font-semibold text-foreground leading-tight">{{ $therapy->title ?? 'Untitled' }}</h3>

        @if(!empty($therapy->excerpt))
            <p class="text-sm text-muted-foreground leading-relaxed">{{ $therapy->excerpt }}</p>
        @else
            <p class="text-sm text-muted-foreground leading-relaxed">
                {{ \Illuminate\Support\Str::limit(strip_tags($therapy->summary ?? $therapy->content ?? ''), 130) }}
            </p>
        @endif

        <div class="mt-auto flex justify-between gap-3 items-center w-full">
            @php
                $detailsUrl = (isset($therapy->slug) && !empty($therapy->slug)) ? route('therapies.show', $therapy->slug) : '#';
            @endphp
            <div>
                <a href="{{ $detailsUrl }}" class="inline-flex items-center gap-2 text-sm text-primary underline"
                    @if($detailsUrl === '#') aria-disabled="true" @endif>
                    View details
                </a>
            </div>
            <div>
                <button type="button"
                    class="btn-primary inline-flex items-center gap-2 text-sm flex-1 justify-center px-4" data-booking
                    data-therapy="{{ $therapy->slug ?? '' }}" data-source="therapy-card"
                    aria-label="Book {{ $therapy->title ?? 'therapy' }}">
                    Book
                </button>
            </div>
        </div>
    </div>
</article>