{{-- resources\views\pages\TherapyPage.blade.php --}}
@extends('layouts.app')

@section('content')
    @php
        // Keep local fallbacks only when controller didn't pass data
        if (!isset($testimonials)) {
            $testimonials = collect([
                [
                    'name' => 'Priya Sharma',
                    'location' => 'Bangalore',
                    'rating' => 5,
                    'text' => 'The Panchakarma detox program transformed my health completely...',
                    'therapy' => 'Panchakarma Detox',
                ],
            ]);
        }

        if (!isset($faqs)) {
            $faqs = [
                ['q' => 'What is Ayurvedic therapy?', 'a' => 'Ayurvedic therapy involves traditional healing treatments...'],
                ['q' => 'How long does a session take?', 'a' => 'Sessions typically last 60-90 minutes...'],
            ];
        }

        // Ensure categories exist for filtering
        if (!isset($categories)) {
            $categories = ['Detox', 'Relaxation', 'Therapeutic'];
        }
        $therapyCollection = collect($therapies ?? []);
    @endphp

    <div class="min-h-screen bg-background text-foreground">
        {{-- HERO SECTION --}}
        <section class="relative py-16 lg:py-24 bg-gradient-to-br from-muted/30 to-background"
            aria-labelledby="hero-heading">
            <div class="max-w-[1100px] mx-auto px-5 text-center">
                <div class="inline-block bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-semibold mb-4">
                    Authentic Healing Therapies
                </div>

                <h1 id="hero-heading" class="text-4xl lg:text-5xl xl:text-6xl font-semibold leading-tight mb-4">
                    Discover Ancient <span class="text-primary">Ayurvedic Therapies</span>
                </h1>

                <p class="text-xl text-muted-foreground leading-relaxed mx-auto mb-6  ">
                    Experience time-tested treatments designed to restore balance, eliminate toxins, and promote natural
                    healing.
                </p>

                <div class="mt-6">
                    <button type="button" class="btn-primary inline-flex items-center gap-2" id="open-booking-from-hero"
                        data-booking data-source="therapy-page">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="16" rx="2" ry="2" stroke-width="1.5" />
                            <path stroke-width="1.5" d="M16 3v4M8 3v4M3 11h18" />
                        </svg>
                        Start Your Healing Journey
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" stroke-width="1.5" />
                        </svg>

                    </button>
                </div>
            </div>
        </section>

        {{-- INTRO SECTION --}}
        <section class="py-16 lg:py-24" aria-labelledby="intro-heading">
            <div class="max-w-[1100px] mx-auto px-5">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <div class="order-2 lg:order-1">
                        <img src="https://images.unsplash.com/photo-1667199021925-5778681d0406?q=80&w=1080"
                            alt="Ayurvedic therapy session showing traditional healing techniques"
                            class="w-full h-[400px] lg:h-[500px] object-cover rounded-3xl shadow-xl" loading="lazy" />
                    </div>

                    <div class="order-1 lg:order-2 space-y-6">
                        <h2 id="intro-heading" class="text-3xl lg:text-4xl font-semibold">Holistic Healing Through Ancient
                            Wisdom</h2>

                        <div class="text-muted-foreground leading-relaxed space-y-4">
                            <p>Our therapeutic treatments are rooted in 5,000 years of Ayurvedic tradition, carefully
                                adapted for modern wellness needs. Each therapy is designed to address not just symptoms,
                                but the root causes of imbalance.</p>
                            <p>From deep detoxification through Panchakarma to gentle healing massages, our comprehensive
                                range of therapies offers natural solutions for physical, mental, and emotional wellbeing.
                            </p>
                        </div>

                        <div class="grid grid-cols-3 gap-4 pt-4" role="list" aria-label="Therapy benefits">
                            <div class="text-center" role="listitem">
                                <div class="bg-primary/10 rounded-full p-3 w-fit mx-auto mb-2" aria-hidden="true">
                                    <svg class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke-width="2" />
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-foreground">Natural</div>
                                <div class="text-xs text-muted-foreground">100% Herbal</div>
                            </div>
                            <div class="text-center" role="listitem">
                                <div class="bg-primary/10 rounded-full p-3 w-fit mx-auto mb-2" aria-hidden="true">
                                    <svg class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path
                                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                            stroke-width="2" />
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-foreground">Gentle</div>
                                <div class="text-xs text-muted-foreground">Non-invasive</div>
                            </div>
                            <div class="text-center" role="listitem">
                                <div class="bg-primary/10 rounded-full p-3 w-fit mx-auto mb-2" aria-hidden="true">
                                    <svg class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" />
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-foreground">Effective</div>
                                <div class="text-xs text-muted-foreground">Proven Results</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FILTERS SECTION --}}
        <section class="py-8 mx-auto px-4 sm:px-6 lg:px-8" aria-labelledby="filters-heading">
            <div class="max-w-[1100px] mx-auto">
                <h2 id="filters-heading" class="sr-only">Therapy Filters</h2>
                <div class="flex flex-col sm:flex-row items-center gap-4 justify-between">
                    <div class="flex items-center gap-3">
                        <label for="filterCategory" class="sr-only">Filter by category</label>
                        <select id="filterCategory"
                            class="border border-border rounded-lg px-3 py-2 bg-background min-w-[150px]">
                            <option value="all">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ \Illuminate\Support\Str::slug(strtolower($cat)) }}">{{ $cat }}</option>
                            @endforeach
                        </select>

                        <label for="filterDuration" class="sr-only">Filter by duration</label>
                        <select id="filterDuration"
                            class="border border-border rounded-lg px-3 py-2 bg-background min-w-[150px]">
                            <option value="all">All Durations</option>
                            <option value="short">Up to 30 mins</option>
                            <option value="mid">31 - 60 mins</option>
                            <option value="long">60+ mins</option>
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button id="therapyReset" type="button" class="btn-secondary">Reset Filters</button>
                    </div>
                </div>
            </div>
        </section>

        {{-- THERAPIES GRID --}}
        <section class="py-16 lg:py-24 mx-auto px-4 sm:px-6 lg:px-8" aria-labelledby="therapies-heading">
            <div class="max-w-[1100px] mx-auto">
                <div class="text-center space-y-4 mb-12">
                    <h2 id="therapies-heading" class="text-3xl lg:text-4xl font-semibold">Our Therapeutic Treatments</h2>
                    <p class="text-lg text-muted-foreground mx-auto  ">
                        Choose from our comprehensive range of authentic Ayurvedic therapies, each designed to target
                        specific health concerns and wellness goals.
                    </p>
                </div>

                <div id="therapiesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" role="list"
                    aria-label="List of therapies">
                    @forelse ($therapyCollection as $therapy)
                        @php
                            $cat = is_object($therapy) ? ($therapy->category ?? '') : ($therapy['category'] ?? '');
                            $catSlug = \Illuminate\Support\Str::slug(strtolower($cat));
                            $durationRaw = is_object($therapy) ? ($therapy->duration ?? '') : ($therapy['duration'] ?? '');
                            preg_match('/\d+/', (string) $durationRaw, $m);
                            $durationInt = isset($m[0]) ? (int) $m[0] : null;
                        @endphp

                        <div class="therapy-card-wrap" data-category="{{ $catSlug }}" data-duration="{{ $durationInt ?? '' }}"
                            role="listitem">
                            <x-therapy.therapy-card :therapy="$therapy" />
                        </div>
                    @empty
                        <div class="col-span-full text-center text-muted-foreground py-8">
                            No therapies available at the moment. Please check back later.
                        </div>
                    @endforelse
                </div>

                <div id="therapiesNoResults" class="text-center text-muted-foreground mt-8 hidden" aria-live="polite">
                    No therapies match your selected filters. Try adjusting your criteria.
                </div>
            </div>
        </section>

        {{-- TESTIMONIALS --}}
        <section class="py-16 lg:py-24 bg-muted/30 mx-auto px-4 sm:px-6 lg:px-8" aria-labelledby="testimonials-heading">
            <div class="max-w-[1100px] mx-auto">
                <div class="text-center mb-12">
                    <h2 id="testimonials-heading" class="text-3xl lg:text-4xl font-semibold">What Our Patients Say</h2>
                    <p class="text-lg text-muted-foreground mx-auto ">
                        Real stories from people who have experienced the transformative power of Ayurvedic healing.
                    </p>
                </div>

                <div class="relative">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex gap-2">
                            <button id="test-prev"
                                class="rounded-full border border-border p-2 hover:bg-primary/10 transition-colors"
                                aria-label="Previous testimonial">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button id="test-next"
                                class="rounded-full border border-border p-2 hover:bg-primary/10 transition-colors"
                                aria-label="Next testimonial">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <div id="test-dots" class="flex gap-2" role="tablist" aria-label="Testimonial navigation"></div>
                    </div>

                    <div id="testimonials" class="testimonials-snap overflow-x-auto no-scrollbar flex gap-6 pb-4"
                        role="region" aria-label="Testimonials carousel">
                        @forelse ($testimonials as $index => $t)
                            @php
                                // Normalize fields (support object or array)
                                $therapyName = optional($t->therapy)->title ?? ($t->therapy ?? ($t['therapy'] ?? ''));
                                $rating = (int) ($t->rating ?? ($t['rating'] ?? 0));
                                $rating = max(0, min(5, $rating)); // clamp 0..5

                                $avatar = $t->avatar ?? ($t['avatar'] ?? null);
                                $avatarSrc = null;
                                if (!empty($avatar)) {
                                    $avatar = trim($avatar);
                                    $isUrl = preg_match('/^(https?:)?\\/\\//', $avatar) || str_starts_with($avatar, '/');
                                    $avatarSrc = $isUrl ? $avatar : asset('storage/' . ltrim($avatar, '/'));
                                }

                                $name = $t->name ?? ($t['name'] ?? '');
                                $location = $t->location ?? ($t['location'] ?? '');
                                $text = $t->text ?? ($t['text'] ?? '');
                            @endphp

                            <x-home.testimonial-card :name="$name" :location="$location" :avatar="$avatarSrc" :rating="$rating"
                                :text="$text" :treatment="$therapyName" :isVideo="false" class="testimonial-card" />
                        @empty
                            <div class="text-muted-foreground text-center w-full py-8">No testimonials available yet.</div>
                        @endforelse
                    </div>


                </div>
            </div>
        </section>

        {{-- CTA SECTION --}}
        <x-contact.BookFreeConsultation />

        {{-- FAQ SECTION --}}
        <section class="py-16 lg:py-24 mx-auto px-4 sm:px-6 lg:px-8" aria-labelledby="faq-heading">
            <div class="max-w-[900px] mx-auto">
                <h2 id="faq-heading" class="text-3xl lg:text-4xl font-semibold text-center mb-6">Frequently Asked Questions
                </h2>

                <div class="space-y-3" role="list">
                    @foreach ($faqs as $i => $f)
                        <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }"
                            class="border border-border rounded-lg overflow-hidden" role="listitem">
                            <button @click="open = !open"
                                class="w-full flex items-center justify-between px-4 py-3 bg-card hover:bg-muted/30 transition-colors text-left"
                                :aria-expanded="open" aria-controls="faq-{{ $i }}">
                                <div class="font-medium">{{ $f['q'] }}</div>
                                <div class="text-muted-foreground text-lg font-semibold" x-text="open ? '−' : '+'"></div>
                            </button>
                            <div x-show="open" x-cloak id="faq-{{ $i }}" class="px-4 py-4 bg-white/50 text-muted-foreground">
                                {!! nl2br(e($f['a'])) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

      {{-- Full-width SEO Content Section --}}
        <div class="w-full bg-gradient-to-br from-primary/5 via-background to-secondary/5  ">
            <div class="max-w-7xl mx-auto px-4 py-16 lg:py-24">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-primary mb-4">
                        Discover Authentic Ayurvedic Healing
                    </h2>
                    <!-- <p class="text-lg text-muted-foreground  mx-auto">
                        Experience the ancient wisdom of Ayurveda at Jivanam Wellness in Coimbatore
                    </p> -->
                </div>

                {{-- Introduction Section --}}
                <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                    <h3 class="text-2xl font-bold mb-6 text-primary flex items-center gap-3">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                        Authentic Ayurvedic Treatment in Coimbatore
                    </h3>
                    <div class="therapy-content text-muted-foreground">
                        <p class="text-base leading-relaxed">Ayurveda is one of the world's oldest holistic healing systems,
                            originating in India more than 5,000 years ago. The word Ayurveda means <span
                                class="font-semibold">"science of life"</span>, and it focuses on maintaining balance
                            between the body, mind, and spirit. At <span class="font-bold">Jivanam Wellness</span>, we
                            provide authentic <span class="font-semibold">Ayurvedic treatment in Coimbatore</span> using
                            traditional therapies that address the root cause of health conditions rather than only managing
                            symptoms.</p>

                        <p class="text-base leading-relaxed mt-4">Unlike modern treatments that often focus on temporary
                            relief, Ayurveda emphasizes long-term healing by restoring the body's natural balance. Ayurvedic
                            therapies include herbal medicines, therapeutic massages, detoxification procedures, dietary
                            guidance, and lifestyle corrections. These treatments help improve overall health, strengthen
                            immunity, and promote natural healing.</p>
                        <p class="text-base leading-relaxed mt-4">Our clinic follows classical Ayurvedic principles and
                            combines them with modern diagnostic understanding to offer safe and effective treatments.
                            Patients visiting Jivanam Wellness for <span class="font-semibold">Ayurvedic therapy in
                                Coimbatore</span> receive personalized treatment plans designed according to their body
                            constitution and specific health concerns.</p>
                        <p class="text-base leading-relaxed mt-4">Ayurvedic therapy can help manage a wide range of health
                            conditions, including chronic pain, joint problems, stress, digestive disorders, lifestyle
                            diseases, and general wellness concerns. Through traditional therapies and natural herbal
                            medicines, Ayurveda works to restore balance in the body and support long-term health.</p>
                        <p class="text-base leading-relaxed mt-4">At Jivanam Wellness, our goal is to help patients achieve
                            better health through authentic Ayurvedic practices that have been trusted for generations.</p>
                    </div>
                </section>

                {{-- Benefits Section --}}
                <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                    <h4 class="text-xl font-semibold mb-6 text-secondary">Benefits of Ayurvedic Therapy</h4>
                    <p class="text-base leading-relaxed text-muted-foreground">
                        Ayurvedic treatments offer several benefits for both physical and mental well-being. Many people
                        today are turning to Ayurveda because it focuses on natural healing and preventive care. <br>
                        Some key benefits of <span class="font-semibold">Ayurvedic treatment in Coimbatore</span> include:

                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-4 bg-background/50 rounded-lg">
                            <div
                                class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 text-2xl">
                                🌿
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Natural Healing</h5>
                                <p class="text-muted-foreground mt-1">Ayurveda uses natural herbs, oils, and therapies that
                                    support the body's natural ability to heal itself.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 bg-background/50 rounded-lg">
                            <div
                                class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 text-2xl">
                                🎯
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Treating the Root Cause</h5>
                                <p class="text-muted-foreground mt-1">Instead of just addressing symptoms, Ayurvedic therapy
                                    identifies the underlying cause of health problems and works to correct the imbalance.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 bg-background/50 rounded-lg">
                            <div
                                class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 text-2xl">
                                👤
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Personalized Treatment</h5>
                                <p class="text-muted-foreground mt-1">Every person has a unique body constitution. Ayurvedic
                                    doctors create customized treatment plans tailored to each patient.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 bg-background/50 rounded-lg">
                            <div
                                class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 text-2xl">
                                🛡️
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Improved Immunity</h5>
                                <p class="text-muted-foreground mt-1">Ayurvedic therapies help strengthen the immune system
                                    and improve the body's resistance to illness.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 bg-background/50 rounded-lg">
                            <div
                                class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 text-2xl">
                                🌅
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Stress Reduction</h5>
                                <p class="text-muted-foreground mt-1">Many Ayurvedic therapies promote relaxation and mental
                                    balance, helping reduce stress and improve overall well-being.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 bg-background/50 rounded-lg">
                            <div
                                class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center flex-shrink-0 text-2xl">
                                🌱
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Long-Term Wellness</h5>
                                <p class="text-muted-foreground mt-1">By focusing on lifestyle, diet, and preventive care,
                                    Ayurveda supports long-term health and sustainable wellness.</p>
                            </div>
                        </div>
                        <p class="text-base leading-relaxed text-muted-foreground">
                            These benefits make Ayurveda a trusted natural healthcare system for individuals seeking safe
                            and effective healing solutions.
                        </p>
                    </div>
                </section>

                {{-- Popular Therapies --}}
                <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                    <h4 class="text-xl font-semibold mb-6 text-secondary">Popular Ayurvedic Therapies at Jivanam Wellness
                    </h4>
                    <p class="text-base leading-relaxed text-muted-foreground">
                        At <b>Jivanam Wellness</b>, we offer a wide range of traditional Ayurvedic therapies that are
                        designed to restore the body’s natural balance and promote long-term health. These therapies are
                        performed by trained therapists under the guidance of experienced Ayurvedic doctors to ensure safe
                        and effective results.
                        <br> Our clinic provides authentic <b>Ayurvedic therapy in Coimbatore</b>, using classical treatment
                        methods that have been practiced in Ayurveda for centuries. Each therapy is recommended after a
                        detailed consultation so that the treatment suits the patient’s body constitution and health
                        condition.
                        <br> Below are some of the most popular Ayurvedic therapies available at Jivanam Wellness.

                    </p>
                    <div class="space-y-6">
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-2"><a
                                    href="https://www.jivanamwellness.in/therapies/abhyangam-ayurveda-therapy-in-coimbatore"
                                    class="hover:text-primary/80 transition-colors">Abhyangam</a> (Ayurvedic Oil Massage)
                            </h5>
                            <p class="text-muted-foreground"><a
                                    href="https://www.jivanamwellness.in/therapies/abhyangam-ayurveda-therapy-in-coimbatore"
                                    class="underline">Abhyangam</a> is one of the most well-known Ayurvedic therapies. It is
                                a full-body massage performed using warm herbal oils that are carefully selected based on
                                the patient's body constitution. <br> This therapy helps improve blood circulation, relax
                                muscles, and nourish the skin while removing toxins from the body. Abhyangam is commonly
                                recommended for stress relief, fatigue, joint stiffness, and improving overall wellness.
                                <br>Many patients visiting Jivanam Wellness for <b>Ayurvedic treatment in Coimbatore</b>
                                choose Abhyangam therapy because it provides deep relaxation and promotes natural healing.
                            </p>
                        </div>
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-2"><a
                                    href="https://www.jivanamwellness.in/therapies/shirodhara-ayurveda-therapy-in-coimbatore"
                                    class="hover:text-primary/80 transition-colors">Shirodhara</a> Therapy</h5>
                            <p class="text-muted-foreground"><a
                                    href="https://www.jivanamwellness.in/therapies/shirodhara-ayurveda-therapy-in-coimbatore"
                                    class="underline">Shirodhara</a> is a unique Ayurvedic therapy where a continuous stream
                                of warm herbal oil or medicated liquid is gently poured over the forehead. This treatment is
                                known for its calming and balancing effects on the nervous system. <br> Shirodhara is often
                                recommended for conditions such as stress, anxiety, insomnia, headaches, and mental fatigue.
                                The therapy helps relax the mind and restore mental clarity. <br>
                                Patients seeking natural solutions for stress and mental well-being often benefit from
                                <b>Shirodhara therapy in Coimbatore</b> at Jivanam Wellness.
                            </p>
                        </div>
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-2">Panchakarma Detox Therapy</h5>
                            <p class="text-muted-foreground"><a
                                    href="https://www.jivanamwellness.in/therapies/virechana-panchakarma-treatment-coimbatore"
                                    class="underline">Panchakarma</a> is one of the most important detoxification
                                treatments in Ayurveda. It is a set of specialized therapies designed to remove toxins from
                                the body and restore balance to the doshas (Vata, Pitta, and Kapha).<br> Panchakarma
                                treatments
                                help cleanse the digestive system, improve metabolism, and strengthen immunity. It is often
                                recommended for individuals dealing with chronic health conditions, lifestyle disorders, and
                                long-term stress. <br>At Jivanam Wellness, Panchakarma therapy is performed under the
                                supervision of experienced Ayurvedic doctors, making it one of the most effective
                                <b>Panchakarma detox treatments in Coimbatore</b>.
                            </p>
                        </div>
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-2">Kizhi (Herbal Poultice Therapy)</h5>
                            <p class="text-muted-foreground"><a
                                    href="https://www.jivanamwellness.in/therapies/njavara-kizhi-ayurveda-therapy-in-coimbatore"
                                    class="underline">Kizhi therapy</a> involves the use of warm herbal bundles filled
                                with medicinal herbs, leaves, or powders. These bundles are heated and gently pressed or
                                massaged on specific areas of the body.<br> This therapy is commonly used for relieving
                                joint
                                pain, muscle stiffness, inflammation, and sports injuries. The herbal ingredients help
                                reduce pain and improve mobility naturally. <br>Patients suffering from musculoskeletal
                                conditions often choose <b>Kizhi therapy as part of their Ayurvedic treatment in Coimbatore.
                                </b></p>
                        </div>
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-2">Pizhichil (Oil Bath Therapy)</h5>
                            <p class="text-muted-foreground">Pizhichil is a traditional Ayurvedic therapy where warm
                                medicated oil is continuously poured over the body while gentle massage techniques are
                                performed. <br> This therapy is known for its rejuvenating effects and is often recommended
                                for
                                improving circulation, strengthening muscles, and supporting nervous system health.
                                <br>Pizhichil therapy is widely considered one of the most luxurious and effective Ayurvedic
                                treatments for overall wellness.
                            </p>
                        </div>
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-2">Njavarakizhi (Rice Bolus Therapy)</h5>
                            <p class="text-muted-foreground">Njavarakizhi is a specialized therapy that uses medicated rice
                                cooked in herbal decoctions and milk. The warm rice bundles are applied to the body through
                                massage-like movements. <br> This therapy is particularly beneficial for strengthening
                                muscles,
                                improving body nourishment, and supporting recovery from weakness or fatigue. <br>It is
                                commonly recommended for patients who require rejuvenation and strengthening therapies.</p>
                        </div>
                    </div>
                </section>

                {{-- Personalized Plans --}}
                <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                    <h4 class="text-xl font-semibold mb-6 text-secondary">Personalized Ayurvedic Therapy Plans</h4>
                    <div class="therapy-content text-muted-foreground">
                        <p class="text-base leading-relaxed">At <b>Jivanam Wellness</b>, every therapy is recommended only
                            after a
                            proper consultation with our experienced Ayurvedic doctors. Since every individual has a unique
                            body constitution, treatments are customized to suit the patient's specific health condition and
                            needs.</p>

                        <p class="text-base leading-relaxed mt-4">Our goal is to provide authentic <b>Ayurvedic therapy in
                                Coimbatore</b> that not only relieves symptoms but also promotes long-term health and
                            wellness. By
                            combining traditional therapies, herbal medicines, and lifestyle guidance, we help patients
                            restore balance and improve their overall quality of life.</p>

                        <p class="text-base leading-relaxed mt-4">Whether you are seeking treatment for chronic pain, stress
                            management, detoxification, or general wellness, our experienced team at Jivanam Wellness is
                            committed to providing safe and effective Ayurvedic care.</p>
                    </div>
                </section>

                {{-- Doctors --}}
                <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                    <h4 class="text-xl font-semibold mb-6 text-secondary">Our Experienced Ayurvedic Doctors</h4>

                    <p class="text-sm text-muted-foreground mt-2">At Jivanam Wellness, our treatments are guided by a team
                        of highly experienced Ayurvedic doctors who
                        follow authentic traditional practices. Each patient receives a personalized treatment plan after a
                        detailed consultation with our specialists. <br>
                        Our medical team has decades of combined experience in providing <b>Ayurvedic therapy in
                            Coimbatore</b>,
                        ensuring that every patient receives safe, effective, and personalized care.
                    </p>
                    <div class="space-y-4">

                        <div class="flex items-center gap-6 p-6 bg-background/50 rounded-lg">
                            <div
                                class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center font-bold text-primary text-xl">
                                JT
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Dr. Jananidhi T</h5>
                                <p class="text-muted-foreground">Ayurvedic Physician • 10+ Years Experience</p>
                                <p class="text-sm text-muted-foreground mt-2">Dr. Jananidhi T has more than 10 years of
                                    experience in Ayurvedic medicine and specializes in treating chronic pain, lifestyle
                                    disorders, and holistic wellness through traditional therapies and herbal treatments.
                                    <br>He focuses on identifying the root cause of health problems and designing
                                    personalized treatment plans that help restore the body’s natural balance.
                                    <br>Patients seeking <b>Ayurvedic treatment in Coimbatore</b> benefit from his extensive
                                    experience and dedication to natural healing methods.

                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 p-6 bg-background/50 rounded-lg">
                            <div
                                class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center font-bold text-primary text-xl">
                                SP
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Dr. Sanju P S</h5>
                                <p class="text-muted-foreground">Ayurvedic Physician • 10+ Years Experience</p>
                                <p class="text-sm text-muted-foreground mt-2">Dr. Sanju P S is an experienced Ayurvedic
                                    doctor known for her patient-centered approach and expertise in women's health, stress
                                    management, and natural healing therapies. <br>She emphasizes personalized care and
                                    holistic healing, ensuring that every patient receives treatments that address both
                                    physical and emotional well-being.
                                    <br>Her compassionate approach makes her a trusted physician for patients seeking
                                    authentic <b>Ayurvedic therapy in Coimbatore</b>.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 p-6 bg-background/50 rounded-lg">
                            <div
                                class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center font-bold text-primary text-xl">
                                VR
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Dr. Venkataraman</h5>
                                <p class="text-muted-foreground">Ayurvedic Physician • 15+ Years Experience</p>
                                <p class="text-sm text-muted-foreground mt-2">Dr. Venkataraman has over 15 years of
                                    experience in Ayurvedic treatment and is skilled in managing joint pain, back pain, and
                                    chronic health conditions using traditional Ayurvedic therapies. <br>His treatment
                                    approach combines herbal medicines, therapeutic massages, and Panchakarma therapies to
                                    help patients achieve long-term relief. <br>
                                    Patients visiting Jivanam Wellness for <b>Ayurvedic therapy in Coimbatore</b> benefit
                                    from his deep clinical knowledge and commitment to patient care.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 p-6 bg-background/50 rounded-lg">
                            <div
                                class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center font-bold text-primary text-xl">
                                TN
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Dr. Thrishnaj</h5>
                                <p class="text-muted-foreground">Ayurvedic Physician • 10+ Years Experience</p>
                                <p class="text-sm text-muted-foreground mt-2">With more than a decade of clinical
                                    experience, Dr. Thrishnaj focuses on providing effective Ayurvedic therapies for pain
                                    management and lifestyle-related health issues. <br>He carefully evaluates each
                                    patient’s condition and recommends therapies that promote natural healing and improve
                                    overall health. <br>
                                    His expertise contributes to the comprehensive Ayurvedic care provided at Jivanam
                                    Wellness.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 p-6 bg-background/50 rounded-lg">
                            <div
                                class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center font-bold text-primary text-xl">
                                VV
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-lg">Dr. Valsala Varier</h5>
                                <p class="text-muted-foreground">Chief Physician • 25+ Years Experience</p>
                                <p class="text-sm text-muted-foreground mt-2">Dr. Valsala Varier is the Chief Physician at
                                    Jivanam Wellness with more than 25 years of experience in Ayurveda. She has extensive
                                    expertise in authentic Ayurvedic therapies and has helped numerous patients achieve
                                    better health through natural healing methods.<br>Her deep understanding of classical
                                    Ayurvedic principles ensures that all treatments at Jivanam Wellness follow traditional
                                    standards while delivering effective results. <br>
                                    Patients seeking trusted Ayurvedic treatment in Coimbatore rely on her experience and
                                    guidance.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Clinic Locations --}}
                <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                    <h4 class="text-xl font-semibold mb-6 text-secondary text-center">Our Clinic Locations in Coimbatore
                    </h4>
                    <p class="text-muted-foreground text-center mb-6">Jivanam Wellness provides authentic Ayurvedic therapy through multiple clinics across Coimbatore so patients can conveniently access treatment.</p>
                    <div class="space-y-6">
                        <div class="text-center p-8 bg-background/50 rounded-xl border border-border/30">
                            <div
                                class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                                🏥
                            </div>
                            <h5 class="font-semibold text-primary text-xl mb-3">Sai Baba Colony</h5>
                            <p class="text-muted-foreground">Our Sai Baba Colony clinic serves patients from nearby areas
                                looking for reliable Ayurvedic therapy and personalized wellness treatments.</p>
                        </div>
                        <div class="text-center p-8 bg-background/50 rounded-xl border border-border/30">
                            <div
                                class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                                🏥
                            </div>
                            <h5 class="font-semibold text-primary text-xl mb-3">Race Course</h5>
                            <p class="text-muted-foreground">The Race Course branch provides authentic Ayurvedic therapies
                                and consultation services for patients seeking natural healing solutions in the central part
                                of Coimbatore.</p>
                        </div>
                        <div class="text-center p-8 bg-background/50 rounded-xl border border-border/30">
                            <div
                                class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                                🏥
                            </div>
                            <h5 class="font-semibold text-primary text-xl mb-3">Vadavalli</h5>
                            <p class="text-muted-foreground">Our Vadavalli clinic offers traditional Ayurvedic treatments
                                designed to help patients improve their health and well-being naturally.</p>
                        </div>
                    </div>
                    <div class="text-center mt-6">
                        <p class="text-muted-foreground">With multiple branches across Coimbatore, Jivanam Wellness has
                            become a trusted destination for individuals seeking <strong>Ayurvedic therapy</strong> in Coimbatore.</p>
                    </div>
                </section>

                {{-- FAQ Section --}}
                <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg">
                    <h4 class="text-xl font-semibold mb-8 text-secondary text-center">Frequently Asked Questions</h4>
                    <div class="space-y-6">
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-3">What is Ayurvedic treatment?</h5>
                            <p class="text-muted-foreground">Ayurvedic treatment is a traditional natural healthcare system
                                that focuses on balancing the body, mind, and spirit. It uses herbal medicines, therapeutic
                                massages, detoxification therapies, and lifestyle changes to promote healing and overall
                                wellness.</p>
                        </div>
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-3">Is Ayurvedic therapy safe?</h5>
                            <p class="text-muted-foreground">Yes, Ayurvedic therapy is generally safe when performed by
                                qualified Ayurvedic doctors. At Jivanam Wellness, all treatments are guided by experienced
                                physicians who follow authentic Ayurvedic practices.</p>
                        </div>
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-3">What conditions can Ayurveda treat?</h5>
                            <p class="text-muted-foreground">Ayurveda can help manage various conditions such as joint pain,
                                back pain, arthritis, digestive disorders, stress, lifestyle diseases, and general health
                                concerns.</p>
                        </div>
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-3">How long does Ayurvedic treatment take?</h5>
                            <p class="text-muted-foreground">The duration of treatment depends on the patient's health
                                condition and individual response to therapy. Some conditions improve within a few weeks,
                                while chronic conditions may require longer treatment plans.</p>
                        </div>
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-3">Do Ayurvedic treatments have side effects?
                            </h5>
                            <p class="text-muted-foreground">When prescribed correctly by qualified doctors, Ayurvedic
                                treatments typically have minimal side effects because they rely on natural herbs and
                                traditional therapies.</p>
                        </div>
                        <div class="p-6 bg-background/50 rounded-lg border border-border/30">
                            <h5 class="font-semibold text-primary text-lg mb-3">Why choose Jivanam Wellness for Ayurvedic
                                therapy in Coimbatore?</h5>
                            <p class="text-muted-foreground">Jivanam Wellness offers authentic Ayurvedic treatments guided
                                by experienced doctors, personalized care, and multiple clinic locations across Coimbatore,
                                making it a trusted destination for natural healing.</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
@endsection

@push('scripts')
    <script>
        // Scroll to booking function
        function scrollToBooking() {
            const target = document.querySelector('#booking');
            if (!target) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return;
            }

            if (!target.hasAttribute('tabindex')) {
                target.setAttribute('tabindex', '-1');
            }

            target.scrollIntoView({ behavior: 'smooth', block: 'start' });

            setTimeout(() => {
                try {
                    target.focus({ preventScroll: true });
                } catch (e) { /* ignore */ }
            }, 450);
        }

        // Handle hash navigation on page load
        document.addEventListener('DOMContentLoaded', () => {
            if (window.location.hash === '#booking') {
                setTimeout(() => {
                    const target = document.querySelector('#booking');
                    if (target) {
                        if (!target.hasAttribute('tabindex')) target.setAttribute('tabindex', '-1');
                        target.focus({ preventScroll: true });
                    }
                }, 250);
            }

            // Add click event to scroll button
            const scrollButton = document.getElementById('scroll-to-booking');
            if (scrollButton) {
                scrollButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    scrollToBooking();
                });
            }
        });

        // Therapy filtering functionality
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('filterCategory');
            const durationSelect = document.getElementById('filterDuration');
            const resetBtn = document.getElementById('therapyReset');
            const grid = document.getElementById('therapiesGrid');
            const noResults = document.getElementById('therapiesNoResults');

            if (!grid) return;

            function applyFilters() {
                const cat = (categorySelect?.value || 'all').toString();
                const dur = (durationSelect?.value || 'all').toString();
                const cards = Array.from(grid.querySelectorAll('.therapy-card-wrap'));
                let visibleCount = 0;

                cards.forEach(card => {
                    const c = (card.dataset.category || '').toString();
                    const d = parseInt(card.dataset.duration) || NaN;
                    let ok = true;

                    // Category filter
                    if (cat !== 'all' && c !== cat) ok = false;

                    // Duration filter
                    if (ok && dur !== 'all') {
                        if (dur === 'short') {
                            if (!(Number.isFinite(d) && d <= 30)) ok = false;
                        } else if (dur === 'mid') {
                            if (!(Number.isFinite(d) && d > 30 && d <= 60)) ok = false;
                        } else if (dur === 'long') {
                            if (!(Number.isFinite(d) && d > 60)) ok = false;
                        }
                    }

                    card.style.display = ok ? '' : 'none';
                    if (ok) visibleCount++;
                });

                // Show/hide no results message
                if (noResults) {
                    noResults.classList.toggle('hidden', visibleCount > 0);
                    grid.classList.toggle('hidden', visibleCount === 0);
                }
            }

            // Event listeners
            if (categorySelect) categorySelect.addEventListener('change', applyFilters);
            if (durationSelect) durationSelect.addEventListener('change', applyFilters);

            if (resetBtn) {
                resetBtn.addEventListener('click', () => {
                    if (categorySelect) categorySelect.value = 'all';
                    if (durationSelect) durationSelect.value = 'all';
                    applyFilters();
                });
            }

            // Initialize filters
            applyFilters();
        });

        // Testimonials carousel functionality
        document.addEventListener('DOMContentLoaded', function () {
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
                if (!dots) return;

                dots.innerHTML = '';
                const pages = Math.ceil(cards.length / itemsPerView());

                for (let i = 0; i < pages; i++) {
                    const btn = document.createElement('button');
                    btn.className = 'w-2 h-2 rounded-full transition-colors bg-border';
                    btn.setAttribute('role', 'tab');
                    btn.setAttribute('aria-selected', i === 0 ? 'true' : 'false');
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
                if (!dots) return;

                const per = itemsPerView();
                let active = 0;
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
                    const isActive = i === active;
                    d.classList.toggle('bg-primary', isActive);
                    d.classList.toggle('bg-border', !isActive);
                    d.setAttribute('aria-selected', isActive ? 'true' : 'false');
                });
            }

            if (prev && next) {
                prev.addEventListener('click', () => {
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
            }

            // Rebuild dots on resize
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    buildDots();
                }, 120);
            });

            container.addEventListener('scroll', () => {
                window.requestAnimationFrame(updateDots);
            });

            // Initialize
            buildDots();
        });
    </script>

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

        @media (min-width: 768px) {
            .testimonial-card {
                min-width: 48%;
            }
        }

        @media (min-width: 1024px) {
            .testimonial-card {
                min-width: 32%;
            }
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
@endpush