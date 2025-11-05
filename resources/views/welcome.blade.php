<x-app-layout>
<section class="relative h-[600px] flex items-center justify-center">
    <div class="absolute inset-0">
        <img src="{{ asset('images/driving.gif') }}" alt="Car on a coastal road" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black opacity-30 dark:bg-black dark:opacity-40"></div>
    </div>

    <div class="relative z-10 w-full max-w-4xl px-4">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-2xl">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Find Your Perfect Ride</h2>
            
            <form class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div>
                    <label for="pickup-location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pickup Location</label>
                    <input type="text" id="pickup-location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="City, Airport, or Address">
                </div>
                
                <div>
                    <label for="pickup-datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pickup Datetime</label>
                    <input type="datetime-local" id="pickup-datetime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div>
                    <label for="return-datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Return Datetime</label>
                    <input type="datetime-local" id="return-datetime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="md:col-span-3">
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="max-w-screen-xl mx-auto py-16 px-4 overflow-hidden">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">Premium Brands</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">Unveil the Finest Selection of High-End Vehicles</p>
            </div>
            <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline flex items-center group">
                Show All Brands
                <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <div class="relative w-full py-4">
            <div class="flex space-x-8 animate-scroll whitespace-nowrap" style="width: fit-content;">
                {{-- Duplicate the logo items to ensure continuous scroll effect --}}
                @php
                    $brands = [
                        ['name' => 'Toyota', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Toyota_logo_transparent.png/800px-Toyota_logo_transparent.png'],
                        ['name' => 'Ford', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/Ford_Motor_Company_Logo.svg/1200px-Ford_Motor_Company_Logo.svg.png'],
                        ['name' => 'Nissan', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Nissan_logo.svg/1200px-Nissan_logo.svg.png'],
                        ['name' => 'Opel', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Opel_Logo_2017.svg/1200px-Opel_Logo_2017.svg.png'],
                        ['name' => 'BMW', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/BMW_logo_%282020%29.svg/1200px-BMW_logo_%282020%29.svg.png'],
                        ['name' => 'Mercedes-Benz', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Mercedes-Benz_Logo_2023.svg/1200px-Mercedes-Benz_Logo_2023.svg.png'],
                        ['name' => 'Volkswagen', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/Volkswagen_logo-2019.svg/1200px-Volkswagen_logo-2019.svg.png'],
                    ];
                    $allBrands = array_merge($brands, $brands); // Duplicate for seamless loop
                @endphp

                @foreach($allBrands as $brand)
                    <div class="flex-none w-[200px] h-32 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm flex items-center justify-center p-4">
                        <img src="{{ $brand['logo'] }}" alt="{{ $brand['name'] }} Logo" class="max-h-full max-w-full object-contain dark:filter dark:invert">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto py-16 px-4">
        
        {{-- Section Header --}}
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">Most View Vehicles</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">The world's leading car brands</p>
            </div>
            
            <div class="flex space-x-2">
                <button type="button" class="p-2 text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </button>
                <button type="button" class="p-2 text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </div>

        {{-- Vehicle Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @foreach($mostViewedVehicles as $vehicle)
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                {{-- Image and Rating --}}
                <div class="relative">
                    <a href="#">
                        <img class="rounded-t-lg h-64 w-full object-cover" src="{{ $vehicle['image'] }}" alt="{{ $vehicle['name'] }}" />
                    </a>
                    <div class="absolute bottom-4 left-4 bg-white/90 dark:bg-gray-900/80 backdrop-blur-sm px-3 py-1 rounded-full flex items-center space-x-1 text-sm">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $vehicle['rating'] }}</span>
                        <span class="text-gray-500 dark:text-gray-400">({{ $vehicle['reviews'] }} reviews)</span>
                    </div>
                </div>

                {{-- Card Content --}}
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-4 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $vehicle['name'] }}</h5>
                    </a>

                    {{-- Specs Grid --}}
                    <div class="grid grid-cols-2 gap-x-2 gap-y-4 mb-5">
                        @foreach($vehicle['specs'] as $spec)
                            <div class="flex items-center space-x-2">
                                {{-- Spec Icons --}}
                                @if($spec['icon'] == 'mileage')
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> {{-- Placeholder, replace with better icon --}}
                                @elseif($spec['icon'] == 'transmission')
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m0 0v2m0-6a2 2 0 100 4m0 0a2 2 0 110 4m0 0v6m0-2a2 2 0 100 4m0 0a2 2 0 110 4m0 0v2m-6-4h.01M6 12h.01M6 18h.01M18 6h.01M18 12h.01M18 18h.01"></path></svg> {{-- Placeholder --}}
                                @elseif($spec['icon'] == 'fuel' && $spec['text'] == 'Electric')
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                @elseif($spec['icon'] == 'fuel')
                                     <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v5a3 3 0 003 3h2a3 3 0 003-3v-5M8 14H6a2 2 0 01-2-2V7a2 2 0 012-2h2v9zm0 0l4-4m-4 4l4 4m0-4V4m0 0h4v4m0 0l-4 4"></path></svg> {{-- Placeholder --}}
                                @elseif($spec['icon'] == 'seats')
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                @endif
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $spec['text'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Price and Book Button --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-2xl font-bold text-gray-900 dark:text-white">${{ $vehicle['price'] }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">/ Per day</span>
                        </div>
                        <a href="#" class="text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        {{-- View More Button --}}
        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                View More
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </section>
    <section class="bg-white dark:bg-gray-900 py-16 px-4">
        <div class="max-w-screen-xl mx-auto text-center">
            
            <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-2">
                HOW IT WORKS
            </p>
            
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-12 max-w-3xl mx-auto">
                Presenting Your New Go-To Car<br>Rental Experience
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                
                <div class="flex flex-col items-center">
                    <svg class="w-12 h-12 text-gray-800 dark:text-gray-200 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Choose a Location</h3>
                    <p class="text-base text-gray-600 dark:text-gray-400">Select the ideal destination to begin your journey with ease</p>
                </div>

                <div class="flex flex-col items-center">
                    <svg class="w-12 h-12 text-gray-800 dark:text-gray-200 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Choose Your Vehicle</h3>
                    <p class="text-base text-gray-600 dark:text-gray-400">Browse our fleet and find the perfect car for your needs</p>
                </div>

                <div class="flex flex-col items-center">
                    <svg class="w-12 h-12 text-gray-800 dark:text-gray-200 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-6 0H6a2.25 2.25 0 01-2.25-2.25V6a2.25 2.25 0 012.25-2.25h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-.75.75h-1.5a2.25 2.25 0 00-2.25 2.25v.75m6-6h6m-6 0v6m6-6v6m-6 6a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-6 0H6a2.25 2.25 0 01-2.25-2.25V6a2.25 2.25 0 012.25-2.25h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-.75.75h-1.5a2.25 2.25 0 00-2.25 2.25v.75m6-6h6m-6 0v6m6-6v6m0 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Verification</h3>
                    <p class="text-base text-gray-600 dark:text-gray-400">Review your information and confirm your booking</p>
                </div>

                <div class="flex flex-col items-center">
                    <svg class="w-12 h-12 text-gray-800 dark:text-gray-200 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m-3-3a3 3 0 00-3 3m3-3h.008M9 12.75A3.375 3.375 0 0112.375 9H17.25a3.375 3.375 0 013.375 3.375v5.25a3.375 3.375 0 01-3.375 3.375H12.375A3.375 3.375 0 019 18v-5.25z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Begin Your Journey</h3>
                    <p class="text-base text-gray-600 dark:text-gray-400">Start your adventure with confidence and ease</p>
                </div>
            </div>
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto py-16 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="relative bg-blue-300 dark:bg-blue-800 rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between overflow-hidden">
                <div class="md:w-1/2 z-10 mb-8 md:mb-0">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-3">Looking for a rental car?</h2>
                    <p class="text-base text-gray-800 dark:text-gray-200 mb-6">
                        Discover your ideal rental car for every adventure, whether it's a road trip or business travel
                    </p>
                    <a href="#" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                        Get Started Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                <div class="relative md:w-1/2">
                    <img class="relative md:absolute md:-bottom-12 md:-right-12 w-full max-w-sm md:max-w-md lg:max-w-lg" src="https://carento.botble.com/storage/cars/img-1.png" alt="Grey SUV">
                </div>
            </div>

            <div class="relative bg-yellow-200 dark:bg-yellow-700 rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between overflow-hidden">
                <div class="md:w-1/2 z-10 mb-8 md:mb-0">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-3">Looking for a rental car?</h2>
                    <p class="text-base text-gray-800 dark:text-gray-200 mb-6">
                        Maximize your vehicle's potential; seamlessly rent or sell with confidence
                    </p>
                    <a href="#" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                        Get Started Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                <div class="relative md:w-1/2">
                    <img class="relative md:absolute md:-bottom-12 md:-right-12 w-full max-w-sm md:max-w-md lg:max-w-lg" src="https://carento.botble.com/storage/cars/img-2.png" alt="Grey BMW">
                </div>
            </div>

        </div>
    </section>
</x-app-layout>