{{-- resources/views/layouts/footer.blade.php --}}

{{-- 
    PROFESSIONAL FOOTER DESIGN:
    - Dark background (bg-black) for premium feel
    - Full-width responsive layout
    - Fixed logo display with proper sizing
    - Organized links into "Resources" and "Legal" columns
    - Copyright and social media in separate bottom bar
--}}

<footer class="bg-black dark:bg-black">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
            
            {{-- Logo and Company Name (Main Section) --}}
            <div class="mb-6 md:mb-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                    {{-- 
                      FIXED FOOTER LOGO:
                      - Mobile: h-10 w-auto (40px height)
                      - Desktop (md): h-12 w-auto (48px height)
                      - object-contain to show full logo without cropping
                      - Proper alignment with company name
                    --}}
                    <img src="{{ asset('images/logo.png') }}" 
                         class="h-10 w-auto md:h-12 lg:h-14 object-contain" 
                         alt="{{ __('footer.company_name') }} Logo" />
                    <span class="self-center text-xl md:text-2xl font-semibold whitespace-nowrap text-white dark:text-white">{{ __('footer.company_name') }}</span>
                </a>
            </div>
            
            {{-- Link Columns --}}
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-2">
                {{-- Resources Links --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-100 uppercase dark:text-white">{{ __('footer.resources_links') }}</h2>
                    <ul class="text-gray-400 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="{{ route('cars.index') }}" class="hover:underline">{{ __('footer.cars') }}</a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('about') }}" class="hover:underline">{{ __('footer.about') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('contact.index') }}" class="hover:underline">{{ __('footer.contact') }}</a>
                        </li>
                    </ul>
                </div>
                
                {{-- Legal Links --}}
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-100 uppercase dark:text-white">{{ __('footer.legal_links') }}</h2>
                    <ul class="text-gray-400 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="{{ route('privacy.index') }}" class="hover:underline">{{ __('footer.privacy_policy') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('terms.index') }}" class="hover:underline">{{ __('footer.terms') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <hr class="my-6 border-gray-600 sm:mx-auto dark:border-gray-700 lg:my-8" />
        
        {{-- Bottom Bar: Copyright & Socials --}}
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-400 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a href="{{ route('home') }}" class="hover:underline">{{ __('footer.company_name') }}™</a>. {{ __('footer.copyright') }}
            </span>
            <div class="flex mt-4 sm:justify-center sm:mt-0 space-x-5 rtl:space-x-reverse">
                <a href="#" class="text-gray-400 hover:text-white dark:hover:text-white" aria-label="Facebook page">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V4.142A1.14 1.14 0 0 1 6.135 3Z" clip-rule="evenodd"/>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white dark:hover:text-white" aria-label="Instagram profile">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 21">
                        <path fill-rule="evenodd" d="M10.034 1.25a8.78 8.78 0 0 1 8.78 8.78c0 2.846-1.42 5.36-3.568 6.868A8.78 8.78 0 0 1 10.034 18.78a8.78 8.78 0 0 1-8.78-8.78c0-2.846 1.42-5.36 3.568-6.868A8.78 8.78 0 0 1 10.034 1.25ZM5.06 5.06a.75.75 0 0 1 .75-.75h8.378a.75.75 0 0 1 .75.75v8.378a.75.75 0 0 1-.75.75H5.81a.75.75 0 0 1-.75-.75V5.06Zm2.57 2.57a.75.75 0 0 1 .75-.75h3.15a.75.75 0 0 1 .75.75v3.15a.75.75 0 0 1-.75.75h-3.15a.75.75 0 0 1-.75-.75V7.63Zm1.5 1.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Z" clip-rule="evenodd"/>
                        <path d="M10.034 5.333a4.7 4.7 0 1 0 0 9.4 4.7 4.7 0 0 0 0-9.4Zm0 7.9a3.2 3.2 0 1 1 0-6.4 3.2 3.2 0 0 1 0 6.4Z"/>
                    </svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-white dark:hover:text-white" aria-label="Twitter page">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                        <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.3 1.3a4.12 4.12 0 0 0 1.27 5.479A4.07 4.07 0 0 1 .4 6.084v.05a4.068 4.068 0 0 0 3.282 3.982 4.09 4.09 0 0 1-1.853.07 4.068 4.068 0 0 0 3.794 2.817 8.18 8.18 0 0 1-5.058 1.71c-.32 0-.63-.016-.94-.052A11.647 11.647 0 0 0 6.29 16c7.552 0 11.683-6.143 11.683-11.536 0-.174 0-.347-.012-.52A8.349 8.349 0 0 0 20 1.892Z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>