{{-- @php
    // Data (can be passed in as props later)
    $quickLinks = [
        ['label' => 'About Us', 'href' => '#about'],
        ['label' => 'Treatments', 'href' => '#treatments'],
        ['label' => 'Practitioners', 'href' => '#practitioners'],
        ['label' => 'Contact', 'href' => '#contact'],
    ];

    $treatments = [
        ['label' => 'Panchakarma', 'href' => '#'],
        ['label' => 'Massage Therapy', 'href' => '#'],
        ['label' => 'Herbal Medicine', 'href' => '#'],
        ['label' => 'Consultation', 'href' => '#'],
    ];

    $resources = [
        ['label' => 'Blog', 'href' => '#blog'],
        ['label' => 'Wellness Tips', 'href' => '#'],
        ['label' => 'Dosha Quiz', 'href' => '#'],
        ['label' => 'FAQ', 'href' => '#'],
    ];

    $socialLinks = [
        ['icon' => 'facebook', 'href' => '#', 'label' => 'Facebook'],
        ['icon' => 'twitter', 'href' => '#', 'label' => 'Twitter'],
        ['icon' => 'instagram', 'href' => '#', 'label' => 'Instagram'],
        ['icon' => 'youtube', 'href' => '#', 'label' => 'YouTube'],
    ];

    $contactInfo = [
        ['icon' => 'map',   'label' => 'Visit Us', 'value' => '123 Brigade Road, Bangalore, Karnataka 560025'],
        ['icon' => 'phone', 'label' => 'Call Us',  'value' => '+91 98765 43210'],
        ['icon' => 'mail',  'label' => 'Email Us', 'value' => 'hello@ayurveda.com'],
    ];
@endphp

<footer class="bg-foreground text-background relative overflow-hidden">
  
  <div class="absolute inset-0 opacity-5">
    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23FEFFF3\" fill-opacity=\"0.1\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"1\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
  </div>

  <div class="max-w-[1200px] mx-auto px-6 relative z-10">
    
    <div class="py-12 grid lg:grid-cols-12 gap-8">
      
      <div class="lg:col-span-4 space-y-4">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center shadow-lg">
            <svg class="w-5 h-5 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-bold text-background">Jivanam Wellness</h3>
            <p class="text-sm text-muted">Ancient Wisdom • Modern Healing</p>
          </div>
        </div>

        <p class="text-muted-foreground leading-relaxed text-sm">
          Experience the harmony of traditional Ayurvedic healing blended with contemporary wellness practices. 
          Restore your natural balance and embrace vitality.
        </p>
 
        <div class="flex flex-wrap gap-3 pt-2">
          <div class="flex items-center space-x-2 text-xs text-muted">
            <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
            <span>Certified Practitioners</span>
          </div>
          <div class="flex items-center space-x-2 text-xs text-muted">
            <div class="w-1.5 h-1.5 bg-accent rounded-full"></div>
            <span>100% Natural</span>
          </div>
        </div>
      </div>
 
      <div class="lg:col-span-2 space-y-4">
        <h4 class="font-semibold text-background text-sm relative inline-block">
          Quick Links
          <span class="absolute -bottom-1 left-0 w-6 h-0.5 bg-primary"></span>
        </h4>
        <ul class="space-y-2">
          @foreach ($quickLinks as $link)
            <li>
              <a href="{{ $link['href'] }}" class="group flex items-center text-muted-foreground hover:text-background transition-all duration-200 hover:translate-x-1 text-sm">
                <svg class="w-3 h-3 mr-2 text-primary opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                {{ $link['label'] }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>
  
      <div class="lg:col-span-2 space-y-4">
        <h4 class="font-semibold text-background text-sm relative inline-block">
          Treatments
          <span class="absolute -bottom-1 left-0 w-6 h-0.5 bg-accent"></span>
        </h4>
        <ul class="space-y-2">
          @foreach ($treatments as $t)
            <li>
              <a href="{{ $t['href'] }}" class="group flex items-center text-muted-foreground hover:text-background transition-all duration-200 hover:translate-x-1 text-sm">
                <svg class="w-3 h-3 mr-2 text-accent opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                {{ $t['label'] }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>
 
      <div class="lg:col-span-4 space-y-4">
        <h4 class="font-semibold text-background text-sm relative inline-block">
          Get In Touch
          <span class="absolute -bottom-1 left-0 w-6 h-0.5 bg-primary"></span>
        </h4>
 
        <div class="space-y-3">
          @foreach ($contactInfo as $item)
            <div class="group flex items-start space-x-3 p-2 rounded-lg bg-white/5 hover:bg-white/10 transition-all duration-200">
              <div class="flex-shrink-0 w-8 h-8 bg-primary rounded-md flex items-center justify-center group-hover:scale-105 transition-transform">
                @if ($item['icon'] === 'map')
                  <svg class="w-4 h-4 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                @elseif($item['icon'] === 'phone')
                  <svg class="w-4 h-4 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                  </svg>
                @else
                  <svg class="w-4 h-4 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                @endif
              </div>
              <div class="min-w-0 flex-1">
                <div class="text-xs text-muted font-medium">{{ $item['label'] }}</div>
                <div class="text-background text-sm truncate">{{ $item['value'] }}</div>
              </div>
            </div>
          @endforeach
        </div>
 
        <div class="pt-2">
          <h5 class="font-medium text-muted-foreground text-xs mb-2">Follow Our Journey</h5>
          <div class="flex space-x-2">
            @foreach ($socialLinks as $s)
              <a href="{{ $s['href'] }}" class="group w-8 h-8 bg-white/10 rounded-md flex items-center justify-center hover:bg-primary transition-all duration-200 hover:scale-105" aria-label="{{ $s['label'] }}">
                @if ($s['icon'] === 'facebook')
                  <svg class="w-3.5 h-3.5 text-muted-foreground group-hover:text-primary-foreground transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                  </svg>
                @elseif($s['icon'] === 'twitter')
                  <svg class="w-3.5 h-3.5 text-muted-foreground group-hover:text-primary-foreground transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                  </svg>
                @elseif($s['icon'] === 'instagram')
                  <svg class="w-3.5 h-3.5 text-muted-foreground group-hover:text-primary-foreground transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.014 5.367 18.647.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.273 14.857 3.784 13.706 3.784 12.41s.489-2.448 1.342-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.853.875 1.342 2.026 1.342 3.323s-.489 2.448-1.342 3.323c-.875.807-2.026 1.297-3.323 1.297z"/>
                  </svg>
                @else
                  <svg class="w-3.5 h-3.5 text-muted-foreground group-hover:text-primary-foreground transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                  </svg>
                @endif
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
 
    <div class="py-6 border-t border-muted">
      <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
        <div class="text-center lg:text-left">
          <h4 class="text-lg font-bold text-background mb-1">Stay Connected</h4>
          <p class="text-muted-foreground text-sm">Get wellness tips & updates</p>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
          <form action="#" method="POST" class="flex gap-2 flex-1 min-w-[250px]">
            <input type="email" name="email" placeholder="Enter your email"
                   class="px-3 py-2 rounded-lg bg-white/10 border border-muted text-background placeholder:text-muted-foreground w-full text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
            />
            <button type="submit" class="btn-primary whitespace-nowrap text-sm px-4">
              Subscribe
            </button>
          </form>

          <a href="#booking" class="btn-secondary whitespace-nowrap text-sm px-4 py-2 flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Book Now
          </a>
        </div>
      </div>
    </div>
 
    <div class="py-4 border-t border-muted flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-muted-foreground">
      <div class="flex items-center space-x-2">
        <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
        <span>© {{ date('Y') }} Jivanam Wellness. All rights reserved.</span>
      </div>
      
      <div class="flex flex-wrap justify-center gap-4">
        <a href="#" class="hover:text-background transition-colors duration-200 text-xs">Privacy Policy</a>
        <a href="#" class="hover:text-background transition-colors duration-200 text-xs">Terms of Service</a>
        <a href="#" class="hover:text-background transition-colors duration-200 text-xs">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer> --}}


@php
    // Data (can be passed in as props later)
    $quickLinks = [
        ['label' => 'About Us', 'href' => '#about'],
        ['label' => 'Treatments', 'href' => '#treatments'],
        ['label' => 'Practitioners', 'href' => '#practitioners'],
        ['label' => 'Contact', 'href' => '#contact'],
    ];

    $treatments = [
        ['label' => 'Panchakarma', 'href' => '#'],
        ['label' => 'Massage Therapy', 'href' => '#'],
        ['label' => 'Herbal Medicine', 'href' => '#'],
        ['label' => 'Consultation', 'href' => '#'],
    ];

    $resources = [
        ['label' => 'Blog', 'href' => '#blog'],
        ['label' => 'Wellness Tips', 'href' => '#'],
        ['label' => 'Dosha Quiz', 'href' => '#'],
        ['label' => 'FAQ', 'href' => '#'],
    ];

    $socialLinks = [
        ['icon' => 'facebook', 'href' => '#', 'label' => 'Facebook'],
        // ['icon' => 'twitter', 'href' => '#', 'label' => 'Twitter'],
        ['icon' => 'instagram', 'href' => '#', 'label' => 'Instagram'],
        ['icon' => 'youtube', 'href' => '#', 'label' => 'YouTube'],
    ];

    $contactInfo = [
        ['icon' => 'map', 'label' => 'Visit Us', 'value' => '123 Brigade Road, Bangalore, Karnataka 560025'],
        ['icon' => 'phone', 'label' => 'Call Us', 'value' => '+91 98765 43210'],
        ['icon' => 'mail', 'label' => 'Email Us', 'value' => 'hello@ayurveda.com'],
    ];
@endphp

<footer class="bg-primary text-background relative overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23FEFFF3\" fill-opacity=\"0.1\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"1\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>
    </div>

    <div class="max-w-[1200px] mx-auto px-6 relative z-10">
        {{-- Main Footer Content --}}
        <div class="py-12 grid lg:grid-cols-12 gap-8">
            {{-- Brand Section --}}
            <div class="lg:col-span-4 space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-primary-foreground" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-background">Jivanam Wellness</h3>
                        <p class="text-sm text-muted">Ancient Wisdom • Modern Healing</p>
                    </div>
                </div>

                <p class="text-muted-background leading-relaxed text-sm">
                    Experience the harmony of traditional Ayurvedic healing blended with contemporary wellness
                    practices.
                    Restore your natural balance and embrace vitality.
                </p>

                {{-- Trust Badges --}}
                <div class="flex flex-wrap gap-3 pt-2">
                    <div class="flex items-center space-x-2 text-xs text-muted">
                        <div class="w-1.5 h-1.5 bg-secondary rounded-full"></div>
                        <span>Certified Practitioners</span>
                    </div>
                    <div class="flex items-center space-x-2 text-xs text-muted">
                        <div class="w-1.5 h-1.5 bg-secondary rounded-full"></div>
                        <span>100% Natural</span>
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="lg:col-span-2 space-y-4">
                <h4 class="font-semibold text-background text-sm relative inline-block">
                    Quick Links
                    <span class="absolute -bottom-1 left-0 w-6 h-0.5 bg-secondary"></span>
                </h4>
                <ul class="space-y-2">
                    @foreach ($quickLinks as $link)
                        <li>
                            <a href="{{ $link['href'] }}"
                                class="group flex items-center text-muted-background hover:text-secondary  transition-all duration-200 hover:translate-x-1 text-sm">
                                <svg class="w-3 h-3 mr-2 text-secondary opacity-0 group-hover:opacity-100 transition-opacity"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Treatments --}}
            <div class="lg:col-span-2 space-y-4">
                <h4 class="font-semibold text-background text-sm relative inline-block">
                    Treatments
                    <span class="absolute -bottom-1 left-0 w-6 h-0.5 bg-secondary"></span>
                </h4>
                <ul class="space-y-2">
                    @foreach ($treatments as $t)
                        <li>
                            <a href="{{ $t['href'] }}"
                                class="group flex items-center text-muted-background hover:text-secondary transition-all duration-200 hover:translate-x-1 text-sm">
                                <svg class="w-3 h-3 mr-2 text-secondary opacity-0 group-hover:opacity-100 transition-opacity"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                {{ $t['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact & Social --}}
            <div class="lg:col-span-4 space-y-4">
                <h4 class="font-semibold text-background text-sm relative inline-block">
                    Get In Touch
                    <span class="absolute -bottom-1 left-0 w-6 h-0.5 bg-primary"></span>
                </h4>

                {{-- Contact Info --}}
                <div class="space-y-3">
                    @foreach ($contactInfo as $item)
                        <div
                            class="group flex items-start space-x-3 p-2 rounded-lg bg-white/5 hover:bg-white/10 transition-all duration-200">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-primary rounded-md flex items-center justify-center group-hover:scale-105 transition-transform">
                                @if ($item['icon'] === 'map')
                                    <svg class="w-4 h-4 text-primary-foreground" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                @elseif($item['icon'] === 'phone')
                                    <svg class="w-4 h-4 text-primary-foreground" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-primary-foreground" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-xs text-muted font-medium">{{ $item['label'] }}</div>
                                <div class="text-background text-sm truncate">{{ $item['value'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>

        {{-- Newsletter & Quick Action --}}
        <div class="py-6 border-t border-muted">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                <div class="flex flex-col sm:flex-row justify-between gap-3 w-full lg:w-1/2">
                    <div class=" text-left">
                        <h4 class="text-lg font-bold text-background ">Stay Connected</h4>
                        <p class="text-border text-sm">Get wellness tips & updates</p>
                    </div> {{-- Social Links --}}
                    <div class=" "> 
                        <h5 class="font-medium text-background text-xs mb-2">Follow Our Journey</h5>
                        <div class="flex space-x-2">
                            @foreach ($socialLinks as $s)
                                <a href="{{ $s['href'] }}"
                                    class="group w-8 h-8 bg-white/10 rounded-md flex items-center justify-center hover:bg-primary transition-all duration-200 hover:scale-105"
                                    aria-label="{{ $s['label'] }}">
                                    @if ($s['icon'] === 'facebook')
                                        <svg class="w-3.5 h-3.5 text-border group-hover:text-primary-foreground transition-colors"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                        {{-- @elseif($s['icon'] === 'twitter')
                  <svg class="w-3.5 h-3.5 text-border group-hover:text-primary-foreground transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                  </svg> --}}
                                    @elseif($s['icon'] === 'instagram')
                                        <svg class="w-3.5 h-3.5 text-border group-hover:text-primary-foreground transition-colors"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.014 5.367 18.647.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.273 14.857 3.784 13.706 3.784 12.41s.489-2.448 1.342-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.853.875 1.342 2.026 1.342 3.323s-.489 2.448-1.342 3.323c-.875.807-2.026 1.297-3.323 1.297z" />
                                        </svg>
                                    @else
                                        <svg class="w-3.5 h-3.5 text-border group-hover:text-primary-foreground transition-colors"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                        </svg>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <form action="#" method="POST" class="flex gap-2 flex-1 min-w-[250px]">
                        <input type="email" name="email" placeholder="Enter your email"
                            class="px-3 py-2 rounded-lg bg-white/10 border border-muted text-background placeholder:text-border w-full text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" />
                        <button type="submit" class="bg-secondary rounded-lg whitespace-nowrap text-sm px-4">
                            Subscribe
                        </button>
                    </form>

                    <a href="#booking"
                        class="btn-secondary whitespace-nowrap text-sm px-4 py-2 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Book Now
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom Footer --}}
        <div
            class="py-4 border-t border-muted flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-muted-foreground">
            <div class="flex items-center space-x-2 text-border">
                <div class="w-1.5 h-1.5 bg-border  rounded-full"></div>
                <span>© {{ date('Y') }} Jivanam Wellness. All rights reserved.</span>
            </div>

            <div class="flex flex-wrap justify-center gap-4">
                <a href="#"
                    class="hover:text-background text-border transition-colors duration-200 text-xs">Privacy Policy</a>
                <a href="#"
                    class="hover:text-background text-border transition-colors duration-200 text-xs">Terms of
                    Service</a>
                <a href="#"
                    class="hover:text-background text-border transition-colors duration-200 text-xs">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>
