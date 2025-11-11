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
        /* No styles needed for the follower slider */
        .location-name-slider {
            position: relative;
        }


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
                <h1 class="text-4xl md:text-5xl font-extrabold text-white my-4">{{ __('contact.hero_title') }}</h1>
                <p class="text-lg text-gray-200 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ __('contact.hero_subtitle') }}
                </p>
            </div>
        </section>

        <br>

        {{-- MAIN CONTENT --}}
        <section class="max-w-screen-xl mx-auto py-16 px-4 -mt-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Left Column: CONTACT FORM --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8 z-20 opacity-0 translate-y-8 transition-all duration-1000 delay-100 ease-out animate-on-scroll">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('contact.form_title') }}</h2>

                    @if (session('success_message_key'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            <span class="font-medium">{{ __('contact.alert_success') }}</span> {{ __(session('success_message_key')) }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Name --}}
                            <div>
                                <x-input-label for="name" :value="__('contact.form_name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                                              :value="old('name', $user?->name)" 
                                              required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            {{-- Email --}}
                            <div>
                                <x-input-label for="email" :value="__('contact.form_email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
                                              :value="old('email', $user?->email)" 
                                              required autocomplete="email" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div>
                            <x-input-label for="subject" :value="__('contact.form_subject')" />
                            <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" 
                                          :value="old('subject')" 
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                        </div>

                        {{-- Message --}}
                        <div>
                            <x-input-label for="message" :value="__('contact.form_message')" />
                            <textarea id="message" name="message" rows="6" 
                                      class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                      placeholder="{{ __('contact.form_message_placeholder') }}">{{ old('message') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('message')" />
                        </div>

                        {{-- Submit Button --}}
                        <div class="text-center px-0">
                            <button type="submit"
                                    class="w-full items-center px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200 ease-in-out hover:scale-105">
                                {{ __('contact.form_send') }}
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Right Column: INFO & MAP --}}
                <div class="space-y-8 z-10 opacity-0 translate-y-8 transition-all duration-1000 delay-200 ease-out animate-on-scroll">
                    
                    {{-- Contact Info Block --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('contact.info_title') }}</h3>
                        <div class="space-y-4 text-gray-600 dark:text-gray-400">
                            {{-- Address --}}
                            <p class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>{{ __('contact.info_address') }}</span>
                            </p>
                            {{-- Phone --}}
                            <p class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>{{ __('contact.info_phone') }}</span>
                            </p>
                            {{-- Email --}}
                            <p class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>{{ __('contact.info_email') }}</span>
                            </p>
                        </div>
                    </div>

                    {{-- === MAPS & LOCATIONS BLOCK === --}}
                    @if(isset($contactItems) && $contactItems->isNotEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                            {{ __('contact.locations_title') }}
                        </h3>
                    
                        {{-- ============================== --}}
                        {{-- === MAP EMBED SLIDESHOW === --}}
                        {{-- ============================== --}}
                        @if($contactItems->count() > 1)
                            {{-- If MORE than 1 map, show slider --}}
                            <div class="map-slider-container">
                                <div class="swiper map-slider">
                                    <div class="swiper-wrapper">
                                        @foreach($contactItems as $item)
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

                        @elseif($contactItems->count() == 1)
                            {{-- If EXACTLY 1 map, show it normally --}}
                            <div class="w-full h-[350px] rounded-lg overflow-hidden mb-6 border border-gray-200 dark:border-gray-700 single-map">
                                {!! $contactItems->first()->embed_code !!}
                            </div>
                        @endif
                        {{-- === END OF MAP SLIDESHOW === --}}

                    
                        {{-- =================================== --}}
                        {{-- === LOCATIONS SLIDER/LIST START === --}}
                        {{-- =================================== --}}
                        @php
                            $itemsWithLocation = $contactItems->filter(fn($item) => $item->location_name);
                        @endphp

                        @if($itemsWithLocation->count() > 1)
                            {{-- This is the "Follower" slider, with no arrows --}}
                            <div class="swiper location-name-slider">
                                <div class="swiper-wrapper">
                                    @foreach($itemsWithLocation as $item)
                                        <div class="swiper-slide">
                                            <div class="py-3 text-center px-4"> 
                                                <h4 class="font-semibold text-gray-800 dark:text-white">{{ $item->location_name }}</h4>
                                                <a href="{{ $item->google_maps_link }}" target="_blank" class="text-sm text-blue-600 hover:underline dark:text-blue-500">
                                                    {{ __('contact.locations_view_map') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
                            @if($contactItems->isEmpty())
                                <p class="text-gray-500 dark:text-gray-400 text-center">{{ __('contact.locations_none') }}</p>
                            @endif
                        @endif
                        {{-- ================================= --}}
                        {{-- === LOCATIONS SLIDER/LIST END === --}}
                        {{-- ================================= --}}

                    </div>
                    @endif
                    {{-- === END OF MAPS & LOCATIONS BLOCK === --}}
                    
                </div>
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

            // 3. Initialize Location Name Slider (Follower)
            const locationNameSlider = new Swiper(".location-name-slider", {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: true,
                allowTouchMove: false, // User cannot swipe this one
            });

            // 4. Initialize the new Map Embed Slideshow (Master)
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