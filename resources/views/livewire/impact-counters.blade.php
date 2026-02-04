<div class="bg-gradient-to-r from-green-600 to-green-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-4">Our Impact</h2>
            <p class="text-green-100 text-lg max-w-2xl mx-auto">
                Together, we're making a real difference in the lives of those who need it most. 
                Here's what we've accomplished with your support.
            </p>
        </div>

        @if ($isLoading)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @for ($i = 0; $i < 6; $i++)
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 text-center animate-pulse">
                        <div class="h-12 w-12 bg-white/20 rounded-full mx-auto mb-4"></div>
                        <div class="h-8 bg-white/20 rounded mb-2"></div>
                        <div class="h-4 bg-white/20 rounded"></div>
                    </div>
                @endfor
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- People Sheltered -->
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 text-center hover:bg-white/20 transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 rounded-full mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-white mb-2" x-data="{ count: 0 }" x-init="
                        let target = {{ $counters['people_sheltered'] }};
                        let increment = target / 100;
                        let timer = setInterval(() => {
                            count += increment;
                            if (count >= target) {
                                count = target;
                                clearInterval(timer);
                            }
                        }, 20);
                    " x-text="Math.floor(count).toLocaleString()">
                        0
                    </div>
                    <p class="text-green-100 font-medium">People Sheltered</p>
                </div>

                <!-- Elderly Cared -->
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 text-center hover:bg-white/20 transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 rounded-full mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-white mb-2" x-data="{ count: 0 }" x-init="
                        let target = {{ $counters['elderly_cared'] }};
                        let increment = target / 100;
                        let timer = setInterval(() => {
                            count += increment;
                            if (count >= target) {
                                count = target;
                                clearInterval(timer);
                            }
                        }, 25);
                    " x-text="Math.floor(count).toLocaleString()">
                        0
                    </div>
                    <p class="text-green-100 font-medium">Elderly Cared For</p>
                </div>

                <!-- Meals Served -->
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 text-center hover:bg-white/20 transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 rounded-full mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-white mb-2" x-data="{ count: 0 }" x-init="
                        let target = {{ $counters['meals_served'] }};
                        let increment = target / 100;
                        let timer = setInterval(() => {
                            count += increment;
                            if (count >= target) {
                                count = target;
                                clearInterval(timer);
                            }
                        }, 15);
                    " x-text="Math.floor(count).toLocaleString()">
                        0
                    </div>
                    <p class="text-green-100 font-medium">Meals Served</p>
                </div>

                <!-- Active Volunteers -->
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 text-center hover:bg-white/20 transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 rounded-full mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-white mb-2" x-data="{ count: 0 }" x-init="
                        let target = {{ $counters['volunteers'] }};
                        let increment = target / 50;
                        let timer = setInterval(() => {
                            count += increment;
                            if (count >= target) {
                                count = target;
                                clearInterval(timer);
                            }
                        }, 30);
                    " x-text="Math.floor(count).toLocaleString()">
                        0
                    </div>
                    <p class="text-green-100 font-medium">Active Volunteers</p>
                </div>

                <!-- Total Donations -->
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 text-center hover:bg-white/20 transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 rounded-full mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-white mb-2" x-data="{ count: 0 }" x-init="
                        let target = {{ $counters['donations_received'] }};
                        let increment = target / 100;
                        let timer = setInterval(() => {
                            count += increment;
                            if (count >= target) {
                                count = target;
                                clearInterval(timer);
                            }
                        }, 20);
                    " x-text="'NPR ' + Math.floor(count).toLocaleString()">
                        NPR 0
                    </div>
                    <p class="text-green-100 font-medium">Donations Received</p>
                </div>

                <!-- Cities Served -->
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 text-center hover:bg-white/20 transition-all duration-300">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-white/20 rounded-full mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-white mb-2" x-data="{ count: 0 }" x-init="
                        let target = {{ $counters['cities_served'] }};
                        let increment = target / 20;
                        let timer = setInterval(() => {
                            count += increment;
                            if (count >= target) {
                                count = target;
                                clearInterval(timer);
                            }
                        }, 50);
                    " x-text="Math.floor(count)">
                        0
                    </div>
                    <p class="text-green-100 font-medium">Cities Served</p>
                </div>
            </div>

            <!-- Refresh Button -->
            <div class="text-center mt-8">
                <button 
                    wire:click="refreshCounters"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center px-4 py-2 bg-white/20 text-white rounded-lg hover:bg-white/30 transition-colors duration-200 disabled:opacity-50"
                >
                    <svg wire:loading.remove class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <svg wire:loading class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove>Refresh Data</span>
                    <span wire:loading>Updating...</span>
                </button>
            </div>
        @endif
    </div>
</div>

@script
<script>
    $wire.on('counters-refreshed', () => {
        // Optional: Add any additional JavaScript actions after refresh
        console.log('Impact counters refreshed');
    });
</script>
@endscript