@php
    $blogPosts = [
        [
            'title' => 'Understanding Your Dosha: A Complete Guide to Ayurvedic Body Types',
            'excerpt' =>
                'Discover how knowing your unique dosha can transform your approach to health, nutrition, and lifestyle choices for optimal well-being.',
            'image' =>
                'https://images.unsplash.com/photo-1736748580995-1d5faa88ce4d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
            'category' => 'Ayurvedic Basics',
            'date' => 'Dec 15, 2024',
            'readTime' => '8 min read',
            'author' => 'Dr. Priya Sharma',
            'authorAvatar' =>
                'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&h=150&fit=crop&crop=face',
        ],
        [
            'title' => 'The Healing Power of Panchakarma: Ancient Detox for Modern Life',
            'excerpt' =>
                'Learn how this comprehensive cleansing process can help reset your body and mind, addressing everything from stress to chronic health issues.',
            'image' =>
                'https://images.unsplash.com/photo-1757689314932-bec6e9c39e51?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
            'category' => 'Treatments',
            'date' => 'Dec 12, 2024',
            'readTime' => '12 min read',
            'author' => 'Dr. Rajesh Patel',
            'authorAvatar' =>
                'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=150&h=150&fit=crop&crop=face',
        ],
        [
            'title' => 'Ayurvedic Nutrition: Eating According to Your Constitution',
            'excerpt' =>
                'Explore how food can be medicine when chosen according to your dosha, seasonal changes, and current state of health.',
            'image' =>
                'https://images.unsplash.com/photo-1589548234057-881a5d872453?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080',
            'category' => 'Nutrition',
            'date' => 'Dec 10, 2024',
            'readTime' => '6 min read',
            'author' => 'Dr. Ananya Krishnan',
            'authorAvatar' =>
                'https://images.unsplash.com/photo-1594824804732-ca8db7531c5e?w=150&h=150&fit=crop&crop=face',
        ],
    ];
@endphp

<section id="blog" class="py-16 lg:py-24 bg-muted/30">
    <div class="max-w-[1100px] mx-auto px-5">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-16">
            <div class="space-y-6">
                <div class="flex ">
                    <h2 class="text-3xl lg:text-4xl font-semibold text-foreground">Wellness Insights & Tips</h2>
                    <div class=" btn-secondary ">
                        <a href="{{ url('/blog') }}"
                            class=" text-primary hover:bg-primary/10 group w-40 inline-flex items-center gap-2 ">
                            View All Articles
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <p class="text-lg text-muted-foreground  leading-relaxed">
                    Stay informed with the latest in Ayurvedic wisdom, practical health tips, and insights from our
                    experienced practitioners.
                </p>
            </div>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($blogPosts as $post)
                @include('components.home.blog-card', [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'image' => $post['image'],
                    'category' => $post['category'],
                    'date' => $post['date'],
                    'readTime' => $post['readTime'],
                    'author' => $post['author'],
                    'authorAvatar' => $post['authorAvatar'],
                ])
            @endforeach
        </div>
    </div>
</section>
