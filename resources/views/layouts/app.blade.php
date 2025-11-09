<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Ram Car Rental') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css','resources/js/app.js'])

        <style>
            #preloader {
                position: fixed;
                inset: 0;
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #e5e7eb; /* bg-gray-200 */
                opacity: 1;
                visibility: visible;
                /* This transition handles the fade-out */
                transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
            }
            .dark #preloader {
                background-color: #111827; /* dark:bg-gray-900 */
            }
            /* This class will be added by JavaScript to hide the preloader */
            #preloader.fade-out {
                opacity: 0;
                visibility: hidden;
            }
        </style>
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-200 dark:bg-gray-900">
        
        <div id="preloader">
            <img id="preloader-logo" src="{{ asset('images/logo.png') }}" alt="Loading..." class="w-32 h-32 animate-zoom-in-out">
        </div>

        @include('layouts.navbar')

        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        
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
    
    <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                // Wait 2000ms (2 seconds) after the page loads, then add the fade-out class
                setTimeout(function() {
                    preloader.classList.add('fade-out');
                }, 1000); // 2000 milliseconds = 2 seconds
            }
        });
    </script>
    
    </body>
</html>