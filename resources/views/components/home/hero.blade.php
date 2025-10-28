<section class="relative overflow-hidden bg-background">
    <!-- Gradient Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-muted/20 to-background/50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Left Content -->
            <div class=" space-y-6 ">
                <div class=" space-y-6">
                    <!-- Badge --> <span class="badge-accent "> Ancient Wisdom, Modern Care </span>
                    <!-- Main Heading -->
                    <h1 class="hero-heading text-foreground pt-5"> Restore Balance with <span
                            class="text-primary">Authentic Ayurveda</span> </h1> <!-- Description -->
                    <p class="hero-description text-muted-foreground "> Experience holistic healing through time-tested
                        Ayurvedic treatments. Our certified practitioners combine ancient wisdom with modern care to
                        restore your natural balance and vitality. </p> <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4"> <button
                            class="btn-primary hover:bg-primary/90 shadow-lg transition-colors duration-200 inline-flex items-center justify-center"
                            data-booking data-treatment="{{ $therapy?->slug ?? ($treatments->first()?->slug ?? '') }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg> Book Consultation </button>
                        <a href="/therapy"
                            class="btn-secondary hover:border-border/80 hover:bg-card/80 transition-colors duration-200">
                            Learn About Treatments </a>
                    </div>
                </div> <!-- Feature Pills -->
                <div class="flex flex-wrap gap-3">
                    @php $features = ['Authentic Ayurvedic Treatments', 'Certified Practitioners', 'Personalized Care
                    Plans', 'Natural Healing Methods',]; @endphp
                    @foreach ($features as $feature) <div
                        class="flex items-center gap-2 bg-card/80 backdrop-blur-sm rounded-full px-4 py-2 border border-border shadow-sm">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg> <span class="text-sm font-medium text-foreground">{{ $feature }}</span>
                    </div>
                    @endforeach </div> <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 pt-8 border-t border-border">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-foreground">2,500+</div>
                        <div class="text-sm text-muted-foreground mt-1">Happy Patients</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-foreground">15+</div>
                        <div class="text-sm text-muted-foreground mt-1">Years Experience</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-foreground">95%</div>
                        <div class="text-sm text-muted-foreground mt-1">Success Rate</div>
                    </div>
                </div>
            </div> <!-- Right Content - Image with Card -->
            <div class="relative">
                <!-- Main Image Container -->
                <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-card"> <img
                        src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1820&q=80"
                        alt="Ayurvedic treatment and herbs" class="w-full h-[500px] lg:h-[600px] object-cover" />
                    <!-- Floating Consultation Card -->
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="card backdrop-blur-sm shadow-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-foreground text-lg">Free Consultation</h3>
                                    <p class="text-muted-foreground mt-1">Discover your dosha and personalized wellness
                                        plan</p>
                                </div>
                                <div class="ml-4 bg-primary/10 rounded-full p-3"> <svg class="w-6 h-6 text-primary"
                                        data-booking
                                        data-treatment="{{ $therapy?->slug ?? ($treatments->first()?->slug ?? '') }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg> </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Decorative Elements -->
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-accent/20 rounded-full blur-2xl opacity-40"></div>
                <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-primary/20 rounded-full blur-2xl opacity-40"></div>
            </div>
        </div>
    </div>
</section>