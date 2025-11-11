<x-app-layout>

    @php
        $isArabic = app()->getLocale() === 'ar';
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900 dark:text-gray-100">

                    <article 
                        class="max-w-none"
                        style="text-align: {{ $isArabic ? 'right' : 'left' }};">
                        
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100">
                            {{ __('privacy.title') }}
                        </h1>
                        
                        <p class="text-lg text-gray-600 dark:text-gray-400 mt-2 mb-8">
                            {{ __('privacy.last_updated', ['date' => now()->format('Y-m-d')]) }}
                        </p>

                        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
                            {{ __('privacy.intro') }}
                        </p>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('privacy.info_we_collect_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mb-4">
                            {{ __('privacy.info_we_collect_text') }}
                        </p>
                        <ul class="list-disc space-y-2 ps-5 text-base text-gray-700 dark:text-gray-300 mb-6">
                            <li>{{ __('privacy.info_we_collect_1') }}</li>
                            <li>{{ __('privacy.info_we_collect_2') }}</li>
                            <li>{{ __('privacy.info_we_collect_3') }}</li>
                        </ul>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('privacy.how_we_use_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mb-4">
                            {{ __('privacy.how_we_use_text') }}
                        </p>
                        <ul class="list-disc space-y-2 ps-5 text-base text-gray-700 dark:text-gray-300 mb-6">
                            <li>{{ __('privacy.how_we_use_1') }}</li>
                            <li>{{ __('privacy.how_we_use_2') }}</li>
                            <li>{{ __('privacy.how_we_use_3') }}</li>
                        </ul>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('privacy.security_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
                            {{ __('privacy.security_text') }}
                        </p>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('privacy.changes_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mb-6">
                            {{ __('privacy.changes_text') }}
                        </p>

                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700 mb-4">
                            {{ __('privacy.contact_title') }}
                        </h2>
                        <p class="text-base text-gray-700 dark:text-gray-300">
                            {{ __('privacy.contact_text') }}
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>