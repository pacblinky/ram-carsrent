<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-[calc(100vh-80px)]">
            <div class="w-full bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:max-w-md p-6 sm:p-8 border dark:border-gray-700">
                
                {{-- ... Title and Text ... --}}
                <h2 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-3xl dark:text-white mb-6">
                    {{ __('auth_pages.verify_email_title') }}
                </h2>

                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('auth_pages.verify_email_code_sent') }} <br>
                    <span class="font-semibold text-blue-600 dark:text-blue-400">{{ Auth::user()->email }}</span>
                </div>

                {{-- ... Status Message ... --}}

                <form method="POST" action="{{ route('verification.verify') }}">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="code" :value="__('auth_pages.verification_code_label')" />
                        <x-text-input id="code" class="block mt-1 w-full text-center tracking-widest text-xl" type="text" name="code" required autofocus />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-primary-button class="w-full justify-center">
                            {{ __('auth_pages.verify_button') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-6 flex flex-col gap-4">
                    
                    {{-- Action Links Row --}}
                    <div class="flex items-center justify-between text-sm">
                        {{-- Resend Code --}}
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                {{ __('auth_pages.resend_code_button') }}
                            </button>
                        </form>

                        {{-- Log Out --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                {{ __('auth_pages.logout') }}
                            </button>
                        </form>
                    </div>

                    {{-- Change Email Button (New) --}}
                    <div class="text-center pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('profile.edit') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                            {{ __('auth_pages.change_email_button') }} &rarr;
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-app-layout>