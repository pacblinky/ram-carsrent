<x-app-layout>
<section class="bg-gray-50 dark:bg-gray-900">
        <div class="w-full bg-white shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex">
                <div class="w-full p-6 space-y-4 md:space-y-6 sm:p-8 max-w-md mx-auto lg:mx-0 lg:max-w-none lg:w-1/2">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Welcome back
                    </h1>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Don't have an account? <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>.
                    </p>

                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('email') border-red-500 dark:border-red-500 @enderror"
                                   placeholder="name@company.com" required="" autocomplete="username" value="{{ old('email') }}">
                            
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') border-red-500 dark:border-red-500 @enderror"
                                   placeholder="••••••••" required="" autocomplete="current-password">

                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" name="remember" aria-describedby="remember" type="checkbox"
                                           class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                            @endif
                        </div>

                        <button type="submit"
                                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Sign in to your account
                        </button>

                        <div class="flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                            <div class="px-3 text-center text-gray-500 dark:text-gray-400">or</div>
                            <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                        </div>

                        <div class="space-y-3">
                            <a href="#"
                               class="inline-flex items-center justify-center w-full px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                    <path fill="currentColor" d="M488 261.8C488 403.3 381.5 512 244 512 110.3 512 0 401.7 0 256S110.3 0 244 0c69.8 0 133.1 28.2 177.2 73.4l-62.9 62.9C337 110.5 293.7 88.8 244 88.8 155.6 88.8 85.5 158.4 85.5 256s70.1 167.2 158.5 167.2c86.3 0 133.3-64.5 139-101.4H244v-81.8h236.1c2.3 12.7 3.9 26.4 3.9 41.4z"></path>
                                </svg>
                                Sign in with Google
                            </a>
                            <a href="#"
                               class="inline-flex items-center justify-center w-full px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="apple" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                    <path fill="currentColor" d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C39.2 141.6 0 184.8 0 249.4c0 103.1 81.1 191.5 195.1 191.5 40.2 0 77.9-18.4 97.4-44.7-20.7-13.4-33.4-34.9-33.4-58.1zM192 64C217.6 64 239 42.6 239 16S217.6 0 192 0 145 21.4 145 48s21.4 16 47 16z"></ssoGgn>
Something is wrong with this ssoGgn tag</path>
                                </svg>
                                Sign in with Apple
                            </a>
                        </div>
                    </form>
                </div>

                <div class="hidden lg:flex lg:w-1/2">
                    <img src="{{ asset('images/car.png') }}" alt="Login Illustration" class="object-cover w-full h-full">
                </div>
            </div>
        </div>
    </div>
</section>
</x-app-layout>