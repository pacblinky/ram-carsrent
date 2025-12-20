<nav class="border-gray-200 bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <div class="flex items-center space-x-3 rtl:space-x-reverse">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo.png') }}" 
                     class="h-12 w-auto md:h-16 lg:h-20 object-contain" 
                     alt="Brand Logo" />
                <span class="self-center text-xl md:text-2xl lg:text-3xl font-semibold whitespace-nowrap neon-animated-brand">{{ __('navbar.brand') }}</span>
            </a>

            <div class="hidden md:flex items-center space-x-3 rtl:space-x-reverse gap-2">
                
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                        </path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
        
                <button type="button" data-dropdown-toggle="language-dropdown" class="inline-flex justify-center items-center text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 font-medium">
                    <span>{{ __('navbar.current_lang') }}</span>
                    <svg class="w-2.5 h-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="language-dropdown">
                    <ul class="py-2" role="none">
                        <li>
                            <a href="{{ url('locale/en') }}"
                                class="block px-4 py-2 text-sm {{ app()->getLocale() == 'en' ? 'text-blue-700 dark:text-blue-500' : 'text-gray-700 dark:text-gray-200' }} hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">
                                English
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('locale/ar') }}"
                                class="block px-4 py-2 text-sm {{ app()->getLocale() == 'ar' ? 'text-blue-700 dark:text-blue-500' : 'text-gray-700 dark:text-gray-200' }} hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">
                                العربية
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex items-center md:order-3 space-x-3 md:space-x-0 rtl:space-x-reverse gap-2">
            @auth
                {{-- Authenticated User Dropdown --}}
                <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">{{ __('navbar.open_user_menu') }}</span>
                    <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                </button>
                
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{ route('reservations.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                {{ __('navbar.my_reservations') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                {{ __('navbar.profile') }}
                            </a>
                        </li>
                        
                        {{-- [START] Push Notification Toggle (Inside Dropdown) --}}
                        @if(Auth::user()->hasVerifiedEmail())
                        <li>
                            <button id="push-notification-toggle-dropdown" onclick="window.togglePushSubscription()" type="button" class="flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white text-start">
                                <span class="flex items-center">
                                    {{-- Enabled Icon --}}
                                    <svg id="push-icon-enabled-dropdown" class="w-4 h-4 me-2 hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                                        <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"/>
                                    </svg>
                                    {{-- Disabled Icon --}}
                                    <svg id="push-icon-disabled-dropdown" class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12" />
                                    </svg>
                                    Notification
                                </span>
                            </button>
                        </li>
                        @endif
                        {{-- [END] Push Notification Toggle --}}

                        @if(Auth::user()->is_admin)
                        <li>
                            <a href="/admin" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                {{ __('navbar.admin_panel') }}
                            </a>
                        </li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="window.handleLogout(event)" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-400 dark:hover:text-white">
                                    {{ __('navbar.sign_out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                {{-- Guest Login/Register Links (Desktop) --}}
                <a href="{{ route('login') }}" class="hidden md:inline-block text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">{{ __('auth_pages.login') }}</a>
                <a href="{{ route('register') }}" class="hidden md:inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('auth_pages.signup') }}</a>
            @endauth

            <button data-collapse-toggle="navbar-solid-bg" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-solid-bg" aria-expanded="false">
                <span class="sr-only">{{ __('navbar.open_main_menu') }}</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>

        <div class="flex items-center space-x-3 rtl:space-x-reverse gap-2 order-3 w-full justify-start mt-2 md:hidden">
            <button id="theme-toggle-mobile" type="button"
                class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                <svg id="theme-toggle-dark-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
    
            <button type="button" data-dropdown-toggle="language-dropdown-mobile" class="inline-flex justify-center items-center text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 font-medium">
                <span>{{ __('navbar.current_lang') }}</span>
                <svg class="w-2.5 h-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="language-dropdown-mobile">
                <ul class="py-2" role="none">
                    <li>
                        <a href="{{ url('locale/en') }}"
                            class="block px-4 py-2 text-sm {{ app()->getLocale() == 'en' ? 'text-blue-700 dark:text-blue-500' : 'text-gray-700 dark:text-gray-200' }} hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">
                            English
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('locale/ar') }}"
                            class="block px-4 py-2 text-sm {{ app()->getLocale() == 'ar' ? 'text-blue-700 dark:text-blue-500' : 'text-gray-700 dark:text-gray-200' }} hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">
                            العربية
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="hidden w-full md:block md:w-auto md:order-1" id="navbar-solid-bg">
            <ul class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                <li>
                    <a href="{{ route('home') }}" class="block py-2 px-3 md:p-0 rounded-sm {{ request()->routeIs('home') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }}" aria-current="page">{{ __('navbar.home') }}</a>
                </li>
                <li>
                    <a href="{{ route('cars.index') }}" class="block py-2 px-3 md:p-0 rounded-sm {{ request()->routeIs('cars*') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }}">{{ __('navbar.cars') }}</a>
                </li>
                <li>
                    <a href="{{ route('about') }}" class="block py-2 px-3 md:p-0 rounded-sm {{ request()->routeIs('about') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }}">{{ __('navbar.about') }}</a>
                </li>
                <li>
                    <a href="{{ route('contact.index') }}" class="block py-2 px-3 md:p-0 rounded-sm {{ request()->routeIs('contact.index') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }}">{{ __('navbar.contact') }}</a>
                </li>

                {{-- Mobile Login/Register Links --}}
                @guest
                    <li class="md:hidden">
                        <a href="{{ route('login') }}" class="block py-2 px-3 md:p-0 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">{{ __('auth_pages.login') }}</a>
                    </li>
                    <li class="md:hidden">
                        <a href="{{ route('register') }}" class="block py-2 px-3 md:p-0 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">{{ __('auth_pages.signup') }}</a>
                    </li>
                @endGuest
            </ul>
        </div>
    </div>
</nav>