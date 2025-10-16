<section class="py-16 bg-gradient-to-r from-primary to-secondary mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rounded-2xl p-6 bg-white/6 border border-white/8 text-white">
                    <div class="grid lg:grid-cols-2 gap-8 items-center max-w-[1100px] mx-auto">
                        <div>
                            <h3 class="text-2xl lg:text-3xl font-semibold">Ready to Begin Your Healing Journey?</h3>
                            <p class="text-white/90 leading-relaxed">Book a consultation with our experienced practitioners
                                and discover which therapies are best suited for your unique needs.</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                            <form method="POST" action="#" class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                @csrf
                                <input name="name" placeholder="Your Name"
                                    class="px-3 py-2 rounded-lg bg-white/20 border border-white/30 text-white" />
                                <input name="phone" placeholder="Phone Number"
                                    class="px-3 py-2 rounded-lg bg-white/20 border border-white/30 text-white" />
                            </form>

                            <div class="flex gap-3">
                                <a href="#booking" class="btn-primary w-full inline-flex items-center justify-center">Book
                                    Free Consultation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
