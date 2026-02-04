<nav class="bg-white shadow-lg sticky top-0 z-40" x-data="mobileMenu()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and Brand -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ $ngoNameEnglish }}" class="h-10 w-10">
                    <div class="hidden sm:block">
                        <div class="text-lg font-bold text-primary-600">{{ $ngoNameEnglish }}</div>
                        <div class="text-xs text-gray-500 nepali-text">{{ $ngoName }}</div>
                    </div>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                    {{ __('Home') }}
                </a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'nav-link-active' : '' }}">
                    {{ __('About') }}
                </a>
                <div class="relative group">
                    <button class="nav-link flex items-center space-x-1">
                        <span>{{ __('Programs') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="py-1">
                            <a href="{{ route('programs.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('All Programs') }}</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Homeless Care') }}</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Elderly Care') }}</a>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <button class="nav-link flex items-center space-x-1">
                        <span>{{ __('Cities') }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="py-1">
                            <a href="{{ route('cities.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('All Cities') }}</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Surkhet') }}</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Jajarkot') }}</a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'nav-link-active' : '' }}">
                    {{ __('Blog') }}
                </a>
                <a href="{{ route('events.index') }}" class="nav-link {{ request()->routeIs('events.*') ? 'nav-link-active' : '' }}">
                    {{ __('Events') }}
                </a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'nav-link-active' : '' }}">
                    {{ __('Contact') }}
                </a>
            </div>
            
            <!-- Action Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Language Switcher -->
                <div class="relative group" x-data="languageSwitcher()">
                    <button class="flex items-center space-x-1 text-gray-600 hover:text-primary-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                        </svg>
                        <span class="text-sm">{{ strtoupper(app()->getLocale()) }}</span>
                    </button>
                    <div class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="py-1">
                            <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">English</a>
                            <a href="{{ route('lang.switch', 'ne') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 nepali-text">नेपाली</a>
                        </div>
                    </div>
                </div>
                
                <!-- Volunteer Button -->
                <a href="{{ route('volunteer.register') }}" class="btn btn-outline">
                    {{ __('Volunteer') }}
                </a>
                
                <!-- Donate Button -->
                <a href="{{ route('donate') }}" class="btn btn-primary">
                    {{ __('Donate Now') }}
                </a>
                
                <!-- User Menu -->
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-primary-600">
                            <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <div class="py-1">
                                @if(auth()->user()->isVolunteer())
                                    <a href="{{ route('volunteer.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Dashboard') }}</a>
                                    <a href="{{ route('volunteer.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Profile') }}</a>
                                @endif
                                @if(auth()->user()->isAdmin())
                                    <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Admin Panel') }}</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __('Logout') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-600">{{ __('Login') }}</a>
                @endauth
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="toggle()" class="text-gray-600 hover:text-primary-600 focus:outline-none focus:text-primary-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Navigation Menu -->
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="md:hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('Home') }}</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('About') }}</a>
            <a href="{{ route('programs.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('Programs') }}</a>
            <a href="{{ route('cities.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('Cities') }}</a>
            <a href="{{ route('blog.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('Blog') }}</a>
            <a href="{{ route('events.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('Events') }}</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('Contact') }}</a>
        </div>
        
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="px-2 space-y-1">
                <a href="{{ route('volunteer.register') }}" class="block px-3 py-2 text-base font-medium text-primary-600 hover:bg-primary-50 rounded-md">{{ __('Volunteer') }}</a>
                <a href="{{ route('donate') }}" class="block px-3 py-2 text-base font-medium bg-primary-600 text-white hover:bg-primary-700 rounded-md">{{ __('Donate Now') }}</a>
                
                @auth
                    <div class="border-t border-gray-200 pt-2 mt-2">
                        @if(auth()->user()->isVolunteer())
                            <a href="{{ route('volunteer.dashboard') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('Dashboard') }}</a>
                        @endif
                        @if(auth()->user()->isAdmin())
                            <a href="/admin" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('Admin Panel') }}</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('Logout') }}</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">{{ __('Login') }}</a>
                @endauth
                
                <!-- Language Switcher Mobile -->
                <div class="border-t border-gray-200 pt-2 mt-2">
                    <div class="px-3 py-2 text-sm font-medium text-gray-500">{{ __('Language') }}</div>
                    <a href="{{ route('lang.switch', 'en') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">English</a>
                    <a href="{{ route('lang.switch', 'ne') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md nepali-text">नेपाली</a>
                </div>
            </div>
        </div>
    </div>
</nav>