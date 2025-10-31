{{-- resources/views/pages/clinics.blade.php --}}
@extends('layouts.app')

@section('content')
@php
// If controller didn't pass $clinics/$cities, fall back to a small sample for local dev
if (!isset($clinics) || !isset($cities)) {
    $sample = [
        [
            'name' => 'Downtown Wellness Center',
            'address' => '123 Healing Lane',
            'city' => 'San Francisco',
            'hours' => 'Mon-Fri: 8AM-7PM, Sat: 9AM-5PM',
            'phone' => '(555) 123-4567',
            'image' => 'https://images.unsplash.com/photo-1730701878011-a423ec61c328?auto=format&fit=crop&w=1080&q=80',
            'is_open' => true,
            'specialties' => ['Panchakarma', 'Consultation', 'Herbal Medicine'],
        ],
        [
            'name' => "Nature's Balance Clinic",
            'address' => '456 Serenity Ave',
            'city' => 'Berkeley',
            'hours' => 'Tue-Sat: 9AM-6PM',
            'phone' => '(555) 234-5678',
            'image' => 'https://images.unsplash.com/photo-1667199021925-5778681d0406?auto=format&fit=crop&w=1080&q=80',
            'is_open' => true,
            'specialties' => ['Massage Therapy', 'Yoga', 'Meditation'],
        ],
    ];

    $clinics = collect($sample);
    $cities = $clinics->pluck('city')->unique()->values()->all();
} else {
    // ensure we have a collection
    if (!$clinics instanceof \Illuminate\Support\Collection) {
        $clinics = collect($clinics);
    }
    if (!isset($cities)) {
        $cities = $clinics->pluck('city')->filter()->unique()->values()->all();
    }
}

// Request inputs for form persistence
$q = request('q', '');
$selectedCity = request('city', 'all');
$openOnly = request('open', null);
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
            Showing <strong>{{ $clinics->count() }}</strong>
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
        {{-- Support both array-like and model objects --}}
        @php
    $c = is_array($clinic) ? (object) $clinic : $clinic;
        @endphp

        {{-- Pass the clinic model/object to the reusable card component --}}
        @include('components.home.clinic-card', [
        'name' => $c->name ?? 'Clinic',
        'address' => $c->address ?? '',
        'city' => $c->city ?? '',
        'hours' => $c->hours ?? '',
        'phone' => $c->phone ?? '',
        'image' => $c->image ?? '',
        'isOpen' => $c->is_open ?? ($c->isOpen ?? false),
        'specialties' => $c->specialties ?? [],
    ])
      @empty
        <div class="md:col-span-2 lg:col-span-3 text-center py-16">
          <div class="max-w-md mx-auto space-y-4">
            @include('components.icon', ['name' => 'map-pin', 'class' => 'w-12 h-12 text-muted-foreground mx-auto'])
            <h3 class="text-xl font-medium text-foreground">No clinics found</h3>
            <p class="text-muted-foreground">Try adjusting your search or filter.</p>
            <a href="{{ route('clinics') }}" class="btn-primary inline-flex items-center gap-2">Show All Clinics</a>
          </div>
        </div>
      @endforelse
    </div>

  </div>
</div>
@endsection
