@extends('layouts.app')
@php
    use Illuminate\Support\Str;

    // Normalize tags to a simple PHP array of strings
    $rawTags = $therapy->tags ?? [];
    if ($rawTags instanceof \Illuminate\Support\Collection) {
        $tags = $rawTags->all();
    } elseif (is_string($rawTags)) {
        $tags = array_values(array_filter(array_map('trim', preg_split('/[,;|]+/', $rawTags))));
    } elseif (is_array($rawTags)) {
        $tags = array_values(array_filter(array_map('trim', $rawTags)));
    } else {
        $tags = [];
    }
@endphp
<style>
    .therapy-content {
        line-height: 1.75;
        color: inherit;
        max-width: none;
    }

    /* Let the rich editor classes do their work */
    .therapy-content * {
        all: revert;
    }

    /* Optional: Add some custom spacing */
    .therapy-content>*+* {
        margin-top: 1.25rem;
    }
</style>
@section('content')
    <div class="min-h-screen bg-background text-foreground">
        <div class="max-w-6xl mx-auto px-4 py-12 lg:py-20">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2 text-sm text-muted-foreground mb-6 hover:text-primary transition">
                &larr; Back
            </a>

            {{-- HERO / IMAGE --}}
            <div class="relative rounded-2xl overflow-hidden shadow-lg">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-black/10 pointer-events-none"></div>

                <img src="{{ $therapy->image ? asset('storage/' . $therapy->image) : asset('fallback.jpg') }}"
                    alt="{{ $therapy->title }}" loading="lazy" class="w-full h-[420px] lg:h-[520px] object-cover" />

                <div class="absolute left-4 bottom-4 right-4  md:left-6  md:right-6 md:bottom-6">
                    <div class="bg-white/10 backdrop-blur-sm px-4 py-3 rounded-2xl border border-white/6  ">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                @if(count($tags))
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        @foreach($tags as $t)
                                            <span
                                                class="text-xs leading-tight px-2 py-1 rounded-full bg-white/90 border border-white/60 text-foreground shadow-sm whitespace-nowrap">
                                                {{ $t }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                                <h1 class="text-2xl md:text-3xl font-semibold leading-tight text-background">
                                    {{ $therapy->title }}
                                </h1>
                                <!--<div class="text-sm text-border mt-1">{{ $therapy->duration ?? '—' }}</div>-->
                            </div>

                            <div class="hidden sm:flex items-center gap-3">
                                <button data-booking
                                    data-treatment="{{ optional($therapy)->slug ?? optional($treatment)->slug ?? '' }}"
                                    class="w-full btn-primary block text-center">Book </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MAIN GRID --}}
            <div class="grid lg:grid-cols-3 gap-8 items-start mt-10">
                {{-- Left / main content --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- meta row --}}
                    <div class="flex items-center justify-between flex-col sm:flex-row gap-4">
                        <div class="flex items-center gap-4">
                            @if(isset($therapy->rating))
                                <div class="flex items-center gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $therapy->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M12 .587l3.668 7.568L24 9.423l-6 5.854L19.335 24 12 19.771 4.665 24 6 15.277 0 9.423l8.332-1.268z" />
                                        </svg>
                                    @endfor
                                    <div class="text-xs text-muted-foreground ml-2">({{ $therapy->rating }})</div>
                                </div>
                            @endif

                            <div class="text-sm text-muted-foreground">Last updated:
                                <span class="ml-2 text-xs">{{ optional($therapy->updated_at)->format('M d, Y') }}</span>
                            </div>
                        </div>

                        <div class="sm:hidden">
                            <a href="#booking" class="btn-primary px-3 py-2">Book Now</a>
                        </div>
                    </div>

                    @if(!empty($safeHtml))
                        <div class="therapy-content mt-4">
                            {!! $safeHtml !!}
                        </div>
                    @endif



                    {{-- Benefits --}}
                    @if(!empty($therapy->benefits) && is_array($therapy->benefits))
                        <section class="mt-6">
                            <h3 class="text-lg font-semibold mb-3">Benefits</h3>
                            <ul class="list-disc pl-5 text-sm text-muted-foreground space-y-1">
                                @foreach($therapy->benefits as $b)
                                    <li>{{ $b }}</li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    {{-- Contraindications --}}
                    @if(!empty($therapy->contraindications) && is_array($therapy->contraindications))
                        <section class="mt-6">
                            <h3 class="text-lg font-semibold mb-3">Contraindications</h3>
                            <ul class="list-disc pl-5 text-sm text-muted-foreground space-y-1">
                                @foreach($therapy->contraindications as $c)
                                    <li>{{ $c }}</li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    {{-- Gallery --}}
                    @if(!empty($therapy->gallery) && is_array($therapy->gallery) && count($therapy->gallery))
                        <section class="mt-6">
                            <h3 class="text-lg font-semibold mb-4">Gallery</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($therapy->gallery as $img)
                                    @php
                                        // if $img is already a URL or absolute path, use it directly
                                        $src = preg_match('/^(http(s)?:)?\\/\\//', $img) || str_starts_with($img, '/') ? $img : asset('storage/' . ltrim($img, '/'));

                                       @endphp

                                    <a href="{{ $src }}" target="_blank" class="block rounded-lg overflow-hidden">
                                        <img src="{{ $src }}" alt="{{ $therapy->title }}" loading="lazy"
                                            class="w-full h-28 object-cover" />
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif


                    {{-- Related testimonials --}}
                    @if(!empty($relatedTestimonials) && $relatedTestimonials->count())
                        <section class="mt-6">
                            <h3 class="text-lg font-semibold mb-4">What people say</h3>
                            <div class="grid sm:grid-cols-2 gap-4">
                                @foreach($relatedTestimonials as $t)
                                    <blockquote class="p-4 rounded-xl bg-card border border-border">
                                        <div class="flex items-start gap-3">
                                            <div
                                                class="w-12 h-12 rounded-full bg-muted/10 flex items-center justify-center text-muted-foreground font-medium">
                                                {{ strtoupper(substr($t->name, 0, 1)) }}
                                            </div>
                                            <div class="flex-1">
                                                <div class="font-medium">{{ $t->name }}</div>
                                                <div class="text-xs text-muted-foreground mb-2">{{ $t->location }}</div>
                                                <div class="text-sm text-muted-foreground">{{ Str::limit($t->text, 160) }}</div>
                                            </div>
                                        </div>
                                    </blockquote>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                {{-- Right / sidebar --}}
                <aside class="space-y-6">
                    <div class="p-5 rounded-2xl bg-card border border-border shadow-sm">
                        <h3 class="font-semibold">Quick Info</h3>
                        <ul class="mt-3 text-sm text-muted-foreground space-y-2">
                            <li><strong>Duration:</strong> <span class="ml-2">{{ $therapy->duration ?? '—' }}</span></li>
                            <li><strong>Category:</strong> <span class="ml-2">{{ $therapy->tag ?? '—' }}</span></li>
                            <li><strong>Availability:</strong> <span
                                    class="ml-2">{{ $therapy->available ? 'Available' : 'Contact us' }}</span></li>
                            @if(!empty($therapy->price))
                                <li>
                                    <strong>Price:</strong>
                                    <span class="ml-2">
                                        {{ ($therapy->price_currency ?? 'INR') . ' ' . number_format((float) $therapy->price, 2) }}
                                    </span>
                                </li>
                            @endif

                        </ul>

                        <div class="mt-4">
                            <button data-booking
                                data-treatment="{{ optional($therapy)->slug ?? optional($treatment)->slug ?? '' }}"
                                class="w-full btn-primary block text-center">Book a Consultation</button>

                            <a href="mailto:info@example.com" class="w-full btn-secondary block text-center mt-3">Request
                                Info</a>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-gradient-to-br from-primary/6 to-background border border-border">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-muted-foreground">Have questions?</div>
                                <div class="font-medium">Connect with our team</div>
                            </div>
                            <a href="tel:+911234567890" class="btn-primary px-3 py-2">Call</a>
                        </div>
                    </div>
                </aside>
            </div>

            {{-- Booking anchor / simple contact form (example) --}}
            <div id="booking" class="  mx-auto mt-12 p-6 bg-card rounded-2xl border border-border">
                <x-contact.BookFreeConsultation :therapy="$therapy" />
            </div>

        </div>
    </div>
@endsection