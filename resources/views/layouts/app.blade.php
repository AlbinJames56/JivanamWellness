<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $title ?? 'Jivanam Wellness' }}</title>

    {{-- Use Mix only if mix-manifest.json exists (i.e. you built with Mix) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine (you can install via npm instead) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="antialiased bg-gray-50 text-gray-900">
    @include('components.commons.header')

    <main class="min-h-screen">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @include('components.commons.footer')

  @stack('scripts')
</body>

</html>
