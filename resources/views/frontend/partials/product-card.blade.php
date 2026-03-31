@props(['product', 'showCategory' => true, 'showBrand' => true])

<div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group hover:-translate-y-2 border border-gray-100 hover:border-green-200">
    <div class="relative overflow-hidden">
        <!-- Wishlist Button -->
        <div class="absolute top-4 right-4 z-10">
            <button class="text-gray-400 hover:text-red-500 bg-white p-2 rounded-full shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-110 wishlist-btn" data-product-id="{{ $product->id }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>
        </div>
        
        <!-- Discount Badge -->
        @if($product->discount > 0)
        <div class="absolute top-4 left-4 z-10">
            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-500 text-white">
                -{{ $product->discount }}% OFF
            </span>
        </div>
        @endif
        
        <!-- Product Image -->
        <a href="{{ route('frontend.products.show', $product->slug) }}">
            <div class="p-4">
                <img src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('images/products/default.jpg') }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-48 object-contain mb-4 group-hover:scale-105 transition-transform duration-500">
            </div>
        </a>
    </div>
    
    <!-- Product Info -->
    <div class="p-4">
        <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-green-900 transition-colors duration-300 line-clamp-1">
            <a href="{{ route('frontend.products.show', $product->slug) }}">
                {{ $product->name }}
            </a>
        </h3>
        
        @if($showBrand && isset($product->brand) && $product->brand)
        <div class="mb-2">
            <a href="{{ route('frontend.products.index', ['brand' => $product->brand]) }}" 
               class="inline-flex items-center text-xs text-green-700 hover:text-green-900">
                <i class="fas fa-tag mr-1"></i>
                {{ $product->brand }}
            </a>
        </div>
        @endif
        
        @if($showCategory && $product->category)
        <div class="mb-2">
            <a href="{{ route('frontend.category.show', $product->category->slug) }}" 
               class="inline-flex items-center text-xs text-blue-700 hover:text-blue-900">
                <i class="fas fa-folder mr-1"></i>
                {{ $product->category->name }}
            </a>
        </div>
        @endif
        
        <!-- Rating -->
        <div class="flex items-center mb-3">
            <div class="flex text-yellow-400">
                @php
                    $rating = $product->rating ?? 0;
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
                            <path d="M10 1l1.993 4.399 4.446.647-3.217 3.134.759 4.426L10 12.367l-3.981 2.239.759-4.426L2.56 6.046l4.447-.647L10 1z"/>
                        </svg>
                    @else
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    @endif
                @endfor
            </div>
            <span class="ml-2 text-gray-600 text-sm">{{ number_format($rating, 1) }} • {{ $product->reviews ?? 0 }} reviews</span>
        </div>
        
        <!-- Price and Add to Cart -->
        <div class="flex justify-between items-center">
            <div>
                @php
                    $price = $product->price ?? 0;
                    $oldPrice = $product->old_price ?? null;
                @endphp
                <span class="text-xl font-bold text-gray-900 group-hover:text-green-900 transition-colors duration-300">₹{{ number_format($price, 0) }}</span>
                @if($oldPrice)
                <span class="text-gray-400 line-through text-sm ml-2">₹{{ number_format($oldPrice, 0) }}</span>
                @endif
            </div>
            @if(($product->stock ?? 'available') !== 'out_of_stock')
            <button class="cart-btn-unified add-to-cart" onclick="addToCart({{ $product->id }})">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Add to Cart
            </button>
            @endif
        </div>
    </div>
    <script>
function addToCart(productId) {
    alert("Product " + productId + " added to cart!");
}
</script>
</div>