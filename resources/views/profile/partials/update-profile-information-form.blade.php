<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9.05 14.5h1.9a3.987 3.987 0 0 1 3.951 2.012A8.949 8.949 0 0 1 10 18Z"/>
                    </svg>
                </div>
                <x-text-input id="name" name="name" type="text" class="block w-full ps-10" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
             <div class="relative mt-1">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                     <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                    </svg>
                </div>
                <x-text-input id="email" name="email" type="email" class="block w-full ps-10" :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Phone Number --}}
        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
             <div class="relative mt-1">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="M19.4 4.012a2.012 2.012 0 0 0-1.412-1.412 2.032 2.032 0 0 0-1.413-.58H3.426a2.032 2.032 0 0 0-1.413.58 2.012 2.012 0 0 0-1.412 1.412 2.032 2.032 0 0 0-.58 1.413v6.15a2.032 2.032 0 0 0 .58 1.413 2.012 2.012 0 0 0 1.412 1.412 2.032 2.032 0 0 0 1.413.58h13.148a2.032 2.032 0 0 0 1.413-.58 2.012 2.012 0 0 0 1.412-1.412 2.032 2.032 0 0 0 .58-1.413v-6.15a2.032 2.032 0 0 0-.58-1.413ZM3.426 14a.032.032 0 0 1-.03-.03V6.043c.01-.01.02-.02.03-.03h13.148c.01 0 .02.02.03.03v7.927a.032.032 0 0 1-.03.03H3.426Zm6.574-3.526a.5.5 0 0 1-.707 0L6.4 7.586a.5.5 0 1 1 .707-.707L9.5 9.279l2.386-2.386a.5.5 0 0 1 .707.707l-2.693 2.693Z"/>
                    </svg>
                </div>
                <x-text-input id="phone_number" name="phone_number" type="tel" class="block w-full ps-10" :value="old('phone_number', $user->phone_number)" autocomplete="tel" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        {{-- Government ID --}}
        <div>
            <x-input-label for="government_id" :value="__('Government ID')" />
             <div class="relative mt-1">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                   <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 0H2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM5 16V4h10v12H5ZM14 7h-4v1h4V7Zm0 3h-4v1h4v-1Zm-2 3h-2v1h2v-1Z"/>
                   </svg>
                </div>
                <x-text-input id="government_id" name="government_id" type="text" class="block w-full ps-10" :value="old('government_id', $user->government_id)" autocomplete="off" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('government_id')" />
        </div>

        {{-- Save Button --}}
        <div class="flex items-center gap-4">
            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800 transition-all duration-200 ease-in-out">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>