<header class="sticky top-0 z-50 w-full bg-white/95 backdrop-blur-sm border-b border-border shadow-sm">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-[1700px]">
        <div class="flex items-center justify-between h-16 lg:h-20">
            {{-- Logo --}}
            <div class="flex items-center cursor-pointer flex-shrink-0"
                onclick="window.location.href='{{ route('home') }}'">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Site') }}"
                    class="h-8 lg:h-14 w-auto transition-all duration-200 hover:scale-105" />
            </div>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center space-x-1 xl:space-x-2 mx-auto" aria-label="Primary">
                @php
                    $navItems = [
                        ['label' => 'Home', 'route' => 'home'],
                        ['label' => 'Therapy', 'route' => 'therapy'],
                        ['label' => 'Pain Management', 'route' => 'pain-management'],
                        ['label' => 'Clinics', 'route' => 'clinics'],
                        ['label' => 'Doctors', 'route' => 'doctors.index'],
                        ['label' => 'About', 'route' => 'about'],
                        ['label' => 'Blog', 'route' => 'blog'],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    @if ($item['route'] === 'pain-management')
                        {{-- Pain Management: mega-dropdown --}}
                        <div class="relative pain-mega group" data-mega>
                            <a href="{{ route('pain-management') }}"
                                class="relative px-4 py-2 text-sm font-medium transition-all duration-200 rounded-lg inline-flex items-center gap-2 {{ request()->routeIs($item['route']) ? 'text-primary bg-primary/5 font-semibold' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}"
                                role="button" aria-haspopup="true" aria-expanded="false" data-mega-toggle>
                                {{ $item['label'] }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-muted-foreground"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>

                            {{-- Mega panel --}}
                            <div class="mega-panel invisible opacity-0 pointer-events-none group-hover:visible group-hover:opacity-100 group-hover:pointer-events-auto group-focus-within:visible group-focus-within:opacity-100 group-focus-within:pointer-events-auto absolute left-1/2 transform -translate-x-1/2 bg-white rounded-xl border border-primary/30 shadow-2xl z-50"
                                role="menu" aria-hidden="true">
                                <div class="p-6">
                                    @php
                                        $cats = $painNav['categories'] ?? [];
                                        $grouped = $painNav['grouped'] ?? [];
                                        $cats = array_slice($cats, 0, 3, true);
                                    @endphp

                                    <div class="mega-grid">
                                        @foreach ($cats as $ck => $clabel)
                                            <div class="mega-column">
                                                <h4 class="text-sm font-semibold text-foreground">{{ $clabel }}</h4>

                                                <ul
                                                    class="text-sm text-muted-foreground space-y-2 max-h-[340px] overflow-y-auto pr-2">
                                                    @if (!empty($grouped[$ck]) && count($grouped[$ck]) > 0)
                                                        @foreach ($grouped[$ck] as $tech)
                                                            <li>
                                                                <a href="{{ url('/treatments/' . ($tech->slug ?? '')) }}"
                                                                    class="rounded-md px-2 py-2 hover:bg-primary/5 focus:bg-primary/5 focus:outline-none transition-colors flex items-center justify-between"
                                                                    role="menuitem">
                                                                    <span class="truncate">{{ $tech->title ?? 'Untitled' }}</span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="w-4 h-4 ml-3 text-muted-foreground shrink-0" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2" d="M9 5l7 7-7 7" />
                                                                    </svg>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li class="text-xs text-muted-foreground">No techniques</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- normal nav item --}}
                        <a href="{{ route($item['route']) }}"
                            class="relative px-4 py-2 text-sm font-medium transition-all duration-200 rounded-lg
                                        {{ request()->routeIs($item['route']) ? 'text-primary bg-primary/5 font-semibold' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
                            {{ $item['label'] }}
                            @if (request()->routeIs($item['route']))
                                <span
                                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1 h-1 bg-primary rounded-full"></span>
                            @endif
                        </a>
                    @endif
                @endforeach
            </nav>

            {{-- Desktop Actions --}}
            <div class="hidden lg:flex items-center space-x-3 flex-shrink-0">
                <a href="tel:+918220503388"
                    class="btn-secondary flex items-center gap-2 px-4 py-2.5 text-sm font-medium transition-all duration-200 hover:scale-105">
                    <i class="fa-solid fa-phone text-xs"></i>
                    Call Us
                </a>

                <button
                    class="btn-primary flex items-center gap-2 px-5 py-2.5 text-sm font-medium transition-all duration-200 hover:scale-105"
                    data-booking @isset($therapy) data-treatment="{{ $therapy->slug }}" @endisset>
                    <i class="fa-solid fa-calendar-check"></i>
                    Book Now
                </button>
            </div>

            {{-- Mobile Menu Toggle --}}
            <div class="flex lg:hidden items-center">
                <button
                    class="mobile-menu-btn relative p-2 rounded-lg bg-primary text-white hover:bg-primary/90 transition-all duration-200"
                    onclick="toggleMobileMenu()" aria-label="Toggle menu" aria-expanded="false">
                    <div class="w-6 h-6 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" id="menuIcon"
                            class="w-6 h-6 absolute inset-0 transition-all duration-200" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" id="closeIcon"
                            class="w-6 h-6 absolute inset-0 transition-all duration-200 opacity-0 scale-75" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu"
            class="hidden lg:hidden absolute top-full left-0 w-full bg-white/95 backdrop-blur-sm border-b border-border shadow-lg">
            <div class="px-4 py-6 space-y-4">
                <nav class="flex flex-col space-y-3" aria-label="Mobile Primary">
                    @foreach ($navItems as $item)
                        @if($item['route'] === 'pain-management')
                            <div class="w-full">
                                <div class="flex items-center justify-between px-4">
                                    <a href="{{ route('pain-management') }}"
                                        class="flex-1 text-base font-medium py-3 rounded-xl text-gray-700 hover:text-primary hover:bg-gray-50 px-0">
                                        {{ $item['label'] }}
                                    </a>

                                    <button type="button" id="mobilePainChevron" aria-controls="mobilePainPanel"
                                        aria-expanded="false"
                                        class="ml-3 p-2 rounded-md inline-flex items-center justify-center hover:bg-gray-100 transition"
                                        title="Expand Pain Management categories">
                                        <svg id="mobilePainChevronSvg" class="w-5 h-5 text-gray-500 transition-transform"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </div>

                                <div id="mobilePainPanel" class="mt-2 px-4 hidden" aria-hidden="true">
                                    @php
                                        $cats = $painNav['categories'] ?? [];
                                        $grouped = $painNav['grouped'] ?? [];
                                        $cats = array_slice($cats, 0, 3, true);
                                    @endphp

                                    <div class="grid grid-cols-1 gap-4">
                                        @foreach($cats as $ck => $clabel)
                                            <div>
                                                <h4 class="text-sm font-semibold text-foreground mb-2">{{ $clabel }}</h4>
                                                <ul class="space-y-1">
                                                    @if(!empty($grouped[$ck]) && count($grouped[$ck]) > 0)
                                                        @foreach($grouped[$ck] as $tech)
                                                            <li>
                                                                <a href="{{ url('/treatments/' . ($tech->slug ?? '')) }}"
                                                                    class="block rounded-md px-2 py-2 text-sm text-muted-foreground hover:bg-primary/5 transition-colors">
                                                                    {{ $tech->title ?? 'Untitled' }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li class="text-xs text-muted-foreground">No techniques</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route($item['route']) }}"
                                class="flex items-center px-4 py-3 text-base font-medium transition-all duration-200 rounded-xl
                                            {{ request()->routeIs($item['route']) ? 'text-primary bg-primary/10 border border-primary/20 font-semibold' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
                                <span class="flex-1">{{ $item['label'] }}</span>

                                @if (request()->routeIs($item['route']))
                                    <i class="fa-solid fa-check text-primary text-sm"></i>
                                @else
                                    <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                                @endif
                            </a>
                        @endif
                    @endforeach
                </nav>

                {{-- Mobile Actions --}}
                <div class="pt-4 border-t border-gray-200 space-y-3">
                    <a href="tel:+918220503388"
                        class="w-full btn-secondary flex items-center justify-center gap-2 px-4 py-3 text-base font-medium rounded-xl transition-all duration-200 active:scale-95">
                        <i class="fa-solid fa-phone"></i>
                        Call Us Now
                    </a>

                    <button
                        class="w-full btn-primary flex items-center justify-center gap-2 px-4 py-3 text-base font-medium rounded-xl transition-all duration-200 active:scale-95"
                        data-booking @isset($therapy) data-treatment="{{ $therapy->slug }}" @endisset>
                        <i class="fa-solid fa-calendar-check"></i>
                        Book Appointment
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

@push('styles')
    <style>
        /* Mega dropdown styling */
        .pain-mega .mega-panel {
            width: 980px;
            border-radius: 14px;
            overflow: visible;
            border: 1px solid rgba(34, 197, 94, 0.12);
            box-shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
            transition: opacity 0.2s ease, visibility 0.2s ease;
            margin-top: 12px;
        }

        /* Create a bridge between button and panel to prevent gap */
        .pain-mega .mega-panel::after {
            content: "";
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            height: 12px;
            background: transparent;
        }

        /* pointer triangle centered above the panel */
        .pain-mega .mega-panel::before {
            content: "";
            position: absolute;
            top: -11px;
            left: var(--mega-triangle-left, 50%);
            transform: translateX(-50%) rotate(45deg);
            width: 18px;
            height: 18px;
            background: white;
            border-top: 1px solid rgba(34, 197, 94, 0.12);
            border-left: 1px solid rgba(34, 197, 94, 0.12);
            z-index: 51;
        }

        /* Grid layout for columns - pure CSS */
        .pain-mega .mega-panel .mega-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 24px;
        }

        .pain-mega .mega-panel .mega-column {
            min-width: 280px;
        }

        .pain-mega .mega-panel .mega-column h4 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .pain-mega .mega-panel .mega-column ul {
            font-size: 0.875rem;
            max-height: 340px;
            overflow-y: auto;
            padding-right: 8px;
        }

        .pain-mega .mega-panel .mega-column ul li {
            margin-bottom: 8px;
        }

        /* inner list scrollbar */
        .pain-mega .mega-panel ul::-webkit-scrollbar {
            width: 6px;
        }

        .pain-mega .mega-panel ul::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.06);
            border-radius: 8px;
        }

        /* Responsive breakpoints */
        @media (max-width: 1200px) {
            .pain-mega .mega-panel {
                width: 880px;
            }

            .pain-mega .mega-panel .mega-column {
                min-width: 260px;
            }
        }

        @media (max-width: 1024px) {
            .pain-mega .mega-panel {
                left: 50% !important;
                transform: translateX(-50%) !important;
                width: calc(100vw - 32px) !important;
            }

            .pain-mega .mega-panel::before {
                left: 32px;
                transform: rotate(45deg);
                top: -9px;
            }

            .pain-mega .mega-panel .mega-grid {
                grid-template-columns: 1fr 1fr !important;
                gap: 16px;
            }

            .pain-mega .mega-panel .mega-column {
                min-width: auto;
            }

            #mobilePainChevronSvg {
                transition: transform .18s ease-in-out;
            }
        }

        @media (max-width: 640px) {
            .pain-mega .mega-panel .mega-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Attach hover/touch handlers to each mega wrapper to prevent accidental close
            document.querySelectorAll('[data-mega]').forEach((wrapper) => {
                const toggle = wrapper.querySelector('[data-mega-toggle]');
                const panel = wrapper.querySelector('.mega-panel');
                if (!toggle || !panel) return;

                const pair = { toggle, panel, wrapper };

                let closeTimer = null;
                let openTimer = null;
                const CLOSE_DELAY = 220; // ms - adjust for feel
                const OPEN_DELAY = 40;  // small delay to avoid flicker

                function openSoon() {
                    clearTimeout(closeTimer);
                    if (openTimer) return;
                    openTimer = setTimeout(() => {
                        openTimer = null;
                        setExpanded(pair, true);
                    }, OPEN_DELAY);
                }

                function closeSoon() {
                    clearTimeout(openTimer);
                    if (closeTimer) return;
                    closeTimer = setTimeout(() => {
                        closeTimer = null;
                        // only close if neither toggle nor panel are hovered/focused
                        const stillInside = wrapper.matches(':hover') || panel.matches(':hover') || toggle.matches(':focus') || panel.contains(document.activeElement);
                        if (!stillInside) setExpanded(pair, false);
                    }, CLOSE_DELAY);
                }

                // Mouse events for desktop
                wrapper.addEventListener('mouseenter', openSoon);
                wrapper.addEventListener('mouseleave', closeSoon);
                panel.addEventListener('mouseenter', () => { clearTimeout(closeTimer); });
                panel.addEventListener('mouseleave', closeSoon);
                toggle.addEventListener('mouseenter', openSoon);

                // Keyboard accessibility: open on focus, close on blur (with small delay)
                toggle.addEventListener('focus', () => setExpanded(pair, true));
                // close when focus moves away from wrapper/panel
                wrapper.addEventListener('focusout', (e) => {
                    // e.relatedTarget is the new focused element
                    const next = e.relatedTarget;
                    if (!wrapper.contains(next)) {
                        // delay just like mouse leave to avoid race
                        closeSoon();
                    }
                });

                // If user clicks outside, ensure panel closes (defensive)
                document.addEventListener('click', (ev) => {
                    if (!wrapper.contains(ev.target)) {
                        clearTimeout(openTimer);
                        clearTimeout(closeTimer);
                        setExpanded(pair, false);
                    }
                });

                // mobile / touch: tap the toggle should open/close as you already handle - keep that behavior
            });
        });
        function setExpanded(panelTogglePair, val) {
            const { toggle, panel, wrapper } = panelTogglePair;

            toggle.setAttribute('aria-expanded', String(val));
            panel.setAttribute('aria-hidden', String(!val));

            if (!val) {
                // close: restore original utility classes so markup fallback still works
                wrapper.classList.remove('open');
                panel.classList.remove('visible', 'opacity-100');
                panel.classList.add('invisible');
                panel.style.pointerEvents = 'none';

                // reset inline positioning
                panel.style.position = '';
                panel.style.left = '';
                panel.style.top = '';
                panel.style.transform = '';
                panel.style.removeProperty('--mega-triangle-left');

                // restore the original Tailwind centering utilities (keeps non-JS behavior identical)
                panel.classList.add('absolute', 'left-1/2', 'transform', '-translate-x-1/2');
                return;
            }

            // open: remove the tailwind centering utilities so inline left/top works exactly
            panel.classList.remove('absolute', 'left-1/2', 'transform', '-translate-x-1/2');

            wrapper.classList.add('open');
            panel.classList.remove('invisible');
            panel.classList.add('visible', 'opacity-100');
            panel.style.pointerEvents = 'auto';

            // make it fixed so it doesn't move with page scroll inside header area
            panel.style.position = 'fixed';
            panel.style.transform = 'none';

            // measure off-screen then place
            panel.style.left = '50%';
            panel.style.top = '-9999px';

            requestAnimationFrame(() => {
                const toggleRect = toggle.getBoundingClientRect();
                const panelRect = panel.getBoundingClientRect();

                // center panel horizontally under the toggle
                const anchorCenterX = toggleRect.left + toggleRect.width / 2;
                let left = Math.round(anchorCenterX - (panelRect.width / 2));

                // if desired, you can clamp to viewport edges here,
                // but per request we prefer exact centering so we don't clamp.

                // position a little below the nav item
                const top = Math.round(toggleRect.bottom + 10);

                panel.style.left = left + 'px';
                panel.style.top = top + 'px';

                // place triangle exactly under the anchor
                const triangleOffset = Math.round(anchorCenterX - left);
                panel.style.setProperty('--mega-triangle-left', triangleOffset + 'px');

                panel.style.zIndex = 2000;
            });
        }



        function toggleMobileMenu() {
            const menu = document.getElementById("mobileMenu");
            const menuIcon = document.getElementById("menuIcon");
            const closeIcon = document.getElementById("closeIcon");
            const body = document.body;

            const isOpening = menu.classList.contains("hidden");

            if (isOpening) {
                menu.classList.remove("hidden");
                menuIcon.classList.add("opacity-0", "scale-75");
                closeIcon.classList.remove("opacity-0", "scale-75");
                closeIcon.classList.add("opacity-100", "scale-100");
                body.classList.add("overflow-hidden");
            } else {
                menu.classList.add("hidden");
                menuIcon.classList.remove("opacity-0", "scale-75");
                menuIcon.classList.add("opacity-100", "scale-100");
                closeIcon.classList.add("opacity-0", "scale-75");
                closeIcon.classList.remove("opacity-100", "scale-100");
                body.classList.remove("overflow-hidden");
            }

            const btn = document.querySelector('.mobile-menu-btn');
            if (btn) btn.setAttribute('aria-expanded', isOpening);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const chevronBtn = document.getElementById('mobilePainChevron');
            const panel = document.getElementById('mobilePainPanel');
            const svg = document.getElementById('mobilePainChevronSvg');

            if (!chevronBtn || !panel) return;

            function closePanel() {
                panel.classList.add('hidden');
                panel.classList.remove('block');
                chevronBtn.setAttribute('aria-expanded', 'false');
                panel.setAttribute('aria-hidden', 'true');
                if (svg) svg.style.transform = 'rotate(0deg)';
            }

            function openPanel() {
                panel.classList.remove('hidden');
                panel.classList.add('block');
                chevronBtn.setAttribute('aria-expanded', 'true');
                panel.setAttribute('aria-hidden', 'false');
                if (svg) svg.style.transform = 'rotate(180deg)';
            }

            chevronBtn.addEventListener('click', function (e) {
                const isOpen = chevronBtn.getAttribute('aria-expanded') === 'true';
                if (isOpen) {
                    closePanel();
                } else {
                    openPanel();
                }
                e.stopPropagation();
            });

            const mobileMenu = document.getElementById('mobileMenu');
            if (mobileMenu) {
                const obs = new MutationObserver(() => {
                    if (mobileMenu.classList.contains('hidden')) closePanel();
                });
                obs.observe(mobileMenu, { attributes: true, attributeFilter: ['class'] });
            }

            document.addEventListener('click', (e) => {
                if (!panel.classList.contains('hidden')) {
                    const inside = panel.contains(e.target) || chevronBtn.contains(e.target);
                    if (!inside) closePanel();
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !panel.classList.contains('hidden')) closePanel();
            });
        });
    </script>
@endpush