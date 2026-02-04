<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Organization Info -->
            <div class="lg:col-span-2">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ asset('images/logo-white.png') }}" alt="{{ $ngoNameEnglish }}" class="h-12 w-12">
                    <div>
                        <div class="text-xl font-bold">{{ $ngoNameEnglish }}</div>
                        <div class="text-sm text-gray-300 nepali-text">{{ $ngoName }}</div>
                    </div>
                </div>
                <p class="text-gray-300 mb-4 max-w-md">
                    {{ __('Dedicated to providing compassionate care and support to homeless individuals and elderly citizens across Nepal. Together, we can make a difference in the lives of those who need it most.') }}
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.418-3.323C6.001 8.198 7.152 7.708 8.449 7.708s2.448.49 3.323 1.416c.875.875 1.365 2.026 1.365 3.323s-.49 2.448-1.365 3.323c-.875.807-2.026 1.218-3.323 1.218zm7.718-1.297c-.875.807-2.026 1.297-3.323 1.297s-2.448-.49-3.323-1.297c-.875-.875-1.365-2.026-1.365-3.323s.49-2.448 1.365-3.323c.875-.926 2.026-1.416 3.323-1.416s2.448.49 3.323 1.416c.875.875 1.365 2.026 1.365 3.323s-.49 2.448-1.365 3.323z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <span class="sr-only">YouTube</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">{{ __('Quick Links') }}</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors duration-200">{{ __('About Us') }}</a></li>
                    <li><a href="{{ route('programs.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">{{ __('Our Programs') }}</a></li>
                    <li><a href="{{ route('cities.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">{{ __('Our Cities') }}</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">{{ __('Blog') }}</a></li>
                    <li><a href="{{ route('events.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">{{ __('Events') }}</a></li>
                    <li><a href="{{ route('volunteer.register') }}" class="text-gray-300 hover:text-white transition-colors duration-200">{{ __('Volunteer') }}</a></li>
                    <li><a href="{{ route('donate') }}" class="text-gray-300 hover:text-white transition-colors duration-200">{{ __('Donate') }}</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-4">{{ __('Contact Info') }}</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <svg class="h-5 w-5 text-primary-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <p class="text-gray-300">{{ $ngoAddress }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="h-5 w-5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:{{ $ngoPhone }}" class="text-gray-300 hover:text-white transition-colors duration-200">{{ $ngoPhone }}</a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="h-5 w-5 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ $ngoEmail }}" class="text-gray-300 hover:text-white transition-colors duration-200">{{ $ngoEmail }}</a>
                    </div>
                </div>
                
                <!-- Newsletter Signup -->
                <div class="mt-6">
                    <h4 class="text-sm font-semibold mb-2">{{ __('Stay Updated') }}</h4>
                    <form class="flex">
                        <input type="email" placeholder="{{ __('Your email') }}" class="flex-1 px-3 py-2 bg-gray-800 text-white placeholder-gray-400 border border-gray-700 rounded-l-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-r-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-colors duration-200">
                            {{ __('Subscribe') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Bottom Section -->
        <div class="border-t border-gray-800 mt-8 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-400 text-sm mb-4 md:mb-0">
                    <p>&copy; {{ date('Y') }} {{ $ngoNameEnglish }}. {{ __('All rights reserved.') }}</p>
                    <p class="mt-1">{{ __('Registration No:') }} {{ env('NGO_REGISTRATION_NUMBER', '12345/2080') }}</p>
                </div>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">{{ __('Privacy Policy') }}</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">{{ __('Terms of Service') }}</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">{{ __('Cookie Policy') }}</a>
                </div>
            </div>
        </div>
    </div>
</footer>