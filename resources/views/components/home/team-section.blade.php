<section id="team" class="py-16 bg-background">
    <div class="max-w-[1100px] mx-auto px-5">
        <div class="text-center space-y-6 mb-8" data-aos="fade-up" data-aos-delay="80">
            <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Meet Our Expert Doctors</h2>
            <p class="text-lg text-muted-foreground mx-auto leading-relaxed max-w-2xl">
                Discover the skilled practitioners guiding our therapies and personalised care plans.
            </p>
        </div>

        {{-- Cards grid (show up to 3) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="120">
            @php $previewMembers = $teamMembers->take(3); @endphp

            @if($previewMembers->isNotEmpty())
                @foreach($previewMembers as $member)
                    <div class="team-card-wrapper">
                        @include('components.home.team-card', ['m' => $member])
                    </div>
                @endforeach

                {{-- If less than 3 members, fill remaining slots with placeholders (optional) --}}
                @for($i = $previewMembers->count(); $i < 3; $i++)
                    <div
                        class="team-card-wrapper opacity-80 border border-border rounded-lg p-4 flex items-center justify-center">
                        <div class="text-center text-muted-foreground">
                            <div class="mb-2 font-medium">Profile coming soon</div>
                            <div class="text-sm">We will add more doctors shortly.</div>
                        </div>
                    </div>
                @endfor
            @else
                <div class="col-span-full text-center text-muted-foreground py-12">
                    Team information will be available soon.
                </div>
            @endif
        </div>

        {{-- CTA --}}
        <div class="flex justify-center mt-8" data-aos="fade-up" data-aos-delay="180">
            <a href="/doctors"
                class="inline-flex items-center gap-3 px-6 py-3 bg-primary text-white rounded-full font-medium shadow-md hover:bg-primary/90 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/40"
                aria-label="View all doctors">
                View All Doctors
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>

<style>
    .team-card-wrapper {
        /* ensure included card stretches consistently */
        display: flex;
        align-items: stretch;
    }

    .team-card-wrapper>* {
        width: 100%;
    }
</style>