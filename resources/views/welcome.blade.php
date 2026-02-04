<x-app-layout>
    <x-slot name="title">{{ __('Home') }}</x-slot>
    <x-slot name="description">{{ __('Buddhabhoomi Human Service Ashram - Dedicated to homeless care and elderly care services across Nepal. Join us in making a difference through donations and volunteer work.') }}</x-slot>

    <!-- Hero Section -->
    <section class="hero-gradient relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 text-shadow-lg">
                    <span class="block">{{ __('Compassionate Care') }}</span>
                    <span class="block text-secondary-300">{{ __('for Those in Need') }}</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto">
                    {{ __('Providing shelter, food, and dignity to homeless individuals and elderly citizens across Nepal. Together, we can transform lives and build a more compassionate society.') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('donate') }}" class="btn btn-secondary text-lg px-8 py-3">
                        {{ __('Donate Now') }}
                    </a>
                    <a href="{{ route('volunteer.register') }}" class="btn btn-outline text-lg px-8 py-3 text-white border-white hover:bg-white hover:text-primary-600">
                        {{ __('Become a Volunteer') }}
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Impact Counters -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('Our Impact') }}</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    {{ __('See the difference we\'ve made together in the lives of those who need it most.') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center" x-data="impactCounter()" data-target="1250">
                    <div class="text-4xl md:text-5xl font-bold text-primary-600 mb-2" x-text="Math.floor(count)">0</div>
                    <div class="text-lg font-medium text-gray-900 mb-1">{{ __('People Served') }}</div>
                    <div class="text-sm text-gray-600">{{ __('Across all programs') }}</div>
                </div>
                
                <div class="text-center" x-data="impactCounter()" data-target="45000">
                    <div class="text-4xl md:text-5xl font-bold text-secondary-600 mb-2" x-text="Math.floor(count)">0</div>
                    <div class="text-lg font-medium text-gray-900 mb-1">{{ __('Meals Provided') }}</div>
                    <div class="text-sm text-gray-600">{{ __('Hot meals daily') }}</div>
                </div>
                
                <div class="text-center" x-data="impactCounter()" data-target="8500">
                    <div class="text-4xl md:text-5xl font-bold text-success-600 mb-2" x-text="Math.floor(count)">0</div>
                    <div class="text-lg font-medium text-gray-900 mb-1">{{ __('Shelter Nights') }}</div>
                    <div class="text-sm text-gray-600">{{ __('Safe accommodation') }}</div>
                </div>
                
                <div class="text-center" x-data="impactCounter()" data-target="150">
                    <div class="text-4xl md:text-5xl font-bold text-danger-600 mb-2" x-text="Math.floor(count)">0</div>
                    <div class="text-lg font-medium text-gray-900 mb-1">{{ __('Active Volunteers') }}</div>
                    <div class="text-sm text-gray-600">{{ __('Dedicated helpers') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('Our Programs') }}</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    {{ __('We focus on two core areas where we can make the most meaningful impact in our communities.') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Homeless Care Program -->
                <div class="card hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-64 overflow-hidden rounded-t-lg">
                        <img src="{{ asset('images/programs/homeless-care.jpg') }}" alt="{{ __('Homeless Care Program') }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ __('Homeless Care') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-gray-600 mb-4">
                            {{ __('Providing shelter, food, clothing, and medical care to homeless individuals. Our comprehensive approach includes rehabilitation programs and job placement assistance to help people rebuild their lives.') }}
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                <span class="font-medium text-primary-600">750+</span> {{ __('people helped') }}
                            </div>
                            <a href="#" class="btn btn-primary">{{ __('Learn More') }}</a>
                        </div>
                    </div>
                </div>
                
                <!-- Elderly Care Program -->
                <div class="card hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-64 overflow-hidden rounded-t-lg">
                        <img src="{{ asset('images/programs/elderly-care.jpg') }}" alt="{{ __('Elderly Care Program') }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ __('Elderly Care') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-gray-600 mb-4">
                            {{ __('Caring for elderly citizens who lack family support or resources. We provide medical care, daily assistance, social activities, and a loving environment where seniors can live with dignity.') }}
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                <span class="font-medium text-secondary-600">500+</span> {{ __('seniors cared for') }}
                            </div>
                            <a href="#" class="btn btn-primary">{{ __('Learn More') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cities Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('Where We Serve') }}</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    {{ __('Our operations span across multiple cities in Nepal, with plans for continued expansion to reach more communities in need.') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Surkhet -->
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    <img src="{{ asset('images/cities/surkhet.jpg') }}" alt="{{ __('Surkhet Operations') }}" class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <h3 class="text-2xl font-bold mb-2">{{ __('Surkhet') }} <span class="nepali-text text-lg">सुर्खेत</span></h3>
                        <p class="text-gray-200 mb-4">{{ __('Our primary operations center, serving as the headquarters for our homeless care and elderly care programs.') }}</p>
                        <div class="flex items-center justify-between">
                            <div class="text-sm">
                                <span class="font-medium">{{ __('Coordinator:') }}</span> {{ __('Ram Bahadur Thapa') }}
                            </div>
                            <a href="#" class="btn btn-outline text-white border-white hover:bg-white hover:text-gray-900">{{ __('Learn More') }}</a>
                        </div>
                    </div>
                </div>
                
                <!-- Jajarkot -->
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    <img src="{{ asset('images/cities/jajarkot.jpg') }}" alt="{{ __('Jajarkot Operations') }}" class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <h3 class="text-2xl font-bold mb-2">{{ __('Jajarkot') }} <span class="nepali-text text-lg">जाजरकोट</span></h3>
                        <p class="text-gray-200 mb-4">{{ __('Our secondary operations, focusing on rural outreach and community-based care programs.') }}</p>
                        <div class="flex items-center justify-between">
                            <div class="text-sm">
                                <span class="font-medium">{{ __('Coordinator:') }}</span> {{ __('Sita Kumari Shrestha') }}
                            </div>
                            <a href="#" class="btn btn-outline text-white border-white hover:bg-white hover:text-gray-900">{{ __('Learn More') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-primary-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ __('Join Our Mission') }}</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                {{ __('Every contribution, whether through donations or volunteering, helps us provide better care and support to those who need it most.') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('donate') }}" class="btn btn-secondary text-lg px-8 py-3">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    {{ __('Make a Donation') }}
                </a>
                <a href="{{ route('volunteer.register') }}" class="btn btn-outline text-lg px-8 py-3 text-white border-white hover:bg-white hover:text-primary-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    {{ __('Volunteer With Us') }}
                </a>
            </div>
        </div>
    </section>
</x-app-layout>