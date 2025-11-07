<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-[calc(100vh-80px)]">
            {{-- Auth Card --}}
            <div class="w-full bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:max-w-md p-6 sm:p-8 border dark:border-gray-700">
                <h2 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-3xl dark:text-white mb-4">
                    Forgot Your Password?
                </h2>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400 mb-6">
                    {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                    <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                </svg>
                            </div>
                            <x-text-input id="email" class="block w-full ps-10" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200 ease-in-out">
                        {{ __('Email Password Reset Link') }}
                    </button>
                    
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                        Remember your password? <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>