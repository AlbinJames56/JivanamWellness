@php
  $quickLinks = [
    ['label' => 'About Us', 'href' => '#about'],
    ['label' => 'Practitioners', 'href' => '#practitioners'],
    ['label' => 'Contact', 'href' => '#contact'],
  ];

  $socialLinks = [
    ['icon' => 'facebook', 'href' => 'https://www.facebook.com/jivanam.wellness/', 'label' => 'Facebook'],
    ['icon' => 'instagram', 'href' => 'https://www.instagram.com/jivanam.wellness/', 'label' => 'Instagram'],
  ];

  $contactInfo = [

    ['icon' => 'phone', 'label' => 'Call Us', 'value' => '+91 82 2050 3388'],
    ['icon' => 'mail', 'label' => 'Email Us', 'value' => 'jeevanamwellnessdigital@gmail.com'],
  ];
@endphp

<!-- local footer color overrides (light theme for footer only) -->
<!-- local footer color overrides (light greenish theme for footer only) -->
<style>
  footer.bg-primary {
    /* 🌿 Theme palette */
    --primary: #f2f9f4;
    /* soft greenish white background */
    --primary-foreground: #0a2e1b;
    /* dark green text */
    --secondary: #3cb371;
    /* medium green for small highlights */
    --accent: #86efac;
    /* light mint accent line */
    --border: #d6e9dc;
    /* subtle divider color */
  }

  /* make all white text adopt new dark color */
  footer.bg-primary .text-white,
  footer.bg-primary .text-white\/90,
  footer.bg-primary .text-white\/80 {
    color: var(--primary-foreground) !important;
    opacity: 1 !important;
  }

  /* adjust background overlays for light mode */
  footer.bg-primary .bg-white\/10 {
    background-color: rgba(10, 46, 27, 0.06) !important;
    /* faint green tint */
  }

  footer.bg-primary .bg-white\/5 {
    background-color: rgba(10, 46, 27, 0.04) !important;
  }

  footer.bg-primary .w-1\.5.h-1\.5 {
    background: var(--secondary) !important;
  }

  footer.bg-primary a:hover {
    color: var(--secondary) !important;
  }

  footer.bg-primary .bg-white {
    background-color: #ffffff !important;
  }
</style>

<footer class="bg-primary text-primary-foreground relative overflow-hidden"
  style="--primary:#f8fafc; --primary-foreground:#0f172a; --secondary:#34d399; --accent:#f59e0b; --border:#e6e7ea;">
  <div class="max-w-[1200px] mx-auto px-6 py-8">
    <!-- Top row (flex columns) -->
    <div class="flex flex-col lg:flex-row lg:items-start lg:gap-8 gap-6">
      <!-- LEFT: Brand / About (6/12) -->
      <div class="w-full lg:w-5/12">
        <div class="mb-4" style="width:280px;">
          <img src="/images/logo.png" alt="Jivanam Wellness"
            style="width:280px; height:auto; display:block; object-fit:contain;" />
        </div>

        <p class="text-sm text-white leading-relaxed mb-4">
          Experience the harmony of traditional Ayurvedic healing blended with contemporary wellness practices.
          Restore your natural balance and embrace vitality.
        </p>

        <div class="flex flex-wrap gap-3 text-xs">
          <span class="inline-flex items-center gap-2 text-white">
            <span class="w-1.5 h-1.5 rounded-full" style="background:var(--secondary);"></span>
            Certified Practitioners
          </span>
          <span class="inline-flex items-center gap-2 text-white">
            <span class="w-1.5 h-1.5 rounded-full" style="background:var(--secondary);"></span>
            100% Natural
          </span>
        </div>
      </div>

      <!-- RIGHT: Contact & Partner Logo (6/12) -->
      <div class="w-full lg:w-7/12">
        <div class="flex flex-col lg:flex-row gap-8">
          <!-- Contact Info -->
          <div class="lg:w-5/12">
            <div class="hidden lg:block h-0.5 w-12 bg-accent mb-3"></div>
            <h4 class="font-bold text-sm text-white mb-3">Get In Touch</h4>

            <div class="space-y-3">
              @foreach ($contactInfo as $item)
                <div class="flex items-start gap-3 p-2 rounded-lg bg-white/5">
                  <div class="w-8 h-8 rounded-md flex items-center justify-center" style="background:var(--primary);">
                    @if   ($item['icon'] === 'phone')
                      <i class="fa-solid fa-phone text-primary-foreground"></i>
                    @else
                      <i class="fa-solid fa-envelope text-primary-foreground"></i>
                    @endif
                  </div>
                  <div class="min-w-0">
                    <div class="text-xs text-white font-medium">{{ $item['label'] }}</div>
                    <div class="text-sm text-white truncate">{{ $item['value'] }}</div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <!-- Partner Logo -->
          <div class="lg:w-7/12">
            <div class="hidden lg:block h-0.5 w-12 bg-accent mb-3"></div>

            <div class="bg-white/10 rounded-lg p-1 flex items-center justify-center ">
              <div class="text-center">
                <img src="{{ asset('images/kotakllogo.jpg') }}" alt="Kotak Partner"
                  class="mx-auto max-w-[330px] h-auto    rounded-lg" />

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Social / CTA row -->
    <div class="pt-6 mt-6 border-t border-muted">
      <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
        <div class="text-left">
          <h4 class="text-lg font-bold text-white mb-1">Stay Connected</h4>
          <p class="text-sm text-white/90">Follow our social channels for tips, updates and more.</p>
        </div>

        <div class="flex items-center gap-3">
          @foreach ($socialLinks as $s)
            <a href="{{ $s['href'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $s['label'] }}"
              class="inline-flex items-center justify-center w-10 h-10 rounded-md bg-white/10 hover:bg-white/20 transition-all text-white">
              @if($s['icon'] === 'facebook')
                <i class="fab fa-facebook-f"></i>
              @elseif($s['icon'] === 'instagram')
                <i class="fab fa-instagram"></i>
              @else
                <i class="fa-solid fa-link"></i>
              @endif
            </a>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Bottom Row -->
    <div class="pt-4 mt-6 border-t border-muted">
      <div class="flex flex-col md:flex-row items-center justify-between gap-3 text-xs text-white/80">
        <div class="flex items-center gap-2">
          <div class="w-1.5 h-1.5 rounded-full" style="background:var(--border);"></div>
          <span>© {{ date('Y') }} Jivanam Wellness. All rights reserved.</span>
        </div>

        <div class="flex gap-4">
          <a href="#" class="text-xs hover:text-primary-foreground">Privacy Policy</a>
          <a href="#" class="text-xs hover:text-primary-foreground">Terms of Service</a>
          <a href="#" class="text-xs hover:text-primary-foreground">Cookie Policy</a>
        </div>
      </div>
    </div>
  </div>
</footer>