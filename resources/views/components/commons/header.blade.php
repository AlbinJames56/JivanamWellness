<header class="sticky top-0 z-50 w-full bg-white/95 backdrop-blur-sm border-b border-border shadow-sm">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-[1300px]">
        <div class="flex items-center justify-between h-16 lg:h-20">
            {{-- Logo --}}
            <div class="flex items-center cursor-pointer flex-shrink-0"
                onclick="window.location.href='{{ route('home') }}'">
                <img src="{{ asset('images/logo.png') }}" alt="Jivanam Wellness"
                    class="h-8 lg:h-14 w-auto transition-all duration-200 hover:scale-105" />
            </div>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center space-x-1 xl:space-x-2 mx-auto">
                @php
                    $navItems = [
                        ['label' => 'Home', 'route' => 'home'],
                        ['label' => 'Therapy', 'route' => 'therapy'],
                        ['label' => 'Pain Management', 'route' => 'pain-management'],
                        ['label' => 'Clinics', 'route' => 'clinics'],
                        ['label' => 'About', 'route' => 'about'],
                        ['label' => 'Blog', 'route' => 'blog'],
                    ];
                @endphp

                @foreach ($navItems as $item)
                            <a href="{{ route($item['route']) }}" class="relative px-4 py-2 text-sm font-medium transition-all duration-200 rounded-lg
                                           {{ request()->routeIs($item['route'])
                    ? 'text-primary bg-primary/5 font-semibold'
                    : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
                                {{ $item['label'] }}

                                @if(request()->routeIs($item['route']))
                                    <span
                                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1 h-1 bg-primary rounded-full"></span>
                                @endif
                            </a>
                @endforeach
            </nav>

            {{-- Desktop Actions --}}
            <div class="hidden lg:flex items-center space-x-3 flex-shrink-0">
                <a href="tel:+919876543210"
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
                    onclick="toggleMobileMenu()" aria-label="Toggle menu">
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
                <nav class="flex flex-col space-y-3">
                    @foreach ($navItems as $item)
                                    <a href="{{ route($item['route']) }}" class="flex items-center px-4 py-3 text-base font-medium transition-all duration-200 rounded-xl
                                                  {{ request()->routeIs($item['route'])
                        ? 'text-primary bg-primary/10 border border-primary/20 font-semibold'
                        : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
                                        <span class="flex-1">{{ $item['label'] }}</span>
                                        @if(request()->routeIs($item['route']))
                                            <i class="fa-solid fa-check text-primary text-sm"></i>
                                        @else
                                            <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                                        @endif
                                    </a>
                    @endforeach
                </nav>

                {{-- Mobile Actions --}}
                <div class="pt-4 border-t border-gray-200 space-y-3">
                    <a href="tel:+919876543210"
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

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById("mobileMenu");
        const menuIcon = document.getElementById("menuIcon");
        const closeIcon = document.getElementById("closeIcon");
        const body = document.body;

        // Toggle menu visibility
        const isOpening = menu.classList.contains("hidden");

        if (isOpening) {
            // Opening menu
            menu.classList.remove("hidden");
            menuIcon.classList.add("opacity-0", "scale-75");
            closeIcon.classList.remove("opacity-0", "scale-75");
            closeIcon.classList.add("opacity-100", "scale-100");
            body.classList.add("overflow-hidden");
        } else {
            // Closing menu
            menu.classList.add("hidden");
            menuIcon.classList.remove("opacity-0", "scale-75");
            menuIcon.classList.add("opacity-100", "scale-100");
            closeIcon.classList.add("opacity-0", "scale-75");
            closeIcon.classList.remove("opacity-100", "scale-100");
            body.classList.remove("overflow-hidden");
        }

        // Update aria-expanded
        const btn = document.querySelector('.mobile-menu-btn');
        if (btn) {
            btn.setAttribute('aria-expanded', isOpening);
        }
    }

    // Close mobile menu when clicking on links (optional)
    document.addEventListener('click', function (e) {
        const menu = document.getElementById("mobileMenu");
        if (!menu.classList.contains("hidden") && e.target.closest('a[href]')) {
            toggleMobileMenu();
        }
    });

    // Close mobile menu on window resize to large screens
    window.addEventListener('resize', () => {
        const menu = document.getElementById("mobileMenu");
        if (window.innerWidth >= 1024 && menu && !menu.classList.contains("hidden")) {
            toggleMobileMenu();
        }
    });

    // Close menu with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const menu = document.getElementById("mobileMenu");
            if (menu && !menu.classList.contains("hidden")) {
                toggleMobileMenu();
            }
        }
    });
</script>

<style>
    /* Smooth transitions for mobile menu */
    #mobileMenu {
        transition: all 0.3s ease-in-out;
    }

    .mobile-menu-btn svg {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Improve button hover effects */
    .btn-primary,
    .btn-secondary {
        transition: all 0.2s ease-in-out;
        transform-origin: center;
    }

    .btn-primary:hover,
    .btn-secondary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Active state for buttons */
    .btn-primary:active,
    .btn-secondary:active {
        transform: translateY(0);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
</style>