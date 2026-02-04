<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Home') | {{ config('app.name', 'बुद्धभुमी मानव सेवा आश्रम') }}</title>
    <meta name="description" content="@yield('description', 'Buddhabhoomi Human Service Ashram - Dedicated to homeless care and elderly care services across Nepal. Join us in making a difference through donations and volunteer work.')">
    <meta name="keywords" content="NGO, Nepal, homeless care, elderly care, donation, volunteer, Surkhet, Jajarkot, humanitarian">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('description', 'Dedicated to homeless care and elderly care services across Nepal')">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', config('app.name'))">
    <meta property="twitter:description" content="@yield('description', 'Dedicated to homeless care and elderly care services across Nepal')">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <!-- Additional head content -->
    @stack('head')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        @include('layouts.navigation')
        
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        
        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('layouts.footer')
    </div>
    
    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2">
        <!-- Toast messages will be inserted here -->
    </div>
    
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <div class="spinner"></div>
            <span class="text-gray-700">Loading...</span>
        </div>
    </div>
    
    @livewireScripts
    
    <!-- Additional scripts -->
    @stack('scripts')
    
    <!-- Flash Messages -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        </script>
    @endif
    
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        </script>
    @endif
    
    <script>
        // Toast notification function
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            const bgColor = {
                'success': 'bg-green-500',
                'error': 'bg-red-500',
                'warning': 'bg-yellow-500',
                'info': 'bg-blue-500'
            }[type] || 'bg-blue-500';
            
            toast.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full opacity-0`;
            toast.textContent = message;
            
            container.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
            }, 100);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    container.removeChild(toast);
                }, 300);
            }, 5000);
        }
        
        // Loading overlay functions
        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('hidden');
            document.getElementById('loading-overlay').classList.add('flex');
        }
        
        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('hidden');
            document.getElementById('loading-overlay').classList.remove('flex');
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>