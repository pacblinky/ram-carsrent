<x-app-layout>
    {{-- HERO SEARCH SECTION --}}
    <section class="relative bg-gray-900 flex items-center justify-center pt-24 pb-48">
        <div class="absolute inset-0">
            <img src="{{ asset('images/driving.gif') }}" alt="Background" class="w-full h-full object-cover opacity-50">
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

        {{-- MAIN SEARCH FORM (AJAX enabled via class 'ajax-form') --}}
        <div class="absolute -bottom-40 md:-bottom-24 z-20 w-full max-w-screen-lg mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
                <form action="{{ route('cars.index') }}" method="GET" class="ajax-form grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    
                    {{-- Location Dropdown --}}
                    <div>
                        <label for="location_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pick up Location</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg>
                            </div>
                            <select name="location_id" id="location_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                <option value="">All Locations</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Date Inputs --}}
                    <div>
                        <label for="pickup-datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pick up Date Time</label>
                        <input type="datetime-local" name="pickup_datetime" id="pickup-datetime" value="{{ request('pickup_datetime') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <div>
                        <label for="dropoff-datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Drop off Date Time</label>
                        <input type="datetime-local" name="dropoff_datetime" id="dropoff-datetime" value="{{ request('dropoff_datetime') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Find a Vehicle
                    </button>
                </form>
            </div>
        </div>
    </section>

    <br><br>

    {{-- MAIN CONTENT --}}
    <section class="max-w-screen-xl mx-auto pt-48 md:pt-32 pb-12 px-4">
        <div class="mb-8">
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">Our Vehicle Fleet</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">Turning dreams into reality with versatile vehicles.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- SIDEBAR FILTERS --}}
            <aside class="lg:col-span-1 space-y-6" id="sidebar-filters">
                
                {{-- 1. Price Filter Form --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Price Range / Day</h3>
                    <form action="{{ route('cars.index') }}" method="GET" class="ajax-form">
                        {{-- Keep other active filters when submitting price --}}
                        @foreach(request()->except(['min_price', 'max_price', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <div class="flex items-center justify-between space-x-2 mb-4">
                            <div class="flex flex-col">
                                <label for="min-price" class="mb-1 text-sm text-gray-600 dark:text-gray-400">Min</label>
                                <input type="number" name="min_price" id="min-price" min="0" max="{{ $maxPriceInDb }}" 
                                       value="{{ request('min_price', $minPriceInDb) }}" 
                                       class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                            <div class="flex flex-col">
                                <label for="max-price" class="mb-1 text-sm text-gray-600 dark:text-gray-400">Max</label>
                                <input type="number" name="max_price" id="max-price" min="0" max="{{ $maxPriceInDb }}" 
                                       value="{{ request('max_price', $maxPriceInDb) }}" 
                                       class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700">
                            Apply Price
                        </button>
                    </form>
                </div>

                {{-- 2. Brand Filter --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Brand</h3>
                        @if(request('brand_id'))
                            <a href="{{ route('cars.index', request()->except(['brand_id', 'page'])) }}" class="ajax-filter-link text-xs text-red-500 hover:underline">Clear</a>
                        @endif
                    </div>
                    <ul class="space-y-3">
                        @foreach($brands as $brand)
                        <li>
                            {{-- Added 'ajax-filter-link' class --}}
                            <a href="{{ route('cars.index', array_merge(request()->query(), ['brand_id' => $brand->id, 'page' => 1])) }}" 
                               class="ajax-filter-link flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request('brand_id') == $brand->id ? 'bg-blue-50 dark:bg-gray-700 ring-2 ring-blue-300 dark:ring-blue-500' : '' }}">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $brand->name }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $brand->cars_count }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- 3. Category Filter --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Categories</h3>
                        @if(request('category'))
                            <a href="{{ route('cars.index', request()->except(['category', 'page'])) }}" class="ajax-filter-link text-xs text-red-500 hover:underline">Clear</a>
                        @endif
                    </div>
                    <ul class="space-y-3">
                        @foreach($categories as $cat)
                        <li>
                             {{-- Added 'ajax-filter-link' class --}}
                            <a href="{{ route('cars.index', array_merge(request()->query(), ['category' => $cat['name'], 'page' => 1])) }}" 
                               class="ajax-filter-link flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request('category') == $cat['name'] ? 'bg-blue-50 dark:bg-gray-700 ring-2 ring-blue-300 dark:ring-blue-500' : '' }}">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $cat['label'] }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $cat['count'] }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- MAIN CONTENT CONTAINER (AJAX will update this) --}}
            <main class="lg:col-span-3" id="car-list-container">
                @include('cars.partials.car-list')
            </main>
        </div>
    </section>

    {{-- AJAX SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('car-list-container');

            // Main function to fetch and update content
            function fetchCars(url) {
                const loadingOverlay = document.getElementById('loading-overlay');
                if (loadingOverlay) loadingOverlay.classList.remove('hidden');
                
                // Ensure the URL is valid before fetching
                if (!url) return;

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    container.innerHTML = html;
                    // Update URL without reloading
                    window.history.pushState({}, '', url);
                    // Re-initialize Flowbite components (like dropdowns) in new content
                    if (typeof initFlowbite === 'function') {
                        initFlowbite();
                    }
                })
                .catch(error => console.error('Error fetching cars:', error))
                .finally(() => {
                   // Overlay is removed by replacing innerHTML, but just in case:
                   const newOverlay = document.getElementById('loading-overlay');
                   if (newOverlay) newOverlay.classList.add('hidden');
                });
            }

            // 1. Handle Filter Links (Brands, Categories, Sort, Per Page, Clear)
            document.addEventListener('click', function(e) {
                // Check if clicked element OR its parent is an ajax-filter-link
                const link = e.target.closest('.ajax-filter-link');
                if (link) {
                    e.preventDefault();
                    fetchCars(link.href);
                    // Optional: Update active state visually in sidebar without full reload
                    // For now, we rely on full page reload for sidebar active state updates perfectly, 
                    // or complex JS to toggle classes.
                    // Simplest MVP: just fetch results.
                }

                // Handle Pagination Links specifically (they might not have our custom class)
                const pageLink = e.target.closest('#pagination-container a');
                if (pageLink) {
                    e.preventDefault();
                    fetchCars(pageLink.href);
                    // Scroll to top of results
                    container.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });

            // 2. Handle Form Submissions (Hero Search, Price Filter)
            document.addEventListener('submit', function(e) {
                if (e.target.classList.contains('ajax-form')) {
                    e.preventDefault();
                    const form = e.target;
                    const url = new URL(form.action);
                    const formData = new FormData(form);
                    
                    // Append current query params to maintain other filters not in this form
                    const currentParams = new URLSearchParams(window.location.search);
                    currentParams.forEach((value, key) => {
                        if (!formData.has(key)) {
                             url.searchParams.append(key, value);
                        }
                    });

                    // Overwrite with new form data
                    formData.forEach((value, key) => {
                        if (value) { // Only append if has value
                             url.searchParams.set(key, value);
                        } else {
                             url.searchParams.delete(key);
                        }
                    });
                    
                    // Reset page to 1 on new filter search
                    url.searchParams.set('page', 1);

                    fetchCars(url.toString());
                }
            });

            // Handle browser back/forward buttons
            window.addEventListener('popstate', function() {
                fetchCars(window.location.href);
            });
        });
    </script>
</x-app-layout>