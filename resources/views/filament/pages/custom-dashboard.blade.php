{{-- resources/views/filament/pages/custom-dashboard.blade.php --}}

<x-filament-panels::page>
    <div class="tactile-dashboard">
        <!-- Welcome Header -->
        <div class="welcome-header mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">AlexRivera</h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Administrator</p>
                </div>
                <div class="search-bar">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Search insights..." 
                               class="w-80 px-4 py-2 pl-10 pr-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Row -->
        <div class="stats-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">TOTAL USERS</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">84,200</h3>
                    </div>
                    <div class="stat-icon p-3 bg-indigo-100 dark:bg-indigo-900/50 rounded-xl">
                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-green-600 text-sm font-medium">+5.2%</span>
                    <span class="text-gray-500 text-sm">vs last month</span>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">REVENUE</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">$124,500</h3>
                    </div>
                    <div class="stat-icon p-3 bg-green-100 dark:bg-green-900/50 rounded-xl">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-green-600 text-sm font-medium">+8.1%</span>
                    <span class="text-gray-500 text-sm">vs last month</span>
                </div>
            </div>

            <!-- Growth Card -->
            <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">GROWTH</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">+12.5%</h3>
                    </div>
                    <div class="stat-icon p-3 bg-purple-100 dark:bg-purple-900/50 rounded-xl">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-green-600 text-sm font-medium">+2.4%</span>
                    <span class="text-gray-500 text-sm">vs last month</span>
                </div>
            </div>

            <!-- Transactions Card -->
            <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">TRANSACTIONS</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">1,284</h3>
                    </div>
                    <div class="stat-icon p-3 bg-orange-100 dark:bg-orange-900/50 rounded-xl">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span class="text-green-600 text-sm font-medium">+2.4%</span>
                    <span class="text-gray-500 text-sm">vs last month</span>
                </div>
            </div>
        </div>

        <!-- Performance Overview Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Performance Chart -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Performance Overview</h3>
                    <div class="flex gap-2">
                        <button class="period-btn active px-4 py-1 text-sm rounded-lg bg-indigo-50 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400">Weekly</button>
                        <button class="period-btn px-4 py-1 text-sm rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">Monthly</button>
                    </div>
                </div>
                <div class="chart-container h-80">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>

            <!-- Weekly Goal Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Weekly Goal</h3>
                <div class="text-center">
                    <div class="relative inline-flex items-center justify-center">
                        <svg class="w-40 h-40">
                            <circle class="text-gray-200 dark:text-gray-700" stroke-width="8" stroke="currentColor" fill="transparent" r="70" cx="80" cy="80"/>
                            <circle class="text-indigo-600 dark:text-indigo-400" stroke-width="8" stroke-linecap="round" stroke="currentColor" fill="transparent" r="70" cx="80" cy="80" 
                                    stroke-dasharray="439.82" stroke-dashoffset="79.16"/>
                        </svg>
                        <div class="absolute">
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">82%</span>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mt-4">You have reached 82% of your target this week.</p>
                </div>
            </div>
        </div>

        <!-- Recent Customers & Support Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Customers -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Customers</h3>
                    <a href="#" class="text-indigo-600 dark:text-indigo-400 text-sm font-medium hover:underline">View All Transactions →</a>
                </div>
                <div class="space-y-4">
                    <div class="customer-item flex justify-between items-center p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white font-semibold">SJ</div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Sarah Jenkins</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">New customer registration</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-green-600 dark:text-green-400">+$240</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">2 mins ago</p>
                        </div>
                    </div>
                    <div class="customer-item flex justify-between items-center p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-teal-500 flex items-center justify-center text-white font-semibold">DM</div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">David Miller</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Premium plan purchase</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-green-600 dark:text-green-400">+$1,120</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">1 hour ago</p>
                        </div>
                    </div>
                    <div class="customer-item flex justify-between items-center p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors duration-200">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center text-white font-semibold">EF</div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Elena Fisher</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Product review submitted</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-green-600 dark:text-green-400">+$85</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">5 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support & Settings -->
            <div class="space-y-6">
                <!-- Support Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636L16.95 7.05M16.95 7.05a7 7 0 11-9.9 9.9 7 7 0 019.9-9.9zM12 12h.01M8 12h.01M16 12h.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">SUPPORT</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">24/7 customer support available</p>
                    <button class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors duration-200">
                        Contact Support
                    </button>
                </div>

                <!-- Settings Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/50 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">SETTINGS</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400 text-sm">Pro Plan Status</span>
                            <button class="px-3 py-1 text-sm bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:shadow-lg transition-all duration-200">Upgrade</button>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-indigo-600 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">65% of premium features used</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js for the performance chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('performanceChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
                    datasets: [
                        {
                            label: 'Revenue',
                            data: [65, 72, 68, 85, 90, 78, 95],
                            borderColor: '#4f46e5',
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Transactions',
                            data: [45, 52, 48, 65, 70, 58, 75],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>

    <style>
        .tactile-dashboard {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
        }
        
        .period-btn.active {
            background: #4f46e5;
            color: white;
        }
        
        .period-btn.active:hover {
            background: #4338ca;
        }
        
        .customer-item {
            transition: all 0.2s;
        }
        
        /* Dark mode adjustments */
        .dark .stat-card {
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .search-bar input {
                width: 200px;
            }
            
            .stats-grid {
                gap: 1rem;
            }
        }
    </style>
</x-filament-panels::page>