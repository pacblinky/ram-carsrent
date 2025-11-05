<x-app-layout>
<div class="max-w-screen-xl mx-auto py-12 px-4">
    
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">Our Vehicle Fleet</h1>
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
                                        {{-- You can add icons here based on $spec['icon'] --}}
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
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
</div>

</x-app-layout>