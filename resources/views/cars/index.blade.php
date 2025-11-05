<x-app-layout>
<section class="relative bg-gray-900 flex items-center justify-center pt-24 pb-48">
    <div class="absolute inset-0">
        <img src="{{ asset('images/driving.gif') }}" alt="Lexus car" class="w-full h-full object-cover opacity-50">
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>

    <div class="relative z-10 text-center px-4">
        <span class="inline-block bg-green-100 text-green-800 text-sm font-medium px-4 py-1.5 rounded-full dark:bg-green-900 dark:text-green-300">
            Find cars for sale and for rent near you
        </span>
        <h1 class="text-4xl md:text-5xl font-extrabold text-white my-4">Find Your Perfect Car</h1>
        <p class="text-lg text-gray-200 dark:text-gray-300 max-w-2xl mx-auto">
            Search and find your best car rental with easy way
        </p>
    </div>
    
 <div class="absolute -bottom-40 md:-bottom-24 z-20 w-full max-w-screen-lg mx-auto px-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
        <form class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label for="search-location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pick up Location</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg>
                    </div>
                    <input type="text" id="search-location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Search for location...">
                </div>
            </div>
            <div>
                <label for="pickup-datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pick up Date Time</label>
                <input type="datetime-local" id="pickup-datetime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            </div>
            <div>
                <label for="dropoff-datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Drop off Date Time</label>
                <input type="datetime-local" id="dropoff-datetime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            </div>
            <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Find a Vehicle
            </button>
        </form>
    </div>
</div>
</section>

<br>
<br>

<section class="max-w-screen-xl mx-auto pt-48 md:pt-32 pb-12 px-4">
    <div class="mb-8">
        <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">Our Vehicle Fleet</h2>
        <p class="text-lg text-gray-600 dark:text-gray-400">Turning dreams into reality with versatile vehicles.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <aside class="lg:col-span-1 space-y-6">
            
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Price Range</h3>
                <div class="mb-4">
                    <input id="default-range" type="range" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                </div>
                <div class="flex justify-between text-sm text-gray-700 dark:text-gray-300">
                    <div class="flex flex-col">
                        <label for="min-price" class="mb-1">MIN</label>
                        <input type="text" id="min-price" value="0" class="w-20 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="flex flex-col items-end">
                        <label for="max-price" class="mb-1">MAX</label>
                        <input type="text" id="max-price" value="98" class="w-20 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Brand</h3>
                <ul class="space-y-3">
                    @foreach($brands as $brand)
                    <li>
                        <a href="#" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $brand['name'] }}</span>
                            <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">{{ $brand['count'] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="mt-4">
                    <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Show more</a>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Categories</h3>
                <ul class="space-y-3">
                    @foreach($categories as $category)
                    <li>
                        <a href="#" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category['name'] }}</span>
                            <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">{{ $category['count'] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

        </aside>

        <main class="lg:col-span-3">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4 md:mb-0">
                    10 items found
                </span>
                
                <div class="flex items-center space-x-4">
                    <button id="showDropdownButton" data-dropdown-toggle="showDropdown" class="text-gray-900 dark:text-white font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center border dark:border-gray-600" type="button">
                        Show: 30
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
                    </button>
                    <div id="showDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="showDropdownButton">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show: 10</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show: 20</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show: 30</a></li>
                        </ul>
                    </div>

                    <button id="sortDropdownButton" data-dropdown-toggle="sortDropdown" class="text-gray-900 dark:text-white font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center border dark:border-gray-600" type="button">
                        Sort by: Recently added
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
                    </button>
                    <div id="sortDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="sortDropdownButton">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Price: Low to High</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Price: High to Low</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Rating</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                
                @foreach($cars as $car)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden flex flex-col md:flex-row">
                    <div class="md:w-1/3">
                        <img class="h-64 w-full object-cover" src="{{ $car['image'] }}" alt="{{ $car['name'] }}">
                    </div>
                    
                    <div class="md:w-2/3 p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center mb-2">
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 inline-flex items-center">
                                    <svg class="w-3 h-3 text-blue-800 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20"><path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.455 8.351l3.656 3.56-0.865 5.031a1.532 1.532 0 0 0 2.226 1.616L11 15.347l4.545 2.394a1.532 1.532 0 0 0 2.226-1.617l-0.865-5.03L20.545 8.35a1.534 1.534 0 0 0 .379-0.725Z"/></svg>
                                    {{ $car['rating'] }} ({{ $car['reviews'] }} review)
                                </span>
                            </div>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $car['name'] }}</h5>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $car['location'] }}</p>
                            
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                @foreach($car['specs'] as $spec)
                                <div class="flex items-center space-x-2">
                                    @if($spec['icon'] == 'mileage')
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @elseif($spec['icon'] == 'transmission')
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.83 2.77c-1.55 0-3.044-.56-4.198-1.57A6 6 0 012.25 13.5a6 6 0 011.57-4.198M15.59 14.37v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A6 6 0 0012 3.75h-1.5a3.375 3.375 0 00-3.375 3.375v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 003.375-3.375V7.5m-6 13.5a3.375 3.375 0 003.375-3.375V15a1.125 1.125 0 011.125-1.125h1.5a3.375 3.375 0 003.375-3.375V7.5m0 13.5m-6-13.5v-1.5c0-.621.504-1.125 1.125-1.125h1.5A3.375 3.375 0 0113.5 7.5v1.5c0 .621-.504 1.125-1.125 1.125h-1.5A3.375 3.375 0 019 7.5v-1.5" />
                                        </svg>
                                    @elseif($spec['icon'] == 'seats')
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A1.5 1.5 0 0118 21.75H6a1.5 1.5 0 01-1.499-1.632z" />
                                        </svg>
                                    @elseif($spec['icon'] == 'brand' || $spec['icon'] == 'fuel')
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25z" />
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $spec['text'] }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">${{ $car['price'] }}</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">/ Per day</span>
                            </div>
                            <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
            
            <nav class="flex items-center justify-between pt-10" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span class="font-semibold text-gray-900 dark:text-white">1-10</span> of <span class="font-semibold text-gray-900 dark:text-white">1000</span></span>
                <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                    </li>
                    <li>
                        <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">1</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                    </li>
                </ul>
            </nav>

        </main>
    </div>
</section>
</x-app-layout>