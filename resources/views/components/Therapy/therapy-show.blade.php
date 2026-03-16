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
                                <img src="{{ $src }}" alt="{{ $therapy->title }}" loading="lazy" class="w-full h-28 object-cover" />
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
            {{-- Booking anchor / simple contact form (example) --}}
            <div id="booking" class="  mx-auto mt-12 p-6 bg-card rounded-2xl border border-border">
                <x-contact.BookFreeConsultation :therapy="$therapy" />
            </div>

        </div>

        {{-- Full-width SEO Content Section --}}
        <div class="w-full bg-gradient-to-br from-primary/5 via-background to-secondary/5 mt-16">
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
    </div>
@endsection