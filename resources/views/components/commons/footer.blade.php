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
    ['icon' => 'map', 'label' => 'Visit Us', 'value' => '123 Brigade Road, Bangalore, Karnataka 560025'],
    ['icon' => 'phone', 'label' => 'Call Us', 'value' => '+91 98765 43210'],
    ['icon' => 'mail', 'label' => 'Email Us', 'value' => 'hello@ayurveda.com'],
  ];
@endphp

{{-- Add Font Awesome in

<head> if not present:
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  --}}

  <footer class="bg-primary text-primary-foreground relative overflow-hidden">
    <div class="max-w-[1200px] mx-auto px-6 py-8">
      <!-- Top row (flex columns) -->
      <div class="flex flex-col lg:flex-row lg:items-start lg:gap-8 gap-6">
        <!-- LEFT: Brand / About (5/12) -->
        <div class="w-full lg:w-5/12">
          <!-- replace your current logo block with this -->
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

        <!-- SPACER: empty column to balance layout on large screens (takes space) -->
        <div class="hidden lg:block lg:w-3/12" style="width:280px;"></div>

        <!-- MIDDLE: Quick Links (2/12) centered; list items left-aligned inside the small centered block -->
        <!--<div class="w-full lg:w-2/12 flex justify-center lg:items-start lg:pt-14">-->
        <!--  <div class= "">-->
        <!--    <h4 class="font-bold text-lg text-white mb-6 text-center lg:text-center">Quick Links</h4>-->

        <!--    <ul class="space-y-3">-->
        <!--      @foreach ($quickLinks as $link)-->
        <!--        <li>-->
        <!--          <a href="{{ $link['href'] }}"-->
        <!--             class="flex items-start gap-3 text-base text-white/90 hover:text-white transition-colors duration-200">-->
        <!--            <span class="flex-shrink-0 mt-1 w-3 h-3 rounded-full" style="background:var(--secondary);"></span>-->
        <!--            <span class="block flex-1 text-left leading-tight">{{ $link['label'] }}</span>-->
        <!--          </a>-->
        <!--        </li>-->
        <!--      @endforeach-->
        <!--    </ul>-->
        <!--  </div>-->
        <!--</div>-->

        <!-- RIGHT: Contact & Social (4/12 or 3/12 depending on space) -->
        <div class="w-full lg:w-3/12 lg:pt-6">
          <div class="hidden lg:block h-0.5 w-12 bg-accent mb-3 ml-auto"></div>
          <h4 class="font-bold text-sm text-white mb-3 lg:ml-auto">Get In Touch</h4>

          <div class="space-y-3">
            @foreach ($contactInfo as $item)
              <div class="flex items-start gap-3 p-2 rounded-lg bg-white/5">
                <div class="w-8 h-8 rounded-md flex items-center justify-center" style="background:var(--primary);">
                  @if ($item['icon'] === 'map')
                    <i class="fa-solid fa-location-dot text-primary-foreground"></i>
                  @elseif($item['icon'] === 'phone')
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