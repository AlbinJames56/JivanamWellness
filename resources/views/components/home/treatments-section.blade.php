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
    </div>
</section>
