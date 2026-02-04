@extends('layouts.app')

@section('title', 'Home')
@section('description', 'बुद्धभुमी मानव सेवा आश्रम - Providing dignity, shelter, care, and compassion to homeless and elderly individuals in Nepal. Join us through donations and volunteering.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-600 to-green-800 text-white overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                <span class="block text-yellow-300">बुद्धभुमी मानव सेवा आश्रम</span>
                <span class="block text-2xl md:text-3xl mt-2 font-medium">Buddhabhoomi Human Service Ashram</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed">
                Providing dignity, shelter, care, and compassion to homeless and elderly individuals, 
                ensuring a humane and respectful life for the most vulnerable members of society.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('donate') }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold py-4 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                    Donate Now
                </a>
                <a href="{{ route('volunteer.register') }}" 
                   class="bg-transparent border-2 border-white hover:bg-white hover:text-green-800 font-semibold py-4 px-8 rounded-lg transition duration-300">
                    Become a Volunteer
                </a>
            </div>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-40 h-40 bg-yellow-300 rounded-full opacity-20"></div>
    <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-60 h-60 bg-green-300 rounded-full opacity-20"></div>
</section>

<!-- Impact Counters -->
@livewire('impact-counters')

<!-- Mission & Vision Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Mission & Vision</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Guided by compassion and driven by purpose, we work towards a Nepal where no one is left behind.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Mission -->
            <div class="bg-green-50 rounded-lg p-8">
                <div class="flex items-center mb-6">
                    <div class="bg-green-600 rounded-full p-3 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Our Mission</h3>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    To provide dignity, shelter, care, and compassion to homeless and elderly individuals, 
                    ensuring a humane and respectful life for the most vulnerable members of society.
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
                    <h3 class="text-2xl font-bold text-gray-900">Our Vision</h3>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    To build a compassionate Nepal where no elderly or homeless person is left abandoned, 
                    neglected, or without care.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Work Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Work</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                We focus on two core areas of humanitarian service, providing comprehensive care and support.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Homeless Care -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <div class="h-48 bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4l2 2 4-4"></path>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Homeless Care Program</h3>
                    <p class="text-gray-600 mb-4">
                        Providing shelter, meals, healthcare, and rehabilitation services to homeless individuals. 
                        We offer a safe haven and pathway to self-sufficiency.
                    </p>
                    <ul class="text-sm text-gray-600 space-y-1 mb-4">
                        <li>• Emergency shelter and accommodation</li>
                        <li>• Daily meals and nutrition support</li>
                        <li>• Healthcare and medical assistance</li>
                        <li>• Job training and placement support</li>
                    </ul>
                    <a href="{{ route('programs.show', 'homeless-care') }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        Learn More →
                    </a>
                </div>
            </div>
            
            <!-- Elderly Care -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <div class="h-48 bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Elderly Care Program</h3>
                    <p class="text-gray-600 mb-4">
                        Comprehensive care for elderly individuals who need support, companionship, and medical attention. 
                        Ensuring dignity in their golden years.
                    </p>
                    <ul class="text-sm text-gray-600 space-y-1 mb-4">
                        <li>• 24/7 care and supervision</li>
                        <li>• Medical care and health monitoring</li>
                        <li>• Social activities and companionship</li>
                        <li>• Spiritual and emotional support</li>
                    </ul>
                    <a href="{{ route('programs.show', 'elderly-care') }}" 
                       class="text-purple-600 hover:text-purple-800 font-medium">
                        Learn More →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Stories of Hope</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Hear from those whose lives have been touched by our work and the volunteers who make it possible.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($testimonials as $testimonial)
                <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ substr($testimonial['name_en'], 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">{{ $testimonial['name_en'] }}</h4>
                            <p class="text-sm text-gray-600">{{ $testimonial['role'] }} • {{ $testimonial['location'] }}</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-700 italic">
                        "{{ $testimonial['message_en'] }}"
                    </blockquote>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Latest Updates Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Latest Updates</h2>
                <p class="text-gray-600">Stay informed about our recent activities and upcoming events.</p>
            </div>
            <a href="{{ route('blog.index') }}" 
               class="text-green-600 hover:text-green-800 font-medium">
                View All →
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($latestPosts as $post)
                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    @if ($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                                {{ $post->published_at->format('M d, Y') }}
                            </time>
                            @if ($post->category)
                                <span class="mx-2">•</span>
                                <span>{{ $post->category->name }}</span>
                            @endif
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                            {{ $post->title }}
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {{ $post->excerpt }}
                        </p>
                        <a href="{{ route('blog.show', $post->slug) }}" 
                           class="text-green-600 hover:text-green-800 font-medium text-sm">
                            Read More →
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">No recent updates available.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-green-600 to-green-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Join Us in Making a Difference</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            Every contribution, whether through donation or volunteering, helps us provide better care 
            and support to those who need it most.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate') }}" 
               class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                Make a Donation
            </a>
            <a href="{{ route('volunteer.register') }}" 
               class="bg-transparent border-2 border-white hover:bg-white hover:text-green-800 font-semibold py-3 px-8 rounded-lg transition duration-300">
                Volunteer With Us
            </a>
            <a href="{{ route('contact') }}" 
               class="bg-transparent border-2 border-white hover:bg-white hover:text-green-800 font-semibold py-3 px-8 rounded-lg transition duration-300">
                Get in Touch
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush