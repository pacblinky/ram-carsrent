<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Ram Car Rental') }}</title>
        <meta name="description" content="@yield('meta_description', 'Rent luxury and economy cars at the best prices with Ram Car Rental. Wide selection of brands and locations.')">
        <meta name="keywords" content="@yield('meta_keywords', 'car rental, rent a car, luxury cars, economy cars, vehicle hire')">
        <meta name="author" content="Ram Car Rental">
        
        <meta property="og:type" content="website">
        <meta property="og:title" content="@yield('title', config('app.name', 'Ram Car Rental'))">
        <meta property="og:description" content="@yield('meta_description', 'Rent luxury and economy cars at the best prices with Ram Car Rental.')">
        <meta property="og:image" content="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
        <meta name="apple-mobile-web-app-title" content="RAM | Car Rental" />
        <link rel="manifest" href="/site.webmanifest" />

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/js/app.js'])
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-200 dark:bg-gray-900">
        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Optional Page Header -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        
        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>

        @include('layouts.footer')
        

    <script>
        window.userIsLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    </script>

    <script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/firebase-messaging-sw.js')
            .then(reg => console.log("✅ Firebase SW registered"))
            .catch(err => console.error("❌ SW Failed:", err));
    }
    </script>
    
    </body>
</html>
