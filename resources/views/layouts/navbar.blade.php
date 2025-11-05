@props(['dir' => app()->getLocale() === 'ar' ? 'rtl' : 'ltr'])

<nav class="bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700 shadow-sm" dir="{{ $dir }}">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Brand -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo.png') }}" class="h-8" alt="{{ config('app.name') }}" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                    {{ __('general.brand_name') }}
                </span>
            </a>

            <!-- Mobile menu button -->
            <button type="button" data-collapse-toggle="navbar-menu"
                class="inline-flex items-center p-2 text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-menu" aria-expanded="false">
                <span class="sr-only">{{ __('Toggle navigation') }}</span>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>

            <!-- Menu -->
            <div class="hidden w-full md:flex md:items-center md:w-auto" id="navbar-menu">
                <ul
                    class="flex flex-col md:flex-row md:space-x-8 rtl:space-x-reverse font-medium mt-4 md:mt-0 p-4 md:p-0
                           border border-gray-100 rounded-lg bg-gray-50 md:border-0 md:bg-white
                           dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    
                    <!-- Pages -->
                    <li>
                        <a href="{{ url('/') }}"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                            {{ __('general.home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/cars') }}"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                            {{ __('general.cars') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/contact') }}"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                            {{ __('general.contact') }}
                        </a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                        <li>
                            <a href="{{ route('login') }}"
                               class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                                {{ __('general.login') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}"
                               class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                                {{ __('general.signup') }}
                            </a>
                        </li>
                    @else
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                                    {{ __('general.logout') }}
                                </button>
                            </form>
                        </li>
                    @endguest

                    <!-- Language Toggle -->
                    <li>
                        <a href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                           class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                            {{ __('general.language') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>