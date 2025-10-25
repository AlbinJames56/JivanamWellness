@php
// Use clinics passed from controller, fallback to your sample if empty
$clinics = $clinics ?? collect();

if ($clinics instanceof \Illuminate\Support\Collection) {
    // map models to arrays for backward compatibility
    $clinics = $clinics->map(function ($c) {
        if (is_object($c)) {
            return [
                'name' => $c->name ?? 'Clinic',
                'address' => $c->address ?? '',
                'city' => $c->city ?? '',
                'hours' => $c->hours ?? '',
                'phone' => $c->phone ?? '',
                'image' => $c->image ? (Str::startsWith($c->image, ['http://', 'https://']) ? $c->image : asset('storage/' . ltrim($c->image, '/'))) : null,
                'isOpen' => (bool) ($c->is_open ?? $c->isOpen ?? false),
                'specialties' => $c->specialties ?? [],
            ];
        }
        return (array) $c;
    })->all();
} elseif (is_array($clinics)) {
    // keep as is
} else {
    $clinics = [];
}

$cities = array_unique(array_merge(['all'], array_map(fn($c) => $c['city'] ?? '', $clinics)));
$selectedCity = request()->get('city', 'all');
$showOpenOnly = request()->get('open', false);

$filteredClinics = array_filter($clinics, function ($clinic) use ($selectedCity, $showOpenOnly) {
    $cityMatch = $selectedCity === 'all' || ($clinic['city'] ?? '') === $selectedCity;
    $openMatch = !$showOpenOnly || ($clinic['isOpen'] ?? false);
    return $cityMatch && $openMatch;
});
@endphp


<section id="clinics" class="py-16 lg:py-24 bg-muted/20">
    <div class="max-w-[1100px] mx-auto px-5">
        <div class="text-center space-y-6 mb-12">
            <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Our Clinic Locations</h2>
            <p class="text-lg text-muted-foreground   mx-auto leading-relaxed">
                Find an Ayurvedic clinic near you. Each location offers the full range of traditional treatments with experienced practitioners.
            </p>
        </div>

        {{-- Filters --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <form method="GET" class="flex flex-wrap gap-4 items-center">
                <select name="city" class="border border-border rounded-lg px-3 py-2">
                    @foreach ($cities as $city)
                        <option value="{{ $city }}" @selected($selectedCity == $city)>
                            {{ $city === 'all' ? 'All Cities' : $city }}
                        </option>
                    @endforeach
                </select>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="open" value="1" @checked($showOpenOnly)>
                    Open Now
                </label>

                <button type="submit" class="btn-primary">Filter</button>
            </form>
        </div>

        {{-- Clinics Grid --}}
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($filteredClinics as $clinic)
                @include('components.home.clinic-card', [
        'name' => $clinic['name'],
        'address' => $clinic['address'],
        'city' => $clinic['city'],
        'hours' => $clinic['hours'],
        'phone' => $clinic['phone'],
        'image' => $clinic['image'],
        'isOpen' => $clinic['isOpen'],
        'specialties' => $clinic['specialties'],
    ])
            @empty
                <div class="text-center py-12 col-span-full">
                    <p class="text-muted-foreground">No clinics found matching your criteria.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
