<x-app-layout>
    {{-- 1. Swiper.js CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    {{-- Page-load fade-in animation --}}
    <style>
        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }

        /* =================================
           CSS FOR LOCATION LIST SLIDER (Small)
           ================================= */
        /* --- CHANGE 1: ---
           The CSS for .location-slider arrows has been REMOVED.
           The new .location-name-slider doesn't need special styles.
        */

        /* =================================
           CSS FOR MAP EMBED SLIDESHOW (Large)
           ================================= */
        .map-slider-container {
            position: relative; /* Container for arrows */
            width: 100%;
            height: 350px; /* Map height */
            margin-bottom: 1.5rem; /* Replaces the 'mb-6' */
        }

        .map-slider {
            width: 100%;
            height: 100%;
            border-radius: 0.5rem; /* rounded-lg */
            overflow: hidden;
            border: 1px solid #e5e7eb; /* border */
        }
        .dark .map-slider {
             border-color: #374151; /* dark:border-gray-700 */
        }
        
        .map-slider .swiper-slide {
            width: 100%;
            height: 100%;
            background-color: #f9fafb; /* bg-gray-50 */
        }
        .dark .map-slider .swiper-slide {
            background-color: #1f2937; /* dark:bg-gray-800 */
        }

        /* This makes the iframe fill the slide */
        .map-slider .swiper-slide > div {
            width: 100%;
            height: 100%;
        }
        
        /* This forces iframes with width/height attributes to be responsive */
        .map-slider .swiper-slide iframe {
            width: 100% !important;
            height: 100% !important;
            border: 0;
        }

        /* Map slider arrows (using unique classes) */
        .map-arrow-prev,
        .map-arrow-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 20; /* Above the iframe */
            width: 40px;
            height: 40px;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: pointer;
            font-family: monospace;
            font-size: 22px;
            line-height: 1;
            transition: background-color 0.2s;
        }
        
        .map-arrow-prev { left: 16px; }
        .map-arrow-next { right: 16px; }

        .map-arrow-next:hover,
        .map-arrow-prev:hover {
             background-color: rgba(0, 0, 0, 0.5);
        }
        /* === END OF MAP SLIDESHOW CSS === */

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

            {{-- === MAPS & LOCATIONS BLOCK === --}}
            @if(isset($aboutItems) && $aboutItems->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8 z-10 opacity-0 translate-y-8 transition-all duration-1000 delay-500 ease-out animate-on-scroll">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6 text-center">
                    {{ __('about.locations_title') }}
                </h2>

                {{-- ============================== --}}
                {{-- === MAP EMBED SLIDESHOW === --}}
                {{-- ============================== --}}
                @if($aboutItems->count() > 1)
                    {{-- If MORE than 1 map, show slider --}}
                    <div class="map-slider-container">
                        <div class="swiper map-slider"> {{-- This is the "Master" --}}
                            <div class="swiper-wrapper">
                                @foreach($aboutItems as $item)
                                    <div class="swiper-slide">
                                        <div>{!! $item->embed_code !!}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Add Arrows --}}
                        <div class="map-arrow-prev">&lt;</div>
                        <div class="map-arrow-next">&gt;</div>
                    </div>

                @elseif($aboutItems->count() == 1)
                    {{-- If EXACTLY 1 map, show it normally --}}
                    <div class="w-full h-[350px] rounded-lg overflow-hidden mb-6 border border-gray-200 dark:border-gray-700 single-map">
                        {!! $aboutItems->first()->embed_code !!}
                    </div>
                @endif
                {{-- === END OF MAP SLIDESHOW === --}}


                {{-- =================================== --}}
                {{-- === LOCATIONS SLIDER/LIST START === --}}
                {{-- =================================== --}}
                @php
                    $itemsWithLocation = $aboutItems->filter(fn($item) => $item->location_name);
                @endphp

                @if($itemsWithLocation->count() > 1)
                    {{-- --- CHANGE 2: HTML --- --}}
                    {{-- This is now the "Follower" slider, with no arrows --}}
                    <div class="swiper location-name-slider">
                        <div class="swiper-wrapper">
                            @foreach($itemsWithLocation as $item)
                                <div class="swiper-slide">
                                    <div class="py-3 text-center px-4"> {{-- Removed px-12 --}}
                                        <h4 class="font-semibold text-gray-800 dark:text-white">{{ $item->location_name }}</h4>
                                        <a href="{{ $item->google_maps_link }}" target="_blank" class="text-sm text-blue-600 hover:underline dark:text-blue-500">
                                            {{ __('contact.locations_view_map') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- All <div class="swiper-button-..."> arrows removed from here --}}
                    </div>

                @elseif($itemsWithLocation->count() == 1)
                    {{-- This full-width layout for 1 item is correct --}}
                    <div class="space-y-3">
                        @php $item = $itemsWithLocation->first(); @endphp
                        @if($item->location_name)
                            <div class="py-3 border-b border-gray-200 dark:border-gray-700 last:border-b-0 flex justify-between items-center px-2">
                                <h4 class="font-semibold text-gray-800 dark:text-white">{{ $item->location_name }}</h4>
                                <a href="{{ $item->google_maps_link }}" target="_blank" class="text-sm text-blue-600 hover:underline dark:text-blue-500">
                                    {{ __('contact.locations_view_map') }}
                                </a>
                            </div>
                        @endif
                    </div>
                
                @else
                    @if($aboutItems->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400 text-center">{{ __('contact.locations_none') }}</p>
                    @endif
                @endif
                {{-- ================================= --}}
                {{-- === LOCATIONS SLIDER/LIST END === --}}
                {{-- ================================= --}}
            </div>

            <br class="my-8 md:my-12">
            @endif
            {{-- === END OF MAPS & LOCATIONS BLOCK === --}}


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

    {{-- === 3. COMBINED SCRIPT === --}}
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            
            // 1. Trigger Hero Animation
            setTimeout(() => {
                const heroContent = document.getElementById('hero-content');
                if (heroContent) {
                    heroContent.classList.remove('opacity-0', 'translate-y-8');
                    heroContent.classList.add('opacity-100', 'translate-y-0');
                }
            }, 100); 

            // 2. Set up Intersection Observer
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

            {{-- --- CHANGE 3: JAVASCRIPT --- --}}
            
            // 3. Initialize Location Name Slider (Follower)
            const locationNameSlider = new Swiper(".location-name-slider", {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: true,
                allowTouchMove: false, // User cannot swipe this one
            });

            // 4. Initialize the Map Embed Slideshow (Master)
            const mapSlider = new Swiper(".map-slider", {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                
                // Navigation for maps
                navigation: {
                    nextEl: ".map-arrow-next",
                    prevEl: ".map-arrow-prev",
                },

                // Connect the two sliders
                controller: {
                    control: locationNameSlider
                }
            });

        });
    </script>
</x-app-layout>