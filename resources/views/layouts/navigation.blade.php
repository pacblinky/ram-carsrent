@props(['dir' => app()->getLocale() === 'ar' ? 'rtl' : 'ltr'])

<nav class="bg-white border-gray-200 dark:bg-gray-900" dir="{{ $dir }}">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Brand -->
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/logo.png') }}" class="h-8" alt="{{ config('app.name') }}" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                {{ app()->getLocale() === 'ar' ? 'رام لتأجير السيارات' : 'Ram Car Rental' }}
            </span>
        </a>

        <!-- Mobile Menu Button -->
        <button data-collapse-toggle="navbar-menu" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none"
            aria-controls="navbar-menu" aria-expanded="false">
            <span class="sr-only">{{ __('Open main menu') }}</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- Menu -->
        <div class="hidden w-full md:block md:w-auto" id="navbar-menu">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50
                       md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white
                       dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                <li>
                    <a href="{{ url('/') }}"
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent
                        md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                        {{ __('Home') }}
                    </a>
                </li>

                <li>
                    <a href="{{ url('/cars') }}"
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent
                        md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                        {{ __('Cars') }}
                    </a>
                </li>

                <li>
                    <a href="{{ url('/contact') }}"
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent
                        md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                        {{ __('Contact') }}
                    </a>
                </li>

                <!-- Language Toggle -->
                <li>
                    <a href="{{ route('locale.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                        class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent
                        md:hover:text-blue-700 md:p-0 dark:text-white dark:hover:text-blue-500">
                        {{ app()->getLocale() === 'ar' ? 'English' : 'العربية' }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>