<x-app-layout>

<div class="max-w-screen-xl mx-auto py-12 px-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
        
        <div class="lg:col-span-2">
            
            <div class="mb-4">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-2">{{ $car['name'] }}</h1>
                <div class="flex items-center text-gray-600 dark:text-gray-400">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    <span>{{ $car['location'] }}</span>
                    <a href="#" class="ml-2 text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Show on map</a>
                </div>
            </div>

            <div id="gallery" class="relative w-full" data-carousel="slide">
                <div class="relative h-96 overflow-hidden rounded-lg">
                    @foreach($car['images'] as $index => $image)
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
                <button class="absolute bottom-5 left-5 z-20 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v10H5V5zm3 1a1 1 0 00-1 1v6a1 1 0 001 1h4a1 1 0 001-1V7a1 1 0 00-1-1H8z"></path></svg>
                    See All Photos
                </button>
            </div>
            <div class="grid grid-cols-6 gap-2 mt-2">
                @foreach($car['thumbnails'] as $index => $thumb)
                <button data-carousel-slide-to="{{ $index }}" class="rounded-lg overflow-hidden border-2 border-transparent hover:border-blue-500 focus:border-blue-500">
                    <img src="{{ $thumb }}" class="h-16 w-full object-cover" alt="Car thumbnail {{ $index + 1 }}">
                </button>
                @endforeach
            </div>

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-8 mb-4">Vehicle Features</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($car['specs'] as $spec)
                <div class="flex items-center p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    @if($spec['icon'] == 'electric')
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                    @elseif($spec['icon'] == 'manual')
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527c.477-.34.994-.142 1.246.317l.545 1.03c.25.46.07.994-.317 1.246l-.527.737c-.25.35-.272.806-.108 1.204.165.397.505.71.93.78l.893.15c.542.09.94.56.94 1.11v1.093c0 .55-.398 1.02-.94 1.11l-.893.149c-.425.07-.764.384-.93.78-.164.398-.142.855.108 1.205l.527.737c.34.477.142.994-.317 1.246l-1.03.545c-.46.25-.994.07-1.246-.317l-.737-.527c-.35-.25-.806-.272-1.204-.108-.397.165-.71.505-.78.93l-.15.893c-.09.542-.56.94-1.11.94h-1.093c-.55 0-1.02-.398-1.11-.94l-.149-.894c-.07-.424-.384-.764-.78-.93-.398-.164-.855-.142-1.205.108l-.737.527c-.477.34-.994.142-1.246-.317l-.545-1.03c-.25-.46-.07-.994.317-1.246l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.893-.15c-.542-.09-.94-.56-.94-1.11v-1.093c0-.55.398-1.02.94-1.11l.893-.149c.425-.07.764-.384.93-.78.164-.398.142-.855-.108-1.205l-.527-.737c-.34-.477-.142-.994.317-1.246l1.03-.545c.46-.25.994-.07 1.246.317l.737.527c.35.25.806.272 1.204.108.397-.165.71-.505.78-.93l.15-.893zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" /></svg>
                    @elseif($spec['icon'] == 'seats')
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A1.5 1.5 0 0118 21.75H6a1.5 1.5 0 01-1.499-1.632z" /></svg>
                    @else
                        <svg class="w-6 h-6 text-gray-700 dark:text-gray-300 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-6 0H6a2.25 2.25 0 01-2.25-2.25V6a2.25 2.25 0 012.25-2.25h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-.75.75h-1.5a2.25 2.25 0 00-2.25 2.25v.75m6-6h6m-6 0v6m6-6v6m0 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-6 0H6a2.25 2.25 0 01-2.25-2.25V6a2.25 2.25 0 012.25-2.25h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-.75.75h-1.5a2.25 2.25 0 00-2.25 2.25v.75m6-6h6m-6 0v6m6-6v6m0 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6" /></svg>
                    @endif
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $spec['text'] }}</span>
                </div>
                @endforeach
            </div>

        </div> <div class="lg:col-span-1">
            <div class="sticky top-24 p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-5">Rent This Vehicle</h2>
                
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="pickup-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pick-Up</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4Zm-1 14H3V8h16v10Z"/></svg>
                            </div>
                            <input datepicker datepicker-format="yyyy-mm-dd" type="text" id="pickup-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Select date">
                        </div>
                    </div>
                    
                    <div>
                        <label for="dropoff-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Drop-Off</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4Zm-1 14H3V8h16v10Z"/></svg>
                            </div>
                            <input datepicker datepicker-format="yyyy-mm-dd" type="text" id="dropoff-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Select date">
                        </div>
                    </div>

                    <div>
                        <label for="start-time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Time *</label>
                        <select id="start-time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            @foreach($car['time_options'] as $time)
                            <option value="{{ $time }}" {{ $time == '09:00' ? 'selected' : '' }}>{{ $time }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="end-time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Time *</label>
                        <select id="end-time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            @foreach($car['time_options'] as $time)
                            <option value="{{ $time }}" {{ $time == '09:00' ? 'selected' : '' }}>{{ $time }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                        <span class="text-lg font-medium text-gray-900 dark:text-white">Total</span>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">
                            ${{ $car['price_per_day'] }}
                        </span>
                    </div>

                    <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Book Now
                    </button>
                </form>
            </div>
        </div> </div> </div>
</x-app-layout>