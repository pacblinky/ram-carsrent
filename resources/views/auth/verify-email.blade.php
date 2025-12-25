<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900 min-h-[calc(100vh-80px)] flex flex-col justify-center items-center p-6">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700 overflow-hidden">
            
            {{-- Header --}}
            <div class="p-6 sm:p-8 text-center border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                <div class="mx-auto w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('auth_pages.verify_email_title') }}
                </h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('auth_pages.verify_email_code_sent') }}
                </p>
            </div>

            <div class="p-6 sm:p-8 space-y-6">
                {{-- Status Message --}}
                @if (session('status') == 'verification-link-sent')
                    <div class="p-4 text-sm font-medium text-green-800 rounded-lg bg-green-50 dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-800 flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ __('auth_pages.verification_code_status') }}</span>
                    </div>
                @endif

                {{-- Verification Code Form --}}
                <form method="POST" action="{{ route('verification.verify') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="code" :value="__('auth_pages.verification_code_label')" class="text-center mb-2 text-base" />
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11.536 17.05a1 1 0 01-.137.137l-.804.804a1 1 0 01-.707.293h-1.414a1 1 0 01-.707-.293l-1.414-1.414a1 1 0 01-.293-.707V15a1 1 0 01.293-.707l.804-.804a1 1 0 01.137-.137l.478-.478A6 6 0 0115 9.171V7z"></path>
                                </svg>
                            </div>
                            <input id="code" type="text" name="code" required autofocus 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-12 p-3 tracking-[0.25em] text-center dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-all duration-200" 
                                placeholder="123456" maxlength="6">
                        </div>
                        <x-input-error :messages="$errors->get('code')" class="mt-2 text-center" />
                    </div>

                    <x-primary-button class="w-full justify-center py-3 text-base">
                        {{ __('auth_pages.verify_button') }}
                    </x-primary-button>
                </form>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-gray-800 text-gray-500">
                            {{ __('auth_pages.or_update_email') }}
                        </span>
                    </div>
                </div>

                {{-- Resend / Update Email Form with AlpineJS Timer --}}
                <form 
                    method="POST" 
                    action="{{ route('verification.send') }}" 
                    class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 space-y-3"
                    x-data="resendTimer"
                    x-init="initTimer"
                    {{-- Pass the session status to JS via data attribute --}}
                    data-status="{{ session('status') == 'verification-link-sent' ? 'sent' : '' }}"
                >
                    @csrf
                    
                    <div>
                        <label for="email" class="block mb-2 text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                            {{ __('auth_pages.email') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 16">
                                    <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                    <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        {{-- Resend Button with Logic --}}
                        <button 
                            type="submit" 
                            :disabled="timeLeft > 0"
                            :class="{ 'opacity-50 cursor-not-allowed': timeLeft > 0, 'hover:underline hover:text-blue-500': timeLeft <= 0 }"
                            class="text-sm font-medium text-blue-600 dark:text-blue-400 focus:outline-none transition-colors duration-200"
                        >
                            <span x-show="timeLeft === 0">{{ __('auth_pages.resend_code_button') }}</span>
                            <span x-show="timeLeft > 0" x-text="'{{ __('auth_pages.resend_in_seconds') }}'.replace(':seconds', timeLeft)"></span>
                        </button>

                        <button form="logout-form" type="submit" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors duration-200">
                            {{ __('auth_pages.logout') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Hidden Logout Form --}}
    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
        @csrf
    </form>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('resendTimer', () => ({
                timeLeft: 0,
                timer: null,
                initTimer() {
                    const status = this.$el.dataset.status;
                    const COOLDOWN_SECONDS = 60; // Set cooldown duration

                    // 1. Check if we just successfully resent the code
                    if (status === 'sent') {
                        this.startTimer(COOLDOWN_SECONDS);
                    } 
                    // 2. Otherwise, check localStorage for an existing timer
                    else {
                        const endTime = localStorage.getItem('resend_timer_end');
                        if (endTime) {
                            const now = Date.now();
                            const remaining = Math.ceil((parseInt(endTime) - now) / 1000);
                            
                            if (remaining > 0) {
                                this.startTimer(remaining);
                            } else {
                                localStorage.removeItem('resend_timer_end');
                            }
                        }
                    }
                },
                startTimer(seconds) {
                    this.timeLeft = seconds;
                    const now = Date.now();
                    const endTime = now + (seconds * 1000);
                    
                    // Only update localStorage if we are starting a fresh timer or extending
                    localStorage.setItem('resend_timer_end', endTime);

                    if (this.timer) clearInterval(this.timer);

                    this.timer = setInterval(() => {
                        this.timeLeft--;
                        if (this.timeLeft <= 0) {
                            clearInterval(this.timer);
                            this.timeLeft = 0;
                            localStorage.removeItem('resend_timer_end');
                        }
                    }, 1000);
                }
            }))
        })
    </script>
</x-app-layout>