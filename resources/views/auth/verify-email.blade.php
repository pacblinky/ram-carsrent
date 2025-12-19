<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-[calc(100vh-80px)]">
            <div class="w-full bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:max-w-md p-6 sm:p-8 border dark:border-gray-700">
                <h2 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-3xl dark:text-white mb-6">
                    {{ __('auth_pages.verify_email_title') }}
                </h2>

                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('auth_pages.verify_email_code_sent') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('auth_pages.verification_code_status') }}
                    </div>
                @endif

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

                <div class="mt-6 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('auth_pages.resend_code_button') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('auth_pages.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>