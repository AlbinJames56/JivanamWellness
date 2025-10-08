@props([
    'name',
    'address',
    'city',
    'hours',
    'phone',
    'image',
    'isOpen' => true,
    'specialties' => []
])

<div class="group bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:scale-[1.02]">
    <div class="relative">
        <img src="{{ $image }}" alt="{{ $name }} clinic" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" />

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
                <div class="flex flex-wrap gap-2 pt-2">
                    @foreach($specialties as $specialty)
                        <span class="badge badge-accent text-xs">{{ $specialty }}</span>
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
