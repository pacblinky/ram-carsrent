<x-app-layout>

    @php
        $isArabic = app()->getLocale() === 'ar';
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">

                    <!-- 
                      - Removed 'prose' class to apply custom, more specific styles.
                      - Added 'dir' attribute for better LTR/RTL support with utilities like 'ps-5'.
                      - The 'style' attribute handles text alignment.
                    -->
                    <article 
                        class="max-w-none" 
                        style="text-align: {{ $isArabic ? 'right' : 'left' }};">
                        
                        <!-- Main Title: Made larger and extra-bold -->
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100">
                            {{ __('terms.title') }}
                        </h1>
                        
                        <!-- Lead Paragraph: Styled for emphasis with a softer color and margin -->
                        <p class="text-lg text-gray-600 dark:text-gray-400 mt-2 mb-8">
                            {{ __('terms.last_updated', ['date' => now()->format('Y-m-d')]) }}
                        </p>

                        <!-- Standard Paragraph: Base styling for readability -->
                        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
                            {{ __('terms.intro') }}
                        </p>

                        <!-- 
                          Section Heading: 
                          - Made bold, larger, with generous top margin for spacing.
                          - Added a border-top for a clean, professional separation between sections.
                        -->
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
                        <!-- 
                          List: 
                          - Used 'ps-5' (padding-start) which safely handles both LTR and RTL.
                          - Added 'space-y-2' for vertical spacing between list items.
                        -->
                        <ul class="list-disc space-y-2 ps-5 text-base text-gray-700 dark:text-gray-300">
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
                        <ul class="list-disc space-y-2 ps-5 text-base text-gray-700 dark:text-gray-300 mb-4">
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