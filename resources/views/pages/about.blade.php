{{-- resources/views/pages/about.blade.php --}}
@extends('layouts.app')

@section('content')
                            @php
    // Page data (replace with DB data later via controller/admin panel)
    $stats = [
        ['number' => '15+', 'label' => 'Years Experience', 'icon' => 'clock'],
        ['number' => '5000+', 'label' => 'Happy Patients', 'icon' => 'heart'],
        ['number' => '25+', 'label' => 'Expert Practitioners', 'icon' => 'users'],
        ['number' => '98%', 'label' => 'Success Rate', 'icon' => 'award'],
    ];

    $values = [
        [
            'icon' => 'leaf',
            'title' => 'Natural Healing',
            'description' =>
                'We believe in the power of nature to heal, using only authentic Ayurvedic herbs and traditional methods that have been proven effective for thousands of years.',
        ],
        [
            'icon' => 'heart',
            'title' => 'Patient-Centered Care',
            'description' =>
                'Every treatment plan is personalized to your unique constitution and health needs. We take time to understand you as an individual, not just your symptoms.',
        ],
        [
            'icon' => 'target',
            'title' => 'Holistic Approach',
            'description' =>
                'We address the root causes of illness, not just symptoms. Our integrated approach considers your physical, mental, and emotional wellbeing.',
        ],
        [
            'icon' => 'shield',
            'title' => 'Safety & Quality',
            'description' =>
                'All our treatments follow strict safety protocols. We use only certified organic herbs and maintain the highest standards of hygiene and quality.',
        ],
    ];

    // $team = [
    //     [
    //         'name' => 'Dr. Rajesh Patel',
    //         'title' => 'Chief Ayurvedic Physician',
    //         'specialization' => 'Panchakarma & Pain Management',
    //         'experience' => '20+ years',
    //         'image' =>
    //             'https://images.unsplash.com/photo-1756699279701-99e1fd273517?auto=format&fit=crop&w=1080&q=80',
    //     ],
    //     [
    //         'name' => 'Dr. Priya Sharma',
    //         'title' => 'Senior Ayurvedic Consultant',
    //         'specialization' => "Women's Health & Wellness",
    //         'experience' => '15+ years',
    //         'image' =>
    //             'https://images.unsplash.com/photo-1756699279701-99e1fd273517?auto=format&fit=crop&w=1080&q=80',
    //     ],
    //     [
    //         'name' => 'Dr. Arjun Kumar',
    //         'title' => 'Ayurvedic Specialist',
    //         'specialization' => 'Digestive Health & Detox',
    //         'experience' => '12+ years',
    //         'image' =>
    //             'https://images.unsplash.com/photo-1756699279701-99e1fd273517?auto=format&fit=crop&w=1080&q=80',
    //     ],
    // ];

    $certifications = [
        'Certified by All India Institute of Ayurveda',
        'Member of National Association of Ayurvedic Physicians',
        'ISO 9001:2015 Certified Facility',
        'Government Approved Ayurvedic Hospital',
        'Certified Organic Herb Suppliers',
        'International Panchakarma Certification',
    ];
                            @endphp

                            <div class="min-h-screen bg-background">

                                {{-- Hero --}}
                                <section class="relative py-10 lg:py-16 bg-gradient-to-br from-muted/20 to-background">
                                    <div class="max-w-[1200px] mx-auto px-5">
                                        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                                            <div class="space-y-6">
                                                <span class="inline-block badge-accent">About AyurVeda Clinic</span>

                                                <h1 class="text-4xl lg:text-5xl xl:text-6xl font-semibold leading-tight text-foreground">
                                                    Healing Lives Through <span class="text-primary">Ancient Wisdom</span>
                                                </h1>

                                                <div class="space-y-4 text-lg text-muted-foreground leading-relaxed">
                                                    <p>
                                                        For over 15 years, we've been dedicated to bringing authentic Ayurvedic healing
                                                        to modern lives, combining time-tested traditions with contemporary wellness practices.
                                                    </p>
                                                    <p>
                                                        Our mission is to help you achieve optimal health naturally, addressing not just
                                                        symptoms but the root causes of imbalance in your body, mind, and spirit.
                                                    </p>
                                                </div>

                                                <a href="#team" class="inline-flex items-center gap-3 btn-primary">
                                                    {{-- calendar svg --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor">
                                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-width="1.5"></rect>
                                                        <path d="M16 2v4M8 2v4M3 10h18" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                    Meet Our Practitioners
                                                    {{-- arrow --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor">
                                                        <path d="M5 12h14M13 5l7 7-7 7" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            </div>

                                            <div class="relative">
                                                <img src="https://images.unsplash.com/photo-1581481336099-e0fbd599b5e0?auto=format&fit=crop&w=1080&q=80"
                                                    alt="Clinic interior" class="w-full h-[500px] object-cover rounded-3xl shadow-xl">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent rounded-3xl"></div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                {{-- Stats --}}
                                <section class="py-16 lg:py-24 bg-muted/30">
                                    <div class="max-w-[1200px] mx-auto px-5">
                                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                                            @foreach ($stats as $stat)
                                                <div class="card p-6 text-center hover:shadow-md transition-shadow">
                                                    <div class="bg-primary/10 rounded-full p-4 w-fit mx-auto mb-4">
                                                        {{-- simple icon placeholder --}}
                                                        <span class="text-primary font-bold">{{ strtoupper(substr($stat['label'], 0, 1)) }}</span>
                                                    </div>
                                                    <div class="text-3xl font-semibold text-foreground mb-2">{{ $stat['number'] }}</div>
                                                    <div class="text-sm text-muted-foreground">{{ $stat['label'] }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>

                                {{-- Our Story --}}
                                <section class="py-16 lg:py-24">
                                    <div class="max-w-[1200px] mx-auto px-5">
                                        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                                            <div class="order-2 lg:order-1">
                                                <img src="https://images.unsplash.com/photo-1583466478015-2dce6bf2f551?auto=format&fit=crop&w=1080&q=80"
                                                    alt="Herbs" class="w-full h-[400px] lg:h-[500px] object-cover rounded-3xl shadow-xl">
                                            </div>

                                            <div class="order-1 lg:order-2 space-y-6">
                                                <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Our Journey in Ayurvedic Healing</h2>

                                                <div class="space-y-4 text-muted-foreground leading-relaxed">
                                                    <p>
                                                        Founded in 2008 by Dr. Rajesh Patel, our clinic began as a small practice
                                                        with a big vision: to make authentic Ayurvedic healing accessible to everyone
                                                        seeking natural wellness solutions.
                                                    </p>

                                                    <p>
                                                        What started as a passion for traditional healing has grown into a comprehensive
                                                        wellness center, serving thousands of patients across India. Our success lies
                                                        in our unwavering commitment to authenticity, quality, and personalized care.
                                                    </p>

                                                    <p>
                                                        Today, we're proud to be recognized as one of the leading Ayurvedic clinics,
                                                        combining ancient wisdom with modern facilities to provide you with the best
                                                        possible healing experience.
                                                    </p>
                                                </div>

                                                <div class="flex items-center gap-4 pt-2">
                                                    <div class="bg-secondary/10 rounded-full p-2">
                                                        {{-- star svg --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-secondary" viewBox="0 0 24 24"
                                                            fill="currentColor">
                                                            <path
                                                                d="M12 .587l3.668 7.431L23.5 9.75l-5.666 5.523L19.334 24 12 20.02 4.666 24l1.5-8.727L.5 9.75l7.832-1.732L12 .587z" />
                                                        </svg>
                                                    </div>
                                                    <span class="text-sm font-medium text-foreground">Award-winning Ayurvedic Healthcare Provider
                                                        2023</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                {{-- Values --}}
                                <section class="py-16 lg:py-24 bg-gradient-to-br from-primary/5 to-muted/20">
                                    <div class="max-w-[1200px] mx-auto px-5">
                                        <div class="text-center space-y-4 mb-12">
                                            <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Our Core Values</h2>
                                            <p class="text-lg text-muted-foreground   mx-auto">The principles that guide everything we do in our
                                                mission to heal and nurture</p>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                            @foreach ($values as $value)
                                                <div class="card p-6 hover:shadow-md transition-shadow">
                                                    <div class="flex items-start gap-4">
                                                        <div class="bg-primary/10 rounded-full p-3 flex-shrink-0">
                                                            {{-- placeholder icon --}}
                                                            <span
                                                                class="text-primary font-semibold">{{ strtoupper(substr($value['title'], 0, 1)) }}</span>
                                                        </div>
                                                        <div class="flex-1">
                                                            <h3 class="font-semibold text-foreground mb-3">{{ $value['title'] }}</h3>
                                                            <p class="text-sm text-muted-foreground leading-relaxed">{{ $value['description'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>

                                {{-- Team --}}
                                <section id="team" class="py-16 lg:py-24">

                                    <div class="max-w-[1200px] mx-auto px-5">
                                        <div class="text-center space-y-4 mb-12">
                                            <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Meet Our Expert Team</h2>
                                            <p class="text-lg text-muted-foreground  mx-auto">Experienced practitioners dedicated to your wellness
                                                journey</p>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                            @foreach ($teamMembers as $member)
                                                @php

                                                    $m = is_object($member) ? $member : (object) $member;
                                                    // resolve image URL if file stored on public disk path
                                                    $imgUrl = null;
                                                    if (!empty($m->image)) {
                                                        if (Str::startsWith($m->image, ['http://', 'https://'])) {
                                                            $imgUrl = $m->image;
                                                        } else {
                                                            $imgUrl = \Illuminate\Support\Facades\Storage::disk('public')->exists(ltrim($m->image, '/'))
                                                                ? \Illuminate\Support\Facades\Storage::disk('public')->url(ltrim($m->image, '/'))
                                                                : asset('storage/' . ltrim($m->image, '/'));
                                                        }
                                                    }
                                                @endphp

                                                <div class="card overflow-hidden hover:shadow-md transition-shadow">
                                                    <div class="relative">
                                                        @if($imgUrl)
                                                            <img src="{{ $imgUrl }}" alt="{{ $m->name }}" class="w-full h-64 object-cover">
                                                        @else
                                                            <div
                                                                class="w-full h-64 bg-gradient-to-br from-primary/10 to-muted/10 flex items-center justify-center">
                                                                <div class="text-muted-foreground">No photo</div>
                                                            </div>
                                                        @endif
                                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                                    </div>

                                                    <div class="p-6 space-y-3">
                                                        <div>
                                                            <h3 class="font-semibold text-foreground">{{ $m->name }}</h3>
                                                            <p class="text-sm text-primary">{{ $m->title }}</p>
                                                        </div>
                                                        <div class="space-y-2 text-sm text-muted-foreground">
                                                            <div><strong>Specialization:</strong> {{ $m->specialization ?? '-' }}</div>
                                                            <div><strong>Experience:</strong> {{ $m->experience ?? '-' }}</div>
                                                        </div>
                                                        <a href="#booking" class="btn-secondary inline-flex items-center justify-center w-full">
                                                            Book Consultation
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>

                                {{-- Certifications --}}
                                <section class="py-16 lg:py-24 bg-muted/30">
                                    <div class="max-w-[1200px] mx-auto px-5">
                                        <div class="text-center space-y-4 mb-12">
                                            <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Certifications & Recognition</h2>
                                            <p class="text-lg text-muted-foreground">Trusted by authorities and recognized for excellence</p>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                            @foreach ($certifications as $cert)
                                                <div class="flex items-center gap-3 p-4 bg-card border border-border rounded-lg">
                                                    {{-- check icon --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary flex-shrink-0"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path d="M20 6L9 17l-5-5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                        </path>
                                                    </svg>
                                                    <span class="text-sm text-foreground">{{ $cert }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>

                                {{-- CTA / Booking Section --}}
                                <!-- <section id="booking" class="py-16 lg:py-24 bg-gradient-to-r from-primary to-secondary">
                                                        <div class="max-w-[1100px] mx-auto px-5 text-center">
                                                            <div class="space-y-6 text-white">
                                                                <h2 class="text-3xl lg:text-4xl font-semibold">Ready to Start Your Healing Journey?</h2>
                                                                <p class="text-xl text-white/90   mx-auto leading-relaxed">
                                                                    Experience the transformative power of authentic Ayurvedic healing. Let our expert practitioners
                                                                    guide you toward optimal health and wellness.
                                                                </p>

                                                                {{-- Simple booking form (POST to route you can create later) --}}
                                                                <form action="{{ route('appointments.store') ?? '#' }}" method="POST"
                                                                    class="  mx-auto grid sm:grid-cols-2 gap-4">
                                                                    @csrf
                                                                    <input name="name" placeholder="Your name" required class="px-4 py-3 rounded-lg border" />
                                                                    <input name="phone" placeholder="Phone or WhatsApp" required class="px-4 py-3 rounded-lg border" />
                                                                    <input name="email" type="email" placeholder="Email (optional)"
                                                                        class="px-4 py-3 rounded-lg sm:col-span-2 border" />
                                                                    <textarea name="notes" placeholder="Tell us briefly about your concern (optional)"
                                                                        class="px-4 py-3 rounded-lg sm:col-span-2 border"></textarea>
                                                                    <div class="flex justify-center sm:col-span-2 ">
                                                                        <button type="submit"
                                                                            class="btn-primary w-1/3 sm:col-span-2 inline-flex items-center justify-center gap-2border">
                                                                            {{-- calendar svg --}}
                                                                           <i class="fa-solid fa-clipboard-question me-1" ></i>
                                                                            Send a Query
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </section> -->

                                <x-contact.BookFreeConsultation />
                            </div>
@endsection