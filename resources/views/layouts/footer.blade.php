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
                            <a href="{{ route('privacy') }}" class="hover:underline">{{ __('footer.privacy_policy') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('terms') }}" class="hover:underline">{{ __('footer.terms') }}</a>
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
                <a href="https://www.tiktok.com/@.ram_rent_a_car" class="text-gray-400 hover:text-white dark:hover:text-white" aria-label="TikTok page">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 448 512">
                        <path d="M448 209.91a210.06 210.06 0 0 1-122.77-39.25V349.38A162.55 162.55 0 1 1 185 188.31V278.2a74.62 74.62 0 1 0 52.23 71.18V0h88a121.18 121.18 0 0 0 1.86 22.17A122.18 122.18 0 0 0 381 102.39a121.43 121.43 0 0 0 67 20.14Z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>