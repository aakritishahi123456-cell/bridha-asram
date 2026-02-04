@extends('layouts.app')

@section('title', 'About Us')
@section('description', 'Learn about बुद्धभुमी मानव सेवा आश्रम - our mission, vision, values, and the dedicated team working to provide compassionate care to homeless and elderly individuals in Nepal.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-4">About Us</h1>
        <p class="text-xl max-w-2xl mx-auto">
            Dedicated to providing compassionate care and support to the most vulnerable members of our society.
        </p>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Mission -->
            <div class="bg-green-50 rounded-lg p-8">
                <div class="flex items-center mb-6">
                    <div class="bg-green-600 rounded-full p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Our Mission</h2>
                </div>
                <p class="text-gray-700 leading-relaxed mb-4">
                    {{ $organizationInfo['mission']['en'] }}
                </p>
                <p class="text-gray-600 text-sm italic">
                    {{ $organizationInfo['mission']['ne'] }}
                </p>
            </div>
            
            <!-- Vision -->
            <div class="bg-yellow-50 rounded-lg p-8">
                <div class="flex items-center mb-6">
                    <div class="bg-yellow-600 rounded-full p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Our Vision</h2>
                </div>
                <p class="text-gray-700 leading-relaxed mb-4">
                    {{ $organizationInfo['vision']['en'] }}
                </p>
                <p class="text-gray-600 text-sm italic">
                    {{ $organizationInfo['vision']['ne'] }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Organization Info -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Organization Information</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                We are a registered non-profit organization committed to transparency and accountability.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center p-6 bg-white rounded-lg shadow-lg">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4l2 2 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Established</h3>
                <p class="text-gray-600">{{ $organizationInfo['established'] }}</p>
            </div>
            
            <div class="text-center p-6 bg-white rounded-lg shadow-lg">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Registration</h3>
                <p class="text-gray-600">{{ $organizationInfo['registration_number'] }}</p>
            </div>
            
            <div class="text-center p-6 bg-white rounded-lg shadow-lg">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Primary Location</h3>
                <p class="text-gray-600">{{ $organizationInfo['primary_location'] }}</p>
            </div>
            
            <div class="text-center p-6 bg-white rounded-lg shadow-lg">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Secondary Location</h3>
                <p class="text-gray-600">{{ $organizationInfo['secondary_location'] }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Core Values</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                These values guide everything we do and shape how we serve our community.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($coreValues as $index => $value)
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">
                        {{ $index + 1 }}
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $value['title']['en'] }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $value['description']['en'] }}</p>
                    <p class="text-gray-500 text-xs italic">{{ $value['title']['ne'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Leadership Team -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Leadership</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Meet the dedicated leaders who guide our mission and ensure we stay true to our values.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            @foreach ($leadership as $leader)
                <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                    <div class="w-24 h-24 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-bold text-2xl">
                        {{ substr($leader['name_en'], 0, 1) }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $leader['name_en'] }}</h3>
                    <p class="text-gray-600 text-sm mb-2 italic">{{ $leader['name'] }}</p>
                    <p class="text-green-600 font-semibold mb-3">{{ $leader['position']['en'] }}</p>
                    <p class="text-gray-600 text-sm">{{ $leader['bio']['en'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gradient-to-r from-green-600 to-green-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Join Our Mission</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            Whether through volunteering, donating, or spreading awareness, you can be part of our mission 
            to create a more compassionate Nepal.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('volunteer.register') }}" 
               class="bg-white text-green-600 font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition duration-300">
                Become a Volunteer
            </a>
            <a href="{{ route('donate') }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold py-3 px-8 rounded-lg transition duration-300">
                Make a Donation
            </a>
            <a href="{{ route('contact') }}" 
               class="bg-transparent border-2 border-white hover:bg-white hover:text-green-800 font-semibold py-3 px-8 rounded-lg transition duration-300">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection