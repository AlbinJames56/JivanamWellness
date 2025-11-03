<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />

    @php
$siteName = config('app.name', 'Jivanam Wellness');
$pageTitle = $title ?? $siteName;
$metaTitle = $meta_title ?? $pageTitle;
$metaDescription = $meta_description ?? 'Experience holistic healing through time-tested Ayurvedic therapies. Restore balance and vitality with our certified practitioners.';
$metaKeywords = $meta_keywords ?? 'Ayurveda, Ayurvedic therapies, pain management, holistic wellness';
$metaImage = $meta_image ?? asset('images/logo.png');
$canonical = $canonical ?? url()->current();
$twitterSite = config('services.twitter.username') ?? '@your_twitter';

// Build structured data safely inside a PHP block to avoid Blade parsing `@context`.
$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => 'MedicalBusiness',
    'name' => $siteName,
    'url' => url('/'),
    'logo' => asset('images/logo.png'),
    'description' => $metaDescription,
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => $address_city ?? 'Your City',
        'addressCountry' => $address_country ?? 'IN',
    ],
    'telephone' => $business_phone ?? '+911234567890',
    'sameAs' => $social_accounts ?? ['https://facebook.com/yourpage'],
];

$structuredJson = json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    @endphp

    <title>{{ $metaTitle }}</title>

    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="author" content="{{ $siteName }}">
    <meta name="robots" content="{{ ($noindex ?? false) ? 'noindex, nofollow' : 'index,follow' }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $og_type ?? 'website' }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ $metaImage }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:site_name" content="{{ $siteName }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="{{ $twitter_card ?? 'summary_large_image' }}">
    <meta name="twitter:site" content="{{ $twitterSite }}">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaImage }}">

    <link rel="canonical" href="{{ $canonical }}">

    {{-- Favicons --}}
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <meta name="theme-color" content="{{ $theme_color ?? '#0ea5a3' }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Structured data (printed safely) --}}
    <script type="application/ld+json">{!! $structuredJson !!}</script>

    {{-- Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous">

    {{-- Alpine --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    {{-- Floating Booking Styles --}}
    @stack('floating-styles')

    @stack('head')
</head>

<body class="antialiased bg-gray-50 text-gray-900">
    
    @include('components.commons.header')

    <main class="min-h-screen">
        {{ $slot ?? '' }}
        @yield('content')
    </main>
    
    @include('components.commons.footer')
    
    {{-- Floating Elements: include WhatsApp + booking after footer so they're not inside transformed containers --}}
    @includeWhen(view()->exists('components.whatsapp-float'), 'components.whatsapp-float')
    @includeWhen(view()->exists('components.floating-booking'), 'components.floating-booking')
    @includeWhen(view()->exists('components.floating-contact'), 'components.floating-contact')
    
    @stack('scripts')

 
</body>

</html>