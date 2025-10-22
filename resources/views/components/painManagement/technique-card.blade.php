{{-- resources\views\components\painManagement\technique-card.blade.php --}}
@props(['technique', 'variant' => 'more'])

@php
    // Raw value (may be array, json-string, or null)
    $raw = $technique->benefits ?? [];

    // if string, try to decode JSON; else treat as single string
    if (is_string($raw)) {
        $decoded = json_decode($raw, true);
        $raw = $decoded === null ? [$raw] : $decoded;
    }

    // Now $raw should be array-ish. Normalize into an array of strings.
    $benefits = [];
    if (is_array($raw)) {
        foreach ($raw as $item) {
            if (is_string($item)) {
                $benefits[] = $item;
                continue;
            }

            if (is_array($item)) {
                // common repeater shapes:
                // ['value' => '...'] or ['benefit' => '...'] or nested items
                if (isset($item['value'])) {
                    $benefits[] = (string) $item['value'];
                } elseif (isset($item['benefit'])) {
                    $benefits[] = (string) $item['benefit'];
                } else {
                    // fallback: join scalar values in the array
                    $flat = array_filter(array_map(function ($v) {
                        return is_scalar($v) ? (string) $v : '';
                    }, $item));
                    if ($flat) {
                        $benefits[] = implode(' ', $flat);
                    }
                }
            }
        }
    }
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
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach ($benefits as $b)
                <span class="inline-block text-xs bg-muted/10 px-3 py-1 rounded-full text-muted-foreground">
                    {{ $b }} {{-- Escaped safely --}}
                </span>
            @endforeach
        </div>
    @endif


    @if($variant === 'more')
        <div>
            <button @click="open = !open"
                class="w-full text-left flex items-center justify-between text-sm font-medium text-primary">
                <span>Learn more</span>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transform transition-transform" viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>

            <div x-show="open" x-cloak
                class="mt-3 text-sm text-muted-foreground p-3 bg-muted/10 rounded-lg prose max-w-none">
                {!! $technique->more_info ?? nl2br(e($technique->description)) !!}
            </div>

            <button onclick="location.hash='booking'" class="btn-primary mt-3 w-full">Book Consultation</button>
        </div>
    @else
        <button onclick="location.hash='booking'" class="btn-primary w-full">Book Consultation</button>
    @endif
</article>
