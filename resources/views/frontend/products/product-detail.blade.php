<x-frontend-layout>
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Image -->
            <div class="bg-white p-8 rounded-3xl shadow">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default-product.jpg') }}" 
                     alt="{{ $product->name }}" 
                     class="w-full rounded-2xl">
            </div>

            <!-- Details -->
            <div class="space-y-8">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">{{ $product->name }}</h1>
                    @if($product->category)
                    <p class="text-green-700 mt-2">{{ $product->category->name }}</p>
                    @endif
                </div>

                <div class="flex items-baseline gap-4">
                    <span class="text-4xl font-bold text-green-700">₹{{ number_format($product->price) }}</span>
                    @if($product->old_price)
                    <span class="text-xl text-gray-400 line-through">₹{{ number_format($product->old_price) }}</span>
                    @endif
                </div>

                <div class="prose text-gray-600">
                    {!! nl2br(e($product->description)) !!}
                </div>

                <div class="pt-6 border-t">
                    <button onclick="addToCart({{ $product->id }})" 
                            class="w-full bg-green-700 hover:bg-green-800 text-white py-4 rounded-2xl font-semibold text-lg transition">
                        Add to Cart
                    </button>
                </div>
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
                    alert("Added to cart!");
                }
            } catch (e) {
                alert("Error");
            }
        }
    </script>
</x-frontend-layout>