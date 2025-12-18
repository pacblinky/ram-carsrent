<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex min-h-[calc(100vh-80px)]">

            {{-- Form Section (Left) --}}
            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 transition-all duration-1000 ease-out opacity-0 translate-y-5" id="register-form-container">
                <div class="w-full max-w-md">
                    <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-3xl dark:text-white mb-4">
                        {{ __('auth_pages.register_title') }}
                    </h1>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 mb-6">
                        {{ __('auth_pages.already_registered') }} <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">{{ __('auth_pages.login') }}</a>.
                    </p>

                    <form id="register-form" class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                        @csrf

                        @php
                            // Added pe-10 to the standard classes for inputs that might have an icon on the right
                            $inputClasses = 'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 text-start placeholder:text-start dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';
                            $passwordInputClasses = $inputClasses . ' pe-10'; // Specific class for password inputs
                            $errorClasses = 'border-red-500 dark:border-red-500';
                        @endphp

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.name') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                    </svg>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="{{ __('auth_pages.name_placeholder') }}"
                                       class="{{ $inputClasses }} @error('name') {{ $errorClasses }} @enderror">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.email') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                    </svg>
                                </div>
                                <input required type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="{{ __('auth_pages.email_placeholder') }}"
                                       class="{{ $inputClasses }} @error('email') {{ $errorClasses }} @enderror">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div>
                            <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.phone_number') }}</label>
                            <input required type="tel" id="phone_number" name="phone_number"
                                   value="{{ old('phone_number') }}" required autocomplete="tel"
                                   class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 text-start placeholder:text-start dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('phone_number') {{ $errorClasses }} @enderror">
                            @error('phone_number')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Government ID --}}
                        <div>
                            <label for="government_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.government_id') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 0 0-2 2v1h16V6a2 2 0 0 0-2-2H4Zm14 5H2v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9Zm-5 2h2v1h-2v-1Zm-2 0h1v1h-1v-1Z"/>
                                    </svg>
                                </div>
                                <input required type="text" id="government_id" name="government_id" value="{{ old('government_id') }}" required autocomplete="government-id" placeholder="{{ __('auth_pages.government_id_placeholder') }}"
                                    class="{{ $inputClasses }} @error('government_id') {{ $errorClasses }} @enderror">
                            </div>
                            @error('government_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.password') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                        <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8V4.5a3 3 0 1 0-6 0V7h6Z"/>
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="{{ __('auth_pages.password_placeholder') }}"
                                       class="{{ $passwordInputClasses }} @error('password') {{ $errorClasses }} @enderror">
                                
                                <button type="button" onclick="togglePassword('password', this)" class="absolute inset-y-0 end-0 flex items-center pe-3 cursor-pointer text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                    <svg class="eye-open w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <svg class="eye-closed w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.confirm_password') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                        <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8V4.5a3 3 0 1 0-6 0V7h6Z"/>
                                    </svg>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('auth_pages.password_placeholder') }}"
                                       class="{{ $passwordInputClasses }}">

                                <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute inset-y-0 end-0 flex items-center pe-3 cursor-pointer text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                    <svg class="eye-open w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <svg class="eye-closed w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200 ease-in-out">
                            {{ __('auth_pages.register') }}
                        </button>
                    </form>
                </div>
            </div>

            {{-- Image Section (Right) --}}
            <div class="hidden lg:flex lg:w-1/2 items-center justify-center transition-all duration-1000 ease-out opacity-0" id="register-image-container">
                <img src="{{ asset('images/car.png') }}" alt="Register Illustration" class="object-contain w-full h-full max-h-[80vh] transition-transform duration-500 hover:scale-[1.02]">
            </div>
        </div>
    </section>
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate form and image
        setTimeout(() => {
            const formContainer = document.getElementById('register-form-container');
            const imageContainer = document.getElementById('register-image-container');
            if(formContainer) formContainer.classList.remove('opacity-0', 'translate-y-5');
            if(imageContainer) imageContainer.classList.remove('opacity-0');
        }, 100);

        const phoneInput = document.querySelector("#phone_number");
        const registerForm = document.getElementById("register-form");

        const initRegisterIti = () => {
            if (!phoneInput || !registerForm) return;
            
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "auto",
                strictMode: true,
                loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/js/utils.js"),
                geoIpLookup: callback => {
                    fetch("https://ipapi.co/json")
                        .then(res => res.json())
                        .then(data => callback(data.country_code))
                        .catch(() => callback("eg"));
                },
                preferredCountries: ['eg', 'sa', 'ae', 'kw'],
                hiddenInput:()=>({ phone: "full_phone" }), 
            });

            registerForm.addEventListener('submit', function(e) {
                if (!iti.isValidNumber()) {
                    e.preventDefault();
                    alert("Please enter a valid phone number");
                }
            });
        };

        const checkIti = setInterval(() => {
            if (window.intlTelInput) {
                clearInterval(checkIti);
                initRegisterIti();
            }
        }, 50);
    });
</script>
</x-app-layout>