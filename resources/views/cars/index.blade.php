<x-app-layout>
    {{-- Style block (Unchanged from last time) --}}
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
        .fade-in-card {
            opacity: 0; 
            animation: fadeIn 0.5s ease-out forwards;
        }
        .fade-in-hero-content, .fade-in-hero-search {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        .fade-in-hero-search {
            animation-delay: 0.2s; 
        }
        .fade-in-main-title, .fade-in-filters {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        .fade-in-main-title {
            animation-delay: 0.3s;
        }
        .fade-in-filters {
            animation-delay: 0.4s;
        }
        .fade-in-sortbar {
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>

    {{-- HERO SEARCH SECTION (Unchanged) --}}
    <section class="relative bg-gray-900 flex flex-col items-center justify-center pt-24 pb-48">
        <div class="absolute inset-0">
            <img src="{{ asset('images/driving.gif') }}" alt="Background" class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>
        <div class="relative z-10 text-center px-4 fade-in-hero-content">
            <span class="inline-block bg-green-100 text-green-800 text-sm font-medium px-4 py-1.5 rounded-full dark:bg-green-900 dark:text-green-300">
                {{ __('cars_page.hero_badge') }}
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white my-4">{{ __('cars_page.hero_title') }}</h1>
            <p class="text-lg text-gray-200 dark:text-gray-300 max-w-2xl mx-auto">
                {{ __('cars_page.hero_subtitle') }}
            </p>
        </div>
        <div class="absolute -bottom-40 md:-bottom-24 z-20 w-full max-w-screen-lg mx-auto px-4 fade-in-hero-search">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
                
                @php
                    // MODIFIED: Removed $times, kept defaults
                    $defaultPickupTime = '09:00';
                    $defaultDropoffTime = '17:00';

                    $pickup_date_value = request('pickup_datetime') ? \Carbon\Carbon::parse(request('pickup_datetime'))->format('Y-m-d') : '';
                    $pickup_time_value = request('pickup_datetime') ? \Carbon\Carbon::parse(request('pickup_datetime'))->format('H:i') : $defaultPickupTime;
                    
                    $dropoff_date_value = request('dropoff_datetime') ? \Carbon\Carbon::parse(request('dropoff_datetime'))->format('Y-m-d') : '';
                    $dropoff_time_value = request('dropoff_datetime') ? \Carbon\Carbon::parse(request('dropoff_datetime'))->format('H:i') : $defaultDropoffTime;
                @endphp

                {{-- MODIFIED: Grid changed to 3 cols --}}
                <form action="{{ route('cars.index') }}" method="GET" class="ajax-form grid grid-cols-1 md:grid-cols-3 gap-4 items-end" id="cars-search-form">
                    
                    {{-- Hidden inputs to store combined datetime --}}
                    <input type="hidden" name="pickup_datetime" id="pickup_datetime">
                    <input type="hidden" name="dropoff_datetime" id="dropoff_datetime">

                    {{-- Location Dropdown --}}
                    <div class="md:col-span-1">
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

                    {{-- Pickup Date --}}
                    <div class="md:col-span-1">
                        <label for="pickup_date_display" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.pickup_date') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input
                                datepicker
                                datepicker-autohide
                                datepicker-format="yyyy-mm-dd"
                                datepicker-min-date="{{ now()->format('Y-m-d') }}"
                                type="text"
                                id="pickup_date_display"
                                value="{{ $pickup_date_value }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="{{ __('cars_page.select_date') }}">
                        </div>
                    </div>
                    
                    {{-- Dropoff Date --}}
                    <div class="md:col-span-1">
                        <label for="dropoff_date_display" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.dropoff_date') }}</label>
                        <div class="relative">
                           <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input
                                datepicker
                                datepicker-autohide
                                datepicker-format="yyyy-mm-dd"
                                datepicker-min-date="{{ now()->format('Y-m-d') }}"
                                type="text"
                                id="dropoff_date_display"
                                value="{{ $dropoff_date_value }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="{{ __('cars_page.select_date') }}">
                        </div>
                    </div>
                    
                    {{-- Submit Button (MODIFIED) --}}
                    <div class="md:col-span-3">
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
        <div class="mb-8 fade-in-main-title">
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">{{ __('cars_page.fleet_title') }}</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">{{ __('cars_page.fleet_subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- Mobile Filter Toggle Button (Unchanged) --}}
            <div class="lg:hidden">
                <button type="button" id="filter-toggle-button" class="flex items-center justify-between w-full p-4 font-medium text-left text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700">
                    <span>{{ __('cars_page.show_filters') ?? 'Show Filters' }}</span> 
                    <svg id="filter-toggle-icon" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>

            {{-- =================================== --}}
            {{-- MODIFIED: SIDEBAR FILTERS --}}
            {{-- =================================== --}}
            <aside class="hidden lg:block lg:col-span-1 space-y-6 fade-in-filters" id="sidebar-filters">
                
                {{-- (Sidebar content is unchanged) --}}
                <a href="{{ route('cars.index') }}" 
                   class="ajax-filter-link block w-full text-center px-4 py-2 text-sm font-medium text-red-600 bg-white border border-red-300 rounded-lg shadow-sm hover:bg-red-50 dark:bg-gray-800 dark:border-gray-700 dark:text-red-500 dark:hover:bg-gray-700">
                    <svg class="inline-block w-4 h-4 me-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('cars_page.clear_all_filters') ?? 'Clear All Filters' }}
                </a>

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
                                <input type="number" name="max_price" id="max-price" min="0" 
                                       value="{{ request('max_price', $maxPriceInDb) }}" 
                                       class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700">
                            {{ __('cars_page.apply_price') }}
                        </button>
                    </form>
                </div>

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
                
                <a href="{{ route('cars.index') }}" 
                   class="ajax-filter-link block w-full text-center px-4 py-2 text-sm font-medium text-red-600 bg-white border border-red-300 rounded-lg shadow-sm hover:bg-red-50 dark:bg-gray-800 dark:border-gray-700 dark:text-red-500 dark:hover:bg-gray-700">
                    <svg class="inline-block w-4 h-4 me-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('cars_page.clear_all_filters') ?? 'Clear All Filters' }}
                </a>

            </aside>

            {{-- MAIN CONTENT CONTAINER (AJAX will update this) --}}
            <main class="lg:col-span-3" id="car-list-container">
                @include('cars.partials.car-list')
            </main>
        </div>
    </section>

    {{-- =================================== --}}
    {{-- AJAX SCRIPT (MODIFIED) --}}
    {{-- =================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('car-list-container');

            // --- Function to bind the mobile toggle button (Unchanged) ---
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
            
            // --- Click handler for the toggle button (Unchanged) ---
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

            // --- Initial bind on page load (Unchanged) ---
            bindMobileToggle();

            // --- MODIFIED: DATE-ONLY SCRIPT ---
            const bindDateTimeSync = () => {
                const pickupDateEl = document.getElementById("pickup_date_display");
                const dropoffDateEl = document.getElementById("dropoff_date_display");
                
                const pickupHiddenEl = document.getElementById("pickup_datetime");
                const dropoffHiddenEl = document.getElementById("dropoff_datetime");

                if (!pickupDateEl) return; // Exit if elements aren't here

                // Use the default times passed from PHP (which include request values)
                const pickupTimeValue = '{{ $pickup_time_value }}';
                const dropoffTimeValue = '{{ $dropoff_time_value }}';

                // Function to update the hidden datetime input
                function updateHiddenInputs() {
                    if (pickupDateEl.value) {
                        pickupHiddenEl.value = `${pickupDateEl.value}T${pickupTimeValue}`;
                    } else {
                        pickupHiddenEl.value = "";
                    }
                    
                    if (dropoffDateEl.value) {
                        dropoffHiddenEl.value = `${dropoffDateEl.value}T${dropoffTimeValue}`;
                    } else {
                        dropoffHiddenEl.value = "";
                    }
                }

                // Function to validate and sync date pickers
                function validateAndSync() {
                    const pd = pickupDateEl.value;
                    const dd = dropoffDateEl.value;

                    if (pd) {
                        // If pickup date is set, ensure dropoff date is not before it
                        if (dd && dd < pd) {
                            dropoffDateEl.value = ""; // Clear invalid dropoff date
                        }
                        
                        // Dynamically update the min-date attribute for Flowbite Datepicker
                        dropoffDateEl.setAttribute('datepicker-min-date', pd);

                    }
                    
                    // Update the hidden inputs
                    updateHiddenInputs();
                }

                // Add event listeners
                pickupDateEl.addEventListener("change", validateAndSync);
                dropoffDateEl.addEventListener("change", validateAndSync);

                // Initial call to set hidden inputs on page load
                validateAndSync();
            }
            bindDateTimeSync();
            
            // --- rebindPartialEvents (Unchanged) ---
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

            // --- fetchCars Function (Unchanged) ---
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

                    if (isMobileHidden) {
                        const newSidebar = document.getElementById('sidebar-filters');
                        if (newSidebar) newSidebar.classList.add('hidden');
                    }

                    window.history.pushState({}, '', url);
                    
                    if (typeof initFlowbite === 'function') {
                        initFlowbite();
                    }
                    
                    rebindPartialEvents(); 
                    bindMobileToggle();
                    bindDateTimeSync(); // <-- This re-binds the new date-only logic
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

            // --- MODIFIED: Click listener ---
            document.addEventListener('click', function(e) {
                // Check for pagination links
                const pageLink = e.target.closest('#pagination-container a');
                if (pageLink) {
                    e.preventDefault();
                    fetchCars(pageLink.href);
                    container.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    return; // Exit
                }

                // Check for generic AJAX filter links (for sorting, per_page, and clear)
                const filterLink = e.target.closest('a.ajax-filter-link');
                if (filterLink) {
                    e.preventDefault();
                    fetchCars(filterLink.href);
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
                    
                    // --- Ensure hidden fields are updated before submitting ---
                    const pickupDateEl = document.getElementById("pickup_date_display");
                    const dropoffDateEl = document.getElementById("dropoff_date_display");
                    const pickupHiddenEl = document.getElementById("pickup_datetime");
                    const dropoffHiddenEl = document.getElementById("dropoff_datetime");

                    // Use the PHP-defined default times
                    const pickupTimeValue = '{{ $pickup_time_value }}';
                    const dropoffTimeValue = '{{ $dropoff_time_value }}';

                    if (pickupDateEl && pickupHiddenEl) {
                         if (pickupDateEl.value) {
                            pickupHiddenEl.value = `${pickupDateEl.value}T${pickupTimeValue}`;
                        } else {
                            pickupHiddenEl.value = "";
                        }
                    }
                    if (dropoffDateEl && dropoffHiddenEl) {
                        if (dropoffDateEl.value) {
                            dropoffHiddenEl.value = `${dropoffDateEl.value}T${dropoffTimeValue}`;
                        } else {
                            dropoffHiddenEl.value = "";
                        }
                    }
                    // --- End of update ---

                    const form = e.target;
                    const url = new URL(form.action);
                    const formData = new FormData(form);
                    
                    const currentParams = new URLSearchParams(window.location.search);
                    currentParams.forEach((value, key) => {
                        if (!formData.has(key)) {
                             url.searchParams.append(key, value);
                        }
                    });

                    formData.forEach((value, key) => {
                        // Exclude the display fields from the form submission
                        if (key.endsWith('_display')) {
                            return;
                        }

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