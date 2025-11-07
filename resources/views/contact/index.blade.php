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
                <h1 class="text-4xl md:text-5xl font-extrabold text-white my-4">Get in Touch</h1>
                <p class="text-lg text-gray-200 dark:text-gray-300 max-w-2xl mx-auto">
                    We're here to help. Send us a message or visit one of our locations.
                </p>
            </div>
        </section>

        <br>

        {{-- MAIN CONTENT --}}
        <section class="max-w-screen-xl mx-auto py-16 px-4 -mt-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Left Column: CONTACT FORM --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8 z-20 opacity-0 translate-y-8 transition-all duration-1000 delay-100 ease-out animate-on-scroll">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Send Us a Message</h2>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            <span class="font-medium">Success!</span> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Name (Prefilled if logged in) --}}
                            <div>
                                <x-input-label for="name" :value="__('Full Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" 
                                              :value="old('name', $user?->name)" 
                                              required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            {{-- Email (Prefilled if logged in) --}}
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
                                              :value="old('email', $user?->email)" 
                                              required autocomplete="email" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div>
                            <x-input-label for="subject" :value="__('Subject')" />
                            <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" 
                                          :value="old('subject')" 
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                        </div>

                        {{-- Message --}}
                        <div>
                            <x-input-label for="message" :value="__('Your Message')" />
                            <textarea id="message" name="message" rows="6" 
                                      class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                      placeholder="How can we help you?">{{ old('message') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('message')" />
                        </div>

                        {{-- Submit Button --}}
                        <div class="text-right">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200 ease-in-out hover:scale-105">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Right Column: INFO & MAP --}}
                <div class="space-y-8 z-10 opacity-0 translate-y-8 transition-all duration-1000 delay-200 ease-out animate-on-scroll">
                    
                    {{-- Contact Info Block --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Contact Information</h3>
                        <div class="space-y-4 text-gray-600 dark:text-gray-400">
                            <p class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>123 Freedom Drive, Anywhere, USA</span>
                            </p>
                            <p class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>(123) 456-7890</span>
                            </p>
                            <p class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-600 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>support@ramcarrental.com</span>
                            </p>
                        </div>
                    </div>

                    {{-- Locations & Map Block --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 md:p-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Our Locations</h3>
                        
                        @if($locations->isNotEmpty())
                            {{-- List of Locations --}}
                            <div class="space-y-3 mb-6">
                                @foreach($locations as $location)
                                    <div class="pb-3 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                                        <h4 class="font-semibold text-gray-800 dark:text-white">{{ $location->name }}</h4>
                                        <a href="{{ $location->google_maps_link }}" target="_blank" class="text-sm text-blue-600 hover:underline dark:text-blue-500">
                                            View on Map
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Google Maps Embed --}}
                            @php
                                // Use the first location's map link for the embed
                                $mapUrl = $locations->first()->google_maps_link;
                            @endphp

                            @if($mapUrl && Str::contains($mapUrl, '/embed'))
                                <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                    <iframe
                                        src="{{ $mapUrl }}"
                                        width="100%"
                                        height="300"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            @elseif($mapUrl)
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Visit our main branch: 
                                    <a href="{{ $mapUrl }}" target="_blank" class="text-blue-600 hover:underline dark:text-blue-500">
                                        {{ $locations->first()->name }}
                                    </a>
                                </p>
                            @endif
                        @else
                            <p class="text-gray-500 dark:text-gray-400">No locations listed yet.</p>
                        @endif
                    </div>

                </div>
            </div>
        </section>
    </div>

    {{-- ANIMATION SCRIPT (Copied from home.blade.php) --}}
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
                threshold: 0.15 // Trigger when 15% of the element is visible
            };

            const scrollObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Add visible state classes
                        entry.target.classList.remove('opacity-0', 'translate-y-8', '-translate-x-8', 'translate-x-8');
                        entry.target.classList.add('opacity-100', 'translate-y-0', 'translate-x-0');
                        // Stop observing once animated
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Target all elements with the 'animate-on-scroll' class
            document.querySelectorAll('.animate-on-scroll').forEach((el) => {
                scrollObserver.observe(el);
            });
        });
    </script>
</x-app-layout>