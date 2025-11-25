@php
    // Use clinics passed from controller, fallback to your sample if empty
    $clinics = $clinics ?? collect();
    $preserve = request()->except(['city', 'open']);
    $clearUrl = url()->current() . (count($preserve) ? ('?' . http_build_query($preserve)) : '');
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
                    'location_link' => $c->location_link ?? '',
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
            <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Your Healing Journey Begins Here - Choose
                Your Nearest Branch</h2>
            <p class="text-lg text-muted-foreground   mx-auto leading-relaxed">
                Find a Jivanam Wellness clinic near you and experience authentic Ayurvedic care close to home. Each
                center offers the complete range of traditional treatments, guided by our expert practitioners.
            </p>
        </div>

        {{-- Filters --}}
        <!-- <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                <form id="clinicFilterForm" method="GET" class="flex flex-wrap gap-4 items-center"
                    onsubmit="submitWithAnchor(event, this)">
                    <select name="city" class="border border-border rounded-lg px-3 py-2"
                        onchange="submitWithAnchor(event, this.form)">
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" @selected($selectedCity == $city)>
                                {{ $city === 'all' ? 'All Cities' : $city }}
                            </option>
                        @endforeach
                    </select>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="open" value="1" @checked($showOpenOnly)
                            onchange="submitWithAnchor(event, this.form)">
                        Open Now
                    </label>

                    {{-- Clear Filters (shows only when a filter is active) --}}
                    @if($selectedCity !== 'all' || $showOpenOnly)
                        <a href="{{ url()->current() }}#clinics" class="btn-secondary inline-flex items-center gap-2">
                            Clear Filters
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 6l12 12M6 18L18 6" />
                            </svg>
                        </a>
                    @endif
                </form>

                <script>
                    /**
                     * Serialize the form and navigate to pathname + ?query + #clinics
                     * Uses URLSearchParams + FormData to reliably include selected inputs.
                     */
                    function submitWithAnchor(ev, form) {
                        if (ev && ev.preventDefault) ev.preventDefault();

                        try {
                            const fd = new FormData(form);
                            const params = new URLSearchParams();

                            // Append FormData values; this automatically ignores unchecked checkboxes
                            for (const [k, v] of fd.entries()) {
                                params.append(k, v);
                            }

                            // If no params, navigate to current path + #clinics (clears filters)
                            const qs = params.toString();
                            const target = window.location.pathname + (qs ? ('?' + qs) : '') + '#clinics';

                            // Use location.assign so Back button works normally
                            window.location.assign(target);
                        } catch (err) {
                            // fallback: submit the form normally and hope for the best
                            form.action = (form.action || window.location.href).split('#')[0] + '#clinics';
                            form.submit();
                        }
                    }

                    // Optional: if user presses an explicit submit button (Enter), ensure anchor is attached
                    document.addEventListener('submit', function (ev) {
                        const f = ev.target;
                        if (f && f.id === 'clinicFilterForm') {
                            ev.preventDefault();
                            submitWithAnchor(ev, f);
                        }
                    });
                </script>


            </div>

        </div> -->

        {{-- Clinics Grid --}}
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($filteredClinics as $clinic)

                @php
                    // small stagger per card
                    $aosDelay = ($loop->index ?? 0) * 80;
                @endphp
                @include('components.home.clinic-card', [
                    'name' => $clinic['name'],
                    'address' => $clinic['address'],
                    'city' => $clinic['city'],
                    'hours' => $clinic['hours'],
                    'phone' => $clinic['phone'],
                    'image' => $clinic['image'],
                    'isOpen' => $clinic['isOpen'],
                    'specialties' => $clinic['specialties'],
                    'location_link' => $clinic['location_link'] ?? '',
                    'aos_delay' => $aosDelay,
                ])
            @empty
                <div class="text-center py-12 col-span-full">
                    <p class="text-muted-foreground">No clinics found matching your criteria.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
 