<x-frontend-layout>
    <!-- Category Hero Banner -->
    <section class="w-full bg-gradient-to-br from-[#f0f9f0] via-[#e8f5e8] to-[#d4edda] py-16 md:py-24 flex items-center overflow-hidden relative">
        <!-- Background decorative elements -->
        <div class="hero-bg-elements absolute inset-0 overflow-hidden">
            <div class="hero-blob-1 absolute top-10 left-10 w-72 h-72 bg-green-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
            <div class="hero-blob-2 absolute top-40 right-20 w-80 h-80 bg-emerald-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
            <div class="hero-blob-3 absolute -bottom-8 left-1/4 w-64 h-64 bg-teal-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center relative z-10">
            <!-- Left Content -->
            <div class="space-y-8">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="p-3 bg-green-900 text-white rounded-xl">
                        {!! $category->icon ?? '<i class="fas fa-box text-xl"></i>' !!}
                    </div>
                    <span class="px-4 py-2 bg-white text-green-900 font-semibold rounded-full text-sm">
                        {{ $products->count() }}+ Products
                    </span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                    Discover 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-700 to-emerald-600">
                        {{ $category->name ?? 'Category' }}
                    </span>
                </h1>
                
                <p class="text-lg md:text-xl text-gray-700 leading-relaxed max-w-2xl">
                    {{ $category->description ?? 'Browse all premium products in this category' }}
                </p>

                <!-- Stats -->
                <div class="flex flex-wrap gap-8 pt-4">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-900">{{ $products->count() ?? 0 }}+</div>
                        <div class="text-gray-500 text-sm">Products</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-900">
                            @if($products->count() > 0)
                                ₹{{ number_format($products->min('price')) }} - ₹{{ number_format($products->max('price')) }}
                            @else
                                ₹0
                            @endif
                        </div>
                        <div class="text-gray-500 text-sm">Price Range</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-900">
                            @if($products->count() > 0)
                                {{ round($products->avg('rating'), 1) }}
                            @else
                                0.0
                            @endif
                        </div>
                        <div class="text-gray-500 text-sm">Avg Rating</div>
                    </div>
                </div>
            </div>

            <!-- Right Image -->
            <div class="relative flex justify-center lg:justify-end">
                <div class="relative w-[320px] md:w-[450px] h-[320px] md:h-[450px]">
                    <!-- Main Category Image -->
                    <div class="absolute inset-0 z-20">
                        <img src="{{ $category->image ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80' }}"
                             alt="{{ $category->name ?? 'Category' }}"
                             class="w-full h-full rounded-3xl shadow-2xl object-cover border-8 border-white hover:scale-105 transition-transform duration-700">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-green-900 transition-colors">
                    <i class="fas fa-home"></i>
                    Home
                </a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <a href="{{ route('frontend.category.index') }}" class="text-gray-600 hover:text-green-900 transition-colors">
                    Categories
                </a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-green-900 font-semibold">{{ $category->name ?? 'Category' }}</span>
            </div>
        </div>
    </section>

    <!-- Products Section -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Products in {{ $category->name }}</h2>
                <p class="text-gray-600 mt-2">Showing {{ $products->count() }} products</p>
            </div>
            
            <!-- Sort Options -->
            <div class="flex items-center gap-4">
                <select class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option>Sort by: Featured</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Rating: High to Low</option>
                    <option>Newest First</option>
                </select>
                
                <div class="flex border border-gray-300 rounded-lg overflow-hidden">
                    <button class="px-4 py-2 bg-white text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group hover:-translate-y-2 border border-gray-100 hover:border-green-200">
                    <div class="relative overflow-hidden">
                        <!-- Wishlist Button -->
                        <div class="absolute top-4 right-4 z-10">
                            <button class="text-gray-400 hover:text-red-500 bg-white p-2 rounded-full shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Badges -->
                        @if($product->discount > 0)
                        <div class="absolute top-4 left-4 z-10">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-500 text-white">
                                -{{ $product->discount }}% OFF
                            </span>
                        </div>
                        @endif
                        
                        @if($product->is_new)
                        <div class="absolute top-4 left-4 z-10 {{ $product->discount > 0 ? 'top-16' : '' }}">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-500 text-white">
                                NEW
                            </span>
                        </div>
                        @endif
                        
                        <div class="p-4">
                            <!-- Product Image -->
                            <a href="{{ route('frontend.products.show', $product->slug) }}">
                                <img src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('images/products/default.jpg') }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-48 object-contain mb-4 group-hover:scale-105 transition-transform duration-500">
                            </a>
                            
                            <!-- Product Info -->
                            <a href="{{ route('frontend.products.show', $product->slug) }}" class="block">
                                <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-green-900 transition-colors duration-300 line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                            </a>
                            
                            <!-- Description -->
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                {{ $product->description }}
                            </p>
                            
                            <!-- Rating -->
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    @php
                                        $rating = $product->rating;
                                        $fullStars = floor($rating);
                                        $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                    @endphp
                                    
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $fullStars)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @elseif($hasHalfStar && $i == $fullStars + 1)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 1a1 1 0 0 1 .777.36l2.558 3.1 3.66.532a1 1 0 0 1 .555 1.706l-2.647 2.578.625 3.64a1 1 0 0 1-1.451 1.054L10 13.347l-3.267 1.72a1 1 0 0 1-1.45-1.054l.624-3.64L2.45 6.698a1 1 0 0 1 .555-1.706l3.66-.532L9.223 1.36A1 1 0 0 1 10 1zm0 2.445L7.615 6.1a1 1 0 0 1-.753.327l-3.107.452 2.248 2.19a1 1 0 0 1 .287.885l-.53 3.095L8.8 12.39a1 1 0 0 1 .93 0l2.782 1.463-.53-3.095a1 1 0 0 1 .287-.885l2.248-2.19-3.107-.452a1 1 0 0 1-.753-.327L10 3.445z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="ml-2 text-gray-600 text-sm">
                                    {{ $product->rating }} • {{ $product->reviews }} reviews
                                </span>
                            </div>
                            
                            <!-- Price and Add to Cart -->
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-xl font-bold text-gray-900 group-hover:text-green-900 transition-colors duration-300">
                                        ₹{{ number_format($product->price) }}
                                    </span>
                                    @if($product->old_price)
                                    <span class="text-gray-400 line-through text-sm ml-2">
                                        ₹{{ number_format($product->old_price) }}
                                    </span>
                                    @endif
                                </div>
                                <button class="cart-btn-unified group" data-product-id="{{ $product->id }}">
                                    <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No Products Found</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    There are no products available in this category at the moment.
                </p>
                <a href="{{ route('frontend.category.index') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-800 to-emerald-700 text-white font-semibold rounded-lg hover:from-green-900 hover:to-emerald-800 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                    <i class="fas fa-arrow-left"></i>
                    Browse Other Categories
                </a>
            </div>
        @endif
    </div>
</section>

    

    <!-- Section 2: Related Categories -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Related Categories</h2>
            <a href="{{ route('frontend.category.index') }}" 
               class="text-green-900 font-semibold hover:underline hover:text-gray-800 transition-colors duration-300 flex items-center gap-2">
                <span>View All Categories</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
        
        @php
            $relatedCategories = \App\Models\Category::where('is_active', true)
                ->where('id', $category->parent_id ?? null)
                ->where('id', '!=', $category->id ?? null)
                ->inRandomOrder()
                ->limit(6)
                ->get();
        @endphp
        
        @if($relatedCategories->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($relatedCategories as $relatedCategory)
                <a href="{{ route('frontend.category.show', ['category' => $relatedCategory->slug]) }}" 
                   class="text-center group cursor-pointer">
                    <div class="bg-gray-50 rounded-xl p-6 mb-4 group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2 border border-gray-100 group-hover:border-green-200">
                        <!-- Category Image -->
                        <img src="{{ $relatedCategory->image ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                             alt="{{ $relatedCategory->name }}" 
                             class="w-full h-32 object-contain mx-auto group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <h3 class="font-semibold text-gray-800 group-hover:text-green-900 transition-colors duration-300">
                        {{ $relatedCategory->name }}
                    </h3>
                    <div class="text-sm text-gray-500 mt-1">
                        {{ $relatedCategory->product_count ?? 0 }} products
                    </div>
                </a>
                @endforeach
            </div>
            
            <!-- View All Button for Mobile -->
            <div class="mt-10 text-center block md:hidden">
                <a href="{{ route('frontend.category.index') }}" 
                   class="inline-flex items-center justify-content gap-2 px-6 py-3 bg-gradient-to-r from-green-800 to-emerald-700 text-white font-semibold rounded-lg hover:from-green-900 hover:to-emerald-800 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                    <span>View All Categories</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        @else
            <!-- Fallback: Show random active categories if no related found -->
            @php
                $fallbackCategories = \App\Models\Category::where('is_active', true)
                    ->inRandomOrder()
                    ->limit(6)
                    ->get();
            @endphp
            
            @if($fallbackCategories->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    @foreach($fallbackCategories as $relatedCategory)
                    <a href="{{ route('frontend.category.show', ['category' => $relatedCategory->slug]) }}" 
                       class="text-center group cursor-pointer">
                        <div class="bg-gray-50 rounded-xl p-6 mb-4 group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2 border border-gray-100 group-hover:border-green-200">
                            <img src="{{ $relatedCategory->image ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                                 alt="{{ $relatedCategory->name }}" 
                                 class="w-full h-32 object-contain mx-auto group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <h3 class="font-semibold text-gray-800 group-hover:text-green-900 transition-colors duration-300">
                            {{ $relatedCategory->name }}
                        </h3>
                        <div class="text-sm text-gray-500 mt-1">
                            {{ $relatedCategory->product_count ?? 0 }} products
                        </div>
                    </a>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</section>

    <!-- Newsletter -->
    <section class="py-16 bg-gradient-to-r from-green-900 to-emerald-800">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Stay Updated with {{ $category->name }}</h2>
            <p class="text-gray-200 mb-8">
                Get notified about new products, special offers, and exclusive deals in {{ $category->name }}
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" 
                       placeholder="Enter your email address" 
                       class="flex-grow px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <button type="submit" 
                        class="px-6 py-3 bg-white text-green-900 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg whitespace-nowrap">
                    Subscribe Now
                </button>
            </form>
        </div>
    </section>

    <style>
        .cart-btn-unified {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(to right, #065f46, #047857);
            color: white;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .cart-btn-unified:hover {
            background: linear-gradient(to right, #054c35, #065f46);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(6, 95, 70, 0.2);
        }
        
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-frontend-layout>