{{-- resources\views\components\Therapy\therapy-card.blade.php --}}
@props(['therapy'])

<article class="  rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition group">
    <div class="relative h-44 sm:h-56 overflow-hidden bg-gray-100">
        <img
            src="{{ $therapy->image ? asset('storage/' . $therapy->image) : asset('fallback.jpg') }}"
            alt="{{ $therapy->image_alt ?? $therapy->title }}"
            loading="lazy"
            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300"
        />

        {{-- small tag --}}
        @if($therapy->tag)
            <div class="absolute left-3 top-3 bg-white/90 px-2 py-1 rounded-full text-xs font-semibold">
                {{ $therapy->tag }}
            </div>
        @endif

        {{-- duration badge --}}
        @if($therapy->duration)
            <div class="absolute right-3 bottom-3 bg-black/60 text-white text-xs px-2 py-1 rounded-full">
                {{ $therapy->duration }}
            </div>
        @endif
    </div>

    <div class="p-5 space-y-3">
        <div class="flex items-center justify-between">
            <div class="text-sm text-muted-foreground">{{ $therapy->tag ?? '—' }}</div>
            <div class="text-xs text-muted-foreground">{{ $therapy->updated_at ? $therapy->updated_at->format('M d, Y') : '' }}</div>
        </div>

        <h3 class="text-lg font-semibold text-foreground">{{ $therapy->title }}</h3>

        @if($therapy->excerpt)
            <p class="text-sm text-muted-foreground leading-relaxed">{{ $therapy->excerpt }}</p>
        @else
            <p class="text-sm text-muted-foreground leading-relaxed">{{ Str::limit(strip_tags($therapy->summary ?? $therapy->content ?? ''), 130) }}</p>
        @endif

            <div>
                <span class="italic">Price:</span>
                <span>{{ $therapy->price ? ($therapy->price_currency ?? 'INR') . ' ' . number_format($therapy->price, 2) : '—' }}</span>
            </div>
        <div class="pt-3 flex gap-3 items-center w-full">
            <a href="#booking" class="btn-primary inline-flex items-center gap-2 text-sm">Book</a>

            {{-- view details button goes to show page --}}
           <a href="{{ route('therapies.show', $therapy->slug) }}" class="inline-flex items-center gap-2 text-sm text-primary underline">
    View details
</a>

        </div>


    </div>
</article>
