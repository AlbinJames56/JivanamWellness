{{-- resources/views/components/Therapy/therapy-card.blade.php --}}
@props(['therapy'])

<article
    class="bg-card border border-border rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition group flex flex-col h-full">
    {{-- Media --}}
    <div class="relative h-44 sm:h-56 bg-muted/10 flex items-center justify-center overflow-hidden">
        @php
            $image = $therapy->image ?? null;
            // allow either absolute urls or storage paths
            if ($image) {
                $imageSrc = preg_match('/^(http(s)?:)?\\/\\//', trim($image))
                    ? trim($image)
                    : asset('storage/' . ltrim($image, '/'));
            } else {
                $imageSrc = null;
            }
        @endphp

        @if($imageSrc)
            <img src="{{ $imageSrc }}" alt="{{ $therapy->image_alt ?? $therapy->title ?? 'Therapy image' }}" loading="lazy"
                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300" />
        @else
            {{-- Inline placeholder so you don't rely on an external fallback file --}}
            <div class="w-full h-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-primary/80" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2v20M4 8h16M4 16h16" />
                </svg>
            </div>
        @endif

        {{-- small tag --}}
        @if(!empty($therapy->tag))
            <div class="absolute left-3 top-3 bg-white/90 px-2 py-1 rounded-full text-xs font-semibold">
                {{ $therapy->tag }}
            </div>
        @endif

        {{-- duration badge --}}
        @if(!empty($therapy->duration))
            <div class="absolute right-3 bottom-3 bg-black/60 text-white text-xs px-2 py-1 rounded-full">
                {{ $therapy->duration }}
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="p-5 space-y-3 flex-1 flex flex-col">
        <div class="flex items-center justify-between">
            <div class="text-sm text-muted-foreground">{{ $therapy->tag ?? '—' }}</div>
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

        <!-- <div class="text-sm text-muted-foreground">
            <span class="italic">Price:</span>
            <span>
                @if(isset($therapy->price) && is_numeric($therapy->price))
                    {{ ($therapy->price_currency ?? 'INR') . ' ' . number_format((float) $therapy->price, 2) }}
                @else
                    —
                @endif
            </span>
        </div> -->

        {{-- Actions (pushed to bottom) --}}
        <div class="mt-auto flex justify-between gap-3 items-center w-full">

            <div>
                @php
                    $detailsUrl = (isset($therapy->slug) && !empty($therapy->slug)) ? route('therapies.show', $therapy->slug) : '#';
                @endphp

                <a href="{{ $detailsUrl }}" class="inline-flex items-center gap-2 text-sm text-primary underline"
                    @if($detailsUrl === '#') aria-disabled="true" @endif>
                    View details
                </a>
            </div>
            <div>
                <a href="#booking" role="button"
                    class="btn-primary inline-flex items-center gap-2 text-sm flex-1 justify-center px-4"
                    aria-label="Book {{ $therapy->title ?? 'therapy' }}">
                    Book
                </a>
            </div>
        </div>
    </div>
</article>