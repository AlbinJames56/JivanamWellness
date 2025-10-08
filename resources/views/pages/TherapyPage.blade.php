{{-- resources/views/therapy.blade.php --}}
@extends('layouts.app')

@section('content')
    @php
        $therapies = [
            [
                'title' => 'Panchakarma Detox',
                'summary' =>
                    'Complete body purification through five therapeutic actions. Eliminates toxins and restores natural balance for optimal health.',
                'image' => 'https://images.unsplash.com/photo-1736748580995-1d5faa88ce4d?q=80&w=1080',
                'duration' => '7-21 days',
                'tag' => 'Detox',
                'featured' => true,
            ],
            [
                'title' => 'Abhyanga Massage',
                'summary' =>
                    'Traditional full-body oil massage using warm herbal oils. Improves circulation and calms the nervous system.',
                'image' => 'https://images.unsplash.com/photo-1757689314932-bec6e9c39e51?q=80&w=1080',
                'duration' => '60-90 min',
                'tag' => 'Massage',
            ],
            [
                'title' => 'Shirodhara Therapy',
                'summary' =>
                    'Meditative treatment with warm oil flowing over the forehead. Deeply relaxes mind and nervous system.',
                'image' => 'https://images.unsplash.com/photo-1589548234057-881a5d872453?q=80&w=1080',
                'duration' => '45-60 min',
                'tag' => 'Relaxation',
            ],
            [
                'title' => 'Kizhi Therapy',
                'summary' =>
                    'Heated herbal poultices applied to body. Excellent for joint pain, muscle stiffness, and inflammation.',
                'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?q=80&w=1080',
                'duration' => '60 min',
                'tag' => 'Pain Relief',
            ],
            [
                'title' => 'Nasya Treatment',
                'summary' =>
                    'Nasal administration of medicated oils. Clears respiratory passages and enhances mental clarity.',
                'image' => 'https://images.unsplash.com/photo-1667199021925-5778681d0406?q=80&w=1080',
                'duration' => '30 min',
                'tag' => 'Respiratory',
            ],
            [
                'title' => 'Yoga Therapy',
                'summary' =>
                    'Therapeutic yoga sessions tailored to your dosha and health goals. Combines asanas, pranayama, and meditation.',
                'image' => 'https://images.unsplash.com/photo-1589548234057-881a5d872453?q=80&w=1080',
                'duration' => '60-75 min',
                'tag' => 'Wellness',
            ],
        ];

        $testimonials = [
            [
                'name' => 'Priya Sharma',
                'location' => 'Bangalore',
                'rating' => 5,
                'text' =>
                    'The Panchakarma detox program transformed my health completely. I feel more energetic and balanced than I have in years.',
                'therapy' => 'Panchakarma Detox',
            ],
            [
                'name' => 'Rajesh Kumar',
                'location' => 'Chennai',
                'rating' => 5,
                'text' =>
                    'Abhyanga massage sessions have helped me manage my chronic back pain effectively. The therapists are truly skilled.',
                'therapy' => 'Abhyanga Massage',
            ],
            [
                'name' => 'Anita Desai',
                'location' => 'Mumbai',
                'rating' => 5,
                'text' =>
                    'Shirodhara therapy helped me overcome my anxiety and sleep issues. Its incredibly relaxing and healing.',
                'therapy' => 'Shirodhara Therapy',
            ],
        ];

        $faqs = [
            [
                'q' => 'How do I choose the right therapy for my condition?',
                'a' =>
                    'Our practitioners will conduct a consultation including pulse diagnosis and dosha assessment to recommend suitable therapies.',
            ],
            [
                'q' => 'Are the therapies safe for everyone?',
                'a' =>
                    'Generally yes when administered by qualified practitioners. We assess each client and adapt treatments for safety.',
            ],
            [
                'q' => 'How many sessions will I need?',
                'a' =>
                    'It varies—acute conditions fewer, chronic conditions may need extended plans. We will advise after assessment.',
            ],
            [
                'q' => 'Can I combine multiple therapies?',
                'a' => 'Yes — integrated plans often combine therapies for optimal results.',
            ],
            [
                'q' => 'What should I expect during my first visit?',
                'a' => 'A detailed consultation, pulse diagnosis and a personalized plan with schedule and follow-up.',
            ],
        ];
    @endphp

    <div class="min-h-screen bg-background text-foreground">
        <div class="mx-auto">

            {{-- HERO --}}
            <section class="relative py-16 lg:py-24 bg-gradient-to-br from-muted/30 to-background px-9">
                <div class="text-center space-y-6  mx-auto">
                    <div class="inline-block bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-semibold">
                        Authentic Healing Therapies</div>

                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-semibold leading-tight">
                        Discover Ancient <span class="text-primary">Ayurvedic Therapies</span>
                    </h1>

                    <p class="text-xl text-muted-foreground leading-relaxed">
                        Experience time-tested treatments designed to restore balance, eliminate toxins, and promote natural
                        healing.
                    </p>

                    {{-- Appointment dialog using Alpine --}}
                    <div x-data="{ open: false }" class="mt-6">
                        <button @click="open=true" class="btn-primary inline-flex items-center gap-2">
                            {{-- calendar svg --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor">
                                <rect x="3" y="5" width="18" height="16" rx="2" ry="2"
                                    stroke-width="1.5" />
                                <path stroke-width="1.5" d="M16 3v4M8 3v4M3 11h18" />
                            </svg>
                            Start Your Healing Journey
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor">
                                <path d="M5 12h14M12 5l7 7-7 7" stroke-width="1.5" />
                            </svg>
                        </button>

                        {{-- Modal --}}
                        <div x-show="open" x-cloak class="fixed inset-0 z-40 flex items-center justify-center p-4">
                            <div @click.self="open=false" class="absolute inset-0 bg-black/40"></div>
                            <div class="relative bg-card rounded-2xl w-full max-w-4xl p-6 z-50 shadow-xl">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold">Book Your Consultation</h3>
                                    <button @click="open=false" aria-label="Close"
                                        class="text-muted-foreground">&times;</button>
                                </div>

                                {{-- simple appointment form (swap action) --}}
                                <form action="#" method="POST" class="space-y-3">
                                    @csrf
                                    <input name="name" required placeholder="Your name"
                                        class="w-full px-3 py-2 rounded-lg border border-border" />
                                    <input name="phone" required placeholder="Phone number"
                                        class="w-full px-3 py-2 rounded-lg border border-border" />
                                    <input name="email" placeholder="Email (optional)"
                                        class="w-full px-3 py-2 rounded-lg border border-border" />
                                    <textarea name="notes" rows="3" placeholder="Notes (optional)"
                                        class="w-full px-3 py-2 rounded-lg border border-border"></textarea>

                                    <div class="flex items-center justify-between gap-3">
                                        <button type="submit" class="btn-primary">Request Consultation</button>
                                        <button type="button" @click="open=false" class="btn-secondary">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- INTRO / IMAGE --}}
            <section class="py-16 lg:py-24 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <div class="order-2 lg:order-1">
                        <img src="https://images.unsplash.com/photo-1667199021925-5778681d0406?q=80&w=1080" alt="ayurveda"
                            class="w-full h-[400px] lg:h-[500px] object-cover rounded-3xl shadow-xl" />
                    </div>

                    <div class="order-1 lg:order-2 space-y-6">
                        <h2 class="text-3xl lg:text-4xl font-semibold">Holistic Healing Through Ancient Wisdom</h2>

                        <div class="text-muted-foreground leading-relaxed space-y-3">
                            <p>Our therapeutic treatments are rooted in 5,000 years of Ayurvedic tradition, carefully
                                adapted for modern wellness needs. Each therapy is designed to address not just symptoms,
                                but the root causes of imbalance.</p>
                            <p>From deep detoxification through Panchakarma to gentle healing massages, our comprehensive
                                range of therapies offers natural solutions for physical, mental, and emotional wellbeing.
                            </p>
                        </div>

                        <div class="grid grid-cols-3 gap-4 pt-4">
                            <div class="text-center">
                                <div class="bg-primary/10 rounded-full p-3 w-fit mx-auto mb-2"><svg
                                        class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 2v20" stroke="currentColor" stroke-width="2" />
                                    </svg></div>
                                <div class="text-sm font-medium text-foreground">Natural</div>
                                <div class="text-xs text-muted-foreground">100% Herbal</div>
                            </div>
                            <div class="text-center">
                                <div class="bg-primary/10 rounded-full p-3 w-fit mx-auto mb-2"><svg
                                        class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 2v20" stroke="currentColor" stroke-width="2" />
                                    </svg></div>
                                <div class="text-sm font-medium text-foreground">Gentle</div>
                                <div class="text-xs text-muted-foreground">Non-invasive</div>
                            </div>
                            <div class="text-center">
                                <div class="bg-primary/10 rounded-full p-3 w-fit mx-auto mb-2"><svg
                                        class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 2v20" stroke="currentColor" stroke-width="2" />
                                    </svg></div>
                                <div class="text-sm font-medium text-foreground">Effective</div>
                                <div class="text-xs text-muted-foreground">Proven Results</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- FILTER BAR (placeholder) --}}
            <section class="py-8 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row items-center gap-4 justify-between">
                    <div class="flex items-center gap-3">
                        <select class="border border-border rounded-lg px-3 py-2">
                            <option>All categories</option>
                            <option>Detox</option>
                            <option>Massage</option>
                        </select>
                        <select class="border border-border rounded-lg px-3 py-2">
                            <option>All durations</option>
                            <option>30-60</option>
                            <option>60+</option>
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button class="btn-secondary">Reset</button>
                        <button class="btn-primary">Apply</button>
                    </div>
                </div>
            </section>

            {{-- THERAPIES GRID --}}
            <section class="py-16 lg:py-24 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center space-y-4 mb-12">
                    <h2 class="text-3xl lg:text-4xl font-semibold">Our Therapeutic Treatments</h2>
                    <p class="text-lg text-muted-foreground   mx-auto">Choose from our comprehensive range of authentic
                        Ayurvedic therapies, each designed to target specific health concerns and wellness goals.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($therapies as $therapy)
                        <article class="card rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition">
                            <div class="h-44 bg-gray-100 overflow-hidden">
                                <img src="{{ $therapy['image'] }}" alt="{{ $therapy['title'] }}"
                                    class="w-full h-full object-cover" />
                            </div>

                            <div class="p-5 space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-muted-foreground">{{ $therapy['tag'] }}</div>
                                    <div class="text-xs text-muted-foreground">{{ $therapy['duration'] }}</div>
                                </div>

                                <h3 class="text-lg font-semibold text-foreground">{{ $therapy['title'] }}</h3>
                                <p class="text-sm text-muted-foreground leading-relaxed">{{ $therapy['summary'] }}</p>

                                <div class="pt-3 flex gap-3 items-center">
                                    <a href="#booking" class="btn-primary inline-flex items-center gap-2 text-sm">Book</a>
                                    <a href="#" class="text-sm text-primary underline">Learn more</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            {{-- TESTIMONIALS: scroll-snap carousel (1/2/3 responsive) --}}
            <section class="py-16 lg:py-24 bg-muted/30 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl lg:text-4xl font-semibold">What Our Patients Say</h2>
                    <p class="text-lg text-muted-foreground  mx-auto">Real stories from people who have experienced the
                        transformative power of Ayurvedic healing.</p>
                </div>

                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex gap-2">
                            <button id="test-prev" class="rounded-full border border-border p-2 hover:bg-primary/10"
                                aria-label="Previous">&#10094;</button>
                            <button id="test-next" class="rounded-full border border-border p-2 hover:bg-primary/10"
                                aria-label="Next">&#10095;</button>
                        </div>

                        <div id="test-dots" class="flex gap-2"></div>
                    </div>

                    <div id="testimonials" class="testimonials-snap overflow-x-auto no-scrollbar flex gap-6 pb-4">
                        @foreach ($testimonials as $t)
                            <article
                                class="testimonial-card bg-card rounded-2xl border border-border p-6 max-w-md flex-shrink-0">
                                <div class="flex items-start  flex-col">
                                    <div>
                                        <div class="flex items-center gap-2 mb-2">
                                            @for ($i = 0; $i < 5; $i++)
                                                <svg class="w-4 h-4 {{ $i < $t['rating'] ? 'text-yellow-400' : 'text-gray-300' }}"
                                                    viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M12 .587l3.668 7.568L24 9.423l-6 5.854L19.335 24 12 19.771 4.665 24 6 15.277 0 9.423l8.332-1.268z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <blockquote class="italic text-foreground leading-relaxed">"{{ $t['text'] }}"
                                        </blockquote>
                                        <div
                                            class="mt-3 text-xs text-primary font-medium bg-primary/10 inline-block px-3 py-1 rounded-full">
                                            {{ $t['therapy'] }}</div>
                                    </div>

                                    <div class="px-4 text-right flex justify-between w-full mt-6">
                                        <div
                                            class="w-12 h-12 rounded-full bg-muted/10 flex items-center justify-center text-muted-foreground">
                                            A</div>

                                        <div>
                                            <div class="text-sm mt-2 font-medium">{{ $t['name'] }}</div>
                                            <div class="text-xs text-muted-foreground">{{ $t['location'] }}</div>
                                        </div>

                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                {{-- small style for no-scrollbar and snap behavior --}}
                <style>
                    .no-scrollbar::-webkit-scrollbar {
                        display: none;
                    }

                    .no-scrollbar {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                    }

                    .testimonials-snap {
                        scroll-snap-type: x mandatory;
                        -webkit-overflow-scrolling: touch;
                    }

                    .testimonial-card {
                        scroll-snap-align: center;
                    }

                    @media(min-width:768px) {
                        .testimonial-card {
                            min-width: 48%;
                        }
                    }

                    @media(min-width:1024px) {
                        .testimonial-card {
                            min-width: 32%;
                        }
                    }
                </style>

                {{-- carousel JS (scroll-snap friendly) --}}
                <script>
                    (function() {
                        const container = document.getElementById('testimonials');
                        if (!container) return;
                        const prev = document.getElementById('test-prev');
                        const next = document.getElementById('test-next');
                        const dots = document.getElementById('test-dots');
                        const cards = Array.from(container.querySelectorAll('.testimonial-card'));

                        function itemsPerView() {
                            const w = window.innerWidth;
                            if (w < 768) return 1;
                            if (w < 1024) return 2;
                            return 3;
                        }

                        function buildDots() {
                            dots.innerHTML = '';
                            const pages = Math.ceil(cards.length / itemsPerView());
                            for (let i = 0; i < pages; i++) {
                                const btn = document.createElement('button');
                                btn.className = 'w-2 h-2 rounded-full transition-colors bg-border';
                                btn.dataset.index = i;
                                btn.addEventListener('click', () => scrollToPage(i));
                                dots.appendChild(btn);
                            }
                            updateDots();
                        }

                        function scrollToPage(i) {
                            const per = itemsPerView();
                            const index = i * per;
                            const target = cards[Math.min(index, cards.length - 1)];
                            if (target) {
                                container.scrollTo({
                                    left: target.offsetLeft - (container.clientWidth - target.clientWidth) / 2,
                                    behavior: 'smooth'
                                });
                            }
                            updateDots();
                        }

                        function updateDots() {
                            const per = itemsPerView();
                            const pages = Math.ceil(cards.length / per);
                            const left = container.scrollLeft;
                            const pageWidth = container.clientWidth;
                            let active = 0;
                            // compute active page by nearest card center
                            let minDiff = Infinity;
                            cards.forEach((c, idx) => {
                                const center = c.offsetLeft + c.offsetWidth / 2 - container.scrollLeft;
                                const diff = Math.abs(center - container.clientWidth / 2);
                                if (diff < minDiff) {
                                    minDiff = diff;
                                    active = Math.floor(idx / per);
                                }
                            });
                            Array.from(dots.children).forEach((d, i) => {
                                d.classList.toggle('bg-primary', i === active);
                                d.classList.toggle('bg-border', i !== active);
                            });
                        }

                        prev.addEventListener('click', () => {
                            // scroll left by container width
                            container.scrollBy({
                                left: -container.clientWidth,
                                behavior: 'smooth'
                            });
                        });
                        next.addEventListener('click', () => {
                            container.scrollBy({
                                left: container.clientWidth,
                                behavior: 'smooth'
                            });
                        });

                        // rebuild dots on resize
                        let t;
                        window.addEventListener('resize', () => {
                            clearTimeout(t);
                            t = setTimeout(() => {
                                buildDots();
                            }, 120);
                        });
                        container.addEventListener('scroll', () => {
                            window.requestAnimationFrame(updateDots);
                        });

                        // init
                        buildDots();
                    })();
                </script>
            </section>

            {{-- CTA BAND --}}
            <section class="py-16 bg-gradient-to-r from-primary to-secondary mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-2xl p-6 bg-white/6 border border-white/8 text-white">
                    <div class="grid lg:grid-cols-2 gap-8 items-center max-w-[1100px] mx-auto">
                        <div>
                            <h3 class="text-2xl lg:text-3xl font-semibold">Ready to Begin Your Healing Journey?</h3>
                            <p class="text-white/90 leading-relaxed">Book a consultation with our experienced practitioners
                                and discover which therapies are best suited for your unique needs.</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <form method="POST" action="#" class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                @csrf
                                <input name="name" placeholder="Your Name"
                                    class="px-3 py-2 rounded-lg bg-white/20 border border-white/30 text-white" />
                                <input name="phone" placeholder="Phone Number"
                                    class="px-3 py-2 rounded-lg bg-white/20 border border-white/30 text-white" />
                            </form>

                            <div class="flex gap-3">
                                <a href="#booking" class="btn-primary w-full inline-flex items-center justify-center">Book
                                    Free Consultation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- FAQ accordion (Alpine) --}}
            <section class="py-16 lg:py-24 mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-[900px] mx-auto">
                    <h2 class="text-3xl lg:text-4xl font-semibold text-center mb-6">Frequently Asked Questions</h2>

                    <div class="space-y-3">
                        @foreach ($faqs as $i => $f)
                            <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }" class="border border-border rounded-lg overflow-hidden">
                                <button @click="open = !open"
                                    class="w-full flex items-center justify-between px-4 py-3 bg-card">
                                    <div class="text-left">
                                        <div class="font-medium">{{ $f['q'] }}</div>
                                    </div>
                                    <div class="text-muted-foreground" x-text="open ? '-' : '+'"></div>
                                </button>
                                <div x-show="open" x-cloak class="px-4 py-4 bg-white/50 text-muted-foreground">
                                    {!! nl2br(e($f['a'])) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
