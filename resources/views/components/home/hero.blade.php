<section class="relative overflow-hidden bg-background">
    <!-- subtle gradient backdrop -->
    <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(135deg,
                rgba(var(--muted-rgb,100,100,100),0.04) 0%,
                rgba(255,255,255,0) 50%,
                rgba(var(--background-rgb,250,250,250),0.02) 100%);"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Use Tailwind grid classes: 1 column on mobile, 2 on lg and above -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <!-- LEFT column -->
            <div class="space-y-6" data-aos="fade-up" data-aos-delay="80">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium"
                        style="background:var(--primary-opaque, rgba(14,165,233,0.08)); color:var(--color-primary,#0ea5e9);"
                        data-aos="fade-up" data-aos-delay="120">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"
                            class="w-4 h-4 mr-2">
                            <path d="M12 2s2.5 2.5 3 6c.5 3-3 6-3 6s-3.5-3-3-6c.5-3 3-6 3-6z" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 14s-3.5 2.5-6 1c-2.5-1.5-2-5-2-5s2.5 1.5 4.5 1.5S12 14 12 14z"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Most Trusted Ayurveda Clinics in Coimbatore
                    </span>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-3" data-aos="fade-up" data-aos-delay="160">
                    <a class="btn-primary shadow-lg inline-flex items-center gap-2 w-full sm:w-auto justify-center"
                        href="#" data-booking
                        data-treatment="{{ $therapy?->slug ?? ($treatments->first()?->slug ?? '') }}"
                        aria-label="Book consultation" style="padding:10px 16px; font-weight:600;" data-aos="zoom-in"
                        data-aos-delay="200">
                        Book Consultation
                    </a>

                    <a href="/therapy" class="btn-secondary px-4 py-2 text-sm w-full sm:w-auto text-center"
                        style="font-weight:600;" data-aos="fade-left" data-aos-delay="220">
                        Learn Treatments
                    </a>
                </div>

                <div>
                    <h1 class="hero-heading font-extrabold text-foreground leading-tight"
                        style="font-size: clamp(28px, 4vw, 44px); margin:0 0 8px 0;" data-aos="fade-up"
                        data-aos-delay="260">
                        Rebalance Your Body, Mind <span class="text-primary">&amp; Spirit with Authentic Ayurveda</span>
                    </h1>

                    <p class="hero-description text-md text-muted-foreground   mt-3" data-aos="fade-up"
                        data-aos-delay="320">
                        Discover natural healing that blends time-tested Ayurvedic therapies with modern wellness care —
                        crafted to restore harmony, relieve pain, and rejuvenate your vitality.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 mt-4">
                    @php
                        $features = [
                            'Certified Ayurvedic Experts',
                            'Personalized Treatment Plans',
                            'Natural Healing & Detox Therapies',
                            'Holistic Wellness for Every Lifestyle',
                        ];
                      @endphp

                    @foreach($features as $feature)
                        <div class="bg-card/70 border border-border shadow-sm inline-flex items-center gap-2 px-3 py-2 rounded-full text-sm"
                            data-aos="fade-up" data-aos-delay="{{ 360 + ($loop->index * 70) }}">
                            <svg class="w-4 h-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-foreground">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-3 gap-4 mt-6 border-t pt-6" aria-hidden="true">
                    <div class="text-center" data-aos="fade-up" data-aos-delay="620">
                        <div class="text-2xl font-bold text-foreground">1 Lakh +</div>
                        <div class="text-xs text-muted-foreground mt-1">Happy Patients</div>
                    </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="680">
                        <div class="text-2xl font-bold text-foreground">10 +</div>
                        <div class="text-xs text-muted-foreground mt-1">Years Experience</div>
                    </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="740">
                        <div class="text-2xl font-bold text-foreground">90%</div>
                        <div class="text-xs text-muted-foreground mt-1">Success Rate</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT column (image + floating card) -->
            <div class="relative hero-right min-h-[360px]" data-aos="zoom-in" data-aos-delay="180">
                <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=1820&q=80"
                    alt="Ayurvedic treatment and herbs"
                    class="w-full h-[420px] lg:h-[500px] object-cover rounded-2xl shadow-xl" />

                <div class="absolute left-6 right-6 bottom-6">
                    <div
                        class="hero-floating p-4 rounded-lg bg-white/5 backdrop-blur-sm border border-white/5 flex items-center justify-between gap-3">
                        <div class="text-white font-semibold">
                            Take your first step toward balance and lasting wellness.
                        </div>

                        <div class="flex gap-3">
                            <button class="btn-primary" data-booking
                                data-treatment="{{ $therapy?->slug ?? ($treatments->first()?->slug ?? '') }}">
                                Book Now
                            </button>
                            <a href="/therapy" class="btn-secondary px-3 py-2 rounded-lg text-sm">View Treatments</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /grid -->
    </div>
</section>

@push('scripts')
    <script>
        // Ensure AOS recalculates offsets after images and layout settle
        document.addEventListener('DOMContentLoaded', function () {
            if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            if (window.AOS && typeof AOS.refresh === 'function') {
                setTimeout(() => AOS.refresh(), 80);
            }
        });
    </script>
@endpush