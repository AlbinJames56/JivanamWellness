@extends('layouts.app') {{-- or your main layout --}}

@section('content')
    <section class="bg-background">
        <div class="max-w-[1100px] mx-auto px-5 pt-12  mt-8 pb-8">

            {{-- Hero --}}
            <div class="rounded-xl overflow-hidden mb-8 shadow-md">
                <div class="relative h-48 md:h-64">
                    <img src="/images/dctrbg.jpg" alt="Doctors hero" class="w-full h-full object-cover" />

                    <div class="absolute inset-0 bg-white/70 flex items-end justify-center p-6">
                        <div>
                            <h1 class="text-2xl md:text-3xl text-white/70  font-extrabold tracking-wide 
                                   drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]">
                                Our Doctors
                            </h1>

                            <p class="text-sm md:text-base text-white/70  font-medium mt-1
                                  drop-shadow-[0_1px_4px_rgba(0,0,0,0.7)]">
                                Meet our experienced panel — primary consultants and supporting duty doctors.
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Main Doctors --}}
            <div class="mb-12">
                <h2 class="text-xl md:text-2xl font-semibold text-foreground mb-4">Main Doctors</h2>
                @if($mainDoctors->isEmpty())
                    <p class="text-muted-foreground">Main doctors will be listed here soon.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($mainDoctors as $doctor)
                            {{-- reuse existing card component; pass model or data as expected --}}
                            @include('components.home.team-card ', ['m' => $doctor])
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Other Duty Doctors --}}
            <div class="mb-24">
                <h2 class="text-xl md:text-2xl font-semibold text-foreground mb-4">Other Duty Doctors</h2>

                @if($dutyDoctors->isEmpty())
                    <p class="text-muted-foreground">No supporting doctors available right now.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($dutyDoctors as $doctor)
                            @include('components.home.team-card ', ['m' => $doctor])
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection