@php
    $clinics = [
        [
            'name' => 'Downtown Wellness Center',
            'address' => '123 Healing Lane',
            'city' => 'San Francisco',
            'hours' => 'Mon-Fri: 8AM-7PM, Sat: 9AM-5PM',
            'phone' => '(555) 123-4567',
            'image' => 'https://images.unsplash.com/photo-1730701878011-a423ec61c328?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
            'isOpen' => true,
            'specialties' => ['Panchakarma', 'Consultation', 'Herbal Medicine'],
        ],
        [
            'name' => "Nature's Balance Clinic",
            'address' => '456 Serenity Ave',
            'city' => 'Berkeley',
            'hours' => 'Tue-Sat: 9AM-6PM',
            'phone' => '(555) 234-5678',
            'image' => 'https://images.unsplash.com/photo-1667199021925-5778681d0406?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
            'isOpen' => true,
            'specialties' => ['Massage Therapy', 'Yoga', 'Meditation'],
        ],
        [
            'name' => 'Holistic Healing Hub',
            'address' => '789 Wellness Way',
            'city' => 'Palo Alto',
            'hours' => 'Mon-Thu: 10AM-8PM, Fri-Sun: 9AM-6PM',
            'phone' => '(555) 345-6789',
            'image' => 'https://images.unsplash.com/photo-1757689314932-bec6e9c39e51?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
            'isOpen' => false,
            'specialties' => ['Shirodhara', 'Detox Programs', 'Nutrition'],
        ],
        [
            'name' => 'Ancient Wisdom Center',
            'address' => '321 Harmony Street',
            'city' => 'San Jose',
            'hours' => 'Daily: 8AM-8PM',
            'phone' => '(555) 456-7890',
            'image' => 'https://images.unsplash.com/photo-1589548234057-881a5d872453?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
            'isOpen' => true,
            'specialties' => ['Traditional Treatments', 'Workshops', 'Retreats'],
        ],
        [
            'name' => 'Peaceful Mind Clinic',
            'address' => '654 Tranquil Blvd',
            'city' => 'San Francisco',
            'hours' => 'Mon-Fri: 9AM-6PM',
            'phone' => '(555) 567-8901',
            'image' => 'https://images.unsplash.com/photo-1736748580995-1d5faa88ce4d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
            'isOpen' => true,
            'specialties' => ['Mental Health', 'Stress Relief', 'Sleep Disorders'],
        ],
        [
            'name' => 'Vitality Restoration Spa',
            'address' => '987 Renewal Road',
            'city' => 'Berkeley',
            'hours' => 'Wed-Sun: 10AM-7PM',
            'phone' => '(555) 678-9012',
            'image' => 'https://images.unsplash.com/photo-1730701878011-a423ec61c328?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
            'isOpen' => false,
            'specialties' => ['Rejuvenation', 'Anti-aging', 'Beauty Treatments'],
        ]
    ];

    $cities = array_unique(array_merge(['all'], array_map(fn($c) => $c['city'], $clinics)));
    $selectedCity = request()->get('city', 'all');
    $showOpenOnly = request()->get('open', false);

    $filteredClinics = array_filter($clinics, function ($clinic) use ($selectedCity, $showOpenOnly) {
        $cityMatch = $selectedCity === 'all' || $clinic['city'] === $selectedCity;
        $openMatch = !$showOpenOnly || $clinic['isOpen'];
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
