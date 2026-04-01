<x-frontend-layout>
    <!-- Hero Banner with Products -->
    <section class="hero-section w-full bg-gradient-to-br from-[#cfe9f3] via-[#e1f0f8] to-[#bde0eb] py-20 md:py-32 min-h-[700px] flex items-center overflow-hidden relative">
        <!-- Background decorative elements -->
        <div class="hero-bg-elements absolute inset-0 overflow-hidden">
            <div class="hero-blob-1 absolute top-10 left-10 w-72 h-72 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
            <div class="hero-blob-2 absolute top-40 right-20 w-80 h-80 bg-green-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
            <div class="hero-blob-3 absolute -bottom-8 left-1/4 w-64 h-64 bg-cyan-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
        </div>

        <div class="hero-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center relative z-10">
            <!-- Left Text -->
            <div class="hero-text space-y-8">
                <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                    Discover Amazing 
                    <span class="hero-gradient-text text-transparent bg-clip-text bg-gradient-to-r from-green-700 to-emerald-600">
                        Products & Deals
                    </span>
                </h1>
                
                <p class="hero-description text-lg md:text-xl text-gray-700 leading-relaxed max-w-2xl">
                    Shop the latest electronics, fashion, home essentials and more. 
                    <span class="font-semibold text-gray-900">Premium quality</span> at 
                    <span class="font-bold text-green-700">unbeatable prices.</span>
                </p>

                <!-- CTA Button -->
                <div class="hero-cta pt-4">
                    <a href="/products"
                       class="hero-btn group inline-flex items-center justify-center gap-3 px-10 py-4 text-lg font-semibold rounded-xl bg-gradient-to-r from-green-800 to-emerald-700 text-white hover:from-green-900 hover:to-emerald-800 transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl active:scale-95 w-full sm:w-auto">
                        <svg class="hero-btn-icon w-6 h-6 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Start Shopping
                    </a>
                </div>
            </div>

            <!-- Right Product Images with Floating Effect -->
            <div class="hero-images relative flex justify-center lg:justify-end">
                <div class="hero-image-container relative w-[320px] md:w-[450px] h-[320px] md:h-[450px]">
                    @php
                        $featuredProduct = $featuredProducts->first();
                        $secondaryProducts = $featuredProducts->skip(1)->take(2);
                    @endphp
                    
                    <!-- Main Product Image -->
                    <div class="hero-main-image absolute inset-0 z-20">
                        @if($featuredProduct)
                        <a href="{{ route('frontend.products.show', $featuredProduct->slug) }}">
                            <img src="{{ $featuredProduct->image ? asset('storage/products/' . $featuredProduct->image) : asset('images/products/default.jpg') }}"
                                 alt="{{ $featuredProduct->name }}"
                                 class="hero-product-img w-full h-full rounded-3xl shadow-2xl object-cover border-8 border-white hover:scale-105 transition-transform duration-700">
                            @if($featuredProduct->discount > 0)
                            <div class="hero-badge absolute -top-4 -right-4 bg-gradient-to-r from-red-500 to-orange-500 text-white px-4 py-2 rounded-xl shadow-lg">
                                <span class="font-bold text-sm">🔥 {{ $featuredProduct->discount }}% OFF</span>
                            </div>
                            @endif
                        </a>
                        @endif
                    </div>
                    
                    <!-- Floating Card 1 -->
                    @if($secondaryProducts->first())
                    <div class="hero-floating-card-1 absolute -bottom-6 -left-6 md:-bottom-10 md:-left-10 z-10">
                        <a href="{{ route('frontend.products.show', $secondaryProducts->first()->slug) }}">
                            <div class="hero-card bg-white rounded-2xl shadow-xl p-3 transform rotate-6 hover:rotate-0 transition-transform duration-500">
                                <img src="{{ $secondaryProducts->first()->image ? asset('storage/products/' . $secondaryProducts->first()->image) : asset('images/products/default.jpg') }}"
                                     alt="{{ $secondaryProducts->first()->name }}"
                                     class="w-full h-full rounded-xl object-cover">
                            </div>
                        </a>
                    </div>
                    @endif
                    
                    <!-- Floating Card 2 -->
                    @if($secondaryProducts->last())
                    <div class="hero-floating-card-2 absolute -top-6 -right-6 md:-top-10 md:-right-10 z-10">
                        <a href="{{ route('frontend.products.show', $secondaryProducts->last()->slug) }}">
                            <div class="hero-card bg-white rounded-2xl shadow-xl p-3 transform -rotate-6 hover:rotate-0 transition-transform duration-500">
                                <img src="{{ $secondaryProducts->last()->image ? asset('storage/products/' . $secondaryProducts->last()->image) : asset('images/products/default.jpg') }}"
                                     alt="{{ $secondaryProducts->last()->name }}"
                                     class="w-full h-full rounded-xl object-cover">
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="hero-scroll-indicator absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <a href="#categories" class="text-gray-400 hover:text-green-700 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </section>

    <!-- Section 2: Shop by Categories -->
    <section id="categories" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Shop Our Top Categories</h2>
                    <p class="text-gray-600 mt-2">Browse products by popular categories</p>
                </div>
                <a href="{{ route('frontend.category.index') }}" 
                   class="text-green-900 font-semibold hover:underline hover:text-gray-800 transition-colors duration-300 flex items-center gap-2">
                    <span>View All Categories</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
            
            @if($categories->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                    <a href="{{ route('frontend.category.show', $category->slug) }}" 
                       class="group cursor-pointer">
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2 border border-gray-100">
                            <div class="relative h-48 overflow-hidden {{ $category->color ?? 'bg-gray-50' }}">
                                @if($category->image)
                                    <img src="{{ $category->image }}" 
                                         alt="{{ $category->name }}" 
                                         class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-105 transition-all duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        @if($category->icon)
                                            <div class="text-5xl text-gray-600 opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300">
                                                {!! $category->icon !!}
                                            </div>
                                        @else
                                            <svg class="w-20 h-20 text-gray-400 opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-white/90 text-gray-700 backdrop-blur-sm">
                                        {{ $category->product_count ?? 0 }} items
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-green-900 transition-colors">
                                    {{ $category->name }}
                                </h3>
                                <p class="text-sm text-gray-500 line-clamp-2 mb-3">
                                    {{ $category->description ?? 'Explore amazing products' }}
                                </p>
                                <div class="flex items-center text-green-900 text-sm font-medium">
                                    <span>Shop Now</span>
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Categories Available</h3>
                    <p class="text-gray-600">Categories will be added soon</p>
                </div>
            @endif
            
            <div class="mt-10 text-center block md:hidden">
                <a href="{{ route('frontend.category.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-800 to-emerald-700 text-white font-semibold rounded-lg hover:from-green-900 hover:to-emerald-800 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                    <span>View All Categories</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Section 3: Today's Best Deals -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900">Today's Best Deals For You!</h2>
                <a href="/products" class="text-green-900 font-semibold hover:underline hover:text-gray-800 transition-colors duration-300">View All →</a>
            </div>
            
            @if($bestSellers->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($bestSellers as $product)
                        @include('frontend.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Best Deals Available</h3>
                    <p class="text-gray-600">Check back soon for amazing deals</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Section 4: Choose by Brand (Dynamic from Admin) -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Choose by Brand</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($dbBrands as $brand)
                <a href="{{ route('frontend.brand.show', $brand->slug) }}" class="block group">
                    <div class="bg-white rounded-xl p-6 text-center hover:shadow-xl transition-all duration-300 group hover:-translate-y-2 border border-gray-100 hover:border-green-200">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-50 rounded-full p-3 group-hover:bg-green-50 transition-colors duration-300">
                            @if($brand->logo)
                                <img src="{{ asset('storage/brands/' . $brand->logo) }}" 
                                     alt="{{ $brand->name }}" 
                                     class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 font-bold text-xl">
                                    {{ substr($brand->name, 0, 2) }}
                                </div>
                            @endif
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-green-900 transition-colors duration-300">
                            {{ $brand->name }}
                        </h3>
                        <p class="text-green-900 text-sm font-medium group-hover:text-gray-800">
                            {{ $brand->product_count }} products
                        </p>
                    </div>
                </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">No brands available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section 5: Get Up to 70% off (Dynamic from Admin) -->
    @if($discountBanners->count() > 0)
        @foreach($discountBanners as $banner)
        <section class="py-20" style="background: {{ $banner->background_color ?? 'linear-gradient(135deg, #1f2937 0%, #111827 100%)' }};">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold mb-4 hover:scale-105 transition-transform duration-300 inline-block" 
                    style="color: {{ $banner->text_color ?? '#ffffff' }};">
                    {{ $banner->title }}
                </h2>
                @if($banner->description)
                    <p class="text-lg mb-8 max-w-2xl mx-auto" style="color: {{ $banner->text_color ?? '#ffffff' }}; opacity: 0.9;">
                        {{ $banner->description }}
                    </p>
                @endif
                @if($banner->cashback_text && $banner->cashback_amount)
                    <p class="text-lg mb-8 font-semibold" style="color: {{ $banner->text_color ?? '#ffffff' }};">
                        {{ $banner->cashback_text }} ₹{{ number_format($banner->cashback_amount, 0) }} on ₹{{ number_format($banner->minimum_purchase, 0) }}
                    </p>
                @endif
                <a href="{{ $banner->button_link }}" 
                   class="inline-flex items-center gap-2 bg-white text-gray-900 font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    {{ $banner->button_text }}
                </a>
            </div>
        </section>
        @endforeach
    @else
        <!-- Fallback Discount Banner -->
        <section class="py-20 bg-gradient-to-r from-green-900 to-gray-800 hover:shadow-2xl transition-shadow duration-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-white mb-4 hover:scale-105 transition-transform duration-300 inline-block">Get 5% Cash back on ₹200</h2>
                <p class="text-gray-200 text-lg mb-8 max-w-2xl mx-auto">
                    Shopping is a bit of a relaxing hobby for me, which is sometimes troubling for the bank balance.
                </p>
                <a href="/products" class="inline-flex items-center gap-2 bg-white text-green-900 font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Shop Now
                </a>
            </div>
        </section>
    @endif

    <!-- Section 6: Weekly Popular Products -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900">Weekly Popular Products</h2>
                <a href="/products" class="text-green-900 font-semibold hover:underline hover:text-gray-800 transition-colors duration-300">View All →</a>
            </div>
            
            @if($weeklyPopular->count() > 0)
                <div class="relative">
                    <div class="flex gap-6 overflow-x-auto pb-6 scrollbar-hide snap-x snap-mandatory scroll-smooth" id="weeklyProductsCarousel">
                        @foreach($weeklyPopular as $product)
                        <div class="flex-shrink-0 w-72 snap-start">
                            @include('frontend.partials.product-card', ['product' => $product])
                        </div>
                        @endforeach
                    </div>
                    
                    @if($weeklyPopular->count() > 4)
                    <div class="flex justify-center gap-2 mt-6">
                        @for($i = 0; $i < ceil($weeklyPopular->count() / 4); $i++)
                        <button class="w-3 h-3 rounded-full bg-gray-300 hover:bg-green-900 transition-colors duration-300 scroll-indicator-dot {{ $i === 0 ? 'bg-green-900' : '' }}" data-index="{{ $i }}"></button>
                        @endfor
                    </div>
                    @endif
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Popular Products</h3>
                    <p class="text-gray-600">Popular products will be added soon</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Section 7: Product Tabs -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-10">Today's Best Deals for you!</h2>
            
            <div class="border-b border-gray-200 mb-8">
                <div class="flex flex-wrap gap-4">
                    <button class="tab-button px-4 py-2 font-medium text-gray-600 hover:text-green-900 border-b-2 border-transparent hover:border-green-900 transition-all duration-300 hover:bg-green-50 rounded-t-lg text-green-900 border-green-900" data-tab="featured">
                        Featured
                    </button>
                    <button class="tab-button px-4 py-2 font-medium text-gray-600 hover:text-green-900 border-b-2 border-transparent hover:border-green-900 transition-all duration-300 hover:bg-green-50 rounded-t-lg" data-tab="new-arrivals">
                        New Arrivals
                    </button>
                    <button class="tab-button px-4 py-2 font-medium text-gray-600 hover:text-green-900 border-b-2 border-transparent hover:border-green-900 transition-all duration-300 hover:bg-green-50 rounded-t-lg" data-tab="trending">
                        Trending
                    </button>
                    <button class="tab-button px-4 py-2 font-medium text-gray-600 hover:text-green-900 border-b-2 border-transparent hover:border-green-900 transition-all duration-300 hover:bg-green-50 rounded-t-lg" data-tab="best-sellers">
                        Best Sellers
                    </button>
                </div>
            </div>

            <div id="tab-content">
                <div class="tab-pane active" id="tab-featured">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($featuredProducts->take(4) as $product)
                            @include('frontend.partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </div>
                
                <div class="tab-pane hidden" id="tab-new-arrivals">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($newArrivals->take(4) as $product)
                            @include('frontend.partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </div>
                
                <div class="tab-pane hidden" id="tab-trending">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($trendingProducts->take(4) as $product)
                            @include('frontend.partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </div>
                
                <div class="tab-pane hidden" id="tab-best-sellers">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($bestSellers->take(4) as $product)
                            @include('frontend.partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 8: Most Selling Products -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900">Most Selling Products</h2>
                <a href="/products" class="text-green-900 font-semibold hover:underline hover:text-gray-800 transition-colors duration-300">View All →</a>
            </div>
            
            @if($bestSellers->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($bestSellers->take(4) as $product)
                        @include('frontend.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Products Available</h3>
                    <p class="text-gray-600">Products will be added soon</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Section 9: Trending Products (Large Featured) -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Trending Products for you!</h2>
            
            @if($trendingProducts->count() >= 2)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($trendingProducts->take(2) as $product)
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group hover:-translate-y-2">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-2/5 p-8">
                                <a href="{{ route('frontend.products.show', $product->slug) }}">
                                    <img src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('images/products/default.jpg') }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-64 object-contain group-hover:scale-110 transition-transform duration-700">
                                </a>
                            </div>
                            
                            <div class="md:w-3/5 p-8 flex flex-col justify-center">
                                <a href="{{ route('frontend.products.show', $product->slug) }}">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-green-900 transition-colors duration-300">{{ $product->name }}</h3>
                                </a>
                                <p class="text-gray-600 mb-6 line-clamp-3">{{ $product->description }}</p>
                                
                                <div class="flex items-center gap-4 mb-8 flex-wrap">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700">Free Shipping</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700">Delivery within 24 hours</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-gray-900">₹{{ number_format($product->price, 0) }}</span>
                                        @if($product->old_price)
                                        <span class="text-lg text-gray-400 line-through ml-2">₹{{ number_format($product->old_price, 0) }}</span>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="bg-gradient-to-r from-green-800 to-emerald-700 hover:from-green-900 hover:to-emerald-800 text-white px-6 py-2 rounded-lg font-medium transition flex items-center gap-2 shadow-md hover:shadow-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            Shop Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">More Trending Products Coming Soon</h3>
                    <p class="text-gray-600">Stay tuned for amazing trending products!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Section 10: Services to help you shop (Dynamic from Admin) -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Services to help you shop</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($services as $service)
                <div class="rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 group hover:-translate-y-2" 
                     style="background-color: {{ $service->background_color ?? '#f0f9ff' }};">
                    <div class="p-8">
                        <div class="mb-6">
                            @if($service->icon)
                                <img src="{{ asset('storage/services/' . $service->icon) }}" 
                                     alt="{{ $service->title }}" 
                                     class="w-12 h-12 object-contain">
                            @elseif($service->icon_class)
                                <div class="text-5xl" style="color: {{ $service->text_color ?? '#1e3a8a' }};">
                                    <i class="{{ $service->icon_class }}"></i>
                                </div>
                            @else
                                <svg class="w-12 h-12" style="color: {{ $service->text_color ?? '#1e3a8a' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold mb-4" style="color: {{ $service->text_color ?? '#1e3a8a' }};">
                            {{ $service->title }}
                        </h3>
                        <p class="text-gray-600 mb-8">{{ $service->description }}</p>
                        
                        <a href="{{ $service->button_link }}" 
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition-all duration-300 hover:scale-105"
                           style="background-color: {{ $service->text_color ?? '#1e3a8a' }}; color: white;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $service->button_text }}
                        </a>
                    </div>
                </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">No services available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Include Footer -->
    {{-- @include('components.frontend-footer') --}}

    <!-- JavaScript for Tabs and Carousel -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabPanes = document.querySelectorAll('.tab-pane');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    tabButtons.forEach(btn => {
                        btn.classList.remove('text-green-900', 'border-green-900');
                        btn.classList.add('text-gray-600', 'border-transparent');
                    });
                    
                    tabPanes.forEach(pane => {
                        pane.classList.remove('active');
                        pane.classList.add('hidden');
                    });
                    
                    this.classList.remove('text-gray-600', 'border-transparent');
                    this.classList.add('text-green-900', 'border-green-900');
                    
                    const activePane = document.getElementById(`tab-${tabId}`);
                    if (activePane) {
                        activePane.classList.remove('hidden');
                        activePane.classList.add('active');
                    }
                });
            });

            // Carousel scroll indicators
            const carousel = document.getElementById('weeklyProductsCarousel');
            const dots = document.querySelectorAll('.scroll-indicator-dot');
            
            if (carousel && dots.length) {
                carousel.addEventListener('scroll', function() {
                    const scrollPosition = carousel.scrollLeft;
                    const itemWidth = carousel.querySelector('.flex-shrink-0')?.offsetWidth || 0;
                    const activeIndex = Math.round(scrollPosition / (itemWidth + 24));
                    
                    dots.forEach((dot, index) => {
                        if (index === activeIndex) {
                            dot.classList.add('bg-green-900');
                            dot.classList.remove('bg-gray-300');
                        } else {
                            dot.classList.remove('bg-green-900');
                            dot.classList.add('bg-gray-300');
                        }
                    });
                });
                
                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        const itemWidth = carousel.querySelector('.flex-shrink-0')?.offsetWidth || 0;
                        const scrollTo = index * (itemWidth + 24);
                        carousel.scrollTo({ left: scrollTo, behavior: 'smooth' });
                    });
                });
            }
        });
    </script>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
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
</x-frontend-layout>