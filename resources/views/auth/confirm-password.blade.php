<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-[calc(100vh-80px)]">
            {{-- Auth Card --}}
            <div class="w-full bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:max-w-md p-6 sm:p-8 border dark:border-gray-700">
                <h2 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-3xl dark:text-white mb-4">
                    {{ __('auth_pages.confirm_password_title') }}
                </h2>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400 mb-6">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>

                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.password') }}</label>
                        <div class="relative">
                             <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8V4.5a3 3 0 1 0-6 0V7h6Z"/>
                                </svg>
                            </div>
                            <x-text-input id="password" class="block w-full ps-10"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password"
                                            placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200 ease-in-out">
                        {{ __('Confirm') }}
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>