<x-app-layout>
    <style>
        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }
    </style>
    <div class="animate-fade-in">
        {{-- HERO SECTION --}}
        <section class="relative bg-gray-900 flex items-center justify-center pt-24 pb-32">
            <div class="absolute inset-0">
                <img src="{{ asset('images/driving.gif') }}" alt="Background" class="w-full h-full object-cover opacity-50">
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>
            <div class="relative z-10 text-center px-4 opacity-0 translate-y-8 animate-load transition-all duration-1000 ease-out" id="hero-content">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white my-4">{{ __('reservations.my_reservations') }}</h1>
                <p class="text-lg text-gray-200 dark:text-gray-300 max-w-2xl mx-auto">
                    {{ __('reservations.manage_desc') }}
                </p>
            </div>
        </section>

        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            {{-- Alerts --}}
            @if (session('success'))
                <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-200 dark:border-green-800" role="alert">
                    <span class="font-bold">{{ __('reservations.alert_success') }}</span> {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200 dark:border-red-800" role="alert">
                    <span class="font-bold">{{ __('reservations.alert_error') }}</span> {{ session('error') }}
                </div>
            @endif

            {{-- Reservations List --}}
            <div class="space-y-6">
                @forelse ($reservations as $reservation)
                    <div class="group bg-white dark:bg-gray-800 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 sm:rounded-xl flex flex-col sm:flex-row border border-gray-100 dark:border-gray-700">
                        
                        {{-- Image Section --}}
                        @php
                            $imageUrl = !empty($reservation->car->images) && is_array($reservation->car->images) && count($reservation->car->images) > 0 
                                ? asset('storage/' . $reservation->car->images[0]) 
                                : asset('images/logo.png');

                            // STATUS LOGIC
                            $statusKey = 'reservations.status_' . $reservation->status->value;
                            
                            // UPDATED: Used 'amber' for Pending to ensure orange color appears
                            $statusColorClasses = match($reservation->status) {
                                \App\Enums\ReservationStatus::Pending => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                \App\Enums\ReservationStatus::Confirmed => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                \App\Enums\ReservationStatus::Completed => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                \App\Enums\ReservationStatus::Canceled => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                \App\Enums\ReservationStatus::Overdue => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                            };
                        @endphp
                        <div class="relative flex-none w-full sm:w-1/3 md:w-72 overflow-hidden">
                            <img src="{{ $imageUrl }}" alt="{{ $reservation->car->name }}" class="w-full h-56 sm:h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        </div>

                        {{-- Details Section --}}
                        <div class="flex-grow p-6 flex flex-col">
                            
                            {{-- Header: ID, Name, Status --}}
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-4 gap-4">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs font-mono text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded">
                                            #{{ $reservation->id }}
                                        </span>
                                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                                            {{ $reservation->car->brand->name }}
                                        </span>
                                    </div>
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                                        {{ $reservation->car->name }}
                                    </h2>
                                </div>

                                {{-- Status Badge --}}
                                <div>
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-md shadow-sm {{ $statusColorClasses }}">
                                        {{ __($statusKey) }}
                                    </span>
                                </div>
                            </div>

                            {{-- Divider --}}
                            <div class="h-px bg-gray-100 dark:bg-gray-700 w-full mb-4"></div>

                            {{-- Info Grid --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-4 gap-x-6 text-sm text-gray-600 dark:text-gray-300 mb-6">
                                
                                {{-- Service Type --}}
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-400 dark:text-gray-500 uppercase font-semibold mb-1">{{ __('reservations.service_type') }}</span>
                                    <div class="flex items-center gap-2">
                                        @if($reservation->with_driver)
                                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            <span class="font-medium text-indigo-700 dark:text-indigo-300">{{ __('reservations.with_driver') }}</span>
                                        @else
                                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.131A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.2-2.85.577-4.147l.156-.479c.412-1.268 1.492-2.185 2.766-2.35A19.554 19.554 0 0112 4c.338 0 .673.007 1.005.02m0 0a11.963 11.963 0 00-6.109 2.022"></path></svg>
                                            <span class="font-medium text-gray-700 dark:text-gray-300">{{ __('reservations.self_drive') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- From Date --}}
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-400 dark:text-gray-500 uppercase font-semibold mb-1">{{ __('reservations.from') }}</span>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="font-medium">{{ $reservation->start_datetime->format('M j, Y') }}</span>
                                    </div>
                                    <span class="text-xs text-gray-500 ps-6">{{ $reservation->start_datetime->format('g:i A') }}</span>
                                </div>

                                {{-- To Date --}}
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-400 dark:text-gray-500 uppercase font-semibold mb-1">{{ __('reservations.to') }}</span>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="font-medium">{{ $reservation->end_datetime->format('M j, Y') }}</span>
                                    </div>
                                    <span class="text-xs text-gray-500 ps-6">{{ $reservation->end_datetime->format('g:i A') }}</span>
                                </div>

                                {{-- Total Price --}}
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-400 dark:text-gray-500 uppercase font-semibold mb-1">{{ __('reservations.total_price') }}</span>
                                    <div class="flex items-center gap-1 font-bold text-gray-900 dark:text-white text-lg">
                                        <img src="{{ asset('images/currency.png') }}" alt="currency" class="w-4 h-4 dark:invert opacity-80">
                                        {{ number_format($reservation->total_price, 2) }}
                                    </div>
                                </div>
                            </div>

                            {{-- Actions Footer --}}
                            <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row gap-3 justify-end">
                                <a href="{{ route('cars.show', $reservation->car) }}" class="inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition-colors">
                                    {{ __('reservations.view_details') }}
                                </a>

                                @if ($reservation->status === \App\Enums\ReservationStatus::Confirmed || $reservation->status === \App\Enums\ReservationStatus::Pending)
                                    <button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-reservation-cancellation-{{ $reservation->id }}')"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-800 transition-colors"
                                    >
                                        {{ __('reservations.cancel_reservation') }}
                                    </button>

                                    <x-modal name="confirm-reservation-cancellation-{{ $reservation->id }}" focusable>
                                        <form method="post" action="{{ route('reservations.cancel', $reservation) }}" class="p-6 text-start rtl:text-right">
                                            @csrf
                                            @method('patch')
                                            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">
                                                {{ __('reservations.cancel_modal_title') }}
                                            </h2>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                                                {{ __('reservations.cancel_modal_desc') }}
                                            </p>
                                            <div class="flex justify-end gap-3">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('reservations.no_keep_it') }}
                                                </x-secondary-button>
                                                <x-danger-button>
                                                    {{ __('reservations.yes_cancel_it') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
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
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('reservations.no_reservations_yet') }}</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('reservations.no_reservations_desc') }}</p>
                    <div class="mt-6">
                        <a href="{{ route('cars.index') }}" 
                            class="inline-flex items-center justify-center px-4 py-2 bg-blue-700 dark:bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-blue-800 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('reservations.book_new_car') }}
                </a>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($reservations->hasPages())
                <div class="mt-10">
                    {{ $reservations->links() }}
                </div>
            @endif
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                setTimeout(() => {
                    const heroContent = document.getElementById('hero-content');
                    if (heroContent) {
                        heroContent.classList.remove('opacity-0', 'translate-y-8');
                        heroContent.classList.add('opacity-100', 'translate-y-0');
                    }
                }, 100);
            });
        </script>
    </div>
</x-app-layout>