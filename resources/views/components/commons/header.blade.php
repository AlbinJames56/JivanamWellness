<header class="sticky top-0 z-50 w-full bg-white/95 backdrop-blur-sm border-b border-border">
    <div class="  mx-auto px-5 xl:px-32">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <div class="flex items-center cursor-pointer" onclick="window.location.href='{{ route('home') }}'">
                <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center mr-3">
                    <div class="w-4 h-4 bg-white rounded-full"></div>
                </div>
                <span class="text-xl font-medium text-foreground">Jivanam Wellness</span>
            </div>

            {{-- Desktop Navigation --}}
            <nav class="hidden md:flex items-center space-x-8">
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

            {{-- Desktop Actions --}}
            <div class="hidden md:flex items-center space-x-4">
                <a href="tel:+91XXXXXXXXXX" class="btn-secondary flex items-center px-3 py-1 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h2l3.6 7.59-1.35 2.44A1 1 0 008 17h10a1 1 0 00.9-1.45L17 10h-2" />
                    </svg>
                    Call Us
                </a>

                <button class="btn-primary flex items-center px-3 py-1 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Book Appointment
                </button>

            </div>

            {{-- Mobile Menu Toggle --}}
            <div class="md:hidden flex items-center space-x-2">
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

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden border-t border-border py-4">
            <nav class="flex flex-col space-y-3">
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="text-sm font-medium transition-colors hover:text-primary
                        {{ request()->routeIs($item['route']) ? 'text-primary' : 'text-muted-foreground' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
                <div class="flex flex-col space-y-2 pt-3 border-t border-border">
                    <a href="tel:+91XXXXXXXXXX" class="btn-secondary flex items-center">
                        Call Us
                    </a>
                    <button class="btn-primary flex items-center">
                        Book Appointment
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
        menu.classList.toggle("hidden");
        menuIcon.classList.toggle("hidden");
        closeIcon.classList.toggle("hidden");
    }
</script>
