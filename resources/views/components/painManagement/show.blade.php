{{-- resources/views/components/painManagement/show.blade.php --}}
@extends('layouts.app')
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

    /* Optional spacing between blocks */
    .therapy-content>*+* {
        margin-top: 1.25rem;
    }
</style>

@section('content')
    <div class="min-h-screen bg-background text-foreground">
        <div class="max-w-5xl mx-auto px-4 py-12 lg:py-20">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2 text-sm text-muted-foreground mb-6 hover:text-primary transition">
                &larr; Back
            </a>

            <div class="grid lg:grid-cols-3 gap-8 items-start">
                <div class="lg:col-span-2 space-y-6">
                    {{-- Hero image --}}
                    <div class="relative rounded-2xl overflow-hidden shadow-lg">
                        <img src="{{ $treatment->image ? (preg_match('/^(http(s)?:)?\\/\\//', $treatment->image) ? $treatment->image : asset('storage/' . ltrim($treatment->image, '/'))) : asset('fallback.jpg') }}"
                            alt="{{ $treatment->title }}" loading="lazy"
                            class="w-full h-[420px] object-cover rounded-2xl" />
                    </div>

                    {{-- Title + meta --}}
                    <div class="space-y-3">
                        <h1 class="text-3xl font-semibold text-foreground">{{ $treatment->title }}</h1>

                        <div class="flex flex-wrap gap-4 items-center text-sm text-muted-foreground">
                            @if(!empty($treatment->duration))
                                <div>Duration: <span class="ml-1">{{ $treatment->duration }}</span></div>
                            @endif

                            @if(!empty($treatment->category))
                                <div>Category: <span class="ml-1">{{ $treatment->category }}</span></div>
                            @endif

                            @if(isset($treatment->featured) && $treatment->featured)
                                <div class="px-2 py-1 bg-primary/10 rounded text-primary text-xs font-medium">Featured</div>
                            @endif
                        </div>

                        <div class="therapy-content">
                            {!! $safeHtml !!}
                        </div>



                    </div>

                    {{-- More info (shown by default) --}}
                @if($moreInfo)
                    <section class="mt-6">
                         
                        <div class="therapy-content">{!! $moreInfo !!}</div>
                    </section>
                @endif



                    {{-- Benefits --}}
                    @if(!empty($treatment->benefits) && is_array($treatment->benefits))
                        <section class="mt-6">
                            <h3 class="text-lg font-semibold mb-3">Benefits</h3>
                            <ul class="list-disc pl-5 text-sm text-muted-foreground space-y-1">
                                @foreach($treatment->benefits as $b)
                                    <li>{{ $b }}</li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    {{-- Contraindications --}}
                    @if(!empty($treatment->contraindications) && is_array($treatment->contraindications))
                        <section class="mt-6">
                            <h3 class="text-lg font-semibold mb-3">Contraindications</h3>
                            <ul class="list-disc pl-5 text-sm text-muted-foreground space-y-1">
                                @foreach($treatment->contraindications as $c)
                                    <li>{{ $c }}</li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    {{-- Gallery (if any) --}}
                    @if(!empty($treatment->gallery) && is_array($treatment->gallery) && count($treatment->gallery))
                        <section class="mt-6">
                            <h3 class="text-lg font-semibold mb-4">Gallery</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($treatment->gallery as $img)
                                    @php
        $src = preg_match('/^(http(s)?:)?\\/\\//', $img) || str_starts_with($img, '/') ? $img : asset('storage/' . ltrim($img, '/'));
                                    @endphp
                                    <a href="{{ $src }}" target="_blank" class="block rounded-lg overflow-hidden">
                                        <img src="{{ $src }}" alt="{{ $treatment->title }}" loading="lazy"
                                            class="w-full h-28 object-cover" />
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                {{-- Sidebar: quick info & CTA --}}
                <aside class="space-y-6">
                    <div class="p-5 rounded-2xl bg-card border border-border shadow-sm">
                        <h3 class="font-semibold">Quick Info</h3>
                        <ul class="mt-3 text-sm text-muted-foreground space-y-2">
                            <li><strong>Duration:</strong> <span class="ml-2">{{ $treatment->duration ?? '—' }}</span></li>
                            <li><strong>Availability:</strong> <span
                                    class="ml-2">{{ $treatment->available ? 'Available' : 'Contact us' }}</span></li>
                            {{-- <li><strong>Price:</strong> <span class="ml-2">{{ $treatment->price ?
                                    ($treatment->price_currency ?? 'INR') . ' ' . number_format($treatment->price, 2) : '—'
                                    }}</span>
                            </li> --}}
                        </ul>

                        <div class="mt-4">
                            <button data-booking data-treatment="{{ optional($treatment)->slug ?? '' }}"
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

            {{-- Booking anchor --}}
            <div id="booking" class="mx-auto mt-12 p-6 bg-card rounded-2xl border border-border">
                <x-contact.BookFreeConsultation :treatment="$treatment" />
            </div>
        </div>
    </div>
@endsection