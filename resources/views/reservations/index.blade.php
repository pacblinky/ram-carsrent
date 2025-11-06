<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">My Reservations</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Manage your upcoming and past vehicle rentals.
            </p>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success!</span> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">Error!</span> {{ session('error') }}
            </div>
        @endif

        {{-- Reservations List --}}
        <div class="space-y-6">
            @forelse ($reservations as $reservation)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 transition-all hover:shadow-md">
                    <div class="p-6 sm:flex sm:justify-between sm:items-center gap-6">
                        
                        {{-- Left: Car Image & Basic Info --}}
                        <div class="flex items-center space-x-6 mb-6 sm:mb-0">
                            <div class="flex-shrink-0 w-24 h-24 sm:w-32 sm:h-32 bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden">
                                @if($reservation->car->images && count($reservation->car->images) > 0)
                                    <img src="{{ asset('storage/' . $reservation->car->images[0]) }}" alt="{{ $reservation->car->name }}" class="w-full h-full object-cover">
                                @else
                                     <div class="flex items-center justify-center h-full text-gray-400">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                     </div>
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                     <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                        {{ $reservation->car->brand->name }} {{ $reservation->car->name }}
                                    </h3>
                                    {{-- Status Badge --}}
                                    @php
                                        $statusColors = [
                                            'pending'   => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                            'confirmed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                            'completed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                            'canceled'  => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                            'overdue'   => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                        ];
                                        $statusColor = $statusColors[$reservation->status->value] ?? $statusColors['pending'];
                                    @endphp
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                        {{ ucfirst($reservation->status->value) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Booking ID: #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}
                                </p>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white mt-2">
                                    Total: ${{ number_format($reservation->total_price, 2) }}
                                </p>
                            </div>
                        </div>

                        {{-- Middle: Dates & Locations --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm flex-grow sm:mx-8 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold mb-1">Pick-up</p>
                                <p class="font-medium text-gray-900 dark:text-white">
                                    {{ $reservation->start_datetime->format('M d, Y - h:i A') }}
                                </p>
                                <p class="text-gray-500 dark:text-gray-400 truncate" title="{{ $reservation->pickup->name }}">
                                    {{ $reservation->pickup->name }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold mb-1">Drop-off</p>
                                <p class="font-medium text-gray-900 dark:text-white">
                                    {{ $reservation->end_datetime->format('M d, Y - h:i A') }}
                                </p>
                                <p class="text-gray-500 dark:text-gray-400 truncate" title="{{ $reservation->dropoff->name }}">
                                    {{ $reservation->dropoff->name }}
                                </p>
                            </div>
                        </div>

                        {{-- Right: Actions --}}
                        <div class="flex flex-col gap-2 min-w-[140px] mt-6 sm:mt-0">
                            <a href="{{ route('cars.show', $reservation->car_id) }}" class="text-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 transition-colors">
                                View Vehicle
                            </a>

                            {{-- Only show Cancel button if status is pending/confirmed AND it's in the future --}}
                            @if(in_array($reservation->status->value, ['pending', 'confirmed']) && $reservation->start_datetime->isFuture())
                                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full text-center px-4 py-2 text-sm font-medium text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 transition-colors">
                                        Cancel Booking
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No reservations yet</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Ready to hit the road? Find your perfect car today.</p>
                    <div class="mt-6">
                        <a href="{{ route('cars.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Browse Vehicles
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $reservations->links() }}
        </div>
    </div>
</x-app-layout>