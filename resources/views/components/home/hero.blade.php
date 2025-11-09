<section class="relative overflow-hidden bg-background" style="position:relative;">
    <!-- subtle gradient backdrop: use theme-muted color if available -->
    <div style="position:absolute; inset:0; pointer-events:none;
              background: linear-gradient(135deg,
                rgba(var(--muted-rgb, 100,100,100), 0.04) 0%,
                rgba(255,255,255,0) 50%,
                rgba(var(--background-rgb, 250,250,250),0.02) 100%);"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top:48px; padding-bottom:48px;">
        <div class="hero-grid" style="display:grid; gap:32px;">
            <style>
                /* keep grid responsive but avoid relying on purged classes */
                .hero-grid {
                    grid-template-columns: 1fr;
                }

                @media (min-width: 1024px) {
                    .hero-grid {
                        grid-template-columns: 1fr 1fr;
                        gap: 40px;
                    }
                }
            </style>

            <!-- LEFT column -->
            <div class="space-y-6 relative" style="padding-right:12px;">
                <div style="display:flex; flex-direction:column; gap:12px;">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium" style="background:var(--primary-opaque, rgba(14,165,233,0.08));
                         color:var(--color-primary, var(--primary, #0ea5e9));">
                            <!-- lotus uses currentColor so it follows the span color -->
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"
                                style="width:18px;height:18px;margin-right:8px;">
                                <path d="M12 2s2.5 2.5 3 6c.5 3-3 6-3 6s-3.5-3-3-6c.5-3 3-6 3-6z" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 14s-3.5 2.5-6 1c-2.5-1.5-2-5-2-5s2.5 1.5 4.5 1.5S12 14 12 14z"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 14s3.5 2.5 6 1c2.5-1.5 2-5 2-5s-2.5 1.5-4.5 1.5S12 14 12 14z"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Trusted Ayurveda
                        </span>
                    </div>

                    <!-- CTA row (uses your btn classes so colors match the theme) -->
                    <div style="display:flex; align-items:center; gap:12px;">
                        <a class="btn-primary shadow-lg inline-flex items-center gap-2" href="#" data-booking
                            data-treatment="{{ $therapy?->slug ?? ($treatments->first()?->slug ?? '') }}"
                            aria-label="Book consultation" style="padding:10px 16px; font-weight:600;">
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" style="width:16px;height:16px;">
                                <path
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Book Consultation
                        </a>

                        <a href="/therapy" class="btn-secondary px-4 py-2 text-sm" style="font-weight:600;">
                            Learn Treatments
                        </a>
                    </div>
                </div>

                <!-- Heading and description (use theme text classes) -->
                <div style="margin-top:6px;">
                    <h1 class="hero-heading font-extrabold text-foreground leading-tight"
                        style="font-size: clamp(28px, 4vw, 44px); margin:0 0 8px 0;">
                        Restore Balance with <span class="text-primary">Authentic Ayurveda</span>
                    </h1>
                    <p class="hero-description text-md text-muted-foreground" style="margin:0; max-width:720px;">
                        Experience holistic healing through time-tested Ayurvedic treatments. Our certified
                        practitioners combine ancient wisdom with modern care to restore your natural balance and
                        vitality.
                    </p>
                </div>

                <!-- Feature pills: use theme classes for text & icons -->
                <div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:12px;">
                    @php $features = ['Authentic Ayurvedic Treatments', 'Certified Practitioners', 'Personalized Care Plans', 'Natural Healing Methods']; @endphp
                    @foreach ($features as $feature)
                        <div style="display:flex; align-items:center; gap:8px; padding:8px 12px; border-radius:9999px;"
                            class="bg-card/70 border border-border shadow-sm">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"
                                class="text-primary" style="width:16px;height:16px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span class="text-sm font-medium text-foreground">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- stats: keep theme text classes -->
                <div
                    style="display:grid; grid-template-columns:repeat(3,1fr); gap:18px; padding-top:20px; border-top:1px solid rgba(0,0,0,0.06); margin-top:18px;">
                    <div style="text-align:center;">
                        <div class="text-2xl font-bold text-foreground">2,500+</div>
                        <div class="text-xs text-muted-foreground mt-1">Happy Patients</div>
                    </div>
                    <div style="text-align:center;">
                        <div class="text-2xl font-bold text-foreground">15+</div>
                        <div class="text-xs text-muted-foreground mt-1">Years Experience</div>
                    </div>
                    <div style="text-align:center;">
                        <div class="text-2xl font-bold text-foreground">95%</div>
                        <div class="text-xs text-muted-foreground mt-1">Success Rate</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT column: image + floating card -->
            <!-- RIGHT column: image + floating card (responsive floating card) -->
            <div
                style="position:relative; border-radius:16px; overflow:hidden; box-shadow:0 10px 30px rgba(2,6,23,0.08);">

                <!-- small local styles to make floating card responsive -->
                <style>
                    /* floating card base */
                    .hero-img {
                        display: block;
                        width: 100%;
                        height: clamp(420px, 56vh, 720px);
                        object-fit: cover;
                    }

                    .hero-floating {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 12px;
                        padding: 14px;
                        border-radius: 12px;
                        background: rgba(255, 255, 255, 0.06);
                        backdrop-filter: blur(6px);
                        border: 1px solid rgba(255, 255, 255, 0.04);
                        box-shadow: 0 6px 20px rgba(2, 6, 23, 0.12);
                    }

                    .hero-floating .hero-floating-text {
                        flex: 1;
                        min-width: 0;
                        margin-right: 8px;
                    }

                    .hero-floating .hero-floating-buttons {
                        display: flex;
                        gap: 10px;
                        align-items: center;
                    }

                    /* Mobile: stack content, shrink padding and make buttons full-width */
                    @media (max-width: 640px) {
                        .hero-img {
                            height: clamp(280px, 40vh, 420px);
                        }

                        /* keep image visible on small screens */
                        .hero-floating {
                            flex-direction: column;
                            align-items: flex-start;
                            justify-content: flex-start;
                            gap: 8px;
                            padding: 10px;
                        }

                        .hero-floating .hero-floating-text {
                            margin: 0;
                        }

                        .hero-floating .hero-floating-buttons {
                            width: 100%;
                            display: flex;
                            gap: 8px;
                            flex-direction: column;
                            /* stack buttons */
                        }

                        .hero-floating .hero-floating-buttons>* {
                            width: 100%;
                            display: inline-flex;
                            justify-content: center;
                        }

                        /* move floating card in a bit so image remains visible */
                        .hero-floating-wrapper {
                            left: 12px !important;
                            right: 12px !important;
                            bottom: 12px !important;
                        }
                    }
                </style>

                <!-- image -->
                <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1820&q=80"
                    alt="Ayurvedic treatment and herbs" class="hero-img" />

                <!-- floating consultation card wrapper (position adjusted inline so media rule can override) -->
                <div class="hero-floating-wrapper" style="position:absolute; left:24px; right:24px; bottom:24px;">
                    <div class="hero-floating">
                        <div class="hero-floating-text">
                            <p class="text-foreground" style="margin:0; font-weight:600;">
                                Discover your dosha and personalized wellness plan
                            </p>
                        </div>

                        <div class="hero-floating-buttons">
                            <!-- Book button -->
                            <button class="btn-primary inline-flex items-center gap-2" data-booking
                                data-treatment="{{ $therapy?->slug ?? ($treatments->first()?->slug ?? '') }}"
                                aria-label="Open booking" style="padding:8px 12px; font-weight:600;">
                                <svg style="width:14px;height:14px;" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Book Now
                            </button>

                            <!-- View treatments -->
                            <a href="/therapy" class="btn-secondary px-3 py-2 rounded-lg text-sm"
                                style="font-weight:600; text-align:center;">
                                View Treatments
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- decorative orbs: use theme-primary / theme-accent with semantic variables -->
            <div
                style="position:absolute; top:-36px; right:-36px; width:112px; height:112px; border-radius:9999px; background: rgba(var(--accent-rgb,250,204,21),0.12); filter:blur(28px); opacity:0.45; pointer-events:none;">
            </div>
            <div
                style="position:absolute; bottom:-36px; left:-36px; width:144px; height:144px; border-radius:9999px; background: rgba(var(--primary-rgb,14,165,233),0.12); filter:blur(28px); opacity:0.45; pointer-events:none;">
            </div>
        </div>
    </div>
    </div>
</section>