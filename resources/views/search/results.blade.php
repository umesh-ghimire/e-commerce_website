<x-frontend-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Search Results
            </h2>
            <div class="text-sm text-gray-600">
                Found {{ $products->total() }} products
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Query Display -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900">
                    Showing results for:
                    <span class="font-bold text-green-600">"{{ $query }}"</span>
                </h3>
            </div>

            @if($products->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No products found</h3>
                    <p class="mt-2 text-gray-500">
                        We couldn't find any products matching "{{ $query }}".<br>
                        Try checking your spelling or use more general terms.
                    </p>
                    <div class="mt-6">
                        <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-800 to-emerald-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-900 hover:to-emerald-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            @else
                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
                            <!-- Product Image -->
                            <a href="{{ route('frontend.products.show', $product->slug) }}" class="block relative">
                                <div class="aspect-w-1 aspect-h-1 bg-gray-100">
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" 
                                             alt="{{ $product->name }}"
                                             class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Badges -->
                                <div class="absolute top-2 left-2 flex flex-col gap-1">
                                    @if($product->discount > 0)
                                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                            -{{ $product->discount }}% OFF
                                        </span>
                                    @endif
                                    @if($product->is_new)
                                        <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">
                                            NEW
                                        </span>
                                    @endif
                                    @if($product->is_best_seller)
                                        <span class="bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">
                                            BEST SELLER
                                        </span>
                                    @endif
                                </div>

                                <!-- Stock Status -->
                                @if($product->stock == 'out_of_stock')
                                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                        <span class="bg-white text-red-600 font-bold px-3 py-1 rounded-full text-sm">
                                            Out of Stock
                                        </span>
                                    </div>
                                @endif
                            </a>

                            <!-- Product Info -->
                            <div class="p-4">
                                <!-- Category/Brand -->
                                <div class="text-xs text-gray-500 mb-1">
                                    @if($product->category)
                                        <a href="{{ route('frontend.category.show', $product->category->slug) }}" class="hover:text-green-600">
                                            {{ $product->category->name }}
                                        </a>
                                    @endif
                                    @if($product->brand)
                                        <span class="mx-1">•</span>
                                        <span>{{ $product->brand }}</span>
                                    @endif
                                </div>

                                <!-- Product Name -->
                                <a href="{{ route('frontend.products.show', $product->slug) }}" class="block">
                                    <h4 class="font-semibold text-gray-900 hover:text-green-600 transition mb-2 line-clamp-2">
                                        {{ $product->name }}
                                    </h4>
                                </a>

                                <!-- Rating -->
                                @if($product->rating > 0)
                                    <div class="flex items-center mb-2">
                                        <div class="flex text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= floor($product->rating))
                                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @elseif($i <= ceil($product->rating))
                                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-xs text-gray-500 ml-1">({{ $product->reviews }})</span>
                                    </div>
                                @endif

                                <!-- Description Preview -->
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    {{ Str::limit($product->description, 80) }}
                                </p>

                                <!-- Price and Action -->
                                <div class="flex items-center justify-between mt-3">
                                    <div>
                                        @if($product->old_price && $product->old_price > $product->price)
                                            <span class="text-gray-400 line-through text-sm">₹{{ number_format($product->old_price, 0) }}</span>
                                            <span class="text-green-700 font-bold text-lg ml-2">₹{{ number_format($product->price, 0) }}</span>
                                        @else
                                            <span class="text-green-700 font-bold text-lg">₹{{ number_format($product->price, 0) }}</span>
                                        @endif
                                    </div>
                                    
                                    @if($product->stock != 'out_of_stock')
                                        <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" 
                                                    class="bg-gradient-to-r from-green-800 to-emerald-700 hover:from-green-900 hover:to-emerald-800 text-white px-3 py-2 rounded-lg text-sm font-medium transition flex items-center gap-1 shadow-md hover:shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="bg-gray-300 text-gray-500 px-3 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                                            Out of Stock
                                        </button>
                                    @endif
                                </div>

                                <!-- Quick View Link -->
                                <div class="mt-2 text-center">
                                    <a href="{{ route('frontend.products.show', $product->slug) }}" 
                                       class="text-xs text-green-600 hover:text-green-800 font-medium">
                                        View Details →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->appends(['query' => $query])->links() }}
                </div>
            @endif
        </div>
    </div>
</x-frontend-layout>