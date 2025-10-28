<header class="sticky top-0 z-50 w-full bg-white/95 backdrop-blur-sm border-b border-border">
    <div class="  mx-auto px-5 xl:px-32">
        <div class="flex items-center justify-between   h-16">
            {{-- Logo --}}
            <div class="flex items-center cursor-pointer" onclick="window.location.href='{{ route('home') }}'">
                <img src="{{ asset('images/logo.png') }}" alt="Site Logo" class="h-8 w-auto" />
            </div>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center space-x-8 lg:space-x-5 xl:space-x-8">
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
                    <a href="{{ route($item['route']) }}"
                        class="text-sm font-medium transition-colors hover:text-primary
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                {{ request()->routeIs($item['route']) ? 'text-primary' : 'text-muted-foreground' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="flex gap-2">
                {{-- Desktop Actions --}}
                <div class="hidden md:flex items-center space-x-2  text-xs ">
                    <a href="tel:+91XXXXXXXXXX" class="btn-secondary flex items-center  text-xs xl:text-sm gap-2">
                        <i class="fa-solid fa-phone me-1"></i>
                        Call Us
                    </a>
                    <button class="flex-1 btn-primary" data-booking @isset($therapy)
                    data-treatment="{{ $therapy->slug }}" @endisset> <i
                            class="fa-solid fa-calendar-check me-1"></i>Book Appointment</button>



                </div>

                {{-- Mobile Menu Toggle --}}
                <div class="lg:hidden flex items-center space-x-2">
                    <button class="btn-primary flex items-center px-3 py-2" onclick="toggleMobileMenu()">
                        <svg xmlns="http://www.w3.org/2000/svg" id="menuIcon" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" id="closeIcon" class="w-5 h-5 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}} 
        <!-- Remove md:hidden — keep default hidden and hide only on lg screens -->
        <div id="mobileMenu" class="hidden lg:hidden border-t border-border py-4">
            <nav class="flex flex-col space-y-3 px-4"> <!-- added small padding for nicer spacing -->
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs($item['route']) ? 'text-primary' : 'text-muted-foreground' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach

                <div class="flex flex-col space-y-2 pt-3 border-t border-border">
                    <a href="tel:+91XXXXXXXXXX" class="btn-secondary flex items-center justify-center">
                        Call Us
                    </a>

                    <button class="flex-1 btn-primary" data-booking @isset($therapy)
                    data-treatment="{{ $therapy->slug }}" @endisset>
                        <i class="fa-solid fa-calendar-check me-1"></i>Book Appointment
                    </button>
                </div>
            </nav>
        </div>

    </div>
</header>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById("mobileMenu");
        const menuIcon = document.getElementById("menuIcon");
        const closeIcon = document.getElementById("closeIcon");

        // Toggle icons
        menuIcon.classList.toggle("hidden");
        closeIcon.classList.toggle("hidden");

        // Toggle visibility: ensure we add a blocking display when opened
        const isHidden = menu.classList.contains("hidden");
        if (isHidden) {
            // open: remove hidden and make sure it's a block element
            menu.classList.remove("hidden");
            // add a block display so Tailwind responsive utilities don't conflict
            menu.classList.add("block");
        } else {
            // close: hide and remove block
            menu.classList.add("hidden");
            menu.classList.remove("block");
        }

        // update aria-expanded on the toggle button (for accessibility)
        const btn = event?.currentTarget || null;
        if (btn && btn.setAttribute) {
            const expanded = !isHidden;
            // if currentTarget is the button, toggle attribute; if not, fallback to search
            btn.setAttribute('aria-expanded', String(!isHidden));
        } else {
            const toggleButton = document.querySelector('button[onclick="toggleMobileMenu()"]');
            if (toggleButton) toggleButton.setAttribute('aria-expanded', String(!isHidden));
        }
    }

    // Optional: close mobile menu on window resize to large screens
    window.addEventListener('resize', () => {
        const menu = document.getElementById("mobileMenu");
        if (!menu) return;
        // If we are on desktop (>= 1024 px), ensure menu is hidden
        if (window.innerWidth >= 1024) {
            menu.classList.add('hidden');
            menu.classList.remove('block');
            // reset icons
            document.getElementById("menuIcon")?.classList.remove('hidden');
            document.getElementById("closeIcon")?.classList.add('hidden');
        }
    });
</script>