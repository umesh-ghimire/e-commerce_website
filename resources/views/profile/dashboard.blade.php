@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-emerald-50/30">
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            <!-- Welcome Header -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl p-6 md:p-8 mb-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-24 -mb-24"></div>
                
                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-3xl font-bold border-2 border-white">
                                {{ substr(auth()->user()->name, 0, 2) }}
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold">Welcome back, {{ auth()->user()->name }}!</h1>
                                <p class="text-emerald-100 mt-1">Member since {{ auth()->user()->created_at->format('F Y') }}</p>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-sm rounded-xl hover:bg-white/30 transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
                <div class="bg-white rounded-xl p-5 text-center shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="text-3xl font-bold text-emerald-600">{{ $stats['total_orders'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500 mt-1">Total Orders</div>
                </div>
                <div class="bg-white rounded-xl p-5 text-center shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="text-3xl font-bold text-emerald-600">₹{{ number_format($stats['total_spent'] ?? 0, 0) }}</div>
                    <div class="text-sm text-gray-500 mt-1">Total Spent</div>
                </div>
                <div class="bg-white rounded-xl p-5 text-center shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="text-3xl font-bold text-emerald-600">{{ $stats['wishlist_count'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500 mt-1">Wishlist</div>
                </div>
                <div class="bg-white rounded-xl p-5 text-center shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="text-3xl font-bold text-emerald-600">{{ $stats['reviews_count'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500 mt-1">Reviews</div>
                </div>
                <div class="bg-white rounded-xl p-5 text-center shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="text-3xl font-bold text-orange-600">{{ $stats['pending_orders'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500 mt-1">Pending</div>
                </div>
                <div class="bg-white rounded-xl p-5 text-center shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="text-3xl font-bold text-green-600">{{ $stats['delivered_orders'] ?? 0 }}</div>
                    <div class="text-sm text-gray-500 mt-1">Delivered</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Orders -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold text-gray-900">Recent Orders</h2>
                            <a href="{{ route('profile.orders') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">View All →</a>
                        </div>
                        
                        @if(isset($recent_orders) && $recent_orders->count() > 0)
                            <div class="space-y-4">
                                @foreach($recent_orders as $order)
                                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                    <div>
                                        <p class="font-semibold text-gray-900">#{{ $order->order_number }}</p>
                                        <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-gray-900">₹{{ number_format($order->total, 2) }}</p>
                                        <span class="text-xs px-2 py-1 rounded-full inline-block mt-1
                                            @if($order->status == 'delivered') bg-green-100 text-green-800
                                            @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                            @else bg-blue-100 text-blue-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <p class="text-gray-500">No orders yet</p>
                                <a href="{{ route('frontend.products.index') }}" class="text-emerald-600 hover:underline mt-2 inline-block">Start Shopping →</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions & Recent Reviews -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Quick Actions</h2>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('profile.orders') }}" class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl hover:from-emerald-50 hover:to-emerald-100 transition-all text-center group">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-600 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <span class="text-sm font-medium">My Orders</span>
                            </a>
                            <a href="{{ route('profile.wishlist') }}" class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl hover:from-emerald-50 hover:to-emerald-100 transition-all text-center group">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-600 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span class="text-sm font-medium">Wishlist</span>
                            </a>
                            <a href="{{ route('profile.addresses') }}" class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl hover:from-emerald-50 hover:to-emerald-100 transition-all text-center group">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-600 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm font-medium">Addresses</span>
                            </a>
                            <a href="{{ route('profile.reviews') }}" class="p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl hover:from-emerald-50 hover:to-emerald-100 transition-all text-center group">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-600 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                                <span class="text-sm font-medium">Reviews</span>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Reviews -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Reviews</h2>
                        @if(isset($recent_reviews) && $recent_reviews->count() > 0)
                            <div class="space-y-3">
                                @foreach($recent_reviews as $review)
                                <div class="border-b border-gray-100 pb-3 last:border-0">
                                    <p class="font-medium text-gray-900">{{ $review->product->name }}</p>
                                    <div class="flex items-center gap-1 mt-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-3 h-3 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $review->comment }}</p>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-6">No reviews yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection