@extends('layouts.app')

@section('title', 'Volunteer Registration Success')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Registration Successful!</h2>
            <p class="text-gray-600">Thank you for your interest in volunteering with us.</p>
        </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="text-center space-y-4">
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-green-800 mb-2">What happens next?</h3>
                    <ul class="text-sm text-green-700 space-y-2 text-left">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">1</span>
                            <span>We'll review your application within 2-3 business days</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">2</span>
                            <span>You'll receive an email with the status of your application</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">3</span>
                            <span>If approved, we'll invite you for orientation and training</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-2 mt-0.5">4</span>
                            <span>Start making a difference in your community!</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="font-semibold text-blue-800 mb-2">Questions?</h4>
                    <p class="text-sm text-blue-700 mb-3">
                        If you have any questions about your application or our volunteer programs, 
                        feel free to contact us.
                    </p>
                    <div class="space-y-1 text-sm text-blue-700">
                        <p><strong>Email:</strong> info@buddhabhoomi.org.np</p>
                        <p><strong>Phone:</strong> +977-83-520123</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <a href="{{ route('home') }}" 
                       class="flex-1 bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300 text-center">
                        Back to Home
                    </a>
                    <a href="{{ route('about') }}" 
                       class="flex-1 bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition duration-300 text-center">
                        Learn More About Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection