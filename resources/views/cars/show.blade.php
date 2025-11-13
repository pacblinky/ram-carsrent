<x-app-layout>
    {{-- ========================================================== --}}
    {{--                 NEW ANIMATION STYLE BLOCK                --}}
    {{-- ========================================================== --}}
    <style>
        /* This ensures the slider track (all images) is in one line
          and the transition is handled by CSS for max performance.
        */
        #slider-track {
            display: flex;
            height: 100%;
            transition: transform 0.7s ease-in-out; /* This is the "beautiful" animation */
        }
        .slider-image {
            width: 100%;
            height: 100%;
            object-cover: cover;
            flex-shrink: 0; /* Prevents images from shrinking */
        }

        /* ========================================================== */
        /* NEW FADE-IN ANIMATION                */
        /* ========================================================== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px); /* A slight "up" motion */
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Base class to apply the animation */
        .section-fade-in {
            animation: fadeIn 0.7s ease-out forwards;
            opacity: 0; /* Start hidden, animation will make it visible */
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
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        <a href="{{ $car->location->google_maps_link }}" target="_blank" class="ml-2 text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $car->location->name }}</a>
                    </div>
                </div>
    
                {{-- ========================================================== --}}
                {{--            ANIMATED GALLERY SECTION (RTL FIXED)            --}}
                {{-- ========================================================== --}}
                <div id="gallery" class="relative w-full section-fade-in" style="animation-delay: 0.2s;">
                    <div class="relative h-96 overflow-hidden rounded-lg">
                        @if(count($thumbnails) > 0)
                            
                            <div id="slider-track">
                                @foreach($thumbnails as $index => $thumb)
                                    <img src="{{ $thumb }}" class="slider-image" alt="Car image {{ $index + 1 }}">
                                @endforeach
                            </div>

                            @if(count($thumbnails) > 1)
                                {{-- PREV BUTTON: Changed left-0 to start-0 and added rtl:rotate-180 to SVG --}}
                                <button id="prev-btn" type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-white dark:text-gray-300 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                        </svg>
                                        <span class="sr-only">Previous</span>
                                    </span>
                                </button>
                                
                                {{-- NEXT BUTTON: Changed right-0 to end-0 and added rtl:rotate-180 to SVG --}}
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
                            {{-- Fallback --}}
                            <div class="flex items-center justify-center h-full bg-gray-100 dark:bg-gray-700 rounded-lg">
                                <img src="{{ asset('images/logo.png') }}" class="w-1/2 h-1/2 object-contain opacity-50" alt="Default car image">
                            </div>
                        @endif
                    </div>
                </div>
                {{-- ========================================================== --}}
                {{--                END MODIFIED GALLERY SECTION                --}}
                {{-- ========================================================== --}}


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
    
                {{-- Features --}}
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
                                <input
                                    type="text"
                                    id="start_date"
                                    name="start_date"
                                    datepicker
                                    datepicker-autohide
                                    datepicker-format="yyyy-mm-dd"
                                    datepicker-min-date="{{ date('Y-m-d') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                        focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5
                                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="{{ __('cars_page.select_date') }}"
                                    required>
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
                                <input
                                    type="text"
                                    id="end_date"
                                    name="end_date"
                                    datepicker
                                    datepicker-autohide
                                    datepicker-format="yyyy-mm-dd"
                                    datepicker-min-date="{{ date('Y-m-d') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                        focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5
                                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="{{ __('cars_page.select_date') }}"
                                    required>
                            </div>
                        </div>
    
                        {{-- Start Time --}}
                        <div>
                            <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('cars_page.start_time') }}
                            </label>
                            <select id="start_time" name="start_time" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </select>
                        </div>
    
                        {{-- End Time --}}
                        <div>
                            <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('cars_page.end_time') }}
                            </label>
                            <select id="end_time" name="end_time" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </select>
                        </div>
    
                        {{-- Pickup Location --}}
                        <div>
                            <label for="pickup_location_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('cars_page.booking_pickup_location') }}
                            </label>
                            <select id="pickup_location_id" name="pickup_location_id" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white truncate">
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ $car->location_id == $loc->id ? 'selected' : '' }}>
                                        {{ \Illuminate\Support\Str::limit($loc->name, 45) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
    
                        {{-- Dropoff Location --}}
                        <div>
                            <label for="dropoff_location_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('cars_page.booking_dropoff_location') }}
                            </label>
                            <select id="dropoff_location_id" name="dropoff_location_id" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white truncate">
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ $car->location_id == $loc->id ? 'selected' : '' }}>
                                        {{ \Illuminate\Support\Str::limit($loc->name, 45) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
    
                        {{-- Total Price Display --}}
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-lg font-medium text-gray-900 dark:text-white">{{ __('cars_page.total') }}</span>
                                </div>
                                <div class="text-right">
                                    <img src="{{ asset('images/currency.png') }}" style="width: 15px; display: inline-block; vertical-align: baseline;" class="dark:invert"> <span id="total_price" class="dark:text-white">0</span>
                                </div>
                            </div>
                            <div id="price_breakdown" class="text-sm text-gray-500 dark:text-gray-400 mt-1 text-right"></div>
                        </div>
    
                        {{-- Terms Checkbox --}}
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms_agree" name="terms_agree" type="checkbox" value="1" required
                                       class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                            </div>
                            <div class="ms-3 text-sm">
                                <label for="terms_agree" class="font-medium text-gray-900 dark:text-gray-300">{{ __('cars_page.pay_on_pickup') }}</label>
                                <p class="text-xs font-normal text-gray-500 dark:text-gray-400">{{ __('cars_page.pay_on_pickup_desc') }}</p>
                            </div>
                        </div>
                        
                        {{-- Updated Book Now Button --}}
                        <button type="submit"
                                id="book-now-button"
                                disabled {{-- Button is disabled by default --}}
                                class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300
                                   font-medium rounded-lg text-sm px-5 py-3 text-center
                                   dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800
                                   disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 ease-in-out">
                            {{ __('cars_page.book_now') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    {{-- ================= JAVASCRIPT ================= --}}
    
    {{-- Script block to pass translations to JavaScript --}}
    <script>
        const translations = {
            past: "{{ __('cars_page.js_past') }}",
            booked: "{{ __('cars_page.js_booked') }}",
            days: "{{ __('cars_page.js_days') }}"
        };
    </script>
    
    {{-- ========================================================== --}}
    {{--                BOOKING FORM SCRIPT (UNCHANGED)             --}}
    {{-- ========================================================== --}}
    <script>
    document.addEventListener("DOMContentLoaded", () => {
    
        // Data passed from Backend
        const unavailable = @json($unavailable ?? []);
        const pricePerDay = {{ $car->price_per_day ?? 0 }};
    
        // Element References
        const startDate = document.getElementById("start_date");
        const endDate   = document.getElementById("end_date");
        const startTime = document.getElementById("start_time");
        const endTime   = document.getElementById("end_time");
        const totalPriceEl = document.getElementById("total_price");
        const breakdownEl  = document.getElementById("price_breakdown");
        const currencySymbol = '<img src="{{ asset('images/currency.png') }}" style="width: 12px; display: inline-block; vertical-align: baseline;" class="dark:invert">';
    
        // --- Checkbox and Button elements ---
        const termsCheckbox = document.getElementById("terms_agree");
        const bookNowButton = document.getElementById("book-now-button");
    
        // 1. Generate 30-minute time intervals for select boxes
        const generateTimes = (select) => {
            select.innerHTML = "";
            for (let h = 0; h < 24; h++) {
                for (let m of [0,30]) {
                    const value = `${String(h).padStart(2,"0")}:${m === 0 ? "00" : "30"}`;
                    
                    // Convert to 12-hour format for display
                    let h12 = h % 12;
                    if (h12 === 0) h12 = 12;
                    const ampm = h >= 12 ? 'PM' : 'AM';
                    const text = `${String(h12).padStart(2,"0")}:${m === 0 ? "00" : "30"} ${ampm}`;
                    
                    // Value remains 24h for logic, Text is 12h for user
                    select.append(new Option(text, value));
                }
            }
            select.value = "10:00";
        };
    
        generateTimes(startTime);
        generateTimes(endTime);
    
        // Helper: Convert "Y-m-d H:i" string into a local Date object
        const toLocalDate = (str) => {
            if (!str) return null;
            const [date, time] = str.split(" ");
            if (!date || !time) return null; 
            const [y, m, d] = date.split("-").map(Number);
            const [hh, mm] = time.split(":").map(Number);
            return new Date(y, m - 1, d, hh, mm, 0, 0);
        };
    
        // Parse unavailable blocks once
        const blocks = unavailable.map(r => ({
            start: toLocalDate(r.start),
            end:   toLocalDate(r.end),
        })).filter(b => b.start && b.end); 
    
        // Check if a specific datetime is inside a- booked block
        const isBlocked = dt => {
            if (!dt) return false;
            const t = dt.getTime();
            // We check if 't' is *inside* a block, so StartBlock <= t < EndBlock
            return blocks.some(b => t >= b.start.getTime() && t < b.end.getTime());
        };
    
        // 2. Update available times based on selected date
        const updateTimeOptions = (dateInput, timeSelect) => {
            const dateVal = dateInput.value;
            if (!dateVal) return;
    
            const now = new Date();
            now.setSeconds(0, 0); 
    
            [...timeSelect.options].forEach(opt => {
                const dt = toLocalDate(`${dateVal} ${opt.value}`);
                if (!dt) {
                    opt.disabled = true;
                    return;
                }
                
                const isPast = dt < now;
                const blocked = isBlocked(dt);
                
                opt.disabled = isPast || blocked;
    
                // Re-generate 12-hour text since we might have appended status text previously
                // or need to refresh it
                const [hStr, mStr] = opt.value.split(':');
                let h = parseInt(hStr, 10);
                let h12 = h % 12;
                if (h12 === 0) h12 = 12;
                const ampm = h >= 12 ? 'PM' : 'AM';
                const time12 = `${String(h12).padStart(2,"0")}:${mStr} ${ampm}`;

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
        };
    
        // 3. Ensure End Date/Time is logically after Start Date/Time
        const ensureEndAfterStart = () => {
            if (!startDate.value || !startTime.value) return;
    
            const start = toLocalDate(`${startDate.value} ${startTime.value}`);
            if (!start) return; 
            
            if (!endDate.value) {
                 endDate.value = startDate.value;
            }
            
            let end = toLocalDate(`${endDate.value} ${endTime.value}`);
    
            if (!end || end <= start) {
                 endDate.value = startDate.value;
                 
                 const newEndTime = new Date(start.getTime() + 60 * 60 * 1000); 
                 const newHH = String(newEndTime.getHours()).padStart(2, '0');
                 const newMM = newEndTime.getMinutes() >= 30 ? "30" : "00";
                 
                 endTime.value = `${newHH}:${newMM}`;
                 
                 updateTimeOptions(endDate, endTime);
            }
        };
    
        // 4. Calculate and display total price
        const calculatePrice = () => {
            const sd = startDate.value;
            const st = startTime.value;
            const ed = endDate.value;
            const et = endTime.value;
    
            if (!sd || !st || !ed || !et) {
                totalPriceEl.textContent = "0";
                if (breakdownEl) breakdownEl.textContent = "";
                return;
            }
    
            const start = toLocalDate(`${sd} ${st}`);
            const end   = toLocalDate(`${ed} ${et}`);
    
            if (!start || !end || end <= start) {
                totalPriceEl.textContent = "0";
                if (breakdownEl) breakdownEl.textContent = "";
                return;
            }
    
            const diffMin = (end - start) / (1000 * 60);
            const daysExact = diffMin / 1440;
            const billableDays = Math.max(1, Math.ceil(daysExact));
            const total = billableDays * pricePerDay;
    
            totalPriceEl.textContent = total.toLocaleString('en-US', {minimumFractionDigits: 0});
    
            if (breakdownEl) {
                breakdownEl.innerHTML = `
                    ${billableDays} ${translations.days} × ${currencySymbol} ${pricePerDay.toLocaleString()} =
                    <strong>${currencySymbol} ${total.toLocaleString()}</strong>
                `;
            }
        };
    
        // ================= EVENT LISTENERS =================
        
        // Checkbox listener to enable/disable button
        termsCheckbox.addEventListener('change', function() {
            bookNowButton.disabled = !this.checked;
        });
    
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
    
        startTime.addEventListener("change", () => {
            ensureEndAfterStart();
            calculatePrice();
        });
    
        endTime.addEventListener("change", () => {
            ensureEndAfterStart();
            calculatePrice();
        });
    
        // Initial runs on page load
        updateTimeOptions(startDate, startTime);
        updateTimeOptions(endDate, endTime);
        calculatePrice();
    });
    </script>

    {{-- ========================================================== --}}
    {{--          ANIMATED SLIDER SCRIPT (MODIFIED)                 --}}
    {{-- ========================================================== --}}
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        // --- NEW: Get the slider track ---
        const sliderTrack = document.getElementById("slider-track");
        
        const thumbs = document.querySelectorAll(".thumb-btn");
        const prevBtn = document.getElementById("prev-btn");
        const nextBtn = document.getElementById("next-btn");
        const gallery = document.getElementById("gallery"); // Get gallery container
        
        let autoSlideInterval = null; // To store the interval

        // --- NEW: Check if slider track exists ---
        if (sliderTrack && thumbs.length > 0) {
            
            const totalImages = thumbs.length;
            let currentIndex = 0;

            // --- NEW: Rewritten updateGallery for horizontal slide ---
            // --- NEW: Rewritten updateGallery for horizontal slide ---
            const updateGallery = (index) => {
                if (index < 0 || index >= totalImages) return; 
                
                currentIndex = index;

                // --- FIX: Check if the document direction is RTL (Right-to-Left) ---
                const isRTL = document.documentElement.dir === 'rtl';
                const multiplier = isRTL ? 1 : -1;

                const offset = multiplier * currentIndex * 100;
                
                // The animation is handled by the CSS transition!
                sliderTrack.style.transform = `translateX(${offset}%)`;

                // 3. Update active thumbnail border
                thumbs.forEach((btn, i) => {
                    if (i === currentIndex) {
                        btn.classList.add("border-blue-500");
                    } else {
                        btn.classList.remove("border-blue-500");
                    }
                });
            };

            // --- Functions to start/stop the timer (no change) ---
            const stopAutoSlide = () => {
                clearInterval(autoSlideInterval);
            };

            const startAutoSlide = () => {
                stopAutoSlide(); // Clear any existing interval first
                if (totalImages <= 1) return; // Don't slide if only one image
                
                autoSlideInterval = setInterval(() => {
                    const newIndex = (currentIndex + 1) % totalImages;
                    updateGallery(newIndex);
                }, 2000); // 2000 milliseconds = 2 seconds
            };


            // --- Event listeners (no change, they just work) ---
            thumbs.forEach((btn, index) => {
                btn.addEventListener("click", () => {
                    updateGallery(index);
                    startAutoSlide(); // Reset timer on click
                });
            });

            if (prevBtn && nextBtn && totalImages > 1) {
                prevBtn.addEventListener("click", () => {
                    const newIndex = (currentIndex - 1 + totalImages) % totalImages;
                    updateGallery(newIndex);
                    startAutoSlide(); // Reset timer on click
                });

                nextBtn.addEventListener("click", () => {
                    const newIndex = (currentIndex + 1) % totalImages;
                    updateGallery(newIndex);
                    startAutoSlide(); // Reset timer on click
                });
            }

            // Set the initial active thumbnail on load
            if(thumbs[0]) {
                thumbs[0].classList.add("border-blue-500");
            }
            
            // Start the auto-slide on page load
            startAutoSlide();
            
            // Pause auto-slide on hover
            if (gallery) {
                gallery.addEventListener('mouseenter', stopAutoSlide);
                gallery.addEventListener('mouseleave', startAutoSlide);
            }
        }
    });
    </script>
</x-app-layout>