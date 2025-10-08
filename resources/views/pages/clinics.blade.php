{{-- resources/views/pages/clinics.blade.php --}}
@extends('layouts.app')

@section('content')
@php
    // If a controller passed $clinics and $cities, those will be used.
    // Otherwise we fall back to a small sample so the page is usable during development.
    if (!isset($clinics) || !isset($cities)) {
        $sample = [
            [
                'name' => 'Downtown Wellness Center',
                'address' => '123 Healing Lane',
                'city' => 'San Francisco',
                'hours' => 'Mon-Fri: 8AM-7PM, Sat: 9AM-5PM',
                'phone' => '(555) 123-4567',
                'image' => 'https://images.unsplash.com/photo-1730701878011-a423ec61c328?auto=format&fit=crop&w=1080&q=80',
                'isOpen' => true,
                'specialties' => ['Panchakarma', 'Consultation', 'Herbal Medicine'],
            ],
            [
                'name' => "Nature's Balance Clinic",
                'address' => '456 Serenity Ave',
                'city' => 'Berkeley',
                'hours' => 'Tue-Sat: 9AM-6PM',
                'phone' => '(555) 234-5678',
                'image' => 'https://images.unsplash.com/photo-1667199021925-5778681d0406?auto=format&fit=crop&w=1080&q=80',
                'isOpen' => true,
                'specialties' => ['Massage Therapy', 'Yoga', 'Meditation'],
            ],
            [
                'name' => 'Holistic Healing Hub',
                'address' => '789 Wellness Way',
                'city' => 'Palo Alto',
                'hours' => 'Mon-Thu: 10AM-8PM, Fri-Sun: 9AM-6PM',
                'phone' => '(555) 345-6789',
                'image' => 'https://images.unsplash.com/photo-1757689314932-bec6e9c39e51?auto=format&fit=crop&w=1080&q=80',
                'isOpen' => false,
                'specialties' => ['Shirodhara', 'Detox Programs', 'Nutrition'],
            ],
            [
                'name' => 'Ancient Wisdom Center',
                'address' => '321 Harmony Street',
                'city' => 'San Jose',
                'hours' => 'Daily: 8AM-8PM',
                'phone' => '(555) 456-7890',
                'image' => 'https://images.unsplash.com/photo-1589548234057-881a5d872453?auto=format&fit=crop&w=1080&q=80',
                'isOpen' => true,
                'specialties' => ['Traditional Treatments', 'Workshops', 'Retreats'],
            ],
        ];

        $clinics = collect($sample);
        $cities = $clinics->pluck('city')->unique()->values()->all();
    } else {
        // make sure $clinics is a collection (if passed as array)
        if (! $clinics instanceof \Illuminate\Support\Collection) {
            $clinics = collect($clinics);
        }
        // if $cities wasn't passed but clinics were, derive cities
        if (! isset($cities)) {
            $cities = $clinics->pluck('city')->filter()->unique()->values()->all();
        }
    }

    // Request inputs for form persistence
    $q = request('q', '');
    $selectedCity = request('city', 'all');
    $openOnly = request('open', null); // '1' indicates checked
@endphp

<div class="pt-24 pb-16">
  <div class="max-w-[1100px] mx-auto px-5">
    {{-- Header --}}
    <div class="text-center space-y-6 mb-12">
      <h1 class="text-4xl lg:text-5xl font-semibold text-foreground">Find Your Nearest Clinic</h1>
      <p class="text-lg text-muted-foreground mx-auto leading-relaxed">
        Discover our network of authentic Ayurvedic clinics. Filter by city, search by name or specialty,
        or show Open Now clinics.
      </p>
    </div>

    {{-- Filters & Search (GET form) --}}
    <form method="GET" action="{{ route('clinics') }}" class="bg-card rounded-2xl border border-border p-6 mb-8">
      <div class="grid md:grid-cols-4 gap-4 items-center">
        <div class="relative">
          {{-- search icon (use your icon partial) --}}
          @include('components.icon', ['name' => 'search', 'class' => 'absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground'])
          <input
            type="search"
            name="q"
            value="{{ old('q', $q) }}"
            placeholder="Search clinics or treatments..."
            class="pl-10 w-full rounded-lg border border-border px-3 py-2"
          />
        </div>

        <div>
          <div class="flex items-center gap-2">
            @include('components.icon', ['name' => 'map-pin', 'class' => 'w-4 h-4 text-primary'])
            <select name="city" class="w-full rounded-lg border border-border px-3 py-2">
              <option value="all" @selected($selectedCity === 'all')>All Cities</option>
              @foreach($cities as $c)
                <option value="{{ $c }}" @selected($selectedCity == $c)>{{ $c }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div>
          <label class="inline-flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="open" value="1" class="rounded" @checked($openOnly == '1') />
            <span class="text-sm">Open Now</span>
          </label>
        </div>

        <div class="text-sm text-muted-foreground flex items-center justify-end">
          <div class="mr-4">
            Showing <strong>{{ is_countable($clinics) ? $clinics->count() : count($clinics) }}</strong>
          </div>
          <div class="flex gap-2">
            <button type="submit" class="btn-primary">Filter</button>
            <a href="{{ route('clinics') }}" class="btn-secondary">Reset</a>
          </div>
        </div>
      </div>
    </form>

    {{-- Results grid --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse ($clinics as $clinic)
        {{-- Support both array-like or object clinics (from DB later) --}}
        @include('components.home.clinic-card', [
          'name' => $clinic['name'] ?? ($clinic->name ?? 'Clinic'),
          'address' => $clinic['address'] ?? ($clinic->address ?? ''),
          'city' => $clinic['city'] ?? ($clinic->city ?? ''),
          'hours' => $clinic['hours'] ?? ($clinic->hours ?? ''),
          'phone' => $clinic['phone'] ?? ($clinic->phone ?? ''),
          'image' => $clinic['image'] ?? ($clinic->image ?? ''),
          'isOpen' => $clinic['isOpen'] ?? ($clinic->is_open ?? false),
          'specialties' => $clinic['specialties'] ?? ($clinic->specialties ?? []),
        ])
      @empty
        <div class="md:col-span-2 lg:col-span-3 text-center py-16">
          <div class="max-w-md mx-auto space-y-4">
            @include('components.icon', ['name' => 'map-pin', 'class' => 'w-12 h-12 text-muted-foreground mx-auto'])
            <h3 class="text-xl font-medium text-foreground">No clinics found</h3>
            <p class="text-muted-foreground">Try adjusting your search or filter.</p>
            <a href="{{ route('clinics') }}" class="btn-primary inline-flex items-center gap-2">
              Show All Clinics
            </a>
          </div>
        </div>
      @endforelse
    </div>

  </div>
</div>
@endsection
