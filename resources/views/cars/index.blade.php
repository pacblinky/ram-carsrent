<x-app-layout>
    {{-- MODIFIED: Style block for fade-in animation --}}
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* For the car cards */
        .fade-in-card {
            opacity: 0; 
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* For the hero section */
        .fade-in-hero-content, .fade-in-hero-search {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .fade-in-hero-search {
            animation-delay: 0.2s; 
        }

        /* ADDED: Classes for Main Content Title and Filters */
        .fade-in-main-title, .fade-in-filters {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }

        .fade-in-main-title {
            animation-delay: 0.3s; /* After hero search */
        }
        
        .fade-in-filters {
            animation-delay: 0.4s; /* After main title */
        }

    </style>
    {{-- END MODIFIED BLOCK --}}

    {{-- HERO SEARCH SECTION --}}
    <section class="relative bg-gray-900 flex flex-col items-center justify-center pt-24 pb-48">
        <div class="absolute inset-0">
            <img src="{{ asset('images/driving.gif') }}" alt="Background" class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        {{-- Added 'fade-in-hero-content' class --}}
        <div class="relative z-10 text-center px-4 fade-in-hero-content">
            <span class="inline-block bg-green-100 text-green-800 text-sm font-medium px-4 py-1.5 rounded-full dark:bg-green-900 dark:text-green-300">
                {{ __('cars_page.hero_badge') }}
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white my-4">{{ __('cars_page.hero_title') }}</h1>
            <p class="text-lg text-gray-200 dark:text-gray-300 max-w-2xl mx-auto">
                {{ __('cars_page.hero_subtitle') }}
            </p>
        </div>

        {{-- =================================== --}}
        {{-- MAIN SEARCH FORM (4-column layout) --}}
        {{-- =================================== --}}
        {{-- Added 'fade-in-hero-search' class --}}
        <div class="absolute -bottom-40 md:-bottom-24 z-20 w-full max-w-screen-lg mx-auto px-4 fade-in-hero-search">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
                <form action="{{ route('cars.index') }}" method="GET" class="ajax-form grid grid-cols-1 md:grid-cols-4 gap-4 items-end" id="cars-search-form">
                    
                    {{-- Location Dropdown --}}
                    <div>
                        <label for="location_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.pickup_location') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg>
                            </div>
                            <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none">
                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                           </div>
                            <select name="location_id" id="location_id" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 pe-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white text-start appearance-none indent-6">
                                <option value="">{{ __('cars_page.all_locations') }}</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Pickup DateTime --}}
                    <div>
                        <label for="pickup_datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.pickup_date') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4Zm-1 14H3V8h16v10Z"/></svg>
                            </div>
                            <input
                                type="datetime-local"
                                id="pickup_datetime"
                                name="pickup_datetime"
                                min="{{ now()->format('Y-m-d\TH:i') }}"
                                value="{{ request('pickup_datetime') ? \Carbon\Carbon::parse(request('pickup_datetime'))->format('Y-m-d\TH:i') : '' }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="{{ __('cars_page.select_date') }}">
                        </div>
                    </div>
                    
                    {{-- Dropoff DateTime --}}
                    <div>
                        <label for="dropoff_datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.dropoff_date') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4Zm-1 14H3V8h16v10Z"/></svg>
                            </div>
                            <input
                                type="datetime-local"
                                id="dropoff_datetime"
                                name="dropoff_datetime"
                                min="{{ now()->format('Y-m-d\TH:i') }}"
                                value="{{ request('dropoff_datetime') ? \Carbon\Carbon::parse(request('dropoff_datetime'))->format('Y-m-d\TH:i') : '' }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="{{ __('cars_page.select_date') }}">
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div>
                        <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            {{ __('cars_page.find_vehicle') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <br><br>

    {{-- MAIN CONTENT --}}
    <section class="max-w-screen-xl mx-auto pt-48 md:pt-32 pb-12 px-4">
        {{-- MODIFIED: Added 'fade-in-main-title' class --}}
        <div class="mb-8 fade-in-main-title">
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">{{ __('cars_page.fleet_title') }}</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">{{ __('cars_page.fleet_subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- =================================== --}}
            {{-- NEW: MOBILE FILTER TOGGLE BUTTON --}}
            {{-- =================================== --}}
            <div class="lg:hidden"> {{-- Only show on screens smaller than lg --}}
                <button type="button" id="filter-toggle-button" class="flex items-center justify-between w-full p-4 font-medium text-left text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700">
                    {{-- Text will be updated by JS --}}
                    <span>{{ __('cars_page.show_filters') ?? 'Show Filters' }}</span> 
                    <svg id="filter-toggle-icon" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>

            {{-- =================================== --}}
            {{-- MODIFIED: SIDEBAR FILTERS --}}
            {{-- =================================== --}}
            {{-- MODIFIED: Added 'fade-in-filters' class --}}
            <aside class="hidden lg:block lg:col-span-1 space-y-6 fade-in-filters" id="sidebar-filters">
                
                {{-- 1. Price Filter Form (Unchanged) --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('cars_page.price_range') }}</h3>
                    <form action="{{ route('cars.index') }}" method="GET" class="ajax-form">
                        @foreach(request()->except(['min_price', 'max_price', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <div class="flex items-end justify-between gap-2 mb-4">
                            <div class="flex flex-col flex-1 text-center">
                                <label for="min-price" class="mb-1 text-sm text-gray-600 dark:text-gray-400">{{ __('cars_page.min_price') }}</label>
                                <input type="number" name="min_price" id="min-price" min="0" max="{{ $maxPriceInDb }}" 
                                       value="{{ request('min_price', $minPriceInDb) }}" 
                                       class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                            <div class="flex flex-col flex-1 text-center">
                                <label for="max-price" class="mb-1 text-sm text-gray-600 dark:text-gray-400">{{ __('cars_page.max_price') }}</label>
                                <input type="number" name="max_price" id="max-price" min="0" max="{{ $maxPriceInDb }}" 
                                       value="{{ request('max_price', $maxPriceInDb) }}" 
                                       class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700">
                            {{ __('cars_page.apply_price') }}
                        </button>
                    </form>
                </div>

                {{-- 2. Brand Filter (Unchanged) --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('cars_page.brand') }}</h3>
                    <ul class="space-y-3">
                        @foreach($brands as $brand)
                        <li>
                            <label for="brand-{{ $brand->id }}" class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox" 
                                       id="brand-{{ $brand->id }}" 
                                       class="ajax-filter-checkbox h-4 w-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       data-url="{{ route('cars.index', array_merge(request()->query(), ['brand_id' => $brand->id, 'page' => 1])) }}"
                                       data-clear-url="{{ route('cars.index', request()->except(['brand_id', 'page'])) }}"
                                       {{ request('brand_id') == $brand->id ? 'checked' : '' }}>
                                
                                <span class="ms-3 flex-1 text-sm font-medium text-gray-900 dark:text-white">{{ $brand->name }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $brand->cars_count }}
                                </span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- 3. Category Filter (Unchanged) --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('cars_page.categories') }}</h3>
                    <ul class="space-y-3">
                        @foreach($categories as $cat)
                        <li>
                            <label for="category-{{ $cat['name'] }}" class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox" 
                                       id="category-{{ $cat['name'] }}"
                                       class="ajax-filter-checkbox h-4 w-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       data-url="{{ route('cars.index', array_merge(request()->query(), ['category' => $cat['name'], 'page' => 1])) }}"
                                       data-clear-url="{{ route('cars.index', request()->except(['category', 'page'])) }}"
                                       {{ request('category') == $cat['name'] ? 'checked' : '' }}>

                                <span class="ms-3 flex-1 text-sm font-medium text-gray-900 dark:text-white">{{ $cat['label'] }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $cat['count'] }}
                                </span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- 4. Fuel Type Filter (Unchanged) --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('cars_page.fuel_type') }}</h3>
                    <ul class="space-y-3">
                        @foreach($fuelTypes as $type)
                        <li>
                            <label for="fuel-{{ $type['name'] }}" class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox" 
                                       id="fuel-{{ $type['name'] }}"
                                       class="ajax-filter-checkbox h-4 w-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       data-url="{{ route('cars.index', array_merge(request()->query(), ['fuel_type' => $type['name'], 'page' => 1])) }}"
                                       data-clear-url="{{ route('cars.index', request()->except(['fuel_type', 'page'])) }}"
                                       {{ request('fuel_type') == $type['name'] ? 'checked' : '' }}>
                                
                                <span class="ms-3 flex-1 text-sm font-medium text-gray-900 dark:text-white">{{ $type['label'] }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $type['count'] }}
                                </span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- 5. Transmission Filter (Unchanged) --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('cars_page.transmission') }}</h3>
                    <ul class="space-y-3">
                        @foreach($transmissions as $trans)
                        <li>
                            <label for="trans-{{ $trans['name'] }}" class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox"
                                       id="trans-{{ $trans['name'] }}"
                                       class="ajax-filter-checkbox h-4 w-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       data-url="{{ route('cars.index', array_merge(request()->query(), ['transmission' => $trans['name'], 'page' => 1])) }}"
                                       data-clear-url="{{ route('cars.index', request()->except(['transmission', 'page'])) }}"
                                       {{ request('transmission') == $trans['name'] ? 'checked' : '' }}>

                                <span class="ms-3 flex-1 text-sm font-medium text-gray-900 dark:text-white">{{ $trans['label'] }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $trans['count'] }}
                                </span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- 6. Number of Seats Filter (Unchanged) --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('cars_page.seats') }}</h3>
                    <ul class="space-y-3">
                        @foreach($seats as $seat)
                        <li>
                            <label for="seat-{{ $seat['name'] }}" class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox"
                                       id="seat-{{ $seat['name'] }}"
                                       class="ajax-filter-checkbox h-4 w-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       data-url="{{ route('cars.index', array_merge(request()->query(), ['seats' => $seat['name'], 'page' => 1])) }}"
                                       data-clear-url="{{ route('cars.index', request()->except(['seats', 'page'])) }}"
                                       {{ request('seats') == $seat['name'] ? 'checked' : '' }}>

                                <span class="ms-3 flex-1 text-sm font-medium text-gray-900 dark:text-white">{{ $seat['label'] }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $seat['count'] }}
                                </span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- 7. Number of Doors Filter (Unchanged) --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('cars_page.doors') }}</h3>
                    <ul class="space-y-3">
                        @foreach($doors as $door)
                        <li>
                            <label for="door-{{ $door['name'] }}" class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                                <input type="checkbox"
                                       id="door-{{ $door['name'] }}"
                                       class="ajax-filter-checkbox h-4 w-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       data-url="{{ route('cars.index', array_merge(request()->query(), ['doors' => $door['name'], 'page' => 1])) }}"
                                       data-clear-url="{{ route('cars.index', request()->except(['doors', 'page'])) }}"
                                       {{ request('doors') == $door['name'] ? 'checked' : '' }}>
                                       
                                <span class="ms-3 flex-1 text-sm font-medium text-gray-900 dark:text-white">{{ $door['label'] }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $door['count'] }}
                                </span>
                            </label>
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

    {{-- =================================== --}}
    {{-- AJAX SCRIPT (Unchanged) --}}
    {{-- =================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('car-list-container');

            // --- Function to bind the mobile toggle button ---
            function bindMobileToggle() {
                const sidebar = document.getElementById('sidebar-filters');
                const toggleButton = document.getElementById('filter-toggle-button');
                
                if (toggleButton && sidebar) { // Ensure both elements exist
                    const toggleIcon = document.getElementById('filter-toggle-icon');
                    const toggleButtonText = toggleButton.querySelector('span');

                    // Update button state on bind (in case of AJAX refresh)
                    const isHidden = sidebar.classList.contains('hidden');
                    if (isHidden) {
                        toggleButtonText.textContent = "{{ __('cars_page.show_filters') ?? 'Show Filters' }}";
                        if (toggleIcon) toggleIcon.classList.remove('rotate-180');
                    } else {
                        toggleButtonText.textContent = "{{ __('cars_page.hide_filters') ?? 'Hide Filters' }}";
                        if (toggleIcon) toggleIcon.classList.add('rotate-180');
                    }
                    
                    // Remove old listener to prevent duplicates (safer)
                    toggleButton.removeEventListener('click', handleToggleClick); 
                    // Add the listener
                    toggleButton.addEventListener('click', handleToggleClick);
                }
            }
            
            // --- Click handler for the toggle button ---
            function handleToggleClick() {
                const sidebar = document.getElementById('sidebar-filters');
                const toggleButton = document.getElementById('filter-toggle-button');
                const toggleIcon = document.getElementById('filter-toggle-icon');
                
                if (sidebar && toggleButton) { // Ensure both exist
                    const toggleButtonText = toggleButton.querySelector('span');

                    sidebar.classList.toggle('hidden');
                    const isHidden = sidebar.classList.contains('hidden');
                    
                    if (isHidden) {
                        toggleButtonText.textContent = "{{ __('cars_page.show_filters') ?? 'Show Filters' }}";
                        if (toggleIcon) toggleIcon.classList.remove('rotate-180');
                    } else {
                        toggleButtonText.textContent = "{{ __('cars_page.hide_filters') ?? 'Hide Filters' }}";
                        if (toggleIcon) toggleIcon.classList.add('rotate-180');
                    }
                }
            }

            // --- Initial bind on page load ---
            bindMobileToggle();

            // --- DATETIME-LOCAL SCRIPT ---
            // Set min attribute for datetime-local inputs to current time
            const setMinDateTime = (selector) => {
                const el = document.querySelector(selector);
                if (el) {
                    // Check if value is not set or is in the past
                    const now = new Date();
                    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
                    now.setSeconds(0, 0); // Clear seconds/milliseconds
                    const minTime = now.toISOString().slice(0, 16);

                    if (!el.value || el.value < minTime) {
                         // We only set the min attribute, the value is set by PHP
                         el.min = minTime;
                    } else {
                        // If value is valid, set min to now anyway
                        el.min = minTime;
                    }
                }
            };
            
            const bindDateTimeSync = () => {
                setMinDateTime("#pickup_datetime");
                setMinDateTime("#dropoff_datetime");
                
                const pickupEl = document.getElementById("pickup_datetime");
                const dropoffEl = document.getElementById("dropoff_datetime");

                if (pickupEl && dropoffEl) {
                    // Sync dropoff min time to pickup time
                    const syncDropoffMin = () => {
                        if (pickupEl.value) {
                            // Set dropoff min to be at least pickup time
                            dropoffEl.min = pickupEl.value;
                            
                            // If dropoff is already set and is now invalid, clear it
                            if (dropoffEl.value && dropoffEl.value < pickupEl.value) {
                                dropoffEl.value = "";
                            }
                        } else {
                             setMinDateTime("#dropoff_datetime"); // Reset to "now"
                        }
                    };
                    
                    pickupEl.removeEventListener("change", syncDropoffMin); // Remove old
                    pickupEl.addEventListener("change", syncDropoffMin); // Add new
                    syncDropoffMin(); // Run on init
                }
            }
            
            // Initial bind
            bindDateTimeSync();
            
            // --- End of Datepicker Logic Setup ---


            // --- rebindPartialEvents (Unchanged) ---
            // This is for the "Sort By" dropdown inside the partial
            function rebindPartialEvents() {
                document.querySelectorAll('.ajax-filter-link-select').forEach(select => {
                    const newSelect = select.cloneNode(true);
                    select.parentNode.replaceChild(newSelect, select);

                    newSelect.addEventListener('change', function(e) {
                        const url = e.target.value;
                        if (url) {
                            fetchCars(url);
                        }
                    });
                });
            }

            // --- fetchCars Function (MODIFIED) ---
            function fetchCars(url) {
                const currentCarListContainer = document.getElementById('car-list-container');
                const currentSidebarContainer = document.getElementById('sidebar-filters');
                const loadingOverlay = document.getElementById('loading-overlay'); 

                if (loadingOverlay) {
                    loadingOverlay.classList.remove('hidden');
                } else if (currentCarListContainer) {
                    currentCarListContainer.style.opacity = '0.5';
                }
                
                if (!url) return;

                // --- MODIFICATION: Preserve sidebar visibility state on mobile ---
                const oldSidebar = document.getElementById('sidebar-filters');
                const isMobileHidden = (window.innerWidth < 1024) && oldSidebar && oldSidebar.classList.contains('hidden');

                fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    const newCarListContent = doc.getElementById('car-list-container');
                    const newSidebarContent = doc.getElementById('sidebar-filters');

                    if (currentCarListContainer && newCarListContent) {
                        currentCarListContainer.innerHTML = newCarListContent.innerHTML;
                    }
                    
                    if (currentSidebarContainer && newSidebarContent) {
                        currentSidebarContainer.innerHTML = newSidebarContent.innerHTML;
                    }

                    // --- MODIFICATION: Re-apply hidden state if it was hidden on mobile ---
                    if (isMobileHidden) {
                        const newSidebar = document.getElementById('sidebar-filters');
                        if (newSidebar) newSidebar.classList.add('hidden');
                    }

                    window.history.pushState({}, '', url);
                    
                    if (typeof initFlowbite === 'function') {
                        initFlowbite();
                    }
                    
                    // --- Re-bind events for new content ---
                    rebindPartialEvents(); 
                    bindMobileToggle(); // <-- RE-BIND THE TOGGLE BUTTON
                    bindDateTimeSync(); // <-- RE-BIND THE DATETIME SYNC
                })
                .catch(error => console.error('Error fetching cars:', error))
                .finally(() => {
                    const newOverlay = document.getElementById('loading-overlay'); 
                    if (newOverlay) {
                        newOverlay.classList.add('hidden');
                    } else if (currentCarListContainer) {
                        currentCarListContainer.style.opacity = '1';
                    }
                });
            }

            // --- Click listener (Unchanged) ---
            document.addEventListener('click', function(e) {
                const pageLink = e.target.closest('#pagination-container a');
                if (pageLink) {
                    e.preventDefault();
                    fetchCars(pageLink.href);
                    container.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });

            // --- Change listener (Unchanged) ---
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('ajax-filter-checkbox')) {
                    const checkbox = e.target;
                    let url;
                    
                    if (checkbox.checked) {
                        url = checkbox.dataset.url;
                    } else {
                        url = checkbox.dataset.clearUrl;
                    }
                    
                    if (url) {
                        fetchCars(url);
                    }
                }
            });

            // --- Form Submit listener (MODIFIED) ---
            document.addEventListener('submit', function(e) {
                if (e.target.classList.contains('ajax-form')) {
                    e.preventDefault();
                    const form = e.target;
                    
                    // Simplified logic: The FormData will now contain the correct
                    // 'pickup_datetime' and 'dropoff_datetime' keys directly
                    // from the form inputs. No more JS magic needed.
                    
                    const url = new URL(form.action);
                    const formData = new FormData(form);
                    
                    const currentParams = new URLSearchParams(window.location.search);
                    currentParams.forEach((value, key) => {
                        if (!formData.has(key)) {
                             url.searchParams.append(key, value);
                        }
                    });

                    formData.forEach((value, key) => {
                        // All form fields are now valid, so just set them
                        if (value) { 
                             url.searchParams.set(key, value);
                        } else {
                             url.searchParams.delete(key);
                        }
                    });
                    
                    url.searchParams.set('page', 1);
                    fetchCars(url.toString());
                }
            });

            // --- popstate listener (Unchanged) ---
            window.addEventListener('popstate', function() {
                fetchCars(window.location.href);
            });

            // --- Initial bind (Unchanged) ---
            rebindPartialEvents();
        });
    </script>
</x-app-layout>