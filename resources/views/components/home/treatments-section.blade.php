{{-- resources/views/components/home/treatments-section.blade.php --}}
@php
    // Accept $treatments passed from controller; fallback to recent Therapy models if empty (safe).
    $treatments = $treatments ?? null;

    if (is_null($treatments)) {
        // Attempt to fetch from Therapy if view was used without controller data (safe fallback)
        try {
            $treatments = \App\Models\Therapy::query()
                ->where('available', true)
                ->orderByDesc('featured')
                ->orderByDesc('created_at')
                ->limit(6)
                ->get();
        } catch (\Throwable $e) {
            $treatments = collect();
        }
    }

    $treatments = collect($treatments);
@endphp

<section id="treatments" class="py-16 lg:py-24 bg-background">
    <div class="max-w-[1100px] mx-auto px-5">
        <div class="text-center space-y-6 mb-16">
            <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">
                Authentic Ayurvedic Therapies
            </h2>
            <p class="text-lg text-muted-foreground mx-auto leading-relaxed">
                Discover our wide range of time-tested Ayurvedic therapies - each crafted to restore
                balance, detoxify the body, and promote natural healing according to your unique
                dosha and wellness needs
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($treatments as $treatment)
                @include('components.home.treatment-card', [
                    'title' => $treatment->title ?? ($treatment['title'] ?? 'Untitled'),
                    'description' => $treatment->excerpt
                        ?? ($treatment->summary
                            ?? ($treatment->description ?? ($treatment['description'] ?? null))),
                    'image' => (isset($treatment->image) && $treatment->image)
                        ? (\Illuminate\Support\Str::startsWith($treatment->image, ['http://', 'https://'])
                            ? $treatment->image
                            : asset('storage/' . ltrim($treatment->image, '/')))
                        : null,
                    'duration' => $treatment->duration ?? ($treatment['duration'] ?? null),
                    'featured' => (bool) ($treatment->featured ?? ($treatment['featured'] ?? false)),
                    'model' => $treatment, // pass model for slug
                ])
            @empty
                    <div class="col-span-full text-center text-muted-foreground">
                        No therapies available at the moment.


                                                          </div>
                @endforelse
                        </div>
                            <div class="flex justify-center mt-10">
                @php
                    $therapiesUrl = 'https://jivanamwellness.in/therapy';
                @endphp

            <a href="{{ $therapiesUrl }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium transition text-primary hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-primary/20"
            title="View all therapies">
            View all therapies
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
            </a>
        </div> 
    </div>
</section>
