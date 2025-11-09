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

    try {
        $clinics = \App\Models\Clinics::orderBy('city')->get();
    } catch (\Throwable $e) {
        $clinics = collect();
        \Log::info('Clinics not loaded for booking dropdown: ' . $e->getMessage());
    }
    $appointmentsAction = \Illuminate\Support\Facades\Route::has('appointments.store')
        ? route('appointments.store')
        : '#';
@endphp

<div x-data="floatingBookingComponent()" x-init="init(); $el.classList.add('alpine-ready')" x-cloak>

    {{-- Booking success toast (hidden by default) --}}
    <div id="booking-toast" role="status" aria-live="polite" aria-hidden="true" style="position:fixed;
            top:1rem; 
            transform:translateX(-50%);
            z-index:9999;
            background:#ffffff;
            color:var(--foreground,#0f172a);
            border:1px solid rgba(0,0,0,0.06);
            min-width:240px;
            max-width:560px;
            box-shadow:0 10px 30px rgba(2,6,23,0.12);
            border-radius:12px;
            padding:12px 14px;
            gap:12px;
            align-items:flex-start;
            display:none;">
        <div
            style="flex-shrink:0; display:flex; align-items:center; justify-content:center; width:40px; height:40px; border-radius:999px; background:var(--primary,#0ea5e9); color:white;">
            <!-- check icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                aria-hidden="true">
                <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </div>

        <div style="flex:1; min-width:0;">
            <div id="booking-toast-title" style="font-weight:700; font-size:14px; color:var(--foreground,#0f172a);">
                Appointment requested
            </div>
            <div id="booking-toast-body" style="font-size:13px; color:var(--muted,#6b7280); margin-top:2px;">
                We've received your request and will confirm by email or phone.
            </div>
        </div>

        <button id="booking-toast-close" aria-label="Dismiss"
            style="background:transparent;border:none;color:var(--muted,#9ca3af);padding:6px; margin-left:6px; cursor:pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                aria-hidden="true">
                <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    </div>



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
                    x-on:submit.prevent="submitForm()" novalidate>


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
                            <p x-show="errors.name" x-text="errors.name" class="text-xs text-red-500 mt-1"
                                style="display:none;"></p>
                        </div>

                        {{-- Phone --}}
                        <div class="flex-1">
                            <label for="phone"
                                class="block text-sm font-medium text-muted-foreground mb-1">Phone</label>
                            <div class="relative">
                                <input id="phone" name="phone" x-model="form.phone" required
                                    class=" block w-full rounded-lg border border-border bg-transparent px-4 py-2 text-foreground placeholder-muted-foreground shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary"
                                    placeholder="+91 00000 00000" aria-required="true" />
                            </div>
                            <p x-show="errors.phone" x-text="errors.phone" class="text-xs text-red-500 mt-1"
                                style="display:none;"></p>

                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:gap-4 gap-4">

                        {{-- Email --}}
                        <div class="flex-1">
                            <label for="email" class="block text-sm font-medium text-muted-foreground mb-1">Email
                            </label>
                            <input id="email" name="email" x-model="form.email" type="email"
                                class="block w-full rounded-lg border border-border bg-transparent px-4 py-2 text-foreground placeholder-muted-foreground shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary"
                                placeholder="you@example.com" />
                        </div>

                        {{-- Preferred date/time --}}
                        {{-- Preferred date (date only) --}}
                        <div class="flex-1">
                            <label for="preferred"
                                class="block text-sm font-medium text-muted-foreground mb-1">Preferred date</label>
                            <input id="preferred" name="preferred" x-model="form.preferred" type="date"
                                class="block w-full rounded-lg border border-border bg-transparent px-4 py-2 text-foreground shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary" />
                        </div>

                        {{-- Location select (clinics) --}}


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
                    <div class="mt-4">
                        <label for="clinic_id" class="block text-sm font-medium text-muted-foreground mb-1">Preferred
                            location</label>
                        <div class="relative">
                            <select id="clinic_id" name="clinic_id" x-model="form.clinic_id"
                                class="block w-full rounded-lg border border-border bg-transparent px-4 py-2 text-foreground shadow-sm focus:ring-2 focus:ring-primary/30 focus:border-primary">
                                <option value="">— Select clinic / location —</option>
                                @foreach($clinics as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }} @if($c->city) — {{ $c->city }} @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-xs text-muted-foreground mt-2">Choose a preferred clinic location for your
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
                                    // small delay to allow Alpine init to register the showBookingToast function
                                    const msg = @json(Session::get('success'));
                                    if (window.showBookingToast) {
                                        window.showBookingToast(msg);
                                    } else {
                                        setTimeout(() => { window.showBookingToast && window.showBookingToast(msg); }, 180);
                                    }
                                });
                            </script>
                        @endif


                    </div>
                    <!-- <p
                        class="text-xs text-muted-foreground mt-3 leading-relaxed bg-green-50 p-3 rounded-lg border border-green-200">
                        ✅ Once your booking is received, you will get an email confirmation.<br>
                        📨 Our team will review your preferred timing and confirm via email.<br>
                        🔄 If the selected slot isn't available, we will notify you with a rescheduled time.
                    </p> -->

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
                        therapy_slug: '',
                        clinic_id: ''
                    },
                    errors: {
                        name: '',
                        phone: ''
                    },

                    get actionUrl() {
                        return @json($appointmentsAction);
                    },

                    init() {
                        // mark ready to un-hide
                        requestAnimationFrame(() => {
                            this.$el.classList.add('alpine-ready');
                        });

                        // expose helpers for global use (used by server-flash script)
                        window.showBookingToast = (message) => this._showBookingToast(message);
                        window.hideBookingToast = () => this._hideBookingToast();

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

                        // Delegate clicks for any elements opting into the booking modal.
                        document.addEventListener('click', (ev) => {
                            try {
                                if (ev && ev.isTrusted === false) return;
                                const el = ev.target.closest && ev.target.closest('[data-booking], .open-booking');
                                if (!el) return;
                                if (el.tagName && el.tagName.toLowerCase() === 'a' && el.getAttribute('href') === '#booking' && !el.hasAttribute('data-booking')) return;

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
                            } catch (e) { console.debug('booking click handler error', e); }
                        }, { passive: false });

                        // convenience global
                        window.openBookingModal = (detail = {}) => window.dispatchEvent(new CustomEvent('open-booking', { detail }));

                        // expose therapies map
                        window.THERAPIES_MAP = @json($therapies->pluck('title', 'slug')->all());

                        // toast close button handler
                        const btn = document.getElementById('booking-toast-close');
                        if (btn) btn.addEventListener('click', () => window.hideBookingToast());
                    },

                    // client-side form submit wrapper with simple validation
                    submitForm() {
                        // reset errors
                        this.errors.name = '';
                        this.errors.phone = '';

                        const name = (this.form.name || '').trim();
                        const phone = (this.form.phone || '').trim();

                        if (!name || name.length < 2) {
                            this.errors.name = 'Please enter your full name';
                            document.getElementById('name')?.focus();
                            return;
                        }

                        // simple phone sanity check; adjust as you wish
                        const digits = phone.replace(/\D/g, '');
                        if (!phone || digits.length < 7) {
                            this.errors.phone = 'Please enter a valid phone number';
                            document.getElementById('phone')?.focus();
                            return;
                        }

                        // passed client-side checks — submit the form (native submit)
                        this.$refs.form.submit();
                    },

                    // show/hide toast helpers (manipulate the DOM element)
                    _showBookingToast(message) {
                        try {
                            const node = document.getElementById('booking-toast');
                            if (!node) return;
                            const title = document.getElementById('booking-toast-title');
                            const body = document.getElementById('booking-toast-body');
                            if (title) title.textContent = 'Appointment requested';
                            if (body) body.textContent = message || 'Your request has been received. We will confirm by email.';
                            node.style.display = 'flex';
                            node.setAttribute('aria-hidden', 'false');

                            // animate in
                            node.style.opacity = '0';
                            node.style.transform = 'translateY(-8px)';
                            node.animate([{ opacity: 0, transform: 'translateY(-8px)' }, { opacity: 1, transform: 'translateY(0)' }], { duration: 220, easing: 'cubic-bezier(.2,.9,.3,1)' });
                            node.style.opacity = '1';
                            node.style.transform = 'none';

                            // auto-hide after 6s
                            clearTimeout(this._toastTimer);
                            this._toastTimer = setTimeout(() => { this._hideBookingToast(); }, 6000);
                        } catch (e) { console.debug(e); }
                    },

                    _hideBookingToast() {
                        const node = document.getElementById('booking-toast');
                        if (!node) return;
                        try {
                            node.animate([{ opacity: 1, transform: 'translateY(0)' }, { opacity: 0, transform: 'translateY(-8px)' }], { duration: 180, easing: 'ease' });
                            setTimeout(() => {
                                node.style.display = 'none';
                                node.setAttribute('aria-hidden', 'true');
                            }, 190);
                        } catch (e) {
                            node.style.display = 'none';
                            node.setAttribute('aria-hidden', 'true');
                        }
                    },


                    openModal() {
                        this._prevScroll = window.scrollY || document.documentElement.scrollTop || 0;
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
                        document.documentElement.classList.remove('modal-lock');
                        document.body.style.position = '';
                        document.body.style.top = '';
                        document.body.style.width = '';
                        if (this._prevScroll != null) {
                            window.scrollTo(0, this._prevScroll);
                            this._prevScroll = null;
                        }
                    }
                };
            }
        </script>
    @endpush


@endonce