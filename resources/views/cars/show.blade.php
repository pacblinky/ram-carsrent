<x-app-layout>
    {{-- ADDED: PHP Logic to parse incoming request dates --}}
    @php
        $reqPickup = request('pickup_datetime');
        $reqDropoff = request('dropoff_datetime');
        $reqLocation = request('location_id');

        $startDateValue = '';
        $startTimeValue = '09:00'; // Default
        if ($reqPickup) {
            try {
                $c = \Carbon\Carbon::parse($reqPickup);
                $startDateValue = $c->format('Y-m-d');
                $startTimeValue = $c->format('H:i');
            } catch (\Exception $e) {}
        }

        $endDateValue = '';
        $endTimeValue = '17:00'; // Default
        if ($reqDropoff) {
            try {
                $c = \Carbon\Carbon::parse($reqDropoff);
                $endDateValue = $c->format('Y-m-d');
                $endTimeValue = $c->format('H:i');
            } catch (\Exception $e) {}
        }
    @endphp

    {{-- ... (Styles block remains the same) ... --}}
    <style>
        #slider-track {
            display: flex;
            height: 100%;
            transition: transform 0.7s ease-in-out; 
        }
        .slider-image {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            flex-shrink: 0; 
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .section-fade-in {
            animation: fadeIn 0.7s ease-out forwards;
            opacity: 0; 
        }
    </style>

    <div class="max-w-screen-xl mx-auto py-12 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
            
            {{-- ================= LEFT COLUMN: DETAILS & GALLERY ================= --}}
            <div class="lg:col-span-2">
                {{-- Header --}}
                <div class="mb-4 section-fade-in" style="animation-delay: 0.1s;">
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">{{ $car->name }}</h1>
                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        <a href="{{ $car->location->google_maps_link }}" target="_blank" class="ml-2 text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $car->location->name }}</a>
                    </div>
                </div>
    
                {{-- Slider (Structure remains the same) --}}
                <div id="gallery" class="relative w-full section-fade-in" style="animation-delay: 0.2s;">
                    <div class="relative h-64 sm:h-96 lg:h-[500px] overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800">
                        @if(count($thumbnails) > 0)
                            {{-- Added touch-action-pan-y to allow scrolling page but catch horizontal swipes --}}
                            <div id="slider-track" style="touch-action: pan-y;">
                                @foreach($thumbnails as $index => $thumb)
                                    <img src="{{ $thumb }}" class="slider-image" alt="Car image {{ $index + 1 }}">
                                @endforeach
                            </div>

                            @if(count($thumbnails) > 1)
                                <button id="prev-btn" type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-white dark:text-gray-300 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                        </svg>
                                        <span class="sr-only">Previous</span>
                                    </span>
                                </button>
                                <button id="next-btn" type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-white dark:text-gray-300 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                        </svg>
                                        <span class="sr-only">Next</span>
                                    </span>
                                </button>
                            @endif
                        @else
                            <div class="flex items-center justify-center h-full bg-gray-100 dark:bg-gray-700 rounded-lg">
                                <img src="{{ asset('images/logo.png') }}" class="w-1/2 h-1/2 object-contain opacity-50" alt="Default car image">
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Thumbnails --}}
                @if(count($thumbnails) > 1)
                <div class="grid grid-cols-6 gap-2 mt-2 section-fade-in" style="animation-delay: 0.3s;">
                    @foreach($thumbnails as $index => $thumb)
                        <button class="thumb-btn rounded-lg overflow-hidden border-2 border-transparent hover:border-blue-500 focus:border-blue-500" data-src="{{ $thumb }}">
                            <img src="{{ $thumb }}" class="h-16 w-full object-cover" alt="Car thumbnail {{ $index + 1 }}">
                        </button>
                    @endforeach
                </div>
                @endif
    
                {{-- Features Section (Unchanged) --}}
                <div class="section-fade-in" style="animation-delay: 0.4s;">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4">{{ __('cars_page.vehicle_features') }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($specs as $spec)
                        <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            @if($spec['icon'] == 'electric' || $spec['icon'] == 'fuel')
                                <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                            @elseif($spec['icon'] == 'manual' || $spec['icon'] == 'auto' || $spec['icon'] == 'transmission')
                                 <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527c.477-.34.994-.142 1.246.317l.545 1.03c.25.46.07.994-.317 1.246l-.527.737c-.25.35-.272.806-.108 1.204.165.397.505.71.93.78l.893.15c.542.09.94.56.94 1.11v1.093c0 .55-.398 1.02-.94 1.11l-.893.149c-.425.07-.764.384-.93.78-.164.398-.142.855.108 1.205l.527.737c.34.477.142.994-.317 1.246l1.03-.545c.46-.25.994-.07 1.246.317l.737.527c.35.25.806.272 1.204.108.397-.165.71-.505.78-.93l.15-.893zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" /></svg>
                            @elseif($spec['icon'] == 'seats' || $spec['icon'] == 'doors')
                                <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A1.5 1.5 0 0118 21.75H6a1.5 1.5 0 01-1.499-1.632z" /></svg>
                            @else
                                <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            @endif
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $spec['text'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Description (Unchanged) --}}
                @php
                $locale = App::getLocale(); 
                $displayDescription = $car->description[$locale] ?? $car->description['en'] ?? null;
                @endphp

                @if($displayDescription)
                <div class="section-fade-in" style="animation-delay: 0.5s;">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4">
                        {{ __('cars_page.vehicle_description') }}
                    </h2>
                    <div class="w-full pt-0 px-6 pb-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">
                            {{ trim($displayDescription) }}
                        </p>
                    </div>
                </div>
                @endif
            </div>
    
            {{-- ================= RIGHT COLUMN: BOOKING FORM ================= --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 section-fade-in" style="animation-delay: 0.3s;">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-5">{{ __('cars_page.rent_this_vehicle') }}</h2>
                    
                    {{-- --- Timezone Notification --- --}}
                    @php
                        // Parse server time to display comfortably
                        $displayTime = \Carbon\Carbon::parse($serverTime);
                        $tzName = config('app.timezone'); // e.g., "Africa/Cairo"
                        $city = last(explode('/', $tzName)); // e.g., "Cairo"
                    @endphp
                    <div class="flex items-center gap-2 mb-6 p-3 text-sm text-blue-800 border border-blue-200 rounded-lg bg-blue-50 dark:bg-gray-700 dark:text-blue-300 dark:border-blue-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div>
                            <span class="font-medium">{{ __('cars_page.booking_timezone_title', ['city' => $city] ) ?? "Bookings are in $city Time" }}:</span>
                            <span class="font-bold">{{ $displayTime->format('h:i A') }}</span>
                        </div>
                    </div>
                    
                    <form action="{{ route('reservations.store', $car->id) }}" method="POST" class="space-y-4">
                        @csrf
                        {{-- Pick-Up Date --}}
                        <div>
                            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('cars_page.pickup_date') }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4Zm-1 14H3V8h16v10Z"/></svg>
                                </div>
                                <input type="text" id="start_date" name="start_date" 
                                       value="{{ $startDateValue }}" 
                                       datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" datepicker-min-date="{{ date('Y-m-d') }}" readonly 
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                       placeholder="{{ __('cars_page.select_date') }}" required>
                            </div>
                        </div>
                        {{-- Drop-Off Date --}}
                        <div>
                            <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('cars_page.dropoff_date') }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4Zm-1 14H3V8h16v10Z"/></svg>
                                </div>
                                <input type="text" id="end_date" name="end_date" 
                                       value="{{ $endDateValue }}"
                                       datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" datepicker-min-date="{{ date('Y-m-d') }}" readonly 
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                       placeholder="{{ __('cars_page.select_date') }}" required>
                            </div>
                        </div>
                        {{-- Start Time --}}
                        <div>
                            <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.start_time') }}</label>
                            <select id="start_time" name="start_time" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"></select>
                        </div>
                        {{-- End Time --}}
                        <div>
                            <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.end_time') }}</label>
                            <select id="end_time" name="end_time" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"></select>
                        </div>
                        {{-- Driver --}}
                        @if($car->driver_price_per_day > 0)
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="with_driver" name="with_driver" type="checkbox" value="1" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                            </div>
                            <div class="ms-3 text-sm">
                                <label for="with_driver" class="font-medium text-gray-900 dark:text-gray-300">
                                    {{ __('cars_page.with_driver') }}
                                    <span class="text-gray-500 dark:text-gray-400 text-xs">(+ <img src="{{ asset('images/currency.png') }}" style="width: 10px; display: inline-block;" class="dark:invert"> {{ number_format($car->driver_price_per_day, 0) }} {{ __('cars_page.per_day') }})</span>
                                </label>
                            </div>
                        </div>
                        @endif
                        {{-- Pickup Location --}}
                        <div>
                            <label for="pickup_location_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.booking_pickup_location') }}</label>
                            <select id="pickup_location_id" name="pickup_location_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white truncate">
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" 
                                        {{ ($reqLocation == $loc->id) ? 'selected' : ($car->location_id == $loc->id ? 'selected' : '') }}>
                                        {{ \Illuminate\Support\Str::limit($loc->name, 100) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Dropoff Location --}}
                        <div>
                            <label for="dropoff_location_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.booking_dropoff_location') }}</label>
                            <select id="dropoff_location_id" name="dropoff_location_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white truncate">
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" 
                                        {{ ($reqLocation == $loc->id) ? 'selected' : ($car->location_id == $loc->id ? 'selected' : '') }}>
                                        {{ \Illuminate\Support\Str::limit($loc->name, 100) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Price --}}
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium text-gray-900 dark:text-white">{{ __('cars_page.total') }}</span>
                                <div class="text-right">
                                    <img src="{{ asset('images/currency.png') }}" style="width: 15px; display: inline-block;" class="dark:invert"> <span id="total_price" class="dark:text-white">0</span>
                                </div>
                            </div>
                            <div id="price_breakdown" class="text-sm text-gray-500 dark:text-gray-400 mt-1 text-right"></div>
                        </div>
                        {{-- Terms --}}
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms_agree" name="terms_agree" type="checkbox" value="1" required class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                            </div>
                            <div class="ms-3 text-sm">
                                <label for="terms_agree" class="font-medium text-gray-900 dark:text-gray-300">{{ __('cars_page.pay_on_pickup') }}</label>
                                <p class="text-xs font-normal text-gray-500 dark:text-gray-400">{{ __('cars_page.pay_on_pickup_desc') }}</p>
                            </div>
                        </div>
                        {{-- Button --}}
                        <button type="submit" id="book-now-button" disabled class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 ease-in-out">{{ __('cars_page.book_now') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    {{-- JS Translations --}}
    <script>
        const translations = {
            past: "{{ __('cars_page.js_past') }}",
            booked: "{{ __('cars_page.js_booked') }}",
            days: "{{ __('cars_page.js_days') }}"
        };
    </script>
    
    {{-- Booking Script (Already has Timezone Logic) --}}
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const unavailable = @json($unavailable ?? []);
        const pricePerDay = {{ $car->price_per_day ?? 0 }};
        const driverPricePerDay = {{ $car->driver_price_per_day ?? 0 }};
        const serverNowString = "{{ $serverTime }}"; 
        
        // ADDED: Pre-selected times from PHP
        const preselectedStartTime = "{{ $startTimeValue }}";
        const preselectedEndTime = "{{ $endTimeValue }}";
        
        const getBusinessNow = () => {
             const d = new Date(serverNowString.replace(/-/g, "/")); 
             return d;
        };

        const startDate = document.getElementById("start_date");
        const endDate   = document.getElementById("end_date");
        const startTime = document.getElementById("start_time");
        const endTime   = document.getElementById("end_time");
        const driverCheckbox = document.getElementById("with_driver");
        const totalPriceEl = document.getElementById("total_price");
        const breakdownEl  = document.getElementById("price_breakdown");
        const currencySymbol = '<img src="{{ asset('images/currency.png') }}" style="width: 12px; display: inline-block; vertical-align: baseline;" class="dark:invert">';
        const termsCheckbox = document.getElementById("terms_agree");
        const bookNowButton = document.getElementById("book-now-button");

        let isDateSelectionValid = false;

        const updateBookButtonState = () => {
            if (isDateSelectionValid && termsCheckbox.checked) {
                bookNowButton.disabled = false;
            } else {
                bookNowButton.disabled = true;
            }
        };
    
        // UPDATED: Accept a default time
        const generateTimes = (select, defaultTime) => {
            select.innerHTML = "";
            for (let h = 0; h < 24; h++) {
                for (let m of [0,30]) {
                    const value = `${String(h).padStart(2,"0")}:${m === 0 ? "00" : "30"}`;
                    let h12 = h % 12;
                    if (h12 === 0) h12 = 12;
                    const ampm = h >= 12 ? 'PM' : 'AM';
                    const text = `\u202A${String(h12).padStart(2,"0")}:${m === 0 ? "00" : "30"} ${ampm}\u202C`;
                    select.append(new Option(text, value));
                }
            }
            select.value = defaultTime || "10:00";
        };
    
        generateTimes(startTime, preselectedStartTime);
        generateTimes(endTime, preselectedEndTime);
    
        const toLocalDate = (str) => {
            if (!str) return null;
            const [date, time] = str.split(" ");
            if (!date || !time) return null; 
            const [y, m, d] = date.split("-").map(Number);
            const [hh, mm] = time.split(":").map(Number);
            return new Date(y, m - 1, d, hh, mm, 0, 0);
        };
    
        const blocks = unavailable.map(r => ({
            start: toLocalDate(r.start),
            end:   toLocalDate(r.end),
        })).filter(b => b.start && b.end); 
    
        const isBlocked = dt => {
            if (!dt) return false;
            const t = dt.getTime();
            return blocks.some(b => t >= b.start.getTime() && t < b.end.getTime());
        };

        const isRangeBlocked = (start, end) => {
            if (!start || !end) return false;
            const s = start.getTime();
            const e = end.getTime();
            return blocks.some(b => s < b.end.getTime() && e > b.start.getTime());
        };
    
        const updateTimeOptions = (dateInput, timeSelect) => {
            const dateVal = dateInput.value;
            if (!dateVal) return;
    
            const now = getBusinessNow();
            now.setSeconds(0, 0); 
            
            let firstValidValue = null;
            let hasSelectedValidOption = false;

            [...timeSelect.options].forEach(opt => {
                const dt = toLocalDate(`${dateVal} ${opt.value}`);
                if (!dt) {
                    opt.disabled = true;
                    return;
                }
                
                const isPast = dt < now;
                const blocked = isBlocked(dt);
                const isDisabled = isPast || blocked;
                
                opt.disabled = isDisabled;

                if (!isDisabled && firstValidValue === null) {
                    firstValidValue = opt.value;
                }
                
                if (opt.selected && !isDisabled) {
                    hasSelectedValidOption = true;
                }
    
                const [hStr, mStr] = opt.value.split(':');
                let h = parseInt(hStr, 10);
                let h12 = h % 12;
                if (h12 === 0) h12 = 12;
                const ampm = h >= 12 ? 'PM' : 'AM';
                const time12 = `\u202A${String(h12).padStart(2,"0")}:${mStr} ${ampm}\u202C`;

                opt.textContent = time12; 

                if (isPast) {
                    opt.textContent += ` ${translations.past}`;
                    opt.classList.add('text-gray-400');
                } else if (blocked) {
                    opt.textContent += ` ${translations.booked}`;
                    opt.classList.add('text-red-400');
                } else {
                    opt.classList.remove('text-gray-400', 'text-red-400');
                }
            });

            if (!hasSelectedValidOption && firstValidValue !== null) {
                timeSelect.value = firstValidValue;
            }
        };
    
        const ensureEndAfterStart = () => {
            if (!startDate.value || !startTime.value) return;
            const start = toLocalDate(`${startDate.value} ${startTime.value}`);
            if (!start) return; 
            
            let end = null;
            if (endDate.value && endTime.value) {
                end = toLocalDate(`${endDate.value} ${endTime.value}`);
            }
    
            if (!end || end <= start) {
                 const newEndObj = new Date(start.getTime() + 60 * 60 * 1000); 
                 const y = newEndObj.getFullYear();
                 const m = String(newEndObj.getMonth() + 1).padStart(2, '0');
                 const d = String(newEndObj.getDate()).padStart(2, '0');
                 const newDateStr = `${y}-${m}-${d}`;
                 const newHH = String(newEndObj.getHours()).padStart(2, '0');
                 const newMM = newEndObj.getMinutes() >= 30 ? "30" : "00";
                 const newTimeStr = `${newHH}:${newMM}`;
                 
                 endDate.value = newDateStr;
                 endTime.value = newTimeStr;
                 updateTimeOptions(endDate, endTime);
            }
        };
    
        const calculatePrice = () => {
            const sd = startDate.value;
            const st = startTime.value;
            const ed = endDate.value;
            const et = endTime.value;
    
            if (!sd || !st || !ed || !et) {
                totalPriceEl.textContent = "0";
                if (breakdownEl) breakdownEl.textContent = "";
                isDateSelectionValid = false;
                updateBookButtonState();
                return;
            }
    
            const start = toLocalDate(`${sd} ${st}`);
            const end   = toLocalDate(`${ed} ${et}`);
            const now = getBusinessNow();
            now.setSeconds(0, 0); 

            if (start < now) {
                totalPriceEl.textContent = "0";
                if (breakdownEl) breakdownEl.textContent = "";
                isDateSelectionValid = false;
                updateBookButtonState();
                return;
            }
    
            if (!start || !end || end <= start) {
                totalPriceEl.textContent = "0";
                if (breakdownEl) breakdownEl.textContent = "";
                isDateSelectionValid = false;
                updateBookButtonState();
                return;
            }

            if (isRangeBlocked(start, end)) {
                totalPriceEl.textContent = "0";
                if (breakdownEl) {
                    breakdownEl.innerHTML = `<span class="text-red-600 font-medium">${translations.booked}</span>`; 
                }
                isDateSelectionValid = false;
                updateBookButtonState();
                return;
            }
    
            const diffMin = (end - start) / (1000 * 60);
            const daysExact = diffMin / 1440;
            const billableDays = Math.max(1, Math.ceil(daysExact));
            const withDriver = driverCheckbox && driverCheckbox.checked;
            const dailyRate = pricePerDay + (withDriver ? driverPricePerDay : 0);
            const total = billableDays * dailyRate;
    
            totalPriceEl.textContent = total.toLocaleString('en-US', {minimumFractionDigits: 0});
            if (breakdownEl) {
                let breakdownText = `${billableDays} ${translations.days} × ${currencySymbol} ${pricePerDay.toLocaleString()}`;
                if(withDriver) {
                    breakdownText += ` + (${currencySymbol} ${driverPricePerDay.toLocaleString()} driver)`;
                }
                breakdownText += ` = <strong>${currencySymbol} ${total.toLocaleString()}</strong>`;
                breakdownEl.innerHTML = breakdownText;
            }
            isDateSelectionValid = true;
            updateBookButtonState();
        };
    
        termsCheckbox.addEventListener('change', updateBookButtonState);
    
        const handleStartDateChange = (e) => {
             endDate.setAttribute('datepicker-min-date', e.target.value);
             updateTimeOptions(startDate, startTime);
             ensureEndAfterStart();
             calculatePrice();
        };
        const handleEndDateChange = (e) => {
             updateTimeOptions(endDate, endTime);
             ensureEndAfterStart();
             calculatePrice();
        };
    
        startDate.addEventListener("change", handleStartDateChange);
        startDate.addEventListener("changeDate", handleStartDateChange);
        endDate.addEventListener("change", handleEndDateChange);
        endDate.addEventListener("changeDate", handleEndDateChange);
        startTime.addEventListener("change", () => { ensureEndAfterStart(); calculatePrice(); });
        endTime.addEventListener("change", () => { ensureEndAfterStart(); calculatePrice(); });
        if(driverCheckbox) { driverCheckbox.addEventListener("change", calculatePrice); }
    
        updateTimeOptions(startDate, startTime);
        updateTimeOptions(endDate, endTime);
        calculatePrice();
    });
    </script>

    {{-- Slider Script with SWIPE Support --}}
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const sliderTrack = document.getElementById("slider-track");
        const thumbs = document.querySelectorAll(".thumb-btn");
        const prevBtn = document.getElementById("prev-btn");
        const nextBtn = document.getElementById("next-btn");
        const gallery = document.getElementById("gallery");
        
        let autoSlideInterval = null; 

        if (sliderTrack && thumbs.length > 0) {
            const totalImages = thumbs.length;
            let currentIndex = 0;

            const updateGallery = (index) => {
                if (index < 0 || index >= totalImages) return; 
                currentIndex = index;

                const isRTL = document.documentElement.dir === 'rtl';
                const multiplier = isRTL ? 1 : -1;
                const offset = multiplier * currentIndex * 100;
                sliderTrack.style.transform = `translateX(${offset}%)`;

                thumbs.forEach((btn, i) => {
                    if (i === currentIndex) {
                        btn.classList.add("border-blue-500");
                    } else {
                        btn.classList.remove("border-blue-500");
                    }
                });
            };

            const stopAutoSlide = () => { clearInterval(autoSlideInterval); };

            const startAutoSlide = () => {
                stopAutoSlide(); 
                if (totalImages <= 1) return; 
                autoSlideInterval = setInterval(() => {
                    const newIndex = (currentIndex + 1) % totalImages;
                    updateGallery(newIndex);
                }, 2000); 
            };

            thumbs.forEach((btn, index) => {
                btn.addEventListener("click", () => {
                    updateGallery(index);
                    startAutoSlide(); 
                });
            });

            if (prevBtn && nextBtn && totalImages > 1) {
                prevBtn.addEventListener("click", () => {
                    const newIndex = (currentIndex - 1 + totalImages) % totalImages;
                    updateGallery(newIndex);
                    startAutoSlide(); 
                });
                nextBtn.addEventListener("click", () => {
                    const newIndex = (currentIndex + 1) % totalImages;
                    updateGallery(newIndex);
                    startAutoSlide(); 
                });
            }

            // --- NEW: SWIPE SUPPORT ---
            let touchStartX = 0;
            let touchEndX = 0;

            sliderTrack.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
                stopAutoSlide(); // Pause while user is touching
            }, {passive: true});

            sliderTrack.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
                startAutoSlide(); // Resume after touch
            }, {passive: true});

            const handleSwipe = () => {
                const threshold = 50; // Minimum distance to be considered a swipe
                const isRTL = document.documentElement.dir === 'rtl';
                
                if (touchEndX < touchStartX - threshold) {
                    // Swiped LEFT
                    // In LTR: Next image. In RTL: Previous image.
                    if (isRTL) {
                        const newIndex = (currentIndex - 1 + totalImages) % totalImages;
                        updateGallery(newIndex);
                    } else {
                        const newIndex = (currentIndex + 1) % totalImages;
                        updateGallery(newIndex);
                    }
                }
                
                if (touchEndX > touchStartX + threshold) {
                    // Swiped RIGHT
                    // In LTR: Prev image. In RTL: Next image.
                    if (isRTL) {
                        const newIndex = (currentIndex + 1) % totalImages;
                        updateGallery(newIndex);
                    } else {
                        const newIndex = (currentIndex - 1 + totalImages) % totalImages;
                        updateGallery(newIndex);
                    }
                }
            }
            // --------------------------

            if(thumbs[0]) { thumbs[0].classList.add("border-blue-500"); }
            startAutoSlide();
            
            if (gallery) {
                gallery.addEventListener('mouseenter', stopAutoSlide);
                gallery.addEventListener('mouseleave', startAutoSlide);
            }
        }
    });
    </script>
</x-app-layout>