<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profile_page.profile_info_title') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("profile_page.profile_info_desc") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="mt-6 space-y-6"
    >
        @csrf
        @method('patch')

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('profile_page.name')" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9.05 14.5h1.9a3.987 3.987 0 0 1 3.951 2.012A8.949 8.949 0 0 1 10 18Z"/>
                    </svg>
                </div>
                <x-text-input id="name" name="name" type="text" class="block w-full ps-10 text-start" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('profile_page.email')" />
             <div class="relative mt-2">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                     <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                    </svg>
                </div>
                <x-text-input id="email" name="email" type="email" class="block w-full ps-10 text-start" :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('profile_page.unverified_email') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                            {{ __('profile_page.resend_verification') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('profile_page.verification_sent') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Phone Number --}}
        <div>
            <x-input-label for="phone_number_profile" :value="__('profile_page.phone_number')" />
            <div class="mt-2">
                {{-- Added opacity-0 to hide input until JS initializes it to prevent FOUC --}}
                <input required type="tel" id="phone_number_profile" name="phone_number"
                    value="{{ old('phone_number', $user->phone_number) }}" required autocomplete="tel"
                    class="opacity-0 transition-opacity duration-500 ease-in-out bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 text-start placeholder:text-start dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        {{-- Government ID --}}
        <div>
            <x-input-label for="government_id" :value="__('profile_page.government_id')" />
             <div class="relative mt-2">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                   <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 0H2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM5 16V4h10v12H5ZM14 7h-4v1h4V7Zm0 3h-4v1h4v-1Zm-2 3h-2v1h2v-1Z"/>
                   </svg>
                </div>
                <x-text-input id="government_id" name="government_id" type="text" class="block w-full ps-10 text-start" :value="old('government_id', $user->government_id)" autocomplete="off" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('government_id')" />
        </div>

        {{-- Save Button --}}
        <div class="flex items-center gap-4">
            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800 transition-all duration-200 ease-in-out">
                {{ __('profile_page.save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('profile_page.saved') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const phoneInputProfile = document.querySelector("#phone_number_profile");
    // Find the closest form to the input
    const profileForm = phoneInputProfile ? phoneInputProfile.closest('form') : null;

    const initProfileIti = () => {
        if (!phoneInputProfile || !profileForm) return;

        const iti = window.intlTelInput(phoneInputProfile, {
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
        
        // Remove opacity-0 once initialized to reveal the formatted input
        phoneInputProfile.classList.remove('opacity-0');

        profileForm.addEventListener('submit', function(e) {
            if (!iti.isValidNumber()) {
                e.preventDefault();
                alert("Please enter a valid phone number");
            }
        });
    };

    const checkIti = setInterval(() => {
        if (window.intlTelInput) {
            clearInterval(checkIti);
            initProfileIti();
        }
    }, 50);
});
</script>