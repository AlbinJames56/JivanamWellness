{{-- resources\views\components\painManagement\technique-card.blade.php --}}
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
    // choose classes for small / md breakpoints if you want better responsiveness
    $gridClass = match ($cols) {
        1 => 'grid-cols-1',
        2 => 'grid-cols-1 sm:grid-cols-2',
        3 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3',
        4 => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-4',
        default => 'grid-cols-1 sm:grid-cols-2 md:grid-cols-5',
    };
    $slug = $technique->slug ?? null;
    $detailUrl = $slug ? route('treatments.show', $slug) : '#';

@endphp

<article x-data="{ open: false }"
    class="group bg-card border border-border rounded-xl p-6 shadow-sm hover:shadow-md transition">
    @if($technique->image)
        <div class="h-44 mb-4 overflow-hidden rounded-lg">
            <img src="{{ asset('storage/' . ltrim($technique->image, '/')) }}" alt="{{ $technique->title }}"
                class="w-full h-full object-cover transition-transform group-hover:scale-105">
        </div>
    @endif

    <h3 class="text-lg font-semibold">{{ $technique->title }}</h3>
    <div class="text-xs text-muted-foreground mb-2">
        {{ $technique->category ? ucfirst($technique->category) . ' · ' : '' }}{{ $technique->duration ?? '—' }}
    </div>

    <p class="text-sm text-muted-foreground leading-relaxed mb-3">{{ $technique->description }}</p>
    @if (count($benefits))
        <div class="mb-4">
            <div class="grid gap-3 {{ $gridClass }}">
                @foreach ($benefits as $b)
                    <div class="p-3 rounded-lg bg-muted/5 text-sm text-foreground">
                        {{ $b }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    {{-- Link to show page instead of inline "Learn more" --}}
    <div class="mt-3 flex flex-col gap-2">
        <a href="{{ $detailUrl }}" class="btn-primary w-full text-center">
            Learn More
        </a>
        <a href="#booking" class="btn-secondary w-full text-center">
            Book Consultation
        </a>
    </div>
</article>
