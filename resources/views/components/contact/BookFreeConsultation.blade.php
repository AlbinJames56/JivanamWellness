@props([
  'therapy' => null,
  'treatment' => null,
  'action' => route('appointments.store') // default route, you can override when including
])
@php
  $selectedSlug = optional($therapy)->slug ?? optional($treatment)->slug ?? '';
  $selectedTitle = optional($therapy)->title ?? optional($treatment)->title ?? null;
@endphp

<section class="py-16 bg-gradient-to-r from-primary to-secondary mx-auto px-4 sm:px-6 lg:px-8">
    <div class="rounded-2xl p-6 bg-white/6 border border-white/8 text-white">
        <div class="grid lg:grid-cols-2 gap-8 items-center max-w-[1100px] mx-auto">
            <div>
                <h3 class="text-2xl lg:text-3xl font-semibold">Ready to Begin Your Healing Journey?</h3>
                <p class="text-white/90 leading-relaxed">Book a consultation with our experienced practitioners
                    and discover which therapies are best suited for your unique needs.</p>
            </div>

            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                 
                <div class="flex gap-3">
                    {{-- If a $therapy variable is available include it, otherwise omit or set empty --}}
                    <button data-booking @if(isset($therapy))  data-booking data-treatment="{{ optional($therapy)->slug ?? optional($treatment)->slug ?? '' }}" @endif
                        class="btn-primary w-full inline-flex items-center justify-center">
                        Book Consultation
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>