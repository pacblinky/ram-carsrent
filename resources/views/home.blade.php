<x-app-layout>
    {{-- HERO SEARCH SECTION --}}
    <section class="relative h-[600px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('images/driving.gif') }}" alt="Car on a coastal road" class="w-full h-full object-cover scale-105 animate-slow-zoom">
            <div class="absolute inset-0 bg-black opacity-30 dark:bg-black dark:opacity-40"></div>
        </div>

        {{-- Added 'animate-load' class for immediate animation on page load --}}
        <div class="relative z-10 w-full max-w-4xl px-4 opacity-0 translate-y-8 animate-load transition-all duration-1000 ease-out">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-2xl">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Find Your Perfect Ride</h2>
                
                <form action="{{ route('cars.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="location_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pickup Location</label>
                        <select name="location_id" id="location_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="pickup_datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pickup Datetime</label>
                        <input type="datetime-local" name="pickup_datetime" id="pickup_datetime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div>
                        <label for="dropoff_datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Return Datetime</label>
                        <input type="datetime-local" name="dropoff_datetime" id="dropoff_datetime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <div class="md:col-span-3">
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-transform hover:scale-[1.02]">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- PREMIUM BRANDS SECTION --}}
    <section class="max-w-screen-xl mx-auto py-16 px-4 overflow-hidden">
        {{-- Added 'animate-on-scroll' to trigger animation when in view --}}
        <div class="flex justify-between items-end mb-8 opacity-0 translate-y-8 transition-all duration-1000 ease-out animate-on-scroll">
            <div>
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">Premium Brands</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">Unveil the Finest Selection of High-End Vehicles</p>
            </div>
            <a href="{{ route('cars.index') }}" class="text-blue-600 dark:text-blue-500 hover:underline flex items-center group">
                Show All Brands
                <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <div class="relative w-full py-4 opacity-0 translate-y-8 transition-all duration-1000 delay-200 ease-out animate-on-scroll">
            <div class="flex space-x-8 animate-scroll whitespace-nowrap" style="width: fit-content;">
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
                    $allBrands = array_merge($brands, $brands);
                @endphp

                @foreach($allBrands as $brand)
                    <div class="flex-none w-[200px] h-32 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm flex items-center justify-center p-4 hover:shadow-md transition-shadow">
                        <img src="{{ $brand['logo'] }}" alt="{{ $brand['name'] }} Logo" class="max-h-full max-w-full object-contain dark:filter dark:invert opacity-80 hover:opacity-100 transition-opacity">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- RECENT VEHICLES SECTION --}}
    <section class="max-w-screen-xl mx-auto py-16 px-4">
        <div class="flex justify-between items-end mb-8 opacity-0 translate-y-8 transition-all duration-1000 ease-out animate-on-scroll">
            <div>
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">Recent Vehicles</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">Our latest additions to the fleet</p>
            </div>
            <div class="flex space-x-2"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($recentCars as $index => $car)
                @php
                     $imageUrl = !empty($car->images) && is_array($car->images) && count($car->images) > 0 
                        ? asset('storage/' . $car->images[0]) 
                        : asset('images/logo.png');
                     $specs = [
                        ['icon' => 'mileage', 'text' => 'Unlimited'],
                        ['icon' => 'transmission', 'text' => ucfirst($car->transmission)],
                        ['icon' => 'fuel', 'text' => ucfirst($car->fuel_type)],
                        ['icon' => 'seats', 'text' => $car->number_of_seats . ' seats'],
                    ];
                    // Stagger delay based on index
                    $delay = $index * 150; 
                @endphp

            {{-- Added stagger delay style --}}
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex flex-col opacity-0 translate-y-12 transition-all duration-1000 ease-out animate-on-scroll hover:shadow-xl hover:-translate-y-1" style="transition-delay: {{ $delay }}ms">
                <div class="relative h-64 overflow-hidden rounded-t-lg">
                    <a href="{{ route('cars.show', $car->id) }}">
                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" src="{{ $imageUrl }}" alt="{{ $car->name }}" />
                    </a>
                </div>

                <div class="p-5 flex-grow flex flex-col justify-between">
                    <div>
                        <a href="{{ route('cars.show', $car->id) }}">
                            <h5 class="mb-4 text-xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-1 hover:text-blue-600 dark:hover:text-blue-500 transition-colors">{{ $car->name }}</h5>
                        </a>
                        <div class="grid grid-cols-2 gap-x-2 gap-y-4 mb-5">
                            @foreach($specs as $spec)
                                <div class="flex items-center space-x-2">
                                    @if($spec['icon'] == 'mileage')
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    @elseif($spec['icon'] == 'transmission')
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527c.477-.34.994-.142 1.246.317l.545 1.03c.25.46.07.994-.317 1.246l-.527.737c-.25.35-.272.806-.108 1.204.165.397.505.71.93.78l.893.15c.542.09.94.56.94 1.11v1.093c0 .55-.398 1.02-.94 1.11l-.893.149c-.425.07-.764.384-.93.78-.164.398-.142.855.108 1.205l.527.737c.34.477.142.994-.317 1.246l1.03-.545c.46-.25.994-.07 1.246.317l.737.527c.35.25.806.272 1.204.108.397-.165.71-.505.78-.93l.15-.893zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" /></svg>
                                    @elseif($spec['icon'] == 'fuel')
                                         <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4-6v2m0 0v2m0-2h2m-2 0H8m8-2v2m0 0v2m0-2h2m-2 0h-2" /></svg>
                                    @elseif($spec['icon'] == 'seats')
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.5 18H8.5v-2.5a2.5 2.5 0 012.5-2.5h2a2.5 2.5 0 012.5 2.5V18zM6 9h12a2 2 0 00-2-2H8a2 2 0 00-2 2z" /></svg>
                                    @endif
                                    <span class="text-sm text-gray-700 dark:text-gray-300 truncate">{{ $spec['text'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <span class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($car->price_per_day, 0) }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">/ day</span>
                        </div>
                        <a href="{{ route('cars.show', $car->id) }}" 
                           class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800 transition-all duration-200 ease-in-out hover:scale-105">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-full text-center text-gray-500 dark:text-gray-400 py-8 opacity-0 animate-on-scroll">
                    No vehicles currently available.
                </div>
            @endforelse
        </div>

        <div class="text-center mt-12 opacity-0 translate-y-8 transition-all duration-1000 delay-300 ease-out animate-on-scroll">
            <a href="{{ route('cars.index') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800 transition-transform hover:scale-105">
                View More
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </section>

    {{-- HOW IT WORKS SECTION --}}
    <section class="bg-white dark:bg-gray-900 py-16 px-4">
        <div class="max-w-screen-xl mx-auto text-center">
            <div class="opacity-0 translate-y-8 transition-all duration-1000 ease-out animate-on-scroll">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-2">
                    HOW IT WORKS
                </p>
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-12 max-w-3xl mx-auto">
                    Presenting Your New Go-To Car<br>Rental Experience
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                {{-- Steps with staggered delay --}}
                <div class="flex flex-col items-center opacity-0 translate-y-8 transition-all duration-1000 delay-100 ease-out animate-on-scroll">
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded-full mb-4">
                         <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Choose a Location</h3>
                    <p class="text-base text-gray-600 dark:text-gray-400">Select the ideal destination to begin your journey with ease</p>
                </div>
                <div class="flex flex-col items-center opacity-0 translate-y-8 transition-all duration-1000 delay-200 ease-out animate-on-scroll">
                     <div class="p-4 bg-green-50 dark:bg-green-900/30 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                     </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Choose Your Vehicle</h3>
                    <p class="text-base text-gray-600 dark:text-gray-400">Browse our fleet and find the perfect car for your needs</p>
                </div>
                <div class="flex flex-col items-center opacity-0 translate-y-8 transition-all duration-1000 delay-300 ease-out animate-on-scroll">
                     <div class="p-4 bg-yellow-50 dark:bg-yellow-900/30 rounded-full mb-4">
                        <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-6 0H6a2.25 2.25 0 01-2.25-2.25V6a2.25 2.25 0 012.25-2.25h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-.75.75h-1.5a2.25 2.25 0 00-2.25 2.25v.75m6-6h6m-6 0v6m6-6v6m-6 6a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-6 0H6a2.25 2.25 0 01-2.25-2.25V6a2.25 2.25 0 012.25-2.25h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-.75.75h-1.5a2.25 2.25 0 00-2.25 2.25v.75m6-6h6m-6 0v6m6-6v6m0 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6" /></svg>
                     </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Verification</h3>
                    <p class="text-base text-gray-600 dark:text-gray-400">Review your information and confirm your booking</p>
                </div>
                <div class="flex flex-col items-center opacity-0 translate-y-8 transition-all duration-1000 delay-500 ease-out animate-on-scroll">
                     <div class="p-4 bg-indigo-50 dark:bg-indigo-900/30 rounded-full mb-4">
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m-3-3a3 3 0 00-3 3m3-3h.008M9 12.75A3.375 3.375 0 0112.375 9H17.25a3.375 3.375 0 013.375 3.375v5.25a3.375 3.375 0 01-3.375 3.375H12.375A3.375 3.375 0 019 18v-5.25z" /></svg>
                     </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Begin Your Journey</h3>
                    <p class="text-base text-gray-600 dark:text-gray-400">Start your adventure with confidence and ease</p>
                </div>
            </div>
        </div>
    </section>

    {{-- BOTTOM CTA SECTIONS --}}
    <section class="max-w-screen-xl mx-auto py-16 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="relative bg-blue-300 dark:bg-blue-800 rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between overflow-hidden opacity-0 -translate-x-8 transition-all duration-1000 ease-out animate-on-scroll">
                <div class="md:w-1/2 z-10 mb-8 md:mb-0">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-3">Looking for a rental car?</h2>
                    <p class="text-base text-gray-800 dark:text-gray-200 mb-6">
                        Discover your ideal rental car for every adventure, whether it's a road trip or business travel
                    </p>
                    <a href="{{ route('cars.index') }}" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800 transition-transform hover:scale-105">
                        Get Started Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                <div class="relative md:w-1/2">
                    <img class="relative md:absolute md:-bottom-12 md:-right-12 w-full max-w-sm md:max-w-md lg:max-w-lg transition-transform duration-700 hover:scale-105" src="https://carento.botble.com/storage/cars/img-1.png" alt="Grey SUV">
                </div>
            </div>

            <div class="relative bg-yellow-200 dark:bg-yellow-700 rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between overflow-hidden opacity-0 translate-x-8 transition-all duration-1000 ease-out animate-on-scroll">
                <div class="md:w-1/2 z-10 mb-8 md:mb-0">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-3">Looking for a rental car?</h2>
                    <p class="text-base text-gray-800 dark:text-gray-200 mb-6">
                        Maximize your vehicle's potential; seamlessly rent or sell with confidence
                    </p>
                    <a href="{{ route('cars.index') }}" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800 transition-transform hover:scale-105">
                        Get Started Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                <div class="relative md:w-1/2">
                    <img class="relative md:absolute md:-bottom-12 md:-right-12 w-full max-w-sm md:max-w-md lg:max-w-lg transition-transform duration-700 hover:scale-105" src="https://carento.botble.com/storage/cars/img-2.png" alt="Grey BMW">
                </div>
            </div>

        </div>
    </section>

    {{-- ANIMATION SCRIPT --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // 1. Trigger Hero Animation Immediately
            setTimeout(() => {
                const heroContent = document.querySelector('.animate-load');
                if (heroContent) {
                    heroContent.classList.remove('opacity-0', 'translate-y-8');
                    heroContent.classList.add('opacity-100', 'translate-y-0');
                }
            }, 100); // Slight delay for smoother appearance after initial paint

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
                        entry.target.classList.remove('opacity-0', 'translate-y-8', '-translate-x-8', 'translate-x-8', 'translate-y-12');
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