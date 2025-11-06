<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-8 lg:py-10">
        <div class="md:flex md:justify-between">
          <div class="mb-8 md:mb-0 max-w-sm">
              <a href="{{ route('home') }}" class="flex items-center mb-4">
                   <svg class="w-8 h-8 mr-3 text-blue-700 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-6 0H6a2.25 2.25 0 01-2.25-2.25V6a2.25 2.25 0 012.25-2.25h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-.75.75h-1.5a2.25 2.25 0 00-2.25 2.25v.75m6-6h6m-6 0v6m6-6v6m0 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-6 0H6a2.25 2.25 0 01-2.25-2.25V6a2.25 2.25 0 012.25-2.25h1.5a.75.75 0 01.75.75v5.25a.75.75 0 01-.75.75h-1.5a2.25 2.25 0 00-2.25 2.25v.75m6-6h6m-6 0v6m6-6v6m0 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6" />
                  </svg>
                  <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Ram | Car Rental</span>
              </a>
              <p class="text-gray-500 dark:text-gray-400">
                  Experience the freedom of the road with our premium car rental services. Reliable, affordable, and always ready for your next adventure.
              </p>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Quick Links</h2>
                  <ul class="text-gray-600 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="{{ route('home') }}" class="hover:underline hover:text-blue-600 dark:hover:text-blue-500 transition-colors">Home</a>
                      </li>
                      <li class="mb-4">
                          <a href="{{ route('cars.index') }}" class="hover:underline hover:text-blue-600 dark:hover:text-blue-500 transition-colors">Vehicle Fleet</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline hover:text-blue-600 dark:hover:text-blue-500 transition-colors">About Us</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Support</h2>
                  <ul class="text-gray-600 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="#" class="hover:underline hover:text-blue-600 dark:hover:text-blue-500 transition-colors">Contact Us</a>
                      </li>
                      <li class="mb-4">
                          <a href="#" class="hover:underline hover:text-blue-600 dark:hover:text-blue-500 transition-colors">FAQs</a>
                      </li>
                       <li>
                          <a href="#" class="hover:underline hover:text-blue-600 dark:hover:text-blue-500 transition-colors">Help Center</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                  <ul class="text-gray-600 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="#" class="hover:underline hover:text-blue-600 dark:hover:text-blue-500 transition-colors">Privacy Policy</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline hover:text-blue-600 dark:hover:text-blue-500 transition-colors">Terms &amp; Conditions</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a href="{{ route('home') }}" class="hover:underline hover:text-blue-600 dark:hover:text-blue-500 transition-colors">Ram Car Rental™</a>. All Rights Reserved.
          </span>
          <div class="flex mt-4 sm:justify-center sm:mt-0 space-x-5 rtl:space-x-reverse">
              <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                    </svg>
                  <span class="sr-only">Facebook page</span>
              </a>
              <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l6.933 10.19L1 20.994h3.066l5.395-6.507 4.715 6.506h6.69l-7.07-10.46zm-2.382 2.954-.305-.436-6.564-9.418h2.441l5.384 7.721.306.436 7.288 10.454h-2.442l-6.108-8.757z"/>
                    </svg>
                  <span class="sr-only">Twitter</span>
              </a>
              <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 0 1 1.772 1.153 4.902 4.902 0 0 1 1.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 0 1-1.153 1.772 4.902 4.902 0 0 1-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 0 1-1.772-1.153 4.902 4.902 0 0 1-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 0 1 1.153-1.772A4.902 4.902 0 0 1 5.451 2.52c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 0 0-.748-1.15 3.098 3.098 0 0 0-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 1 1 0 10.27 5.135 5.135 0 0 1 0-10.27zm0 1.802a3.333 3.333 0 1 0 0 6.666 3.333 3.333 0 0 0 0-6.666zm5.338-3.205a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4z" clip-rule="evenodd"/>
                  </svg>
                  <span class="sr-only">Instagram</span>
              </a>
               <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12.51 8.796v1.697a3.738 3.738 0 0 1 3.288-1.684c3.455 0 4.202 2.16 4.202 4.97V19.5h-3.2v-5.072c0-1.21-.244-2.766-2.128-2.766-1.827 0-2.139 1.317-2.139 2.676V19.5h-3.19V8.796h3.168ZM7.2 6.106a1.61 1.61 0 0 1-.988 1.483 1.595 1.595 0 0 1-1.743-.348A1.607 1.607 0 0 1 5.6 4.5a1.601 1.601 0 0 1 1.6 1.606Z" clip-rule="evenodd"/>
                    <path d="M7.2 19.5H4.0V8.796h3.2V19.5Z"/>
                </svg>
                  <span class="sr-only">LinkedIn</span>
              </a>
          </div>
      </div>
    </div>
</footer>