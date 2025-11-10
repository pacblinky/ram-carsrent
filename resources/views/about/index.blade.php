<x-app-layout>

    {{-- Page-load fade-in animation --}}
    <style>
        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }
    </style>

    <div class="animate-fade-in">
        {{-- HERO SECTION --}}
        <section class="relative bg-gray-900 flex items-center justify-center pt-24 pb-32">
            <div class="absolute inset-0">
                <img src="{{ asset('images/driving.gif') }}" alt="Background" class="w-full h-full object-cover opacity-50">
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>
            <div class="relative z-10 text-center px-4 opacity-0 translate-y-8 animate-load transition-all duration-1000 ease-out" id="hero-content">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white my-4">{{ __('about.hero_title') }}</h1>
                <p class="text-lg text-gray-200 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ __('about.hero_subtitle') }}
                </p>
            </div>
        </section>

        <br>

        {{-- MAIN CONTENT --}}
        <section class="max-w-screen-xl mx-auto py-16 px-4 -mt-16">
            
            {{-- OUR MISSION BLOCK --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8 z-20 opacity-0 translate-y-8 transition-all duration-1000 delay-100 ease-out animate-on-scroll">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('about.mission_title') }}</h2>
                <div class="space-y-4 text-lg text-gray-600 dark:text-gray-400">
                    <p>{{ __('about.mission_text_1') }}</p>
                    <p>{{ __('about.mission_text_2') }}</p>
                </div>
            </div>

            <br class="my-8 md:my-12">

            {{-- WHY CHOOSE US? (FEATURES) --}}
            <div class="z-10">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 md:mb-12 text-center opacity-0 translate-y-8 transition-all duration-1000 delay-200 ease-out animate-on-scroll">
                    {{ __('about.why_title') }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    {{-- Feature 1 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8 text-center opacity-0 translate-y-8 transition-all duration-1000 delay-300 ease-out animate-on-scroll">
                        <div class="flex justify-center items-center mb-4">
                            <svg class="w-10 h-10 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('about.why_item_1_title') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ __('about.why_item_1_text') }}</p>
                    </div>

                    {{-- Feature 2 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8 text-center opacity-0 translate-y-8 transition-all duration-1000 delay-400 ease-out animate-on-scroll">
                        <div class="flex justify-center items-center mb-4">
                            <svg class="w-10 h-10 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('about.why_item_2_title') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ __('about.why_item_2_text') }}</p>
                    </div>

                    {{-- Feature 3 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8 text-center opacity-0 translate-y-8 transition-all duration-1000 delay-500 ease-out animate-on-scroll">
                        <div class="flex justify-center items-center mb-4">
                            <svg class="w-10 h-10 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('about.why_item_3_title') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ __('about.why_item_3_text') }}</p>
                    </div>

                </div>
            </div>

            <br class="my-8 md:my-12">

            {{-- =================================== --}}
            {{-- === NEW LOCATIONS SECTION START === --}}
            {{-- =================================== --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8 z-10 opacity-0 translate-y-8 transition-all duration-1000 delay-600 ease-out animate-on-scroll">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 md:mb-12 text-center">{{ __('about.locations_title') }}</h2>

                @if($locations->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- List of Locations --}}
                        <div class="space-y-4">
                            @foreach($locations as $location)
                                <div class="pb-4 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $location->name }}</h4>
                                    <p class="text-gray-600 dark:text-gray-400 mb-1">{{ $location->address }}</p>
                                    <a href="{{ $location->google_maps_link }}" target="_blank" class="text-sm text-blue-600 hover:underline dark:text-blue-500">
                                        {{ __('about.locations_view_map') }}
                                        <svg class="w-3 h-3 inline-block ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        {{-- Google Maps Embed (using first location) --}}
                        <div>
                            @php
                                $mapUrl = $locations->first()->google_maps_link;
                            @endphp

                            @if($mapUrl && Str::contains($mapUrl, '/embed'))
                                <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 h-full min-h-[300px]">
                                    <iframe
                                        src="{{ $mapUrl }}"
                                        width="100%"
                                        height="100%"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            @elseif($mapUrl)
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('about.locations_visit_branch') }}
                                    <a href="{{ $mapUrl }}" target="_blank" class="text-blue-600 hover:underline dark:text-blue-500">
                                        {{ $locations->first()->name }}
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                @else
                    <p class="text-center text-gray-500 dark:text-gray-400">{{ __('about.locations_none') }}</p>
                @endif
            </div>
            {{-- ================================= --}}
            {{-- === NEW LOCATIONS SECTION END === --}}
            {{-- ================================= --}}


            <br class="my-8 md:my-12">

            {{-- CALL TO ACTION (CTA) BLOCK --}}
            <div class="text-center bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8 md:p-12 z-10 opacity-0 translate-y-8 transition-all duration-1000 delay-700 ease-out animate-on-scroll">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ __('about.cta_title') }}</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">{{ __('about.cta_text') }}</p>
                <a href="{{ route('cars.index') }}"
                   class="inline-flex items-center px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200 ease-in-out hover:scale-105">
                    {{ __('about.cta_button') }}
                </a>
            </div>

        </section>
    </div>

    {{-- ANIMATION SCRIPT --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // 1. Trigger Hero Animation Immediately
            setTimeout(() => {
                const heroContent = document.getElementById('hero-content');
                if (heroContent) {
                    heroContent.classList.remove('opacity-0', 'translate-y-8');
                    heroContent.classList.add('opacity-100', 'translate-y-0');
                }
            }, 100); 

            // 2. Set up Intersection Observer for Scroll Animations
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15 
            };

            const scrollObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0', 'translate-y-8', '-translate-x-8', 'translate-x-8');
                        entry.target.classList.add('opacity-100', 'translate-y-0', 'translate-x-0');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-on-scroll').forEach((el) => {
                scrollObserver.observe(el);
            });
        });
    </script>
</x-app-layout>