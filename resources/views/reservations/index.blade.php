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
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ __('reservations.alert_success') }}</span> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">{{ __('reservations.alert_error') }}</span> {{ session('error') }}
            </div>
        @endif

        {{-- Reservations List --}}
        <div class="space-y-6">
            @forelse ($reservations as $reservation)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col sm:flex-row">
                    
                    {{-- Image --}}
                    @php
                        $imageUrl = !empty($reservation->car->images) && is_array($reservation->car->images) && count($reservation->car->images) > 0 
                            ? asset('storage/' . $reservation->car->images[0]) 
                            : asset('images/logo.png');
                    @endphp
                    <div class="flex-none w-full sm:w-1/3 md:w-1/4">
                        <img src="{{ $imageUrl }}" alt="{{ $reservation->car->name }}" class="w-full h-48 sm:h-full object-cover sm:rounded-s-lg rtl:sm:rounded-s-none rtl:sm:rounded-e-lg">
                    </div>

                    {{-- Details --}}
                    <div class="flex-grow p-6 flex flex-col sm:flex-row sm:justify-between sm:space-x-6 rtl:space-x-reverse">
                        <div class="flex-grow">
                            <div class="flex justify-between items-start">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $reservation->car->brand->name }} {{ $reservation->car->name }}</h2>
                                
                                {{-- Status Badge --}}
                                <div class="text-sm font-medium sm:text-start sm:rtl:text-end">
                                    <span class="font-semibold text-gray-600 dark:text-gray-400 block sm:hidden">{{ __('reservations.status') }}</span>
                                    
                                    {{-- LOGIC FIX: Use the enum value to dynamically get the translation --}}
                                    @php
                                        $statusKey = 'reservations.status_' . $reservation->status->value;
                                        $statusColorClasses = match($reservation->status) {
                                            \App\Enums\ReservationStatus::Pending => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                            \App\Enums\ReservationStatus::Confirmed => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                            \App\Enums\ReservationStatus::Completed => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                            \App\Enums\ReservationStatus::Canceled => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                            \App\Enums\ReservationStatus::Overdue => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                            default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 text-xs rounded-full {{ $statusColorClasses }}">
                                        {{ __($statusKey) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-y-4 gap-x-6 mt-4 sm:mt-2 text-sm text-gray-700 dark:text-gray-300">
                                <div>
                                    <span class="font-semibold text-gray-500 dark:text-gray-400 block">{{ __('reservations.from') }}</span>
                                    {{ $reservation->start_datetime->format('D, M j, Y, g:i A') }}
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-500 dark:text-gray-400 block">{{ __('reservations.to') }}</span>
                                    {{ $reservation->end_datetime->format('D, M j, Y, g:i A') }}
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-500 dark:text-gray-400 block">{{ __('reservations.total_price') }}</span>
                                    <span class="font-bold text-gray-900 dark:text-white">${{ number_format($reservation->total_price, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex-none sm:ms-6 rtl:sm:ms-0 rtl:sm:me-6 mt-6 sm:mt-0 pt-6 sm:pt-0 border-t sm:border-t-0 sm:border-s rtl:sm:border-s-0 rtl:sm:border-e border-gray-200 dark:border-gray-700">
                            <div class="h-full flex flex-row sm:flex-col justify-end sm:justify-start space-x-4 rtl:space-x-reverse sm:space-x-0 sm:space-y-3 ps-0 sm:ps-6 rtl:sm:ps-0 rtl:sm:pe-6">
                                <a href="{{ route('cars.show', $reservation->car) }}" class="inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('reservations.view_details') }}
                                </a>
                                @if ($reservation->status === \App\Enums\ReservationStatus::Confirmed || $reservation->status === \App\Enums\ReservationStatus::Pending)
                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-reservation-cancellation-{{ $reservation->id }}')"
                                    >{{ __('reservations.cancel_reservation') }}</x-danger-button>

                                    {{-- Individual Modal per Reservation --}}
                                    <x-modal name="confirm-reservation-cancellation-{{ $reservation->id }}" focusable>
                                        <form method="post" action="{{ route('reservations.cancel', $reservation) }}" class="p-6 text-start rtl:text-right">
                                            @csrf
                                            @method('patch')
                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                {{ __('reservations.cancel_modal_title') }}
                                            </h2>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {{ __('reservations.cancel_modal_desc') }}
                                            </p>
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('reservations.no_keep_it') }}
                                                </x-secondary-button>
                                                <x-danger-button class="ms-3 rtl:ms-0 rtl:me-3">
                                                    {{ __('reservations.yes_cancel_it') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                @endif
                            </div>
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
                        <x-primary-button as="a" href="{{ route('cars.index') }}">
                            {{ __('reservations.book_new_car') }}
                        </x-primary-button>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($reservations->hasPages())
            <div class="mt-8">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>
        <script>
        document.addEventListener("DOMContentLoaded", () => {
            // 1. Trigger Hero Animation Immediately
            setTimeout(() => {
                const heroContent = document.getElementById('hero-content');
                if (heroContent) {
                    heroContent.classList.remove('opacity-0', 'translate-y-8');
                    heroContent.classList.add('opacity-100', 'translate-y-0');
                }
            }, 100); 

            // 2. Set up Intersection Observer for Scroll Animations
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15 // Trigger when 15% of the element is visible
            };

            const scrollObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Add visible state classes
                        entry.target.classList.remove('opacity-0', 'translate-y-8', '-translate-x-8', 'translate-x-8');
                        entry.target.classList.add('opacity-100', 'translate-y-0', 'translate-x-0');
                        // Stop observing once animated
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Target all elements with the 'animate-on-scroll' class
            document.querySelectorAll('.animate-on-scroll').forEach((el) => {
                scrollObserver.observe(el);
            });
        });
    </script>
</x-app-layout>