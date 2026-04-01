<div class="relative">
    <div class="trending-products-horizontal-scroll flex space-x-6 pb-4 overflow-x-auto scrollbar-hide snap-x snap-mandatory">
        @forelse($products as $product)
        <div class="flex-shrink-0 w-72 snap-start">
            @include('frontend.partials.product-card', ['product' => $product])
        </div>
        @empty
        <div class="w-full text-center py-12">
            <p class="text-gray-500">No products available in this category yet.</p>
        </div>
        @endforelse
    </div>
    
    @if($products->count() > 4)
    <div class="flex justify-center mt-4 space-x-2">
        <button class="scroll-left-btn w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-gray-50 transition-colors">
            <i class="fas fa-chevron-left text-gray-600"></i>
        </button>
        <button class="scroll-right-btn w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-gray-50 transition-colors">
            <i class="fas fa-chevron-right text-gray-600"></i>
        </button>
    </div>
    @endif
</div>