{{-- resources/views/components/painManagement/technique-card.blade.php --}}
@props(['technique', 'variant' => 'more'])

@php
// Raw value (may be array, json-string, or null)
$benefitsArr = $technique->benefits ?? [];
// ensure it's an array of strings
if (is_string($benefitsArr)) {
    $decoded = json_decode($benefitsArr, true);
    $benefitsArr = $decoded === null ? [$benefitsArr] : $decoded;
}
$benefits = collect($benefitsArr)->map(function ($b) {
    if (is_array($b)) {
        return $b['value'] ?? $b['benefit'] ?? implode(' ', array_filter($b));
    }
    return (string) $b;
})->filter()->values()->all();

$n = count($benefits);
// clamp between 1 and 5
$cols = max(1, min(5, $n));
// responsive grid classes

$slug = $technique->slug ?? null;
$detailUrl = $slug ? route('treatments.show', $slug) : '#';
@endphp

<article x-data="{ open: false }"
    class="group bg-card border border-border rounded-xl p-6 shadow-sm hover:shadow-md transition flex flex-col h-full">
    {{-- Media: fixed height to keep cards equal --}}
    <div class="h-44 mb-4 overflow-hidden rounded-lg bg-muted/5 flex items-center justify-center">
        @if(!empty($technique->image))
            @php
    $img = $technique->image;
    $imgSrc = preg_match('/^(http(s)?:)?\\/\\//', trim($img)) ? trim($img) : asset('storage/' . ltrim($img, '/'));
            @endphp
            <img src="{{ $imgSrc }}" alt="{{ $technique->title ?? 'Technique image' }}"
                class="w-full h-full object-cover transition-transform group-hover:scale-105" />
        @else
            {{-- placeholder when no image --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-muted-foreground" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7M8 3h8l1 4H7l1-4z" />
            </svg>
        @endif
    </div>

    {{-- Header / meta --}}
    <h3 class="text-lg font-semibold">{{ $technique->title }}</h3>
    <div class="text-xs text-muted-foreground mb-2">
        {{ $technique->category ? ucfirst($technique->category) . ' · ' : '' }}{{ $technique->duration ?? '—' }}
    </div>

    {{-- Description + benefits (growable area) --}}
    <div class="text-sm text-muted-foreground leading-relaxed mb-4 flex-1 min-h-0">
        {{-- safe truncated description so card heights remain consistent --}}
        <p class="mb-3 text-sm text-muted-foreground">
            {{ $technique->description ? Str::limit(strip_tags($technique->description), 160) : '' }}
        </p>

        @if (count($benefits))
            <div class="mb-1">
            <div class="flex flex-wrap gap-2">
                @foreach ($benefits as $b)
                    <span class="p-1 px-2 rounded-lg border border-emerald-500 bg-muted/5 text-sm text-foreground whitespace-nowrap">
                        {{ $b }}
                    </span>
                @endforeach
            </div>

            </div>
        @endif
    </div>

    {{-- Actions (pushed to bottom) --}}
    <div class="mt-auto flex flex-col gap-2">
        <a href="{{ $detailUrl }}" class="btn-primary w-full text-center" @if($detailUrl === '#') aria-disabled="true"
        @endif>
            Learn More
        </a>

        <button class="btn-secondary w-full text-center" data-booking @if(isset($technique) && !empty($technique->slug))
        data-treatment="{{ $technique->slug }}" @elseif(isset($t)) data-treatment="{{ $t->slug }}" @endif>
            Book Consultation
        </button>
    </div>
</article>