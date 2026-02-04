@extends('layouts.app')

@section('title', 'Volunteer Registration')
@section('description', 'Join बुद्धभुमी मानव सेवा आश्रम as a volunteer and make a direct impact in the lives of homeless and elderly individuals in Nepal. Register today to start your journey of service.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-4">Become a Volunteer</h1>
        <p class="text-xl max-w-2xl mx-auto">
            Join our compassionate community of volunteers and make a direct impact in the lives of 
            those who need it most. Your time and skills can change lives.
        </p>
    </div>
</section>

<!-- Why Volunteer Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Volunteer With Us?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Volunteering with us is more than just giving your time – it's about being part of a 
                mission that transforms lives and builds a more compassionate society.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Make a Real Difference</h3>
                <p class="text-gray-600 text-sm">
                    Your direct involvement helps provide care, comfort, and hope to vulnerable individuals 
                    in our community.
                </p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Join a Community</h3>
                <p class="text-gray-600 text-sm">
                    Connect with like-minded individuals who share your passion for helping others and 
                    making positive change.
                </p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Develop Skills</h3>
                <p class="text-gray-600 text-sm">
                    Gain valuable experience in healthcare, social work, community service, and 
                    leadership while serving others.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Volunteer Opportunities -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Volunteer Opportunities</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                We have various volunteer roles to match your skills, interests, and availability.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Direct Care Support</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Assist with daily care activities, meal preparation, and providing companionship 
                    to our beneficiaries.
                </p>
                <ul class="text-xs text-gray-500 space-y-1">
                    <li>• Meal assistance and feeding</li>
                    <li>• Personal hygiene support</li>
                    <li>• Companionship and conversation</li>
                    <li>• Recreation activities</li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Administrative Support</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Help with office work, documentation, data entry, and organizational tasks 
                    that keep our programs running smoothly.
                </p>
                <ul class="text-xs text-gray-500 space-y-1">
                    <li>• Data entry and record keeping</li>
                    <li>• Event planning and coordination</li>
                    <li>• Social media management</li>
                    <li>• Fundraising support</li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Skills-Based Volunteering</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Use your professional skills in healthcare, education, counseling, or other 
                    specialized areas to support our programs.
                </p>
                <ul class="text-xs text-gray-500 space-y-1">
                    <li>• Medical and healthcare support</li>
                    <li>• Educational programs</li>
                    <li>• Counseling and mental health</li>
                    <li>• Legal and financial advice</li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Event Support</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Help organize and run special events, fundraisers, awareness campaigns, 
                    and community outreach programs.
                </p>
                <ul class="text-xs text-gray-500 space-y-1">
                    <li>• Event setup and coordination</li>
                    <li>• Community outreach</li>
                    <li>• Awareness campaigns</li>
                    <li>• Fundraising events</li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Outreach & Advocacy</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Help spread awareness about our mission, advocate for the rights of vulnerable 
                    populations, and engage with the community.
                </p>
                <ul class="text-xs text-gray-500 space-y-1">
                    <li>• Community presentations</li>
                    <li>• Social media advocacy</li>
                    <li>• Partnership development</li>
                    <li>• Public speaking</li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Flexible Volunteering</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Can't commit to regular hours? We have one-time opportunities and flexible 
                    arrangements to fit your schedule.
                </p>
                <ul class="text-xs text-gray-500 space-y-1">
                    <li>• Weekend activities</li>
                    <li>• Holiday programs</li>
                    <li>• One-time events</li>
                    <li>• Remote volunteering</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Registration Form Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to Get Started?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Fill out our volunteer registration form below. We'll review your application and 
                contact you within 2-3 business days to discuss next steps.
            </p>
        </div>
        
        @livewire('volunteer-registration-form')
    </div>
</section>

<!-- What to Expect Section -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">What to Expect</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Here's what happens after you submit your volunteer application.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">
                    1
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Application Review</h3>
                <p class="text-sm text-gray-600">
                    We review your application and match your skills with our current needs.
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">
                    2
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Interview & Orientation</h3>
                <p class="text-sm text-gray-600">
                    Brief interview followed by orientation about our programs and policies.
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">
                    3
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Training</h3>
                <p class="text-sm text-gray-600">
                    Receive training specific to your volunteer role and our care standards.
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-white font-bold text-xl">
                    4
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Start Volunteering</h3>
                <p class="text-sm text-gray-600">
                    Begin your volunteer journey and start making a difference!
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Have Questions?</h2>
        <p class="text-gray-600 mb-6">
            We're here to help! If you have any questions about volunteering with us, 
            don't hesitate to reach out.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                Contact Us
            </a>
            <a href="tel:+977-83-520123" 
               class="bg-transparent border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                Call: +977-83-520123
            </a>
        </div>
    </div>
</section>
@endsection