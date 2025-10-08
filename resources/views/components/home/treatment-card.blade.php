@props([
    'title',
    'description',
    'image',
    'duration',
    'price' => null,
    'featured' => false,
])

<div class="group bg-card rounded-2xl border border-border overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300
    {{ $featured ? 'ring-2 ring-primary/20 scale-[1.02]' : 'hover:scale-[1.02]' }}">

    {{-- Image --}}
    <div class="relative">
        <img src="{{ $image }}" alt="{{ $title }}"
             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" />

        @if ($featured)
            <span class="absolute top-3 left-3 bg-primary text-white text-xs font-medium px-2 py-1 rounded-md">
                Most Popular
            </span>
        @endif

        @if ($duration)
            <span class="absolute top-3 right-3 bg-white/90 text-foreground text-xs font-medium px-2 py-1 rounded-md flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2" />
                </svg>
                {{ $duration }}
            </span>
        @endif
    </div>

    {{-- Card Content --}}
    <div class="p-6 space-y-4">
        <div class="space-y-3">
            <h3 class="text-xl font-semibold text-foreground group-hover:text-primary transition-colors">
                {{ $title }}
            </h3>
            <p class="text-muted-foreground leading-relaxed">
                {{ $description }}
            </p>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-border">
            <div>
                @if ($price)
                    <div class="text-2xl font-semibold text-primary">{{ $price }}</div>
                @endif
            </div>

            <a href="#"
               class="text-primary hover:bg-primary/10 px-3 py-2 rounded-md inline-flex items-center transition group">
                Learn More
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
