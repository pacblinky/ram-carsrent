<x-app-layout>
    {{-- HERO SEARCH SECTION --}}
    <section class="relative bg-gray-900 flex flex-col items-center justify-center pt-24 pb-48">
        <div class="absolute inset-0">
            <img src="{{ asset('images/driving.gif') }}" alt="Background" class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>

        <div class="relative z-10 text-center px-4">
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
        <div class="absolute -bottom-40 md:-bottom-24 z-20 w-full max-w-screen-lg mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
                <form action="{{ route('cars.index') }}" method="GET" class="ajax-form grid grid-cols-1 md:grid-cols-4 gap-4 items-end" id="cars-search-form">
                    
                    {{-- Hidden fields for submission (FULL DATETIME VALUES) --}}
                    {{-- These are pre-filled with the request values, which may contain times from the homepage --}}
                    <input type="hidden" name="pickup_datetime" id="hidden_pickup_datetime_cars" value="{{ request('pickup_datetime') }}">
                    <input type="hidden" name="dropoff_datetime" id="hidden_dropoff_datetime_cars" value="{{ request('dropoff_datetime') }}">

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

                    {{-- Pickup Date (Date-only filter display) --}}
                    <div>
                        <label for="search_start_date_cars" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.pickup_date') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4Zm-1 14H3V8h16v10Z"/></svg>
                            </div>
                            <input
                                type="text"
                                id="search_start_date_cars"
                                datepicker
                                datepicker-autohide
                                datepicker-format="yyyy-mm-dd"
                                datepicker-min-date="{{ date('Y-m-d') }}"
                                {{-- Extract date part from full datetime string for display --}}
                                value="{{ request('pickup_datetime') ? \Carbon\Carbon::parse(request('pickup_datetime'))->format('Y-m-d') : '' }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="{{ __('cars_page.select_date') }}">
                        </div>
                    </div>
                    
                    {{-- Dropoff Date (Date-only filter display) --}}
                    <div>
                        <label for="search_end_date_cars" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.dropoff_date') }}</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4Zm-1 14H3V8h16v10Z"/></svg>
                            </div>
                            <input
                                type="text"
                                id="search_end_date_cars"
                                datepicker
                                datepicker-autohide
                                datepicker-format="yyyy-mm-dd"
                                datepicker-min-date="{{ date('Y-m-d') }}"
                                {{-- Extract date part from full datetime string for display --}}
                                value="{{ request('dropoff_datetime') ? \Carbon\Carbon::parse(request('dropoff_datetime'))->format('Y-m-d') : '' }}"
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
        <div class="mb-8">
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-2">{{ __('cars_page.fleet_title') }}</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">{{ __('cars_page.fleet_subtitle') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- SIDEBAR FILTERS --}}
            <aside class="lg:col-span-1 space-y-6" id="sidebar-filters">
                
                {{-- 1. Price Filter Form --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('cars_page.price_range') }}</h3>
                    <form action="{{ route('cars.index') }}" method="GET" class="ajax-form">
                        {{-- Keep other active filters when submitting price --}}
                        @foreach(request()->except(['min_price', 'max_price', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <div class="flex items-center justify-between space-x-2 mb-4">
                            <div class="flex flex-col">
                                <label for="min-price" class="mb-1 text-sm text-gray-600 dark:text-gray-400">{{ __('cars_page.min_price') }}</label>
                                <input type="number" name="min_price" id="min-price" min="0" max="{{ $maxPriceInDb }}" 
                                       value="{{ request('min_price', $minPriceInDb) }}" 
                                       class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                            <div class="flex flex-col">
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

                {{-- 2. Brand Filter --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('cars_page.brand') }}</h3>
                        @if(request('brand_id'))
                            <a href="{{ route('cars.index', request()->except(['brand_id', 'page'])) }}" class="ajax-filter-link text-xs text-red-500 hover:underline">{{ __('cars_page.clear') }}</a>
                        @endif
                    </div>
                    <ul class="space-y-3">
                        @foreach($brands as $brand)
                        <li>
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
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('cars_page.categories') }}</h3>
                        @if(request('category'))
                            <a href="{{ route('cars.index', request()->except(['category', 'page'])) }}" class="ajax-filter-link text-xs text-red-500 hover:underline">{{ __('cars_page.clear') }}</a>
                        @endif
                    </div>
                    <ul class="space-y-3">
                        @foreach($categories as $cat)
                        <li>
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
                
                {{-- 4. Fuel Type Filter --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('cars_page.fuel_type') }}</h3>
                        @if(request('fuel_type'))
                            <a href="{{ route('cars.index', request()->except(['fuel_type', 'page'])) }}" class="ajax-filter-link text-xs text-red-500 hover:underline">{{ __('cars_page.clear') }}</a>
                        @endif
                    </div>
                    <ul class="space-y-3">
                        @foreach($fuelTypes as $type)
                        <li>
                            <a href="{{ route('cars.index', array_merge(request()->query(), ['fuel_type' => $type['name'], 'page' => 1])) }}" 
                               class="ajax-filter-link flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request('fuel_type') == $type['name'] ? 'bg-blue-50 dark:bg-gray-700 ring-2 ring-blue-300 dark:ring-blue-500' : '' }}">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $type['label'] }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $type['count'] }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- 5. Transmission Filter --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('cars_page.transmission') }}</h3>
                        @if(request('transmission'))
                            <a href="{{ route('cars.index', request()->except(['transmission', 'page'])) }}" class="ajax-filter-link text-xs text-red-500 hover:underline">{{ __('cars_page.clear') }}</a>
                        @endif
                    </div>
                    <ul class="space-y-3">
                        @foreach($transmissions as $trans)
                        <li>
                            <a href="{{ route('cars.index', array_merge(request()->query(), ['transmission' => $trans['name'], 'page' => 1])) }}" 
                               class="ajax-filter-link flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request('transmission') == $trans['name'] ? 'bg-blue-50 dark:bg-gray-700 ring-2 ring-blue-300 dark:ring-blue-500' : '' }}">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $trans['label'] }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $trans['count'] }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- 6. Number of Seats Filter --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('cars_page.seats') }}</h3>
                        @if(request('seats'))
                            <a href="{{ route('cars.index', request()->except(['seats', 'page'])) }}" class="ajax-filter-link text-xs text-red-500 hover:underline">{{ __('cars_page.clear') }}</a>
                        @endif
                    </div>
                    <ul class="space-y-3">
                        @foreach($seats as $seat)
                        <li>
                            <a href="{{ route('cars.index', array_merge(request()->query(), ['seats' => $seat['name'], 'page' => 1])) }}" 
                               class="ajax-filter-link flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request('seats') == $seat['name'] ? 'bg-blue-50 dark:bg-gray-700 ring-2 ring-blue-300 dark:ring-blue-500' : '' }}">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $seat['label'] }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $seat['count'] }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- 7. Number of Doors Filter (NEW) --}}
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('cars_page.doors') }}</h3>
                        @if(request('doors'))
                            <a href="{{ route('cars.index', request()->except(['doors', 'page'])) }}" class="ajax-filter-link text-xs text-red-500 hover:underline">{{ __('cars_page.clear') }}</a>
                        @endif
                    </div>
                    <ul class="space-y-3">
                        @foreach($doors as $door)
                        <li>
                            <a href="{{ route('cars.index', array_merge(request()->query(), ['doors' => $door['name'], 'page' => 1])) }}" 
                               class="ajax-filter-link flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request('doors') == $door['name'] ? 'bg-blue-50 dark:bg-gray-700 ring-2 ring-blue-300 dark:ring-blue-500' : '' }}">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $door['label'] }}</span>
                                <span class="text-xs font-medium text-gray-700 bg-gray-200 px-2 py-0.5 rounded-full dark:bg-gray-600 dark:text-gray-200">
                                    {{ $door['count'] }}
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

    {{-- =================================== --}}
    {{-- AJAX SCRIPT --}}
    {{-- =================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('car-list-container');

            // --- Datepicker Logic Setup ---
            const startDateEl = document.getElementById("search_start_date_cars");
            const endDateEl   = document.getElementById("search_end_date_cars");

            // Element References for hidden fields
            const hiddenPickup = document.getElementById("hidden_pickup_datetime_cars");
            const hiddenDropoff = document.getElementById("hidden_dropoff_datetime_cars");

            if (startDateEl && endDateEl) {
                const startDatePicker = new Datepicker(startDateEl, {
                    autohide: true,
                    format: 'yyyy-mm-dd',
                    minDate: '{{ date('Y-m-d') }}'
                });
                const endDatePicker = new Datepicker(endDateEl, {
                    autohide: true,
                    format: 'yyyy-mm-dd',
                    minDate: '{{ date('Y-m-d') }}'
                });

                const toDate = (str) => {
                    if (!str) return null;
                    const [y, m, d] = str.split("-").map(Number);
                    if (isNaN(y) || isNaN(m) || isNaN(d)) return null;
                    return new Date(y, m - 1, d);
                };

                const syncPickers = () => {
                    const startDate = toDate(startDateEl.value);
                    const endDate = toDate(endDateEl.value);

                    if (startDate) {
                        endDatePicker.setOptions({
                            minDate: startDateEl.value
                        });
                        if (endDate && endDate < startDate) {
                            endDatePicker.setDate(startDateEl.value);
                        }
                    }
                };

                startDateEl.addEventListener("changeDate", syncPickers);
                // Set initial state just in case of pre-filled values
                syncPickers(); 
            }
            // --- End of Datepicker Logic Setup ---


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

            function fetchCars(url) {
                const loadingOverlay = document.getElementById('loading-overlay');
                if (loadingOverlay) loadingOverlay.classList.remove('hidden');
                
                if (!url) return;

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    container.innerHTML = html;
                    window.history.pushState({}, '', url);
                    if (typeof initFlowbite === 'function') {
                        initFlowbite();
                    }
                    rebindPartialEvents(); 
                })
                .catch(error => console.error('Error fetching cars:', error))
                .finally(() => {
                    const newOverlay = document.getElementById('loading-overlay');
                    if (newOverlay) newOverlay.classList.add('hidden');
                });
            }

            document.addEventListener('click', function(e) {
                const link = e.target.closest('.ajax-filter-link');
                if (link) {
                    e.preventDefault();
                    fetchCars(link.href);
                }

                const pageLink = e.target.closest('#pagination-container a');
                if (pageLink) {
                    e.preventDefault();
                    fetchCars(pageLink.href);
                    container.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });

            document.addEventListener('submit', function(e) {
                if (e.target.classList.contains('ajax-form')) {
                    e.preventDefault();
                    const form = e.target;

                    // --- Populate hidden date fields before creating FormData ---
                    const formId = form.getAttribute('id');
                    if (formId === 'cars-search-form' && startDateEl && endDateEl && hiddenPickup && hiddenDropoff) {
                        if (startDateEl.value && endDateEl.value) {
                            // Combine date with default times (T00:00 and T23:59)
                            hiddenPickup.value = `${startDateEl.value}T00:00`;
                            hiddenDropoff.value = `${endDateEl.value}T23:59`;
                        } else {
                            // Clear hidden fields if visual date pickers are empty
                            hiddenPickup.value = '';
                            hiddenDropoff.value = '';
                        }
                    }
                    // --- End of date logic ---

                    const url = new URL(form.action);
                    const formData = new FormData(form);
                    
                    const currentParams = new URLSearchParams(window.location.search);
                    currentParams.forEach((value, key) => {
                        // Preserve existing params unless they are being overwritten by the current form
                        if (!formData.has(key)) {
                             url.searchParams.append(key, value);
                        }
                    });

                    formData.forEach((value, key) => {
                        // Remove datepicker inputs from query, rely on hidden fields
                        if (key === 'search_start_date_cars' || key === 'search_end_date_cars') {
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

            window.addEventListener('popstate', function() {
                fetchCars(window.location.href);
            });

            rebindPartialEvents();
        });
    </script>
</x-app-layout>