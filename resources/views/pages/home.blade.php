@extends('layouts.app')

@section('content')


    @include('components.home.hero')
    @include('components.home.treatments-section', ['treatments' => $treatments ?? collect()])
    @include('components.home.clinics-section', ['clinics' => $clinics ?? collect()])
    @include('components.home.team-section', ['teamMembers' => $teamMembers ?? collect()])

    @include('components.home.testimonials-section', ['testimonials' => $testimonials ?? collect()])
    @include('components.home.blog-section', ['blogPosts' => $articles ?? collect()])

    {{-- SEO Content Section (Post-Blog) --}}
    <div class="w-full bg-gradient-to-br from-primary/5 via-background to-secondary/5 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-16 lg:py-24">
            <div class="text-center mb-10">
                <h2 class="text-3xl lg:text-4xl font-bold text-primary mb-4">Ayurvedic Clinics in Coimbatore – Authentic
                    Healing at Jivanam Wellness</h2>
                <p class="text-lg text-muted-foreground  mx-auto">Ayurveda has been practiced for thousands of years as a
                    natural system of healing that focuses on restoring balance in the body and mind. In recent years, many
                    people have started turning towards Ayurveda to manage health problems, improve overall wellness, and
                    maintain a healthier lifestyle. If you are looking for reliable <b>Ayurvedic clinics in Coimbatore</b>,
                    Jivanam
                    Wellness offers authentic Ayurvedic treatments guided by experienced doctors and trained therapists.</p>
            </div>

            <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                <h3 class="text-2xl font-semibold mb-4 text-primary">Why Choose Ayurvedic Clinics in Coimbatore?</h3>
                <p class="text-base leading-relaxed text-muted-foreground mb-4">Ayurveda is based on the principle that good
                    health depends on a balanced relationship between the body, mind, and environment. When this balance is
                    disturbed, various health issues may arise. Through traditional Ayurvedic therapies, herbal medicines,
                    and lifestyle guidance, Ayurveda aims to restore this balance and support the body’s natural healing
                    process.</p>
                <p class="text-base leading-relaxed text-muted-foreground">At Jivanam Wellness, our goal is to provide
                    genuine Ayurvedic care in a calm and supportive environment. Many patients visit our <b>Ayurvedic
                        clinics
                        in Coimbatore</b> seeking natural treatment for chronic health conditions, stress, lifestyle
                    disorders, and
                    preventive wellness therapies.</p>
            </section>

            <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                <h3 class="text-2xl font-semibold mb-4 text-primary">About Jivanam Wellness</h3>
                <p class="text-base leading-relaxed text-muted-foreground mb-4">Jivanam Wellness is one of the trusted
                    <b>Ayurvedic clinics in Coimbatore</b>, providing traditional Ayurvedic treatments based on classical
                    Ayurvedic
                    principles. Our clinics focus on delivering personalized care where each patient receives attention and
                    treatment according to their individual health needs.
                </p>
                <p class="text-base leading-relaxed text-muted-foreground mb-4">Unlike treatments that only address
                    symptoms, Ayurveda focuses on identifying the root cause of a problem. At Jivanam Wellness, every
                    patient undergoes a detailed consultation with our doctors before starting treatment. This consultation
                    helps us understand the patient’s body constitution (Prakriti), current health condition, and lifestyle
                    patterns.</p>
                <p class="text-base leading-relaxed text-muted-foreground">Our clinics are designed to offer a peaceful
                    environment where patients can experience traditional Ayurvedic therapies in a comfortable setting. Many
                    people visit <b>Ayurvedic clinics in Coimbatore</b> like Jivanam Wellness because they are looking for
                    natural
                    healing methods that focus on long-term health and wellness.</p>
            </section>

            <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                <h3 class="text-2xl font-semibold mb-4 text-primary">Experienced Ayurvedic Doctors</h3>
                <p class="text-base leading-relaxed text-muted-foreground mb-6">One of the most important aspects of
                    choosing Ayurvedic clinics in Coimbatore is the experience and guidance of qualified Ayurvedic doctors.
                    At Jivanam Wellness, treatments are supervised by a team of experienced Ayurvedic physicians who
                    carefully evaluate each patient before recommending therapies.</p>

                <div class="space-y-4">
                    <div class="bg-background/50 rounded-lg p-6 border border-border/30">
                        <h4 class="font-semibold text-lg">Dr. Valsala Varier – Chief Physician (25+ Years Experience)</h4>
                        <p class="text-sm text-muted-foreground mt-2">Dr. Valsala Varier has extensive experience in
                            Ayurvedic medicine and Panchakarma therapies. She has guided numerous patients through
                            traditional Ayurvedic treatments and focuses on identifying the root cause of health conditions
                            through classical Ayurvedic diagnostic methods.</p>
                    </div>
                    <div class="bg-background/50 rounded-lg p-6 border border-border/30">
                        <h4 class="font-semibold text-lg">Dr. Venkataraman – Senior Ayurvedic Physician (15+ Years
                            Experience)</h4>
                        <p class="text-sm text-muted-foreground mt-2">Dr. Venkataraman specializes in Panchakarma therapies
                            and chronic disease management using Ayurvedic treatments. His experience in traditional
                            therapies helps patients receive effective treatment plans based on individual health
                            conditions.</p>
                    </div>
                    <div class="bg-background/50 rounded-lg p-6 border border-border/30">
                        <h4 class="font-semibold text-lg">Dr. Jananidhi T – Ayurvedic Doctor (10+ Years Experience)</h4>
                        <p class="text-sm text-muted-foreground mt-2">Dr. Jananidhi focuses on holistic Ayurvedic care and
                            works closely with patients undergoing detox and rejuvenation therapies. Her approach combines
                            classical Ayurvedic knowledge with personalized patient care.</p>
                    </div>
                    <div class="bg-background/50 rounded-lg p-6 border border-border/30">
                        <h4 class="font-semibold text-lg">Dr. Sanju P S – Ayurvedic Doctor (10+ Years Experience)</h4>
                        <p class="text-sm text-muted-foreground mt-2">Dr. Sanju provides guidance for various Ayurvedic
                            treatments and ensures that therapies are planned according to the patient’s health needs and
                            dosha balance.</p>
                    </div>
                    <div class="bg-background/50 rounded-lg p-6 border border-border/30">
                        <h4 class="font-semibold text-lg">Dr. Thrishnaj – Ayurvedic Doctor (10+ Years Experience)</h4>
                        <p class="text-sm text-muted-foreground mt-2">Dr. Thrishnaj is experienced in Ayurvedic treatments
                            and Panchakarma therapies and supports patients throughout their treatment process.</p>
                    </div>
                </div>

                <p class="text-base leading-relaxed text-muted-foreground mt-6">The doctors at Jivanam Wellness carefully
                    assess the patient’s health condition and recommend suitable therapies, medicines, and lifestyle
                    changes. This personalized approach helps patients achieve better results through natural healing
                    methods.</p>
            </section>

            <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                <h3 class="text-2xl font-semibold mb-4 text-primary">Traditional Ayurvedic Treatments</h3>
                <p class="text-base leading-relaxed text-muted-foreground mb-4">Ayurveda offers a wide range of therapies
                    designed to detoxify the body, improve circulation, relieve pain, and restore overall balance. At
                    Jivanam Wellness, patients visiting our <b>Ayurvedic clinics in Coimbatore</b> can experience various
                    traditional Ayurvedic treatments.</p>

                <h4 class="font-semibold text-lg mt-6 mb-2">Panchakarma Therapy</h4>
                <p class="text-sm text-muted-foreground mb-2">Panchakarma is one of the most important treatment systems in
                    Ayurveda. It is a detoxification process that helps remove toxins from the body and restore balance
                    between the three doshas – Vata, Pitta, and Kapha. <br> Panchakarma therapies are performed under the
                    supervision of experienced doctors and trained therapists.</p>
                <p class="text-sm text-muted-foreground mb-2">Some commonly recommended Panchakarma treatments include:</p>
                <ul class="list-disc pl-6 text-sm text-muted-foreground space-y-1 mb-4">
                    <li><strong>Virechana</strong> – A therapeutic detox treatment that helps eliminate toxins from the
                        digestive system and liver.</li>
                    <li><strong>Basti</strong> – A specialized Ayurvedic therapy used to balance Vata dosha and cleanse the
                        colon.</li>
                    <li><strong>Nasya</strong> – A nasal therapy that helps cleanse the sinus and respiratory system.</li>
                </ul>
                <p class="text-sm text-muted-foreground">Many patients visit <b>Ayurvedic clinics in Coimbatore</b>
                    specifically
                    for Panchakarma therapies because of their ability to deeply detoxify and rejuvenate the body.</p>

                <h4 class="font-semibold text-lg mt-6 mb-2">Abhyangam (Ayurvedic Oil Massage)</h4>
                <p class="text-sm text-muted-foreground mb-2">Abhyangam is a traditional Ayurvedic oil massage performed
                    using warm medicated herbal oils. This therapy helps improve blood circulation, relax muscles, and
                    reduce stress.</p>
                <p class="text-sm text-muted-foreground">Regular Abhyangam therapy can support detoxification and promote
                    relaxation. Many patients visit <b>Ayurvedic clinics in Coimbatore</b> for Abhyangam therapy to relieve
                    fatigue, body pain, and stress caused by busy lifestyles.</p>

                <h4 class="font-semibold text-lg mt-6 mb-2">Shirodhara Therapy</h4>
                <p class="text-sm text-muted-foreground mb-2">Shirodhara is a deeply relaxing Ayurvedic therapy in which
                    warm medicated oil is gently poured over the forehead in a continuous stream. This therapy is known for
                    calming the mind and improving mental clarity.</p>
                <p class="text-sm text-muted-foreground">It is commonly recommended for people experiencing stress, anxiety,
                    sleep disturbances, and mental fatigue.</p>

                <h4 class="font-semibold text-lg mt-6 mb-2">Njavarakizhi Therapy</h4>
                <p class="text-sm text-muted-foreground mb-2">Njavarakizhi is a rejuvenation therapy where special medicated
                    rice bundles are applied to the body using warm herbal preparations. This therapy helps strengthen
                    muscles, improve circulation, and nourish body tissues.</p>
                <p class="text-sm text-muted-foreground">It is often recommended for neurological conditions, muscle
                    weakness, and joint problems.</p>

                <h4 class="font-semibold text-lg mt-6 mb-2">Podikizhi Therapy</h4>
                <p class="text-sm text-muted-foreground mb-2">Podikizhi is a therapy that uses herbal powder bundles heated
                    and applied to the body. This treatment helps relieve pain, stiffness, and inflammation in muscles and
                    joints.</p>
                <p class="text-sm text-muted-foreground">Many people visit <b>Ayurvedic clinics in Coimbatore</b> for
                    Podikizhi
                    therapy when experiencing chronic body pain or musculoskeletal problems.</p>
            </section>

            <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                <h3 class="text-2xl font-semibold mb-4 text-primary">Skilled Ayurvedic Therapists</h3>
                <p class="text-base leading-relaxed text-muted-foreground mb-4">In Ayurveda, the skill of the therapist
                    plays an important role in the effectiveness of treatment. At Jivanam Wellness, our therapists are
                    trained in traditional Ayurvedic therapy techniques and follow authentic treatment procedures.</p>
                <p class="text-base leading-relaxed text-muted-foreground mb-4">They work closely with the doctors to ensure
                    that every therapy session is performed safely and effectively. Their experience and attention to detail
                    help patients feel comfortable and relaxed during treatments.</p>
                <p class="text-base leading-relaxed text-muted-foreground">The therapists carefully follow Ayurvedic methods
                    while performing therapies such as oil massage, herbal steam treatments, and Panchakarma procedures.</p>
            </section>

            <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                <h3 class="text-2xl font-semibold mb-4 text-primary">Conditions Treated at Ayurvedic Clinics</h3>
                <p class="text-base leading-relaxed text-muted-foreground mb-4">Many people visit <b>Ayurvedic clinics in
                        Coimbatore</b> for natural treatment of various health conditions. <br>
                    Some of the common health concerns treated through Ayurveda include:</p>
                <ul class="list-disc pl-6 text-sm text-muted-foreground space-y-1">
                    <li>Joint pain and arthritis</li>
                    <li>Back pain and neck pain</li>
                    <li>Digestive disorders</li>
                    <li>Stress and anxiety</li>
                    <li>Sleep disturbances</li>
                    <li>Skin conditions</li>
                    <li>Weight management</li>
                    <li>Lifestyle disorders</li>
                </ul>
                <p class="text-base leading-relaxed text-muted-foreground mb-4">Ayurvedic treatments focus on restoring
                    balance within the body, which helps improve overall health and prevent future health problems.</p>
            </section>

            <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg mb-8">
                <h3 class="text-2xl font-semibold mb-4 text-primary">Our Clinics in Coimbatore</h3>
                <p class="text-base leading-relaxed text-muted-foreground mb-6">Jivanam Wellness operates multiple
                    <b>Ayurvedic clinics in Coimbatore</b> to make authentic Ayurvedic care accessible to more patients.
                <br>Our clinics are located in:</p>
                
                    <div class="space-y-6">
                    <div class="text-center p-8 bg-background/50 rounded-xl border border-border/30">
                        <div
                            class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                            🏥</div>
                        <h5 class="font-semibold text-primary text-xl mb-2">Sai Baba Colony</h5>
                        <p class="text-muted-foreground">Our Sai Baba Colony clinic serves patients from nearby areas
                            looking for reliable Ayurvedic therapy and personalized wellness treatments.</p>
                    </div>
                    <div class="text-center p-8 bg-background/50 rounded-xl border border-border/30">
                        <div
                            class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                            🏥</div>
                        <h5 class="font-semibold text-primary text-xl mb-2">Race Course</h5>
                        <p class="text-muted-foreground">The Race Course branch provides authentic Ayurvedic therapies and
                            consultation services for patients seeking natural healing solutions in the central part of
                            Coimbatore.</p>
                    </div>
                    <div class="text-center p-8 bg-background/50 rounded-xl border border-border/30">
                        <div
                            class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                            🏥</div>
                        <h5 class="font-semibold text-primary text-xl mb-2">Vadavalli</h5>
                        <p class="text-muted-foreground">Our Vadavalli clinic offers traditional Ayurvedic treatments
                            designed to help patients improve their health and well-being naturally.</p>
                    </div>
                </div>
                <div class="text-center mt-6">
                    <p class="text-muted-foreground">Each clinic is designed to provide a calm and hygienic environment suitable for Ayurvedic therapies and treatments.<br>Patients visiting our clinics receive personalized care guided by
                        experienced doctors and therapists.</p>
                </div>
            </section>

            <section class="bg-card/50 backdrop-blur-sm p-8 rounded-2xl border border-border/50 shadow-lg">
                <h3 class="text-2xl font-semibold mb-4 text-primary">Natural Healing with Ayurveda</h3>
                <p class="text-base leading-relaxed text-muted-foreground mb-4">Ayurveda continues to be one of the most
                    trusted natural healing systems because it focuses on treating the body as a whole rather than
                    addressing isolated symptoms.</p>
                <p class="text-base leading-relaxed text-muted-foreground mb-4">Through detox therapies, herbal medicines,
                    lifestyle guidance, and traditional treatments, Ayurveda helps restore balance and improve overall
                    well-being. <br> Many people searching for <b>Ayurvedic clinics in Coimbatore</b> choose Jivanam Wellness because of
                    our commitment to authentic Ayurvedic practices and personalized patient care.</p>
                <p class="text-base leading-relaxed text-muted-foreground">Whether you are seeking treatment for a specific
                    health condition or looking for preventive wellness therapies, Ayurveda offers a natural approach to
                    maintaining long-term health.<br> At Jivanam Wellness, we welcome patients who want to experience genuine
                    Ayurvedic healing and improve their quality of life through natural therapies.</p>
            </section>
        </div>
    </div>

@endsection