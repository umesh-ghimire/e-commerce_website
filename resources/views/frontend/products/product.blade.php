<x-frontend-layout>
    <link rel="stylesheet" href="{{ asset('frontend/css/products.css') }}">

    <div class="product-page">
        <!-- Hero Banner -->
        <div class="container mx-auto px-4 py-16 text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Discover Amazing Products</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Browse through our collection of quality products with great deals and discounts</p>
        </div>

        <!-- Promotional Banners -->
        <div class="container mx-auto px-4 py-12">
            <h2 class="text-3xl font-bold text-center mb-8">Special Offers</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="relative rounded-2xl overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="New Arrivals" class="w-full h-80 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent p-8 flex flex-col justify-end">
                        <span class="text-white bg-green-600 px-4 py-1 rounded-full text-sm inline-block w-fit mb-3">New</span>
                        <h3 class="text-3xl font-bold text-white">New Arrivals</h3>
                        <a href="{{ route('frontend.products.index') }}?sort=newest" class="mt-4 text-white inline-flex items-center gap-2 hover:underline">
                            Shop Now <span class="text-xl">→</span>
                        </a>
                    </div>
                </div>

                <div class="relative rounded-2xl overflow-hidden shadow-lg">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Free Shipping" class="w-full h-80 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent p-8 flex flex-col justify-end">
                        <span class="text-white bg-blue-600 px-4 py-1 rounded-full text-sm inline-block w-fit mb-3">Free</span>
                        <h3 class="text-3xl font-bold text-white">Free Shipping</h3>
                        <p class="text-white/90">On all orders above ₹500</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Best Sellers & Trending -->
        <div class="bg-gray-50 py-16" id="trending">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-10">Best Sellers & Trending</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Best Sellers -->
                    <div>
                        <h3 class="text-xl font-semibold mb-6 flex items-center gap-2">
                            <span class="text-orange-500">★</span> Best Sellers
                        </h3>
                        <div class="space-y-6">
                            @foreach($bestSellers->take(4) as $product)
                            <div class="flex gap-4 bg-white p-4 rounded-xl shadow-sm">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.jpg') }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-medium line-clamp-2">{{ $product->name }}</h4>
                                    <p class="text-lg font-bold text-green-700 mt-1">₹{{ number_format($product->price) }}</p>
                                    <button onclick="addToCart({{ $product->id }})" 
                                            class="text-sm text-green-600 hover:text-green-700 mt-2">Add to Cart</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Trending -->
                    <div>
                        <h3 class="text-xl font-semibold mb-6 flex items-center gap-2">
                            <span class="text-red-500">🔥</span> Trending Now
                        </h3>
                        <div class="space-y-6">
                            @foreach($trendingProducts->take(4) as $product)
                            <div class="flex gap-4 bg-white p-4 rounded-xl shadow-sm">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.jpg') }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-medium line-clamp-2">{{ $product->name }}</h4>
                                    <p class="text-lg font-bold text-green-700 mt-1">₹{{ number_format($product->price) }}</p>
                                    <button onclick="addToCart({{ $product->id }})" 
                                            class="text-sm text-green-600 hover:text-green-700 mt-2">Add to Cart</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- New Arrivals -->
                    <div>
                        <h3 class="text-xl font-semibold mb-6 flex items-center gap-2">
                            <span class="text-blue-500">✨</span> New Arrivals
                        </h3>
                        <div class="space-y-6">
                            @foreach($newArrivals->take(4) as $product)
                            <div class="flex gap-4 bg-white p-4 rounded-xl shadow-sm">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.jpg') }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-medium line-clamp-2">{{ $product->name }}</h4>
                                    <p class="text-lg font-bold text-green-700 mt-1">₹{{ number_format($product->price) }}</p>
                                    <button onclick="addToCart({{ $product->id }})" 
                                            class="text-sm text-green-600 hover:text-green-700 mt-2">Add to Cart</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- All Products -->
        <div class="container mx-auto px-4 py-16" id="products">
            <h2 class="text-3xl font-bold mb-8">All Products</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                    <div class="aspect-square bg-gray-100">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.jpg') }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium line-clamp-2 h-12">{{ $product->name }}</h3>
                        <p class="text-green-700 font-bold mt-2">₹{{ number_format($product->price) }}</p>
                        <button onclick="addToCart({{ $product->id }})" 
                                class="mt-4 w-full bg-green-700 text-white py-3 rounded-xl text-sm font-medium hover:bg-green-800">
                            Add to Cart
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        async function addToCart(productId) {
            try {
                const res = await fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ product_id: productId, quantity: 1 })
                });
                const data = await res.json();
                if (data.success) {
                    alert("Added to cart successfully!");
                } else {
                    alert(data.message || "Failed to add to cart");
                }
            } catch (e) {
                alert("Something went wrong");
            }
        }
    </script>
</x-frontend-layout>