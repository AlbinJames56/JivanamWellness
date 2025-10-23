@props([
    'name' => 'Clinic',
    'address' => '',
    'city' => '',
    'hours' => '',
    'phone' => '',
    'image' => '',
    'isOpen' => false,
    'specialties' => [],
])

@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// normalize specialties (same as before)
$specialtiesRaw = $specialties ?? [];
if (is_string($specialtiesRaw) && json_decode($specialtiesRaw, true) !== null) {
    $specialtiesRaw = json_decode($specialtiesRaw, true);
}
$specialties = collect($specialtiesRaw)->map(function ($item) {
    if (is_array($item)) {
        if (array_key_exists('value', $item))
            return (string) $item['value'];
        if (array_key_exists('specialty', $item))
            return (string) $item['specialty'];
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

// Resolve the image URL safely:
$imgUrl = null;
if (!empty($image)) {
    // 1) already absolute URL?
    if (Str::startsWith($image, ['http://', 'https://'])) {
        $imgUrl = $image;
    } else {
        // normalize path
        $trimmed = ltrim($image, '/');

        // 2) file exists on public disk (recommended when using Filament FileUpload -> disk('public'))
        if (Storage::disk('public')->exists($trimmed)) {
            $imgUrl = Storage::disk('public')->url($trimmed); // -> /storage/clinics/xxx.webp
        } elseif (file_exists(public_path($trimmed))) {
            // 3) maybe the saved value already points under public/ (rare)
            $imgUrl = asset($trimmed);
        } elseif (file_exists(public_path('storage/' . $trimmed))) {
            // 4) sometimes files are in public/storage/clinics/...
            $imgUrl = asset('storage/' . $trimmed);
        } else {
            // fallback: try asset('storage/...')
            $imgUrl = asset('storage/' . $trimmed);
        }
    }
}
@endphp


<div class="group bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">
    <div class="relative">
        @if($imgUrl)
            <img src="{{ $imgUrl }}" alt="{{ $name }} clinic"
                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" />
        @else
            <div class="h-48 w-full bg-gradient-to-br from-primary/8 to-muted/8 flex items-center justify-center">
                <div class="text-lg font-medium text-muted-foreground">No image</div>
            </div>
        @endif

        <div class="absolute top-3 left-3">
            <span class="badge {{ $isOpen ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                {{ $isOpen ? 'Open Now' : 'Closed' }}
            </span>
        </div>
    </div>

    <div class="p-6 space-y-4">
        <div class="space-y-3">
            <h3 class="text-xl font-semibold text-foreground group-hover:text-primary transition-colors">{{ $name }}</h3>

            <div class="space-y-2 text-sm text-muted-foreground">
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 mt-0.5 text-primary flex-shrink-0">...</svg> {{-- MapPin icon --}}
                    <div>
                        <div>{{ $address }}</div>
                        <div>{{ $city }}</div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary">...</svg> {{-- Clock icon --}}
                    <span>{{ $hours }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary">...</svg> {{-- Phone icon --}}
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

        <div class="flex gap-3 pt-4 border-t border-border">
            <button class="flex-1 btn-primary">Book Appointment</button>
            <button class="btn-secondary flex items-center justify-center">
                <svg class="w-4 h-4">...</svg> {{-- ArrowRight icon --}}
            </button>
        </div>
    </div>
</div>
