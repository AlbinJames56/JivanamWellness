@props([
    'name' => 'Clinic',
    'address' => '',
    'city' => '',
    'hours' => '',
    'phone' => '',
    'image' => '',
    'isOpen' => false,
    'specialties' => [],
    'location_link' => '',
    'aos_delay' => 0,
])

@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Normalize specialties into a simple array of strings.
 * Accepts array, JSON string, objects, or nested arrays.
 */
$specialtiesRaw = $specialties ?? [];
if (is_string($specialtiesRaw) && @json_decode($specialtiesRaw, true) !== null) {
    $specialtiesRaw = json_decode($specialtiesRaw, true);
}
$specialties = collect($specialtiesRaw)->map(function ($item) {
    if (is_array($item)) {
        if (array_key_exists('value', $item))
            return (string) $item['value'];
        if (array_key_exists('specialty', $item))
            return (string) $item['specialty'];
        // pick first scalar value
        foreach ($item as $v)
            if (is_scalar($v))
                return (string) $v;
        return json_encode($item);
    }
    if (is_object($item)) {
        if (isset($item->value))
            return (string) $item->value;
        if (isset($item->name))
            return (string) $item->name;
        return json_encode($item);
    }
    return is_scalar($item) ? (string) $item : null;
})->filter()->values()->all();

/**
 * Resolve an image URL safely:
 * - If absolute URL -> use it
 * - If stored on public disk -> use Storage::disk('public')->url(...)
 * - If points to public path -> use asset(...)
 * - Fallback to asset('storage/...')
 */
$imgUrl = null;
if (!empty($image)) {
    // Already absolute?
    if (Str::startsWith($image, ['http://', 'https://'])) {
        $imgUrl = $image;
    } else {
        $trimmed = ltrim($image, '/');

        // 1) public disk (recommended when using disk 'public' for uploads)
        try {
            if (Storage::disk('public')->exists($trimmed)) {
                $imgUrl = Storage::disk('public')->url($trimmed); // e.g. /storage/clinics/xx.jpg
            } elseif (file_exists(public_path($trimmed))) {
                // 2) path already relative to public/
                $imgUrl = asset($trimmed);
            } elseif (file_exists(public_path('storage/' . $trimmed))) {
                // 3) stored under public/storage/...
                $imgUrl = asset('storage/' . $trimmed);
            } else {
                // 4) fallback to asset('storage/...')
                $imgUrl = asset('storage/' . $trimmed);
            }
        } catch (\Throwable $e) {
            // Defensive fallback when storage isn't available
            $imgUrl = asset('storage/' . $trimmed);
            \Log::debug("clinic-card: Storage check failed: " . $e->getMessage());
        }
    }
}
@endphp

<div class="group bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:scale-[1.02] flex flex-col h-full" data-aos="fade-up"
  data-aos-delay="{{ (int) $aos_delay }}">
    <div class="relative flex-shrink-0">
        @if($imgUrl)
            <img src="{{ $imgUrl }}" alt="{{ $name }} clinic"
                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" />
        @else
            <div class="h-48 w-full bg-gradient-to-br from-primary/8 to-muted/8 flex items-center justify-center">
                <div class="text-lg font-medium text-muted-foreground">No image</div>
            </div>
        @endif

        <!-- <div class="absolute top-3 left-3">
            <span class="badge rounded-3xl py-1 px-2 {{ $isOpen ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                {{ $isOpen ? 'Open Now' : 'Closed' }}
            </span>
        </div> -->
    </div>

    <div class="p-6 space-y-4 flex-1 flex flex-col">
        <div class="space-y-3">
            <h3 class="text-xl font-semibold text-foreground group-hover:text-primary transition-colors">{{ $name }}</h3>

            <div class="space-y-2 text-sm text-muted-foreground">
                <div class="flex items-start gap-2">
                    <div class="flex items-start gap-2">
    
    <div>
       @if(!empty($location_link))
        <a href="{{ $location_link }}" target="_blank" class="flex items-start gap-2 underline hover:text-primary">
            <i class="fa-solid fa-location-dot mt-1"></i>
            <div>
                <div>{{ $address }}</div>
                <div>{{ $city }}</div>
            </div>
        </a>
    @else
    <div class="flex items-start gap-2">
        <i class="fa-solid fa-location-dot mt-1"></i>
        <div>
            <div>{{ $address }}</div>
            <div>{{ $city }}</div>
        </div>
    </div>
@endif

    </div>
</div>

                </div>

                <div class="flex items-center gap-2">
                   <i class="fa-solid fa-clock"></i>
                    <span>{{ $hours }}</span>
                </div>

                <div class="flex items-center gap-2">
                   <i class="fa-solid fa-phone"></i>
                    <span>{{ $phone }}</span>
                </div>
            </div>

            @if(count($specialties) > 0)
                <div class="flex flex-wrap gap-2 pt-3">
                    @foreach($specialties as $s)
                        <span class="inline-block text-xs bg-muted/10 px-3 py-1 rounded-full text-muted-foreground">{{ $s }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Button pushed to bottom --}}
        <div class="mt-auto">
            <button class="w-full btn-primary"
                data-booking
                @if(isset($therapy)) data-treatment="{{ $therapy->slug }}"
                @elseif(isset($t)) data-treatment="{{ $t->slug }}"
                @elseif(isset($treatment)) data-treatment="{{ $treatment->slug }}"
                @endif>
                Book Appointment
            </button>
        </div>
    </div>
</div>
