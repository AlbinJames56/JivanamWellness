{{-- resources/views/components/home/team-card-like.blade.php --}}
@php
    /** $m expected (TeamMember model or array-like) */
    $m = $m ?? ($member ?? null);

    // safe getters
    $name = $m->name ?? ($m['name'] ?? 'Team Member');
    $title = $m->title ?? ($m['title'] ?? '');
    $specialization = $m->specialization ?? ($m['specialization'] ?? '-');
    $experience = $m->experience ?? ($m['experience'] ?? '-');

    // image url (handles storage paths and absolute urls)
    $img = $m->image ?? ($m['image'] ?? null);
    if ($img) {
        $imgUrl = \Illuminate\Support\Str::startsWith($img, ['http://', 'https://']) ? $img : asset('storage/' . ltrim($img, '/'));
    } else {
        $imgUrl = null;
    }

    // initial + deterministic hex color palette (guaranteed to render)
    $initialHexColors = [
        '#059669',
        '#ef4444',
        '#4f46e5',
        '#ca8a04',
        '#ec4899',
        '#0ea5e9',
        '#84cc16',
        '#7c3aed',
        '#f97316',
        '#c026d3'
    ];
    $trimmed = trim((string) $name);
    $initial = $trimmed !== '' ? mb_strtoupper(mb_substr($trimmed, 0, 1)) : '?';
    $colorIndex = $trimmed !== '' ? (int) (crc32($trimmed) % count($initialHexColors)) : 0;
    $bgHex = $initialHexColors[$colorIndex];

    // booking anchor — you can replace with route('booking.create', ['doctor' => $m->id]) if you have a route
    $bookingHref = '#booking';
@endphp

<div class="card overflow-hidden hover:shadow-md transition-shadow rounded-2xl border border-border bg-card">
    <div class="relative">
        @if($imgUrl)
            <img src="{{ $imgUrl }}" alt="{{ $name }}" class="w-full h-64 object-cover">
        @else
            {{-- initial fallback displayed as background --}}
            <div class="w-full h-64 flex items-center justify-center"
                style="background: linear-gradient(135deg, rgba(0,0,0,0.03), rgba(0,0,0,0.06));">
                <div class="w-28 h-28 rounded-full flex items-center justify-center text-white font-semibold text-2xl"
                    style="background: {{ $bgHex }};">
                    {{ $initial }}
                </div>
            </div>
        @endif

        {{-- subtle top-to-transparent gradient for legibility --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent pointer-events-none"></div>
    </div>

    <div class="p-6 space-y-3">
        <div>
            <h3 class="font-semibold text-foreground text-lg">{{ $name }}</h3>
            @if($title)
                <p class="text-sm text-primary">{{ $title }}</p>
            @endif
        </div>

        <div class="space-y-2 text-sm text-muted-foreground">
            <div><strong>Specialization:</strong> {{ $specialization ?? '-' }}</div>
            <div><strong>Experience:</strong> {{ $experience ?? '-' }}</div>
        </div>

        {{-- booking button: replace href or add data attributes for JS handlers --}}
        <button type="button" class="btn-secondary inline-flex items-center justify-center w-full px-3 py-2 rounded-md"
            data-booking data-member-id="{{ $m->id ?? '' }}" data-member-name="{{ e($name) }}" data-source="team-card"
            aria-label="Book consultation with {{ e($name) }}">
            Book Consultation
        </button>

    </div>
</div>