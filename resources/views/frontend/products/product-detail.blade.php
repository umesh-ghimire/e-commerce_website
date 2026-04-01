<x-frontend-layout>
    <!-- Breadcrumb -->
    <section class="bg-gray-50 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center text-sm">
                <a href="/" class="text-gray-600 hover:text-green-900 transition-colors">Home</a>
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="{{ route('frontend.category.index') }}" class="text-gray-600 hover:text-green-900 transition-colors">Categories</a>
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                @if($product->category)
                <a href="{{ route('frontend.category.show', $product->category->slug) }}" class="text-gray-600 hover:text-green-900 transition-colors">
                    {{ $product->category->name }}
                </a>
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                @endif
                <span class="text-green-900 font-medium truncate">{{ $product->name }}</span>
            </nav>
        </div>
    </section>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Product Detail Section -->
    <section class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Product Images -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="bg-white rounded-2xl p-4 md:p-8 shadow-sm border border-gray-100">
                        <div class="relative aspect-square">
                            <img src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('images/products/default.jpg') }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-contain" 
                                 id="main-product-image">
                        </div>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="space-y-6">
                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2">
                        @if($product->discount > 0)
                        <span class="px-3 py-1 bg-red-500 text-white text-sm font-semibold rounded-full">
                            -{{ $product->discount }}% OFF
                        </span>
                        @endif
                        @if($product->is_new)
                        <span class="px-3 py-1 bg-green-500 text-white text-sm font-semibold rounded-full">
                            New Arrival
                        </span>
                        @endif
                        @if($product->is_best_seller)
                        <span class="px-3 py-1 bg-purple-500 text-white text-sm font-semibold rounded-full">
                            Best Seller
                        </span>
                        @endif
                        @if($product->is_trending)
                        <span class="px-3 py-1 bg-yellow-500 text-white text-sm font-semibold rounded-full">
                            Trending
                        </span>
                        @endif
                    </div>
                    
                    <!-- Product Title -->
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">{{ $product->name }}</h1>
                    
                    <!-- Rating & Stock -->
                    <div class="flex items-center gap-4 flex-wrap">
                        <!-- Rating -->
                        <div class="flex items-center gap-2">
                            <div class="flex items-center">
                                @php
                                    $rating = $product->averageRating;
                                    $fullStars = floor($rating);
                                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $fullStars)
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @elseif($hasHalfStar && $i == $fullStars + 1)
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 1l1.993 4.399 4.446.647-3.217 3.134.759 4.426L10 12.367l-3.981 2.239.759-4.426L2.56 6.046l4.447-.647L10 1z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <a href="#reviews" class="text-gray-600 hover:text-green-700">
                                {{ number_format($product->averageRating, 1) }} ({{ $product->totalReviews }} reviews)
                            </a>
                        </div>
                        
                        <!-- Stock Status -->
                        <span class="px-3 py-1 rounded-full text-sm font-medium 
                            @if($product->stock == 'available') bg-green-100 text-green-800
                            @elseif($product->stock == 'low') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            @if($product->stock == 'available') In Stock
                            @elseif($product->stock == 'low') Low Stock
                            @else Out of Stock @endif
                        </span>
                        
                        <!-- Category -->
                        @if($product->category)
                        <a href="{{ route('frontend.category.show', $product->category->slug) }}" 
                           class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                            {{ $product->category->name }}
                        </a>
                        @endif
                    </div>
                    
                    <!-- Price -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <span class="text-3xl md:text-4xl font-bold text-gray-900">₹{{ number_format($product->price, 0) }}</span>
                            @if($product->old_price)
                            <span class="text-xl text-gray-400 line-through">₹{{ number_format($product->old_price, 0) }}</span>
                            @endif
                        </div>
                        @if($product->discount > 0 && $product->old_price)
                        <div class="text-green-900 font-semibold">
                            Save ₹{{ number_format($product->old_price - $product->price, 0) }} ({{ $product->discount }}% OFF)
                        </div>
                        @endif
                    </div>
                    
                    <!-- Description -->
                    <div class="space-y-3">
                        <h3 class="text-xl font-semibold text-gray-900">Description</h3>
                        <div class="text-gray-600 leading-relaxed prose max-w-none">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                    
                    <!-- Key Features -->
                    @if($product->badges && is_array($product->badges))
                    <div class="space-y-3">
                        <h3 class="text-xl font-semibold text-gray-900">Key Features</h3>
                        <ul class="space-y-2">
                            @foreach($product->badges as $feature)
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-900 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-gray-600">{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <!-- Add to Cart & Actions -->
                    <div class="space-y-4 pt-6 border-t border-gray-200">
                        <!-- Quantity Selector -->
                        <div class="flex items-center gap-4">
                            <span class="text-gray-900 font-medium">Quantity:</span>
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button type="button" class="quantity-btn px-4 py-2 text-gray-600 hover:text-green-900" onclick="decreaseQuantity()">-</button>
                                <input type="text" value="1" class="w-16 text-center border-x border-gray-300 py-2 focus:outline-none" id="quantity-input">
                                <button type="button" class="quantity-btn px-4 py-2 text-gray-600 hover:text-green-900" onclick="increaseQuantity()">+</button>
                            </div>
                            <div class="text-sm text-gray-500">
                                @if($product->stock == 'available')
                                    Available in stock
                                @elseif($product->stock == 'low')
                                    Only a few left
                                @else
                                    Currently unavailable
                                @endif
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            @if($product->stock != 'out_of_stock')
                            <button class="cart-btn-unified flex-1 justify-center" onclick="addToCart({{ $product->id }})">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Add to Cart
                            </button>
                            <button class="buy-now-btn-unified flex-1 justify-center" onclick="buyNow({{ $product->id }})">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Buy Now
                            </button>
                            @else
                            <button class="cart-btn-unified flex-1 justify-center opacity-50 cursor-not-allowed" disabled>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Out of Stock
                            </button>
                            @endif
                            
                            <!-- Wishlist Button -->
                            <button class="wishlist-btn-unified" onclick="toggleWishlist({{ $product->id }})" id="wishlist-btn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Shipping Info -->
                    <div class="bg-gray-50 rounded-xl p-4 space-y-3">
                        <h4 class="font-semibold text-gray-900">Shipping & Returns</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-600">Free shipping</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">Delivery in 2-3 days</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-600">30-day returns</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">Secure payment</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Related Products</h2>
                <a href="{{ route('frontend.products.index') }}" class="text-green-900 font-semibold hover:underline flex items-center gap-2">
                    View All
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group hover:-translate-y-1">
                    <a href="{{ route('frontend.products.show', $relatedProduct->slug) }}">
                        <div class="p-4">
                            <div class="relative h-48 mb-4 overflow-hidden rounded-lg bg-gray-50">
                                <img src="{{ $relatedProduct->image ? asset('storage/products/' . $relatedProduct->image) : asset('images/products/default.jpg') }}" 
                                     alt="{{ $relatedProduct->name }}" 
                                     class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-green-900 line-clamp-1">{{ $relatedProduct->name }}</h3>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-bold text-gray-900">₹{{ number_format($relatedProduct->price, 0) }}</span>
                                    @if($relatedProduct->old_price)
                                    <span class="text-sm text-gray-400 line-through ml-2">₹{{ number_format($relatedProduct->old_price, 0) }}</span>
                                    @endif
                                </div>
                                <button class="cart-btn-unified" onclick="addToCart({{ $relatedProduct->id }}, event)">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Product Reviews Section -->
    <section class="py-12 bg-white" id="reviews">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">Customer Reviews</h2>
            
            @if($product->totalReviews > 0)
            <!-- Overall Rating -->
            <div class="bg-gray-50 rounded-xl p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="text-center md:text-left">
                        <div class="text-5xl font-bold text-gray-900 mb-2">{{ number_format($product->averageRating, 1) }}</div>
                        <div class="flex items-center justify-center md:justify-start mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($product->averageRating))
                                    <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-gray-300 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <p class="text-gray-600">Based on {{ $product->totalReviews }} reviews</p>
                    </div>
                    
                    <!-- Rating Distribution -->
                    <div class="flex-1 max-w-md">
                        @foreach([5,4,3,2,1] as $star)
                            @php
                                $count = $product->reviews()->where('rating', $star)->count();
                                $percentage = $product->totalReviews > 0 ? ($count / $product->totalReviews) * 100 : 0;
                            @endphp
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-12 text-sm">{{ $star }} <i class="fas fa-star text-yellow-400 text-xs"></i></div>
                                <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="w-12 text-sm text-gray-500">{{ $count }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Write a Review Button -->
            @auth
                @php
                    $userReview = $product->reviews()->where('user_id', auth()->id())->first();
                @endphp
                
                @if(!$userReview)
                    <div class="mb-8">
                        <button onclick="toggleReviewForm()" 
                                class="bg-gradient-to-r from-green-800 to-emerald-700 text-white px-6 py-2 rounded-lg font-medium hover:from-green-900 hover:to-emerald-800 transition-all duration-300">
                            <i class="fas fa-edit mr-2"></i>
                            Write a Review
                        </button>
                    </div>
                    
                    <div id="review-form-container" class="hidden mb-8">
                        @include('frontend.partials.review-form', ['product' => $product])
                    </div>
                @else
                    <div class="mb-8 p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-blue-700">You have already reviewed this product. Thank you for your feedback!</p>
                        </div>
                        
                    </div>
                @endif
            @else
                <div class="mb-8 p-4 bg-gray-50 rounded-lg text-center">
                    <p class="text-gray-600">
                        Please <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:underline">login</a> to write a review.
                    </p>
                </div>
            @endauth
            
            <!-- Reviews List -->
            @if($product->approvedReviews()->count() > 0)
                <div class="space-y-4 mt-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Recent Reviews</h3>
                    @foreach($product->approvedReviews()->limit(5)->get() as $review)
                        @include('frontend.partials.review-card', ['review' => $review])
                    @endforeach
                    
                    @if($product->approvedReviews()->count() > 5)
                        <div class="text-center mt-6">
                            <a href="{{ route('reviews.index', $product) }}" 
                               class="inline-block text-green-700 hover:text-green-900 font-medium">
                                Read all {{ $product->approvedReviews()->count() }} reviews →
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-xl">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Reviews Yet</h3>
                    <p class="text-gray-600 mb-4">Be the first to review this product!</p>
                    @auth
                        @if(!isset($userReview) || !$userReview)
                            <button onclick="toggleReviewForm()" 
                                    class="cart-btn-unified inline-flex px-6">
                                Write First Review
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="cart-btn-unified inline-flex px-6">
                            Login to Review
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </section>

    <style>
        .quantity-btn {
            transition: all 0.3s ease;
        }
        
        .quantity-btn:hover {
            background-color: #f3f4f6;
        }
        
        .cart-btn-unified {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background-color: #065f46;
            color: white;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .cart-btn-unified:hover {
            background-color: #064e3b;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(6, 95, 70, 0.2);
        }
        
        .buy-now-btn-unified {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background-color: #dc2626;
            color: white;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .buy-now-btn-unified:hover {
            background-color: #b91c1c;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
        }
        
        .wishlist-btn-unified {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 3rem;
            height: 3rem;
            background-color: #f8f9fa;
            color: #6c757d;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .wishlist-btn-unified:hover,
        .wishlist-btn-unified.active {
            background-color: #065f46;
            color: white;
            border-color: #065f46;
        }
        
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .prose {
            max-width: none;
        }
        
        .prose p {
            margin-bottom: 1rem;
        }
        
        .prose p:last-child {
            margin-bottom: 0;
        }
    </style>

    <script>
        // Quantity control functions
        function increaseQuantity() {
            const input = document.getElementById('quantity-input');
            let value = parseInt(input.value) || 1;
            input.value = value + 1;
        }
        
        function decreaseQuantity() {
            const input = document.getElementById('quantity-input');
            let value = parseInt(input.value) || 1;
            if (value > 1) {
                input.value = value - 1;
            }
        }
        
        // Toggle review form
        function toggleReviewForm() {
            const form = document.getElementById('review-form-container');
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                form.classList.add('hidden');
            }
        }
        
        // Add to cart function
        async function addToCart(productId, event = null) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            const quantity = document.getElementById('quantity-input').value;
            
            const btn = event ? event.target.closest('.cart-btn-unified') : document.querySelector('.cart-btn-unified');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>';
            btn.disabled = true;
            
            try {
                const response = await fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showToast('Product added to cart successfully!', 'success');
                    updateCartCount(data.cart_count);
                } else {
                    showToast(data.message || 'Failed to add to cart', 'error');
                }
            } catch (error) {
                showToast('An error occurred. Please try again.', 'error');
            } finally {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        }
        
        // Buy now function
        function buyNow(productId) {
            const quantity = document.getElementById('quantity-input').value;
            window.location.href = `/checkout?product=${productId}&quantity=${quantity}`;
        }
        
        // Wishlist function
        function toggleWishlist(productId) {
            const btn = document.getElementById('wishlist-btn');
            const isActive = btn.classList.contains('active');
            
            // Simulate API call (replace with actual)
            if (isActive) {
                btn.classList.remove('active');
                btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>';
                showToast('Removed from wishlist', 'info');
            } else {
                btn.classList.add('active');
                btn.innerHTML = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>';
                showToast('Added to wishlist', 'success');
            }
            
            localStorage.setItem(`wishlist_${productId}`, !isActive);
        }
        
        // Toast notification function
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-600' : (type === 'error' ? 'bg-red-600' : 'bg-blue-600');
            toast.className = `fixed top-20 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white transform transition-all duration-300 translate-x-full ${bgColor}`;
            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${type === 'success' ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12'}"></path>
                    </svg>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 10);
            
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }
        
        // Update cart count
        function updateCartCount(count) {
            const cartCount = document.querySelector('.cart-count');
            if (cartCount) {
                cartCount.textContent = count || (parseInt(cartCount.textContent) || 0) + 1;
            }
        }
        
        // Prevent quantity input from non-numeric values
        const quantityInput = document.getElementById('quantity-input');
        if (quantityInput) {
            quantityInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value === '' || parseInt(this.value) < 1) {
                    this.value = 1;
                }
            });
        }
        
        // Initialize wishlist button
        function initWishlist() {
            const isInWishlist = localStorage.getItem(`wishlist_{{ $product->id }}`) === 'true';
            if (isInWishlist) {
                const btn = document.getElementById('wishlist-btn');
                btn.classList.add('active');
                btn.innerHTML = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>';
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            initWishlist();
        });
    </script>
</x-frontend-layout>