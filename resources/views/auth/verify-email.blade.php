<x-app-layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-[calc(100vh-80px)]">
            {{-- Auth Card --}}
            <div class="w-full bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:max-w-md p-6 sm:p-8 border dark:border-gray-700">
                <h2 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-3xl dark:text-white mb-6">
                    {{ __('auth_pages.verify_email_title') }}
                </h2>

                @if (session('status') == 'verification-link-sent')
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        {{ __('auth_pages.verification_sent') }}
                    </div>
                @endif

                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    {{ __('auth_pages.verify_email_text_1') }} {{ __('auth_pages.verify_email_text_2') }}
                </p>

                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200 ease-in-out">
                            {{ __('auth_pages.resend_verification') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="text-center">
                        @csrf
                        <button type="submit" class="w-full text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700 transition-all">
                            {{ __('auth_pages.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>