<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex min-h-[calc(100vh-80px)]"> {{-- Adjust 80px if your navbar height is different --}}
            
            {{-- Form Section (Left) --}}
            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 transition-all duration-1000 ease-out opacity-0 translate-y-5" id="register-form-container">
                <div class="w-full max-w-md">
                    <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-3xl dark:text-white mb-4">
                        {{ __('auth_pages.register_title') }}
                    </h1>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400 mb-6">
                        {{ __('auth_pages.already_registered') }} <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">{{ __('auth_pages.login') }}</a>.
                    </p>
    
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                        @csrf
    
                        {{-- Base input classes --}}
                        @php
                            // UPDATED: Added 'placeholder:text-start' to align the placeholder
                            $inputClasses = 'bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 text-start placeholder:text-start dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';
                            $errorClasses = 'border-red-500 dark:border-red-500';
                        @endphp
    
                        {{-- Name --}}
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('auth_pages.name') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9.05 14.5h1.9a3.987 3.987 0 0 1 3.951 2.012A8.949 8.949 0 0 1 10 18Z"/>
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
                                 <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="{{ __('auth_pages.email_placeholder') }}"
                                       class="{{ $inputClasses }} @error('email') {{ $errorClasses }} @enderror">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Phone Number --}}
                        <div>
                            <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('auth_pages.phone_number') }}
                            </label>

                            <div class="relative">
                                {{-- Icon --}}
                                <div class="absolute inset-y-0 flex items-center pointer-events-none ltr:left-3 rtl:right-3">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M15.992 11.285c-1.28 0-2.514.2-3.693.606a.75.75 0 0 1-.88-.09l-1.42-1.14a13.4 13.4 0 0 0-4.99-4.99l-1.14-1.42a.75.75 0 0 1-.09-.88c.402-1.178.605-2.412.605-3.693a.75.75 0 0 0-.75-.75H1.75a.75.75 0 0 0-.75.75c0 9.808 7.942 17.75 17.75 17.75a.75.75 0 0 0 .75-.75v-2.344a.75.75 0 0 0-.75-.75Z" />
                                    </svg>
                                </div>

                                {{-- Input --}}
                                <input dir="auto" type="tel" id="phone_number" name="phone_number"
                                    value="{{ old('phone_number') }}" required autocomplete="tel"
                                    placeholder="{{ __('auth_pages.phone_placeholder') }}"
                                    class="{{ $inputClasses }} @error('phone_number') {{ $errorClasses }} @enderror ltr:pl-10 rtl:pr-10 ltr:text-left rtl:text-right">
                            </div>

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
                                        <path d="M18 0H2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM5 16V4h10v12H5ZM14 7h-4v1h4V7Zm0 3h-4v1h4v-1Zm-2 3h-2v1h2v-1Z"/>
                                   </svg>
                                </div>
                                <input type="text" id="government_id" name="government_id" value="{{ old('government_id') }}" required autocomplete="off" placeholder="{{ __('auth_pages.government_id_placeholder') }}"
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
                                       class="{{ $inputClasses }} @error('password') {{ $errorClasses }} @enderror">
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
                                       class="{{ $inputClasses }}">
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
        // Simple load-in animation
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const form = document.getElementById('register-form-container');
                const image = document.getElementById('register-image-container');
                if(form) form.classList.remove('opacity-0', 'translate-y-5');
                if(image) image.classList.remove('opacity-0');
            }, 100);
        });
    </script>
</x-app-layout>