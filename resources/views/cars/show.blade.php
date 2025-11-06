<x-app-layout>

<div class="max-w-screen-xl mx-auto py-12 px-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
        
        {{-- ================= LEFT COLUMN: DETAILS & GALLERY ================= --}}
        <div class="lg:col-span-2">
            
            {{-- Header --}}
            <div class="mb-4">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">{{ $car->name }}</h1>
                <div class="flex items-center text-gray-600 dark:text-gray-400">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    <span>{{ $car->location->name }}</span>
                    <a href="{{ $car->location->google_maps_link }}" target="_blank" class="ml-2 text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Show on map</a>
                </div>
            </div>

            {{-- Gallery Carousel --}}
            <div id="gallery" class="relative w-full" data-carousel="slide">
                <div class="relative h-96 overflow-hidden rounded-lg">
                    @foreach($thumbnails as $index => $image)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="{{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ $image }}" class="absolute block w-full h-full object-cover" alt="Car image {{ $index + 1 }}">
                    </div>
                    @endforeach
                </div>
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/></svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
            
            {{-- Thumbnails --}}
            <div class="grid grid-cols-6 gap-2 mt-2">
                @foreach($thumbnails as $index => $thumb)
                <button data-carousel-slide-to="{{ $index }}" class="rounded-lg overflow-hidden border-2 border-transparent hover:border-blue-500 focus:border-blue-500">
                    <img src="{{ $thumb }}" class="h-16 w-full object-cover" alt="Car thumbnail {{ $index + 1 }}">
                </button>
                @endforeach
            </div>

            {{-- Features --}}
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4">Vehicle Features</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($specs as $spec)
                <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    {{-- Simple icon logic based on 'icon' key --}}
                    @if($spec['icon'] == 'electric')
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                    @elseif($spec['icon'] == 'manual' || $spec['icon'] == 'auto')
                         <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527c.477-.34.994-.142 1.246.317l.545 1.03c.25.46.07.994-.317 1.246l-.527.737c-.25.35-.272.806-.108 1.204.165.397.505.71.93.78l.893.15c.542.09.94.56.94 1.11v1.093c0 .55-.398 1.02-.94 1.11l-.893.149c-.425.07-.764.384-.93.78-.164.398-.142.855.108 1.205l-.527.737c-.34.477-.142-.994.317-1.246l1.03-.545c.46-.25.994-.07 1.246.317l.737.527c.35.25.806.272 1.204.108.397-.165.71-.505.78-.93l.15-.893zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" /></svg>
                    @elseif($spec['icon'] == 'seats')
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A1.5 1.5 0 0118 21.75H6a1.5 1.5 0 01-1.499-1.632z" /></svg>
                    @else
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    @endif
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $spec['text'] }}</span>
                </div>
                @endforeach
            </div>

        </div>

        {{-- ================= RIGHT COLUMN: BOOKING FORM ================= --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24 p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-5">Rent This Vehicle</h2>
                
                <form action="{{ route('reservations.store', $car->id) }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Pick-Up Date --}}
                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Pick-Up Date
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4Zm-1 14H3V8h16v10Z"/></svg>
                            </div>
                            {{-- Uses datepicker-min-date for Flowbite compatibility --}}
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
                                placeholder="Select date"
                                required>
                        </div>
                    </div>

                    {{-- Drop-Off Date --}}
                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Drop-Off Date
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
                                placeholder="Select date"
                                required>
                        </div>
                    </div>

                    {{-- Start Time --}}
                    <div>
                        <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Start Time *
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
                            End Time *
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
                            Pick-Up Location
                        </label>
                        <select id="pickup_location_id" name="pickup_location_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ $car->location_id == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dropoff Location --}}
                    <div>
                        <label for="dropoff_location_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Drop-Off Location
                        </label>
                        <select id="dropoff_location_id" name="dropoff_location_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ $car->location_id == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Total Price Display --}}
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                        <span class="text-lg font-medium text-gray-900 dark:text-white">Total</span>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{-- Currency symbol can be adjusted here --}}
                                $<span id="total_price">0</span>
                            </span>
                             <div id="price_breakdown" class="text-sm text-gray-500 dark:text-gray-400 mt-1"></div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300
                                font-medium rounded-lg text-sm px-5 py-3 text-center
                                dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Book Now
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ================= JAVASCRIPT ================= --}}
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

    // 1. Generate 30-minute time intervals for select boxes
    const generateTimes = (select) => {
        select.innerHTML = "";
        for (let h = 0; h < 24; h++) {
            for (let m of [0,30]) {
                const value = `${String(h).padStart(2,"0")}:${m === 0 ? "00" : "30"}`;
                select.append(new Option(value, value));
            }
        }
        // Set sensible defaults (e.g., 10:00 AM) if possible
        select.value = "10:00";
    };

    generateTimes(startTime);
    generateTimes(endTime);

    // Helper: Convert "Y-m-d H:i" string into a local Date object
    const toLocalDate = (str) => {
        if (!str) return null;
        const [date, time] = str.split(" ");
        const [y, m, d] = date.split("-").map(Number);
        const [hh, mm] = time.split(":").map(Number);
        return new Date(y, m - 1, d, hh, mm, 0, 0);
    };

    // Parse unavailable blocks once
    const blocks = unavailable.map(r => ({
        start: toLocalDate(r.start),
        end:   toLocalDate(r.end),
    }));

    // Check if a specific datetime is inside a booked block
    const isBlocked = dt => {
        if (!dt) return false;
        const t = dt.getTime();
        return blocks.some(b => t >= b.start.getTime() && t < b.end.getTime());
    };

    // 2. Update available times based on selected date
    //    Disables past times for today, and fully booked times slots.
    const updateTimeOptions = (dateInput, timeSelect) => {
        const dateVal = dateInput.value;
        if (!dateVal) return;

        const now = new Date();

        [...timeSelect.options].forEach(opt => {
            const dt = toLocalDate(`${dateVal} ${opt.value}`);
            if (!dt) return;
            
            // Block if it's in the past OR overlaps with a reservation
            const isPast = dt < now;
            const blocked = isPast || isBlocked(dt);
            
            opt.disabled = blocked;
            // Optional: add visual cue for disabled options if browser supports it well
            if (blocked && !opt.textContent.includes("(Unavailable)")) {
                 // opt.textContent += " (Unavailable)"; 
            }
        });
    };

    // 3. Ensure End Date/Time is logically after Start Date/Time
    const ensureEndAfterStart = () => {
        if (!startDate.value || !startTime.value) return;

        const start = toLocalDate(`${startDate.value} ${startTime.value}`);
        // If end date isn't set yet, default it to start date
        if (!endDate.value) {
             endDate.value = startDate.value;
        }
        
        let end = toLocalDate(`${endDate.value} ${endTime.value}`);

        // If End is strictly before Start, reset End to Start + 1 hour (or 30mins)
        if (end && end <= start) {
             // Reset end date to match start date
             endDate.value = startDate.value;
             
             // Find a time at least 1 hour after start time
             const newEndTime = new Date(start.getTime() + 60 * 60 * 1000);
             const newHH = String(newEndTime.getHours()).padStart(2, '0');
             const newMM = newEndTime.getMinutes() >= 30 ? "30" : "00";
             
             endTime.value = `${newHH}:${newMM}`;
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

        // Calculate difference in minutes
        const diffMin = (end - start) / (1000 * 60);
        // Convert minutes to days (1440 mins = 1 day)
        const daysExact = diffMin / 1440;
        // Round up to nearest full day (or whatever your business logic is)
        const billableDays = Math.max(1, Math.ceil(daysExact));

        const total = billableDays * pricePerDay;

        // Format with commas for thousands if needed
        totalPriceEl.textContent = total.toLocaleString('en-US', {minimumFractionDigits: 0});

        if (breakdownEl) {
            breakdownEl.innerHTML = `
                ${billableDays} day(s) × $${pricePerDay} =
                <strong>$${total.toLocaleString()}</strong>
            `;
        }
    };

    // ================= EVENT LISTENERS =================
    
    // Handle Start Date changes
    const handleStartDateChange = (e) => {
         // When start date changes, attempt to update End Date minimum
         // Note: Flowbite might require re-initialization for this to take visual effect immediately in some versions.
         endDate.setAttribute('datepicker-min-date', e.target.value);
         
         updateTimeOptions(startDate, startTime);
         ensureEndAfterStart();
         calculatePrice();
    };

    // Handle End Date changes
    const handleEndDateChange = (e) => {
         updateTimeOptions(endDate, endTime);
         ensureEndAfterStart();
         calculatePrice();
    };

    // Listen to standard 'change' and custom Flowbite 'changeDate' events
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

    // Initial calculation on load if values happen to be pre-filled
    updateTimeOptions(startDate, startTime);
    calculatePrice();
});
</script>
</x-app-layout>