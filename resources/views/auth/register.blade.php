<x-app-layout>
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex min-h-[calc(100vh-80px)]"> {{-- Adjust 80px if your navbar height is different --}}
        
        {{-- Form Section (Left) --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 transition-all duration-1000 ease-out opacity-0 translate-y-5" id="register-form-container">
            <div class="w-full max-w-md">
                <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-3xl dark:text-white mb-4">
                    Create an Account
                </h1>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400 mb-6">
                    Already have an account? <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Sign in</a>.
                </p>

                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9.05 14.5h1.9a3.987 3.987 0 0 1 3.951 2.012A8.949 8.949 0 0 1 10 18Z"/>
                                </svg>
                            </div>
                            <x-text-input id="name" name="name" type="text" class="block w-full ps-10" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                    <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                </svg>
                            </div>
                            <x-text-input id="email" name="email" type="email" class="block w-full ps-10" :value="old('email')" required autocomplete="username" placeholder="name@company.com" />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    
                    {{-- Phone Number --}}
                    <div>
                        <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path d="M19.4 4.012a2.012 2.012 0 0 0-1.412-1.412 2.032 2.032 0 0 0-1.413-.58H3.426a2.032 2.032 0 0 0-1.413.58 2.012 2.012 0 0 0-1.412 1.412 2.032 2.032 0 0 0-.58 1.413v6.15a2.032 2.032 0 0 0 .58 1.413 2.012 2.012 0 0 0 1.412 1.412 2.032 2.032 0 0 0 1.413.58h13.148a2.032 2.032 0 0 0 1.413-.58 2.012 2.012 0 0 0 1.412-1.412 2.032 2.032 0 0 0 .58-1.413v-6.15a2.032 2.032 0 0 0-.58-1.413ZM3.426 14a.032.032 0 0 1-.03-.03V6.043c.01-.01.02-.02.03-.03h13.148c.01 0 .02.02.03.03v7.927a.032.032 0 0 1-.03.03H3.426Zm6.574-3.526a.5.5 0 0 1-.707 0L6.4 7.586a.5.5 0 1 1 .707-.707L9.5 9.279l2.386-2.386a.5.5 0 0 1 .707.707l-2.693 2.693Z"/>
                                </svg>
                            </div>
                            <x-text-input id="phone_number" name="phone_number" type="tel" class="block w-full ps-10" :value="old('phone_number')" required autocomplete="tel" placeholder="+1234567890" />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                    </div>

                    {{-- Government ID --}}
                    <div>
                        <label for="government_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Government ID</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                               <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M18 0H2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM5 16V4h10v12H5ZM14 7h-4v1h4V7Zm0 3h-4v1h4v-1Zm-2 3h-2v1h2v-1Z"/>
                               </svg>
                            </div>
                            <x-text-input id="government_id" name="government_id" type="text" class="block w-full ps-10" :value="old('government_id')" required autocomplete="off" placeholder="National ID or Passport No." />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('government_id')" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="relative">
                             <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8V4.5a3 3 0 1 0-6 0V7h6Z"/>
                                </svg>
                            </div>
                            <x-text-input id="password" class="block w-full ps-10" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                        <div class="relative">
                             <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8V4.5a3 3 0 1 0-6 0V7h6Z"/>
                                </svg>
                            </div>
                            <x-text-input id="password_confirmation" class="block w-full ps-10" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200 ease-in-out">
                        Create account
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