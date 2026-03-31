<x-frontend-layout>
    <div class="bg-emerald-900 text-white text-center text-sm py-2">
        Go and purchase our latest products 
        <a href="#" class="underline font-semibold">Shopping</a>
        <button onclick="this.parentElement.style.display='none'" 
                class="absolute right-2 top-1 text-white hover:text-gray-300 font-bold text-lg">
            &times;
        </button>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-8 bg-[#f9f6ee]">
        <h1 class="text-3xl font-bold tracking-wide mb-6">YOUR CART</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Cart Items -->
            <div id="cart-items" class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6 space-y-6">
                @if(!empty($cart))
                    @foreach($cart as $id => $item)
                    <div class="cart-item flex gap-4 items-center border border-gray-100 rounded-xl p-4"
                         data-cart-id="{{ $id }}">
                        
                        <img src="{{ $item['image'] ? asset('storage/products/' . $item['image']) : asset('images/products/default.jpg') }}"
                             class="w-20 h-20 rounded-lg object-cover" alt="{{ $item['name'] }}">

                        <div class="flex-1">
                            <p class="item-name font-semibold text-slate-900">{{ $item['name'] }}</p>
                            <p class="mt-2 font-semibold text-lg">
                                Rs <span class="item-price">{{ number_format($item['price'], 0) }}</span>
                            </p>
                        </div>

                        <div class="flex items-center gap-3">
                            <button class="qty-minus w-8 h-8 flex items-center justify-center rounded-full border hover:bg-gray-100 transition-colors"
                                    data-cart-id="{{ $id }}">-</button>
                            
                            <span class="qty text-base font-medium w-8 text-center" 
                                  data-qty="{{ $item['quantity'] }}">{{ $item['quantity'] }}</span>
                            
                            <button class="qty-plus w-8 h-8 flex items-center justify-center rounded-full border hover:bg-gray-100 transition-colors"
                                    data-cart-id="{{ $id }}">+</button>

                            <button class="remove-item text-red-500 hover:text-red-700 ml-6 transition-colors"
                                    data-cart-id="{{ $id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>

                        <div class="ml-auto text-right">
                            <span class="item-total font-semibold text-lg block">
                                Rs {{ number_format($item['price'] * $item['quantity'], 0) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-20">
                        <p class="text-2xl text-gray-400 mb-4">Your cart is empty 🛒</p>
                        <a href="{{ route('frontend.products.index') }}" 
                           class="inline-block bg-black text-white px-10 py-4 rounded-full hover:bg-gray-800 transition-colors">
                            Continue Shopping
                        </a>
                    </div>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="bg-white rounded-2xl shadow-sm p-8 flex flex-col">
                <h2 class="text-lg font-semibold mb-6">Order Summary</h2>
                
                <div class="space-y-3 text-sm flex-1">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span class="font-semibold" id="subtotal">Rs 0</span>
                    </div>
                    <div class="flex justify-between text-red-500">
                        <span>Discount (-20%)</span>
                        <span id="discount">- Rs 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Delivery Fee</span>
                        <span id="delivery">Rs 100</span>
                    </div>
                </div>

                <div class="border-t mt-6 pt-6 flex justify-between items-center">
                    <span class="font-semibold">Total</span>
                    <span class="font-bold text-2xl" id="total">Rs 0</span>
                </div>

               <a href="{{ route('frontend.checkout') }}" 
                    class="mt-8 w-full rounded-full bg-black text-white py-4 font-semibold flex items-center justify-center gap-2 hover:bg-gray-900 transition-all">
                    Proceed to Checkout →
                </a>
            </div>
        </div>

        <!-- Stay Connected -->
        <div class="mt-10 bg-emerald-900 text-white rounded-3xl p-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="max-w-md">
                <h3 class="text-2xl font-semibold mb-2">STAY CONNECTED ABOUT OUR LATEST OFFERS</h3>
                <p class="text-sm text-emerald-100">Be the first to know about new arrivals, sales, and exclusive offers.</p>
            </div>
            <div class="w-full md:w-80">
                <a href="/shopping">
                    <button class="w-full rounded-full bg-white text-emerald-900 py-3 font-bold hover:scale-105 transition-all">
                        CONNECT WITH US
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Recalculate totals
        function recalcTotals() {
            let subtotal = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const price = parseFloat(item.querySelector('.item-price').innerText.replace(/[^0-9.]/g, '')) || 0;
                const qty = parseInt(item.querySelector('.qty').dataset.qty) || 1;
                const itemTotal = price * qty;

                const totalEl = item.querySelector('.item-total');
                if (totalEl) totalEl.innerText = 'Rs ' + itemTotal.toLocaleString('en-IN');

                subtotal += itemTotal;
            });

            const discountPercent = 20;
            const discountAmount = Math.round(subtotal * discountPercent / 100);
            const deliveryFee = subtotal > 0 ? 100 : 0;
            const total = subtotal - discountAmount + deliveryFee;

            document.getElementById('subtotal').innerText = 'Rs ' + subtotal.toLocaleString('en-IN');
            document.getElementById('discount').innerText = '- Rs ' + discountAmount.toLocaleString('en-IN');
            document.getElementById('delivery').innerText = 'Rs ' + deliveryFee.toLocaleString('en-IN');
            document.getElementById('total').innerText = 'Rs ' + total.toLocaleString('en-IN');
        }

        // AJAX Helpers
        async function cartAction(url, data) {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });
            return response.json();
        }

        // Update Quantity
        async function updateQuantity(cartId, newQty) {
            const result = await cartAction("{{ route('frontend.cart.update') }}", {
                id: cartId,
                quantity: newQty
            });

            if (result.success) {
                recalcTotals();
            }
        }

        // Remove Item
        async function removeItem(cartId) {
            if (!confirm('Remove this item from cart?')) return;

            const result = await cartAction("{{ route('frontend.cart.remove') }}", { id: cartId });

            if (result.success) {
                const item = document.querySelector(`.cart-item[data-cart-id="${cartId}"]`);
                if (item) item.remove();
                recalcTotals();
            }
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', () => {
            const cartContainer = document.getElementById('cart-items');

            cartContainer.addEventListener('click', async (e) => {
                const item = e.target.closest('.cart-item');
                if (!item) return;

                const cartId = item.dataset.cartId;
                const qtySpan = item.querySelector('.qty');
                let qty = parseInt(qtySpan.dataset.qty);

                if (e.target.classList.contains('qty-plus')) {
                    qty++;
                    qtySpan.dataset.qty = qty;
                    qtySpan.textContent = qty;
                    await updateQuantity(cartId, qty);
                }
                else if (e.target.classList.contains('qty-minus')) {
                    qty = Math.max(1, qty - 1);
                    qtySpan.dataset.qty = qty;
                    qtySpan.textContent = qty;
                    await updateQuantity(cartId, qty);
                }
                else if (e.target.closest('.remove-item')) {
                    await removeItem(cartId);
                }
            });

            // Initial calculation
            recalcTotals();
        });

       
    </script>
</x-frontend-layout>