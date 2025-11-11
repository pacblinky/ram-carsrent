<x-app-layout>

    {{-- 
      - @php block is no longer needed.
      - We will use 'text-start' which is RTL/LTR aware.
    --}}

    <div class="py-12">
        {{--
          - CHANGED: Added 'px-4' for mobile padding.
        --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">

                    {{-- 
                      - BEST PRACTICE: Removed inline 'style' attribute.
                      - Added 'text-start', which handles LTR/RTL alignment automatically
                        (assuming 'dir' is set on your <html> tag).
                    --}}
                    <article class="max-w-none text-start">
                        
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100">
                            {{ __('terms.title') }}
                        </h1>
                        
                        <p class="text-lg text-gray-600 dark:text-gray-400 mt-2 mb-8">
                            {{ __('terms.last_updated', ['date' => now()->format('Y-m-d')]) }}
                        </p>

                        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
                            {{ __('terms.intro') }}
                        </p>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('terms.accept_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300">
                            {{ __('terms.accept_text') }}
                        </p>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('terms.account_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300">
                            {{ __('terms.account_text') }}
                        </p>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('terms.reservation_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300">
                            {{ __('terms.reservation_text') }}
                        </p>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('terms.cancel_title') }}
                        </h2>
                        {{-- 
                          List: 
                          - 'ps-5' (padding-start) correctly handles LTR/RTL.
                          - BEST PRACTICE: Added 'list-inside' for better alignment.
                        --}}
                        <ul class="list-disc list-inside space-y-2 ps-5 text-base text-gray-700 dark:text-gray-300">
                            <li>{{ __('terms.cancel_1') }}</li>
                            <li>{{ __('terms.cancel_2') }}</li>
                            <li>{{ __('terms.cancel_3') }}</li>
                        </ul>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('terms.renter_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mb-4">
                            {{ __('terms.renter_intro') }}
                        </p>
                        <ul class="list-disc list-inside space-y-2 ps-5 text-base text-gray-700 dark:text-gray-300 mb-4">
                            <li>{{ __('terms.renter_1') }}</li>
                            <li>{{ __('terms.renter_2') }}</li>
                            <li>{{ __('terms.renter_3') }}</li>
                        </ul>
                        <p class="text-base text-gray-700 dark:text-gray-300">
                            {{ __('terms.renter_text') }}
                        </p>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('terms.liability_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300">
                            {{ __('terms.liability_text') }}
                        </p>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('terms.law_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300">
                            {{ __('terms.law_text') }}
                        </p>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('terms.changes_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300">
                            {{ __('terms.changes_text') }}
                        </p>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('terms.contact_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300">
                            {{ __('terms.contact_text') }}
                        </p>

                    </article>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>