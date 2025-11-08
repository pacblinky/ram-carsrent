{{-- Sorting & Pagination Controls --}}
<div class="flex flex-col md:flex-row justify-between items-center mb-6 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4 md:mb-0">
        {{ __('cars_page.showing_results', [
            'start' => $carsPaginator->firstItem() ?? 0,
            'end' => $carsPaginator->lastItem() ?? 0,
            'total' => $carsPaginator->total()
        ]) }}
    </span>

    <div class="flex items-center space-x-4">
        {{-- Per Page Dropdown --}}
        <button id="showDropdownButton" data-dropdown-toggle="showDropdown" class="text-gray-900 dark:text-white font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center border dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700" type="button">
            {{ __('cars_page.show') }} {{ request('per_page', 10) }}
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <div id="showDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="showDropdownButton">
                @foreach([10, 20, 30, 50] as $count)
                <li>
                    <a href="{{ route('cars.index', array_merge(request()->query(), ['per_page' => $count, 'page' => 1])) }}"
                       class="ajax-filter-link block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ request('per_page', 10) == $count ? 'font-bold bg-gray-50 dark:bg-gray-600' : '' }}">
                        {{ __('cars_page.show') }} {{ $count }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Sort Dropdown --}}
        @php
            $sortText = match(request('sort', 'newest')) {
                'price_asc' => __('cars_page.price_low_high'),
                'price_desc' => __('cars_page.price_high_low'),
                default => __('cars_page.newest'),
            };
        @endphp
        <button id="sortDropdownButton" data-dropdown-toggle="sortDropdown" class="text-gray-900 dark:text-white font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center border dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700" type="button">
            {{ __('cars_page.sort_by') }} {{ $sortText }}
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <div id="sortDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="sortDropdownButton">
                <li><a href="{{ route('cars.index', array_merge(request()->query(), ['sort' => 'newest', 'page' => 1])) }}" class="ajax-filter-link block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('cars_page.newest') }}</a></li>
                <li><a href="{{ route('cars.index', array_merge(request()->query(), ['sort' => 'price_asc', 'page' => 1])) }}" class="ajax-filter-link block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('cars_page.price_low_high') }}</a></li>
                <li><a href="{{ route('cars.index', array_merge(request()->query(), ['sort' => 'price_desc', 'page' => 1])) }}" class="ajax-filter-link block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('cars_page.price_high_low') }}</a></li>
            </ul>
        </div>
    </div>
</div>

{{-- CARDS GRID --}}
<div class="space-y-6 relative min-h-[500px]">
    {{-- Loading overlay (initially hidden) --}}
    <div id="loading-overlay" class="absolute inset-0 bg-white/50 dark:bg-gray-900/50 z-50 flex items-center justify-center hidden backdrop-blur-sm transition-opacity duration-300">
        <div role="status">
            <svg aria-hidden="true" class="w-12 h-12 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">{{ __('cars_page.loading') }}</span>
        </div>
    </div>

    @forelse($carsPaginator as $car)
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden flex flex-col md:flex-row hover:shadow-md transition-shadow">
            <div class="md:w-1/3 relative">
                <img class="h-full w-full object-cover absolute inset-0" src="{{ $car['image'] }}" alt="{{ $car['name'] }}">
            </div>
            {{-- Spacer for aspect ratio on mobile --}}
            <div class="md:hidden h-48">
                <img class="h-full w-full object-cover" src="{{ $car['image'] }}" alt="{{ $car['name'] }}">
            </div>

            <div class="md:w-2/3 p-6 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-500">
                                <a href="{{ route('cars.show', $car['id']) }}">{{ $car['name'] }}</a>
                            </h5>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 flex items-center mt-1">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $car['location'] }}
                            </p>
                        </div>
                    </div>

                    {{-- Specs Grid --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
                        @foreach($car['specs'] as $spec)
                            <div class="flex items-center space-x-2 text-gray-700 dark:text-gray-300" title="{{ ucfirst($spec['icon']) }}">
                                @if($spec['icon'] == 'mileage')
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                @elseif($spec['icon'] == 'transmission')
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527c.477-.34.994-.142 1.246.317l.545 1.03c.25.46.07.994-.317 1.246l-.527.737c-.25.35-.272.806-.108 1.204.165.397.505.71.93.78l.893.15c.542.09.94.56.94 1.11v1.093c0 .55-.398 1.02-.94 1.11l-.893.149c-.425.07-.764.384-.93.78-.164.398-.142.855.108 1.205l-.527.737c.34.477.142.994-.317 1.246l1.03-.545c.46-.25.994-.07 1.246.317l.737.527c.35.25.806.272 1.204.108.397-.165.71-.505.78-.93l.15-.893zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" />
                                    </svg>
                                @elseif($spec['icon'] == 'seats')
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.5 18H8.5v-2.5a2.5 2.5 0 012.5-2.5h2a2.5 2.5 0 012.5 2.5V18zM6 9h12a2 2 0 00-2-2H8a2 2 0 00-2 2z" />
                                    </svg>
                                @elseif($spec['icon'] == 'fuel')
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4-6v2m0 0v2m0-2h2m-2 0H8m8-2v2m0 0v2m0-2h2m-2 0h-2" />
                                    </svg>
                                @endif
                                <span class="text-sm truncate">{{ $spec['text'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center justify-between mt-auto">
                    <div>
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">${{ number_format($car['price'], 0) }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('cars_page.per_day') }}</span>
                    </div>
                    <a href="{{ route('cars.show', $car['id']) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                        {{ __('cars_page.view_details') }}
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('cars_page.no_vehicles_found') }}</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('cars_page.no_vehicles_found_desc') }}</P>
            <div class="mt-6">
                <a href="{{ route('cars.index') }}" class="ajax-filter-link inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('cars_page.clear_all_filters') }}
                </a>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-8" id="pagination-container">
    {{ $carsPaginator->onEachSide(1)->links() }}
</div>