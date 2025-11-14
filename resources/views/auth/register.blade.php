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
                            $inputClasses = 'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 text-start placeholder:text-start dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';
                            $errorClasses = 'border-red-500 dark:border-red-500';
                        @endphp

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.name') }}</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="{{ __('auth_pages.name_placeholder') }}"
                                   class="{{ $inputClasses }} @error('name') {{ $errorClasses }} @enderror">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.email') }}</label>
                            <input required type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="{{ __('auth_pages.email_placeholder') }}"
                                   class="{{ $inputClasses }} @error('email') {{ $errorClasses }} @enderror">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div>
                            <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.phone_number') }}</label>
                            <input required type="tel" id="phone_number" name="phone_number"
                                   value="{{ old('phone_number') }}" required autocomplete="tel"
                                   class="{{ $inputClasses }} @error('phone_number') {{ $errorClasses }} @enderror text-start">
                            @error('phone_number')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Government ID --}}
                        <div>
                            <label for="government_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.government_id') }}</label>
                            <input required type="text" id="government_id" name="government_id" value="{{ old('government_id') }}" required autocomplete="government-id" placeholder="{{ __('auth_pages.government_id_placeholder') }}"
                                class="{{ $inputClasses }} @error('government_id') {{ $errorClasses }} @enderror">
                            @error('government_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.password') }}</label>
                            <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="{{ __('auth_pages.password_placeholder') }}"
                                   class="{{ $inputClasses }} @error('password') {{ $errorClasses }} @enderror">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.confirm_password') }}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('auth_pages.password_placeholder') }}"
                                   class="{{ $inputClasses }}">
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
            // Animate form and image on load
            setTimeout(() => {
                document.getElementById('register-form-container').classList.remove('opacity-0', 'translate-y-5');
                document.getElementById('register-image-container').classList.remove('opacity-0');
            }, 100);

            // Initialize intl-tel-input without utils.js
            const phoneInput = document.querySelector("#phone_number");
            const registerForm = document.getElementById("register-form");

            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "auto",
                geoIpLookup: callback => {
                    fetch("https://ipapi.co/json")
                        .then(res => res.json())
                        .then(data => callback(data.country_code))
                        .catch(() => callback("us"));
                },
                separateDialCode: true,
                preferredCountries: ['eg', 'sa', 'us', 'gb'],
            });

            // Custom validation and formatting
            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();

                let phoneNumber = phoneInput.value.trim();

                // Basic validation: digits only, 8-15 characters
                if (!phoneNumber.match(/^\d{8,15}$/)) {
                    alert("Please enter a valid phone number");
                    return;
                }

                // Append selected country code
                const dialCode = iti.getSelectedCountryData().dialCode;
                phoneInput.value = `+${dialCode}${phoneNumber.replace(/^0+/, '')}`;

                this.submit();
            });
        });
    </script>
</x-app-layout>