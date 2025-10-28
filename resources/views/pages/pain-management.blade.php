{{-- resources\views\pages\pain-management.blade.php --}}
@extends('layouts.app')
@php

    // If controller didn't pass $articles, try to load 3 latest published.
    if (!isset($articles)) {
        $articles = \App\Models\Article::query()
            ->where('published', true)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();
    }
@endphp

@section('content')
    <div class="min-h-screen bg-background">

        {{-- Hero Section --}}
        <section class="relative py-20 lg:py-28 bg-gradient-to-br from-muted/20 to-background">
            <div class="  mx-auto px-5 text-center space-y-6">
                <div class="max-w-4xl mx-auto space-y-6">
                    <span class="inline-block badge-accent">Natural Pain Relief</span>

                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-semibold leading-tight text-foreground">
                        Find Lasting Relief from <span class="text-primary">Chronic Pain</span>
                    </h1>

                    <div class="space-y-4 text-lg text-muted-foreground leading-relaxed   mx-auto">
                        <p>Experience gentle, effective pain management through time-tested Ayurvedic therapies. Our
                            holistic approach addresses root causes, providing sustainable relief without harsh side
                            effects.</p>
                    </div>

                    <a href="#booking"
                        class="btn-secondary border-primary text-primary hover:bg-primary hover:text-primary-foreground inline-flex items-center justify-center group">
                        @include('components.icon', ['name' => 'calendar', 'class' => 'w-5 h-5 mr-2'])
                        Get Pain Assessment
                        @include('components.icon', ['name' => 'arrow-right', 'class' => 'w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform'])
                    </a>
                </div>
            </div>
        </section>

        {{-- Symptoms Section --}}
        <section class="py-16 lg:py-24">
            <div class="max-w-[1100px] mx-auto px-5 grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="space-y-4">
                        <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">
                            Are You Experiencing These Symptoms?
                        </h2>
                        <p class="text-lg text-muted-foreground leading-relaxed">
                            If you're dealing with persistent pain that affects your daily life,
                            our specialized Ayurvedic treatments can help you find natural, lasting relief.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @php
                            $symptoms = [
                                ['icon' => 'alert-circle', 'text' => 'Chronic back and neck pain'],
                                ['icon' => 'target', 'text' => 'Joint pain and stiffness'],
                                ['icon' => 'zap', 'text' => 'Muscle tension and spasms'],
                                ['icon' => 'activity', 'text' => 'Arthritis and inflammatory conditions'],
                                ['icon' => 'brain', 'text' => 'Headaches and migraines'],
                                ['icon' => 'heart', 'text' => 'Nerve pain and sciatica'],
                                ['icon' => 'clock', 'text' => 'Post-injury rehabilitation'],
                                ['icon' => 'shield', 'text' => 'Chronic fatigue syndrome'],
                            ];
                        @endphp
                        @foreach ($symptoms as $symptom)
                            <div
                                class="flex items-center gap-3 p-4 bg-card border border-border rounded-lg hover:shadow-sm transition-shadow">
                                <div class="bg-accent/10 rounded-full p-2 flex-shrink-0">
                                    @include('components.icon', ['name' => $symptom['icon'], 'class' => 'w-4 h-4 text-accent'])
                                </div>
                                <span class="text-sm text-foreground">{{ $symptom['text'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?auto=format&fit=crop&w=1080&q=80"
                        alt="Ayurvedic pain management therapy" class="w-full h-[500px] object-cover rounded-3xl shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl"></div>
                </div>
            </div>
        </section>

        {{-- Causes Section --}}
        <section class="py-16 lg:py-24 bg-muted/30">
            <div class="max-w-[1100px] mx-auto px-5 text-center">
                <div class="space-y-4 mb-12">
                    <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Understanding Pain Causes</h2>
                    <p class="text-lg text-muted-foreground   mx-auto">
                        Effective treatment begins with understanding the root causes of your pain
                    </p>
                </div>

                @php
                    $conditions = [
                        [
                            'icon' => 'stethoscope',
                            'title' => 'Poor Posture',
                            'description' => 'Modern sedentary lifestyle and desk work',
                        ],
                        [
                            'icon' => 'activity',
                            'title' => 'Physical Stress',
                            'description' => 'Overuse injuries and repetitive strain',
                        ],
                        [
                            'icon' => 'brain',
                            'title' => 'Mental Stress',
                            'description' => 'Emotional tension manifesting physically',
                        ],
                        [
                            'icon' => 'alert-circle',
                            'title' => 'Inflammation',
                            'description' => 'Chronic inflammatory conditions',
                        ],
                        [
                            'icon' => 'clock',
                            'title' => 'Age-related',
                            'description' => 'Natural wear and degenerative changes',
                        ],
                        [
                            'icon' => 'target',
                            'title' => 'Autoimmune',
                            'description' => 'Conditions affecting joints and muscles',
                        ],
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($conditions as $c)
                        <div class="card text-center hover:shadow-md transition-shadow">
                            <div class="bg-primary/10 rounded-full p-4 w-fit mx-auto mb-4">
                                @include('components.icon', ['name' => $c['icon'], 'class' => 'w-6 h-6 text-primary'])
                            </div>
                            <h3 class="font-semibold text-foreground mb-2">{{ $c['title'] }}</h3>
                            <p class="text-sm text-muted-foreground">{{ $c['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="py-16 lg:py-24">
            <div class="max-w-[1100px] mx-auto px-5">
                <div class="text-center space-y-4 mb-12">
                    <h2 class="text-3xl lg:text-4xl font-semibold">Our Pain Management Techniques</h2>
                    <p class="text-lg text-muted-foreground  mx-auto">Comprehensive therapies designed to address
                        different types of pain and underlying causes</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($techniques as $t)
                        <x-painManagement.technique-card :technique="$t" variant="more" />
                    @empty
                        <div class="col-span-full text-center text-muted-foreground">No techniques available yet.</div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Blog Section --}}
        <section class="py-16 lg:py-24">
            <div class="max-w-[1100px] mx-auto px-5 text-center">
                <div class="space-y-4 mb-12">
                    <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">
                        Learn More About Pain Management
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Explore our articles and insights on natural pain relief
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($articles as $article)
                        <a href="{{ route('articles.show', $article->slug) }}"
                            class="card hover:shadow-md transition-shadow group">
                            <div class="space-y-4">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . ltrim($article->image, '/')) }}" alt="{{ $article->title }}"
                                        class="w-full h-44 object-cover rounded-lg">
                                @endif

                                <h3 class="font-semibold text-foreground group-hover:text-primary transition-colors">
                                    {{ $article->title }}
                                </h3>

                                <p class="text-sm text-muted-foreground leading-relaxed">
                                    {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 120) }}
                                </p>

                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-muted-foreground">
                                        {{ $article->read_time ?? $article->estimated_read_time }} min read
                                    </span>
                                    @include('components.icon', ['name' => 'arrow-right', 'class' => 'w-4 h-4 text-primary group-hover:translate-x-1 transition-transform'])
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </section>

        {{-- Call To Action --}}
        <section id="booking" class="py-16 lg:py-24 bg-gradient-to-br from-primary/5 to-muted/20 text-center">
            <div class="max-w-[900px] mx-auto space-y-6">
                <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">
                    Start Your Pain-Free Journey
                </h2>
                <p class="text-muted-foreground text-lg   mx-auto">
                    Book your personalized Ayurvedic pain assessment today and discover holistic healing.
                </p>
             <button class="btn-primary inline-flex items-center justify-center"
                data-booking
                @if(isset($therapy)) data-treatment="{{ $therapy->slug }}"
                @elseif(isset($t)) data-treatment="{{ $t->slug }}"
                @elseif(isset($treatment)) data-treatment="{{ $treatment->slug }}"
                @endif>
                @include('components.icon', ['name' => 'calendar', 'class' => 'w-4 h-4 mr-2'])
                Book Appointment
            </button>

            </div>
        </section>
    </div>
@endsection
