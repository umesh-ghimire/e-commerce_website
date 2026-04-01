<x-frontend-layout>
    <!-- Hero Banner -->
    <section class="py-16 bg-gradient-to-br from-green-50 to-white">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Discover Amazing Products
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                    Browse through our collection of {{ number_format($allProducts->count()) }}+ quality products with great deals and discounts
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#products" class="hero-btn-unified inline-flex items-center justify-center gap-2">
                        <i class="fas fa-shopping-bag"></i>
                        Shop Now
                    </a>
                    <a href="#trending" class="hero-btn-secondary inline-flex items-center justify-center gap-2">
                        <i class="fas fa-fire"></i>
                        View Trending
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Promotional Banners -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Special Offers</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- New Arrivals Banner -->
                <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                    @php $newArrival = $newArrivals->first(); @endphp
                    @if($newArrival)
                    <a href="{{ route('frontend.products.show', $newArrival->slug) }}">
                        <img src="{{ $newArrival->image ? asset('storage/products/' . $newArrival->image) : asset('images/products/default.jpg') }}"
                             alt="New Arrivals"
                             class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    @else
                    <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="New Arrivals"
                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                        <span class="inline-block px-3 py-1 bg-green-500 text-white text-sm font-semibold rounded-full mb-2">
                            New
                        </span>
                        <h3 class="text-2xl font-bold text-white mb-2">New Arrivals</h3>
                        <p class="text-gray-200 mb-4">Discover the latest products just added to our collection.</p>
                        <a href="{{ route('frontend.products.index') }}?sort=newest#products" class="hero-btn-unified">
                            Explore <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Free Shipping Banner -->
                <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                         alt="Free Shipping"
                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                        <span class="inline-block px-3 py-1 bg-blue-500 text-white text-sm font-semibold rounded-full mb-2">
                            Free
                        </span>
                        <h3 class="text-2xl font-bold text-white mb-2">Free Shipping</h3>
                        <p class="text-gray-200 mb-4">Free shipping on all orders over ₹500. Shop now and save!</p>
                        <a href="#" class="hero-btn-unified">
                            Learn More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Sellers / Trending Products with Horizontal Scroll -->
    <section class="py-16 bg-gray-50" id="trending">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Best Sellers & Trending</h2>
                <div class="flex justify-center space-x-4 mb-8" id="trending-tabs-container">
                    <button class="trending-tab active px-6 py-2 rounded-full font-semibold transition-colors duration-300"
                            data-tab="best-sellers">
                        Best Sellers
                    </button>
                    <button class="trending-tab px-6 py-2 rounded-full font-semibold transition-colors duration-300"
                            data-tab="trending">
                        Trending Now
                    </button>
                    <button class="trending-tab px-6 py-2 rounded-full font-semibold transition-colors duration-300"
                            data-tab="new-arrivals">
                        New Arrivals
                    </button>
                </div>
            </div>
            
            <div id="trending-products">
                <!-- Best Sellers Tab -->
                <div class="trending-tab-content active" id="best-sellers-content">
                    @include('frontend.partials.product-horizontal-scroll', ['products' => $bestSellers, 'type' => 'best-seller'])
                </div>
                
                <!-- Trending Products Tab -->
                <div class="trending-tab-content hidden" id="trending-content">
                    @include('frontend.partials.product-horizontal-scroll', ['products' => $trendingProducts, 'type' => 'trending'])
                </div>
                
                <!-- New Arrivals Tab -->
                <div class="trending-tab-content hidden" id="new-arrivals-content">
                    @include('frontend.partials.product-horizontal-scroll', ['products' => $newArrivals, 'type' => 'new'])
                </div>
            </div>
        </div>
    </section>

    <!-- All Products Filters Section -->
    <section class="py-16" id="products">
        <div class="container mx-auto px-4">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    @if(request()->has('brand'))
                        {{ request('brand') }} Products
                    @elseif(request()->has('search'))
                        Search Results for "{{ request('search') }}"
                    @else
                        All Products
                    @endif
                </h2>
                <p class="text-gray-600 mt-2">
                    @if(request()->has('brand') && request()->has('search'))
                        Showing {{ $products->count() }} {{ request('brand') }} products matching "{{ request('search') }}"
                    @elseif(request()->has('brand'))
                        Showing {{ $products->count() }} products
                    @elseif(request()->has('search'))
                        Showing {{ $products->count() }} results for "{{ request('search') }}"
                    @else
                        Showing {{ $products->count() }} of {{ $allProducts->count() }} products
                    @endif
                </p>
            </div>

            <!-- Active Filters -->
            @if(request()->anyFilled(['brand', 'search', 'category', 'min_price', 'max_price', 'sort']))
            <div class="mb-6">
                <div class="flex flex-wrap gap-2">
                    <!-- Brand filter badge -->
                    @if(request()->has('brand'))
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        <i class="fas fa-tag mr-2"></i>
                        Brand: {{ request('brand') }}
                        <a href="{{ route('frontend.products.index', request()->except('brand')) }}#products" class="ml-2 text-green-600 hover:text-green-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                    
                    <!-- Search filter badge -->
                    @if(request()->has('search'))
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                        <i class="fas fa-search mr-2"></i>
                        Search: "{{ request('search') }}"
                        <a href="{{ route('frontend.products.index', request()->except('search')) }}#products" class="ml-2 text-blue-600 hover:text-blue-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                    
                    <!-- Category filter badge -->
                    @if(request()->has('category'))
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-100 text-purple-800">
                        <i class="fas fa-folder mr-2"></i>
                        Category: {{ request('category') }}
                        <a href="{{ route('frontend.products.index', request()->except('category')) }}#products" class="ml-2 text-purple-600 hover:text-purple-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                    
                    <!-- Price filter badge -->
                    @if(request()->has('min_price') || request()->has('max_price'))
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800">
                        <i class="fas fa-indian-rupee-sign mr-2"></i>
                        Price: 
                        @if(request()->has('min_price')){{ request('min_price') }} @endif
                        @if(request()->has('min_price') && request()->has('max_price'))-@endif
                        @if(request()->has('max_price')){{ request('max_price') }} @endif
                        <a href="{{ route('frontend.products.index', request()->except(['min_price', 'max_price'])) }}#products" class="ml-2 text-yellow-600 hover:text-yellow-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                    
                    <!-- Sort filter badge -->
                    @if(request()->has('sort') && request('sort') != 'featured')
                    @php
                        $sortLabels = [
                            'newest' => 'Newest',
                            'price-low' => 'Price: Low to High',
                            'price-high' => 'Price: High to Low',
                            'rating' => 'Top Rated',
                            'popular' => 'Most Popular'
                        ];
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-red-100 text-red-800">
                        <i class="fas fa-sort mr-2"></i>
                        {{ $sortLabels[request('sort')] ?? 'Sorted' }}
                        <a href="{{ route('frontend.products.index', request()->except('sort')) }}#products" class="ml-2 text-red-600 hover:text-red-800">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                    
                    <!-- Clear All Filters -->
                    <a href="{{ route('frontend.products.index') }}#products" 
                       class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200">
                        <i class="fas fa-times mr-1"></i>
                        Clear all
                    </a>
                </div>
            </div>
            @endif

            <!-- Horizontal Filters Bar -->
            <div class="mb-8 bg-white rounded-xl shadow-sm p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Category Dropdown -->
                    @if(isset($categories) && count($categories) > 0)
                    <div class="relative group">
                        <button class="filter-dropdown-btn">
                            <i class="fas fa-folder mr-2"></i>
                            @if(request()->has('category'))
                                Category: {{ request('category') }}
                            @else
                                Category
                            @endif
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>
                        <div class="filter-dropdown-menu">
                            <a href="{{ route('frontend.products.index', request()->except('category')) }}#products" 
                               class="filter-dropdown-item {{ !request()->has('category') ? 'active' : '' }}">
                                All Categories
                                <span class="text-gray-500 text-sm ml-auto">{{ $allProducts->count() }}</span>
                            </a>
                            @foreach($categories as $category)
                            <a href="{{ route('frontend.products.index', array_merge(request()->except('page'), ['category' => $category->slug])) }}#products" 
                               class="filter-dropdown-item {{ request('category') == $category->slug ? 'active' : '' }}">
                                {{ $category->name }}
                                <span class="text-gray-500 text-sm ml-auto">{{ $category->products_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Brand Dropdown -->
                    @if(isset($brands) && count($brands) > 0)
                    <div class="relative group">
                        <button class="filter-dropdown-btn">
                            <i class="fas fa-tag mr-2"></i>
                            @if(request()->has('brand'))
                                Brand: {{ request('brand') }}
                            @else
                                Brand
                            @endif
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>
                        <div class="filter-dropdown-menu max-h-80 overflow-y-auto">
                            <a href="{{ route('frontend.products.index', request()->except('brand')) }}#products" 
                               class="filter-dropdown-item {{ !request()->has('brand') ? 'active' : '' }}">
                                All Brands
                                <span class="text-gray-500 text-sm ml-auto">{{ $allProducts->count() }}</span>
                            </a>
                            @foreach($brands as $brand)
                            <a href="{{ route('frontend.products.index', array_merge(request()->except('page'), ['brand' => $brand['name']])) }}#products" 
                               class="filter-dropdown-item {{ request('brand') == $brand['name'] ? 'active' : '' }}">
                                {{ $brand['name'] }}
                                <span class="text-gray-500 text-sm ml-auto">{{ $brand['count'] }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Price Range Dropdown -->
                    <div class="relative group">
                        <button class="filter-dropdown-btn">
                            <i class="fas fa-indian-rupee-sign mr-2"></i>
                            @if(request()->has('min_price') || request()->has('max_price'))
                                Price: 
                                @if(request()->has('min_price')){{ request('min_price') }} @endif
                                @if(request()->has('min_price') && request()->has('max_price'))-@endif
                                @if(request()->has('max_price')){{ request('max_price') }} @endif
                            @else
                                Price
                            @endif
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>
                        <div class="filter-dropdown-menu p-4 w-72">
                            <form action="{{ route('frontend.products.index') }}" method="GET" id="priceFilterForm" class="space-y-4">
                                <!-- Preserve existing filters -->
                                @if(request()->has('brand'))
                                <input type="hidden" name="brand" value="{{ request('brand') }}">
                                @endif
                                @if(request()->has('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                @if(request()->has('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                @if(request()->has('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                @endif
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs text-gray-600 mb-1">Min</label>
                                            <input type="number" 
                                                   name="min_price" 
                                                   value="{{ request('min_price') }}"
                                                   placeholder="0" 
                                                   min="0"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-600 mb-1">Max</label>
                                            <input type="number" 
                                                   name="max_price" 
                                                   value="{{ request('max_price') }}"
                                                   placeholder="10000" 
                                                   min="0"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2 pt-2">
                                    <button type="submit" class="flex-1 hero-btn-unified text-sm py-2">
                                        Apply
                                    </button>
                                    @if(request()->has('min_price') || request()->has('max_price'))
                                    <a href="{{ route('frontend.products.index', request()->except(['min_price', 'max_price'])) }}#products" 
                                       class="flex-1 py-2 px-4 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg font-medium text-sm text-center">
                                        Clear
                                    </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="relative group">
                        <button class="filter-dropdown-btn">
                            <i class="fas fa-sort mr-2"></i>
                            @php
                                $sortLabels = [
                                    'featured' => 'Featured',
                                    'newest' => 'Newest',
                                    'price-low' => 'Price: Low to High',
                                    'price-high' => 'Price: High to Low',
                                    'rating' => 'Top Rated',
                                    'popular' => 'Most Popular'
                                ];
                            @endphp
                            {{ $sortLabels[request('sort', 'featured')] ?? 'Sort By' }}
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>
                        <div class="filter-dropdown-menu">
                            @foreach($sortLabels as $key => $label)
                            <a href="{{ route('frontend.products.index', array_merge(request()->except(['page', 'sort']), ['sort' => $key])) }}#products" 
                               class="filter-dropdown-item {{ request('sort', 'featured') == $key ? 'active' : '' }}">
                                @php
                                    $icons = [
                                        'featured' => 'fas fa-star',
                                        'newest' => 'fas fa-clock',
                                        'price-low' => 'fas fa-arrow-down',
                                        'price-high' => 'fas fa-arrow-up',
                                        'rating' => 'fas fa-star-half-alt',
                                        'popular' => 'fas fa-fire'
                                    ];
                                @endphp
                                <i class="{{ $icons[$key] ?? 'fas fa-sort' }} mr-2 text-sm"></i>
                                {{ $label }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Clear Filters Button (visible only when filters are active) -->
                    @if(request()->anyFilled(['brand', 'search', 'category', 'min_price', 'max_price', 'sort']))
                    <div>
                        <a href="{{ route('frontend.products.index') }}#products" 
                           class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-700 hover:bg-red-100 rounded-lg font-medium text-sm transition-colors">
                            <i class="fas fa-times"></i>
                            Clear Filters
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Products Grid -->
            <div id="products-grid">
                @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        @include('frontend.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($products->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $products->links() }}
                </div>
                @endif
                @else
                <div class="text-center py-12">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                    <p class="text-gray-600">Try adjusting your filters to find what you're looking for.</p>
                    <a href="{{ route('frontend.products.index') }}#products" class="hero-btn-unified inline-flex items-center gap-2 mt-4">
                        <i class="fas fa-shopping-bag"></i>
                        Browse All Products
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-gradient-to-r from-green-900 to-gray-800">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Never Miss a Deal</h2>
            <p class="text-gray-200 text-lg mb-8 max-w-2xl mx-auto">
                Subscribe to get daily deals and new arrivals
            </p>
            <form class="newsletter-form max-w-md mx-auto flex gap-2">
                <input type="email" placeholder="Enter your email address" 
                       class="newsletter-input flex-1 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <button type="submit" class="hero-btn-unified">
                    Subscribe Now
                </button>
            </form>
        </div>
    </section>

    <!-- Include external CSS and JS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/products.css') }}">
    <script src="{{ asset('frontend/js/products.js') }}"></script>
    
    <!-- Tab and Filter Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabs = document.querySelectorAll('.trending-tab');
            const contents = document.querySelectorAll('.trending-tab-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    // Update active tab styling
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Show corresponding content
                    contents.forEach(content => content.classList.add('hidden'));
                    document.getElementById(`${tabId}-content`).classList.remove('hidden');
                });
            });
            
            // Horizontal scroll functionality
            const scrollContainers = document.querySelectorAll('.trending-products-horizontal-scroll');
            
            scrollContainers.forEach(container => {
                const leftBtn = container.parentElement?.querySelector('.scroll-left-btn');
                const rightBtn = container.parentElement?.querySelector('.scroll-right-btn');
                
                if (leftBtn && rightBtn) {
                    leftBtn.addEventListener('click', () => {
                        container.scrollBy({ left: -320, behavior: 'smooth' });
                    });
                    
                    rightBtn.addEventListener('click', () => {
                        container.scrollBy({ left: 320, behavior: 'smooth' });
                    });
                }
            });
            
            // Price filter form submission
            const priceForm = document.getElementById('priceFilterForm');
            if (priceForm) {
                priceForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const params = new URLSearchParams(formData);
                    let url = this.action;
                    
                    if (params.toString()) {
                        url += '?' + params.toString();
                    }
                    
                    url += '#products';
                    window.location.href = url;
                });
            }
            
            // Handle pagination links
            document.addEventListener('click', function(e) {
                const pageLink = e.target.closest('.pagination a');
                if (pageLink && !pageLink.classList.contains('disabled') && !pageLink.classList.contains('active')) {
                    e.preventDefault();
                    
                    let url = pageLink.href;
                    if (!url.includes('#products')) {
                        url += '#products';
                    }
                    
                    window.location.href = url;
                }
            });
        });
    </script>
    
    <style>
        /* Filter Dropdown Styles */
        .filter-dropdown-btn {
            @apply px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium text-sm transition-colors flex items-center;
        }
        
        .filter-dropdown-menu {
            @apply absolute top-full left-0 mt-2 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 min-w-[200px];
        }
        
        .filter-dropdown-item {
            @apply block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors flex justify-between items-center;
        }
        
        .filter-dropdown-item.active {
            @apply bg-green-50 text-green-700;
        }
        
        /* Scrollbar Hide */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Hero Buttons */
        .hero-btn-unified {
            @apply bg-gradient-to-r from-green-800 to-emerald-700 text-white px-6 py-3 rounded-lg font-semibold hover:from-green-900 hover:to-emerald-800 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg;
        }
        
        .hero-btn-secondary {
            @apply bg-white text-green-800 border-2 border-green-800 px-6 py-3 rounded-lg font-semibold hover:bg-green-50 transition-all duration-300;
        }
        
        /* Pagination Styles */
        .pagination {
            @apply flex space-x-2;
        }
        
        .pagination a, .pagination span {
            @apply px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors;
        }
        
        .pagination .active span {
            @apply bg-green-600 text-white border-green-600;
        }
        
        .pagination .disabled span {
            @apply bg-gray-100 text-gray-400 cursor-not-allowed;
        }
    </style>
</x-frontend-layout>