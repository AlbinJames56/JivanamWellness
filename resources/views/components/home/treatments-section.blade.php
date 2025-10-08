@php
    $treatments = [
        [
            'title' => 'Panchakarma Detox',
            'description' => 'Complete purification and rejuvenation therapy that eliminates toxins and restores balance to your body and mind.',
            'image' => 'https://images.unsplash.com/photo-1736748580995-1d5faa88ce4d?...',
            'duration' => '7-21 days',
            'price' => 'From $800',
            'featured' => true
        ],
        [
            'title' => 'Abhyanga Massage',
            'description' => 'Traditional full-body oil massage using warm herbal oils to nourish skin, improve circulation, and calm the nervous system.',
            'image' => 'https://images.unsplash.com/photo-1757689314932-bec6e9c39e51?...',
            'duration' => '60-90 min',
            'price' => 'From $150'
        ],
        [
            'title' => 'Pain Management Therapy',
            'description' => 'Specialized Ayurvedic treatments for chronic pain including joint disorders, arthritis, and musculoskeletal conditions using therapeutic oils and herbs.',
            'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?...',
            'duration' => '60-90 min',
            'price' => 'From $180',
            'featured' => true
        ],
        [
            'title' => 'Shirodhara Therapy',
            'description' => 'Meditative treatment where warm oil flows continuously over the forehead, deeply relaxing the mind and nervous system.',
            'image' => 'https://images.unsplash.com/photo-1589548234057-881a5d872453?...',
            'duration' => '45-60 min',
            'price' => 'From $120'
        ],
        [
            'title' => 'Ayurvedic Consultation',
            'description' => 'Comprehensive health assessment including pulse diagnosis, dosha analysis, and personalized wellness recommendations.',
            'image' => 'https://images.unsplash.com/photo-1730701878011-a423ec61c328?...',
            'duration' => '60-90 min',
            'price' => 'From $200'
        ],
        [
            'title' => 'Herbal Medicine',
            'description' => 'Customized herbal formulations based on your unique constitution and health needs, prepared fresh daily.',
            'image' => 'https://images.unsplash.com/photo-1736748580995-1d5faa88ce4d?...',
            'duration' => 'Ongoing',
            'price' => 'From $80'
        ]
    ];
@endphp

<section id="treatments" class="py-16 lg:py-24 bg-background">
    <div class="max-w-[1100px] mx-auto px-5">
        <div class="text-center space-y-6 mb-16">
            <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">
                Authentic Ayurvedic Therapies
            </h2>
            <p class="text-lg text-muted-foreground    mx-auto leading-relaxed">
                Discover our comprehensive range of traditional therapies, each designed to restore
                balance and promote natural healing according to your unique constitution.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($treatments as $treatment)
                @include('components.home.treatment-card', [
                    'title' => $treatment['title'],
                    'description' => $treatment['description'],
                    'image' => $treatment['image'],
                    'duration' => $treatment['duration'],
                    'price' => $treatment['price'] ?? null,
                    'featured' => $treatment['featured'] ?? false,
                ])
            @endforeach
        </div>
    </div>
</section>
