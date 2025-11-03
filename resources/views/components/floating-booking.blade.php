{{-- resources/views/components/floating-booking.blade.php --}}



@once
    @push('floating-styles')
        <style>
            /* floating-booking styles (improved) */
            [ x-cloak] {
                display: none !important;
            }

            /* container hidden until Alpine ready */
            [ x-data] {
                opacity: 0;
                transform: translateY(6px);
                transition: opacity .22s ease, transform .22s ease;
                will-change: opacity, transform;
            }

            [ x-data].alpine-ready {
                opacity: 1;
                transform: translateY(0);
            }

            /* backdrop */
            .floating-backdrop {
                background: rgba(0, 0, 0, .45);
                backdrop-filter: blur(4px);
            }

            /* modal-lock helper to avoid scroll jump when used with position:fixed */
            .modal-lock {
                overflow: hidden !important;
            }

            /* keep your scroll-area tweaks (unchanged) */
            .booking-scroll-area {
                max-height: calc(50vh - 80px);
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }

            @media (max-width:640px) {
                .floating-cta-right {
                    display: none
                }

                .floating-cta-bottom {
                    display: block
                }
            }

            @media (min-width:641px) {
                .floating-cta-bottom {
                    display: none
                }
            }

            /* scroll area */
            .booking-scroll-area {
                max-height: calc(50vh - 80px);
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }

            .booking-scroll-area::-webkit-scrollbar {
                width: 8px;
            }

            .booking-scroll-area::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.12);
                border-radius: 6px;
            }

            /* Hide scrollbar but keep scrolling (cross-browser) */
            @media (hover: hover) and (pointer: fine) {

                /* target the scroll area */
                .booking-scroll-area,
                .floating-modal[style*="overflow-y:auto"],
                .floating-modal .booking-scroll-area {
                    scrollbar-width: none;
                    /* Firefox */
                    -ms-overflow-style: none;
                    /* IE 10+ */
                }

                /* Chrome, Edge, Safari, Opera */
                .booking-scroll-area::-webkit-scrollbar,
                .floating-modal::-webkit-scrollbar,
                .floating-modal .booking-scroll-area::-webkit-scrollbar {
                    width: 0;
                    height: 0;
                    display: none;
                }
            }

            /* Extra safety: hide horizontal scrollbar */
            .floating-modal,
            .floating-modal * {
                overflow-x: hidden !important;
            }
        </style>
    @endpush
@endonce

@php
try {
    $therapies = \App\Models\Therapy::orderBy('title')->get();
} catch (\Throwable $e) {
    $therapies = collect();
    \Log::info('Therapies not loaded for booking dropdown: ' . $e->getMessage());
}
$appointmentsAction = \Illuminate\Support\Facades\Route::has('appointments.store')
    ? route('appointments.store')
    : '#';
@endphp

<div x-data="floatingBookingComponent()" x-init="init(); $el.classList.add('alpine-ready')" x-cloak>


    <!-- CTA Right (desktop) -->
    <!-- <div class="fixed right-6 top-1/2 -translate-y-1/2 z-50 floating-cta-right">
        <div class="bg-card border border-border rounded-2xl shadow-lg p-4 max-w-xs floating-card">
            

            <div class="flex gap-2">
                <button @click="openModal()" class="btn-primary w-full inline-flex items-center justify-center"
                    data-booking>
                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Book Consultation
                </button>

                <button @click="minimized = !minimized"
                    class="h-10 w-10 rounded-full bg-muted/5 flex items-center justify-center" title="Minimize">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div> -->

    <!-- CTA Bottom (mobile) -->
    <div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 floating-cta-bottom">
        <div class=" floating-card">
            <div class="flex items-center justify-center gap-3">

                <div class="flex gap-2">
                    <button @click="openModal()" class="btn-primary px-4 py-2" data-booking>Book Appoinment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div x-show="open" x-cloak x-trap.noscroll="open" x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center floating-backdrop overflow-x-hidden">

        <div @click.away="closeModal()" @keydown.escape.window="closeModal()" tabindex="0"
            class="floating-modal bg-card border border-border rounded-2xl shadow-xl w-full max-w-4xl p-6 mx-4 overflow-x-hidden"
            role="dialog" aria-modal="true" aria-labelledby="booking-title">

            <div class="relative mb-4">
                <!-- Centered Heading -->
                <h2 id="booking-title" class="text-lg font-bold text-center text-foreground">
                    Book Your Consultation
                </h2>
                <p class="text-sm text-muted-foreground text-center mt-1">
                    Pick a date/time and tell us about your concerns. We'll contact you to confirm.
                </p>

                <!-- Close Button (absolute top-right) -->
                <button @click="closeModal()" type="button"
                    class="absolute top-0 right-0 h-8 w-8 rounded-full flex items-center justify-center text-muted-foreground hover:text-foreground"
                    aria-label="Close">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <div class="mt-4 pr-2 booking-scroll-area" style="max-height:calc(90vh - 160px);
            overflow-y:auto;
            -webkit-overflow-scrolling:touch;
            scrollbar-width:none; /* Firefox */
            -ms-overflow-style:none; /* IE/Edge */">

                {{-- Improved, aligned and styled form --}}
                <form method="POST" action="{{ route('appointments.store') }}" class="flex flex-col gap-6" x-ref="form"
                    novalidate>

                    @csrf
                    <input type="hidden" name="source_page" :value="source" />

                    <div class="flex flex-col sm:flex-row sm:gap-4 gap-4">

                        {{-- Name --}}
                        <div class="flex-1">
                            <label for="name" class="block text-sm font-medium text-muted-foreground mb-1">Full
                                name</label>
                            <div class="relative">
                                <input id="name" name="name" x-model="form.name" required
                                    class=" flex-1 block w-full rounded-lg border border-border bg-transparent px-4 py-2 text-foreground placeholder-muted-foreground shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary"
                                    placeholder="Your full name" aria-required="true" />
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="flex-1">
                            <label for="phone"
                                class="block text-sm font-medium text-muted-foreground mb-1">Phone</label>
                            <div class="relative">
                                <input id="phone" name="phone" x-model="form.phone" required
                                    class=" block w-full rounded-lg border border-border bg-transparent px-4 py-2 text-foreground placeholder-muted-foreground shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary"
                                    placeholder="+91 98765 43210" aria-required="true" />
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:gap-4 gap-4">

                        {{-- Email --}}
                        <div class="flex-1">
                            <label for="email" class="block text-sm font-medium text-muted-foreground mb-1">Email
                                (optional)</label>
                            <input id="email" name="email" x-model="form.email" type="email"
                                class="block w-full rounded-lg border border-border bg-transparent px-4 py-2 text-foreground placeholder-muted-foreground shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary"
                                placeholder="you@example.com" />
                        </div>

                        {{-- Preferred date/time --}}
                        <div class="flex-1">
                            <label for="preferred"
                                class="block text-sm font-medium text-muted-foreground mb-1">Preferred date &
                                time</label>
                            <input id="preferred" name="preferred" x-model="form.preferred" type="datetime-local"
                                class="block w-full rounded-lg border border-border bg-transparent px-4 py-2 text-foreground shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                        </div>
                    </div>

                    {{-- Therapy select (full width) --}}
                    <div>
                        <label for="therapy_slug" class="block text-sm font-medium text-muted-foreground mb-1">Choose
                            therapy (optional)</label>
                        <div class="relative">
                            <select id="therapy_slug" name="therapy_slug" x-model="form.therapy_slug"
                                class="block w-full rounded-lg border border-border bg-transparent px-4 py-2 text-foreground shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary">
                                <option value="">— Select a therapy —</option>
                                @foreach($therapies as $t)
                                    <option value="{{ $t->slug }}">{{ $t->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-xs text-muted-foreground mt-2">Selecting a therapy helps us prepare before
                            your
                            consultation.</p>
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label for="notes" class="block text-sm font-medium text-muted-foreground mb-1">Notes
                            (optional)</label>
                        <textarea id="notes" name="notes" x-model="form.notes" rows="4"
                            class="block w-full rounded-lg border border-border bg-transparent px-4 py-2 text-foreground placeholder-muted-foreground shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary"
                            placeholder="Briefly describe your concern or goals"></textarea>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-3 ">

                        <!-- Selected text (single line, truncate if long) -->
                        <div class="min-w-0 w-full">
                            <div class="text-sm text-muted-foreground whitespace-nowrap truncate"
                                x-show="form.therapy_slug">
                                <span class="font-medium">Selected:</span>
                                <span x-text="form.therapy_slug"></span>
                            </div>
                        </div>

                        <!-- Buttons inline -->
                        <div class="flex items-center justify-center gap-2 flex-shrink-0 w-full md:w-auto ">
                            <button type="button" @click="closeModal()"
                                class="btn-secondary px-4 py-2 rounded-lg whitespace-nowrap  ">
                                Cancel
                            </button>
                            <button type="submit"
                                class="inline-flex items-center gap-2 btn-primary px-4 py-2 rounded-lg whitespace-nowrap  ">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Request Booking
                            </button>
                            <div class="md:w-4"></div>


                        </div>
                        @if(Session::has('success'))
                            <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    // Show toast / popup
                                    alert(@json(Session::get('success')));

                                    // Optionally reopen modal if you want to display success inside it
                                    // window.openBookingModal();
                                });
                            </script>
                        @endif

                    </div>
                    <p
                        class="text-xs text-muted-foreground mt-3 leading-relaxed bg-green-50 p-3 rounded-lg border border-green-200">
                        ✅ Once your booking is received, you will get an email confirmation.<br>
                        📨 Our team will review your preferred timing and confirm via email.<br>
                        🔄 If the selected slot isn't available, we will notify you with a rescheduled time.
                    </p>

                    {{-- small privacy note --}}
                    <p class="text-xs text-muted-foreground mt-2">
                        We respect your privacy. By submitting you agree we may contact you to confirm this request.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            function floatingBookingComponent() {
                return {
                    open: false,
                    minimized: false,
                    source: window.location.pathname || '',
                    form: {
                        name: '',
                        phone: '',
                        email: '',
                        preferred: '',
                        notes: '',
                        therapy_slug: ''
                    },
                    get actionUrl() {
                        return @json($appointmentsAction);
                    },
                    init() {
                        requestAnimationFrame(() => {
                            // mark ready to un-hide
                            this.$el.classList.add('alpine-ready');
                        });
                        this.open = false;
                        this.minimized = false;
                        // Listen for programmatic open events
                        window.addEventListener('open-booking', (ev) => {
                            const d = ev.detail || {};
                            if (d.treatment) this.form.therapy_slug = d.treatment;
                            if (d.source) this.source = d.source;
                            if (d.prefill) Object.assign(this.form, d.prefill);
                            this.open = true;
                            setTimeout(() => {
                                const el = document.querySelector('input[name="name"]');
                                if (el) el.focus();
                            }, 80);
                        });
                        this.setupEventListeners();
                        // convenience global function
                        window.openBookingModal = (detail = {}) => window.dispatchEvent(new CustomEvent('open-booking', {
                            detail
                        }));

                        // expose therapies map (same as before)
                        window.THERAPIES_MAP = @json($therapies->pluck('title', 'slug')->all());

                        // Defensive: only open modal when user *clicks* on elements that explicitly opt in:
                        // - elements with data-booking, or
                        // - elements with class .open-booking
                        // We deliberately do NOT include a[href="#booking"] so plain anchor navigation won't open modal.
                        document.addEventListener('click', (ev) => {
                            try {
                                // ensure it's a user-initiated click (optional but helpful)
                                if (ev && ev.isTrusted === false) return;

                                const el = ev.target.closest && ev.target.closest('[data-booking], .open-booking');
                                if (!el) return;

                                // If it's an anchor with href="#booking" but NOT data-booking, let normal anchor behaviour occur:
                                if (el.tagName && el.tagName.toLowerCase() === 'a' && el.getAttribute('href') === '#booking' && !el.hasAttribute('data-booking')) {
                                    // allow default anchor navigation — do not open modal
                                    return;
                                }

                                ev.preventDefault();

                                const detail = {};
                                const t = el.getAttribute('data-treatment') || el.dataset.treatment;
                                const src = el.getAttribute('data-source') || el.dataset.source;
                                if (t) detail.treatment = t;
                                if (src) detail.source = src;
                                const prefill = {};
                                if (el.dataset.name) prefill.name = el.dataset.name;
                                if (el.dataset.email) prefill.email = el.dataset.email;
                                if (Object.keys(prefill).length) detail.prefill = prefill;

                                window.openBookingModal(detail);
                            } catch (e) {
                                // don't break page on error
                                console.debug('booking click handler error', e);
                            }
                        }, { passive: false });

                        // If page loads with hash "#booking", scroll to booking form instead of auto-opening the modal
                        if (window.location.hash === '#booking') {
                            // small timeout so page finishes layout, then smooth-scroll
                            setTimeout(() => {
                                const target = document.querySelector('#booking');
                                if (target) {
                                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                                    if (!target.hasAttribute('tabindex')) target.setAttribute('tabindex', '-1');
                                    try { target.focus({ preventScroll: true }); } catch (e) { /* ignore */ }
                                }
                            }, 250);
                        }
                    },

                    openModal() {
                        // save scroll position
                        this._prevScroll = window.scrollY || document.documentElement.scrollTop || 0;
                        // add lock class (CSS handles overflow)
                        document.documentElement.classList.add('modal-lock');
                        document.body.style.top = `-${this._prevScroll}px`;
                        document.body.style.position = 'fixed';
                        document.body.style.width = '100%';

                        this.open = true;
                        setTimeout(() => {
                            const el = document.querySelector('input[name="name"]');
                            if (el) el.focus();
                        }, 80);
                    },

                    closeModal() {
                        this.open = false;

                        // restore scroll and remove lock
                        document.documentElement.classList.remove('modal-lock');
                        document.body.style.position = '';
                        document.body.style.top = '';
                        document.body.style.width = '';
                        if (this._prevScroll != null) {
                            window.scrollTo(0, this._prevScroll);
                            this._prevScroll = null;
                        }
                    },
                };
            }
        </script>
    @endpush
@endonce