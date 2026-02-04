@extends('layouts.app')

@section('title', 'Make a Donation')
@section('description', 'Support बुद्धभुमी मानव सेवा आश्रम by making a secure online donation. Your contribution helps provide care and support to homeless and elderly individuals in Nepal.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold mb-4">Make a Donation</h1>
        <p class="text-xl max-w-2xl mx-auto">
            Your generosity helps us provide essential care, shelter, and support to those who need it most. 
            Every contribution makes a real difference in someone's life.
        </p>
    </div>
</section>

<!-- Donation Impact Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Your Impact</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                See how your donation directly helps our beneficiaries and supports our programs.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="text-center p-6 bg-blue-50 rounded-lg">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">NPR</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">NPR 500</h3>
                <p class="text-gray-600 text-sm">Provides meals for one person for a week</p>
            </div>
            
            <div class="text-center p-6 bg-green-50 rounded-lg">
                <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">NPR</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">NPR 2,000</h3>
                <p class="text-gray-600 text-sm">Covers basic healthcare for one elderly person per month</p>
            </div>
            
            <div class="text-center p-6 bg-purple-50 rounded-lg">
                <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">NPR</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">NPR 5,000</h3>
                <p class="text-gray-600 text-sm">Provides shelter and care for one person for a month</p>
            </div>
        </div>
    </div>
</section>

<!-- Donation Form Section -->
<section class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @livewire('donation-form')
    </div>
</section>

<!-- Security & Trust Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Secure & Transparent</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                We ensure your donations are secure and used effectively for our humanitarian programs.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Secure Payments</h3>
                <p class="text-sm text-gray-600">SSL encrypted transactions</p>
            </div>
            
            <div class="text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Instant Receipt</h3>
                <p class="text-sm text-gray-600">Email confirmation & receipt</p>
            </div>
            
            <div class="text-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Full Transparency</h3>
                <p class="text-sm text-gray-600">Track your donation impact</p>
            </div>
            
            <div class="text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Direct Impact</h3>
                <p class="text-sm text-gray-600">100% goes to programs</p>
            </div>
        </div>
    </div>
</section>

<!-- Alternative Donation Methods -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Other Ways to Donate</h2>
            <p class="text-gray-600">
                Prefer to donate through other methods? We accept donations through various channels.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Bank Transfer</h3>
                <div class="space-y-2 text-sm">
                    <p><strong>Account Name:</strong> बुद्धभुमी मानव सेवा आश्रम</p>
                    <p><strong>Bank:</strong> Nepal Bank Limited</p>
                    <p><strong>Account Number:</strong> 01234567890123</p>
                    <p><strong>Branch:</strong> Surkhet Branch</p>
                </div>
                <p class="text-xs text-gray-500 mt-4">
                    Please email us the transfer receipt at info@buddhabhoomi.org.np
                </p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">In-Kind Donations</h3>
                <div class="space-y-2 text-sm">
                    <p>• Food items and groceries</p>
                    <p>• Clothing and blankets</p>
                    <p>• Medical supplies</p>
                    <p>• Educational materials</p>
                </div>
                <p class="text-xs text-gray-500 mt-4">
                    Contact us at +977-83-520123 to coordinate in-kind donations.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
        </div>
        
        <div class="space-y-6">
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="font-semibold text-gray-900 mb-2">Is my donation tax-deductible?</h3>
                <p class="text-gray-600 text-sm">
                    Yes, as a registered NGO in Nepal, donations to our organization are tax-deductible. 
                    You will receive a receipt that can be used for tax purposes.
                </p>
            </div>
            
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="font-semibold text-gray-900 mb-2">How is my donation used?</h3>
                <p class="text-gray-600 text-sm">
                    100% of your donation goes directly to our programs. We cover administrative costs 
                    through separate funding sources to ensure maximum impact of your contribution.
                </p>
            </div>
            
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="font-semibold text-gray-900 mb-2">Can I make recurring donations?</h3>
                <p class="text-gray-600 text-sm">
                    Currently, we accept one-time donations through our online platform. For recurring 
                    donations, please contact us directly and we can set up a monthly transfer arrangement.
                </p>
            </div>
            
            <div class="border border-gray-200 rounded-lg p-6">
                <h3 class="font-semibold text-gray-900 mb-2">Will I receive updates on how my donation is used?</h3>
                <p class="text-gray-600 text-sm">
                    Yes! We send regular updates to our donors about our programs, impact stories, 
                    and how donations are making a difference in the lives of our beneficiaries.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection