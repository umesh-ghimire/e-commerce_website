<x-frontend-layout>
    <div class="max-w-6xl mx-auto px-4 py-10 bg-[#f9f6ee]">
        <h1 class="text-3xl font-bold tracking-wide mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Shipping + Payment Form -->
            <div class="lg:col-span-7 bg-white rounded-3xl shadow-sm p-8">
                <h2 class="text-2xl font-semibold mb-6">Shipping Details</h2>
                
                <form id="checkout-form" method="POST" action="{{ route('frontend.checkout.store') }}">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Full Name *</label>
                            <input type="text" name="name" required class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:border-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Phone Number *</label>
                            <input type="text" name="phone" required class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:border-green-500">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium mb-2">Email Address *</label>
                        <input type="email" name="email" required class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:border-green-500">
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium mb-2">Shipping Address *</label>
                        <textarea name="shipping_address" rows="4" required class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:border-green-500"></textarea>
                    </div>

                    <!-- Payment Method -->
                    <div class="mt-10">
                        <h3 class="text-xl font-semibold mb-4">Payment Method</h3>
                        
                        <div class="space-y-4">
                            <!-- Cash on Delivery -->
                            <label class="payment-option flex items-center gap-4 border-2 border-transparent rounded-2xl p-5 cursor-pointer hover:border-green-200" data-type="cod">
                                <input type="radio" name="payment_method" value="cash_on_delivery" checked class="w-5 h-5 accent-green-600">
                                <div class="flex-1">
                                    <p class="font-semibold">Cash on Delivery (COD)</p>
                                    <p class="text-sm text-gray-500">Pay when you receive the product</p>
                                </div>
                            </label>

                            <!-- Digital Wallet -->
                            <label class="payment-option flex items-center gap-4 border-2 border-transparent rounded-2xl p-5 cursor-pointer hover:border-green-200" data-type="wallet">
                                <input type="radio" name="payment_method" value="digital_wallet" class="w-5 h-5 accent-green-600">
                                <div class="flex-1">
                                    <p class="font-semibold">Digital Wallet / Card</p>
                                    <p class="text-sm text-gray-500">eSewa, Khalti, IME Pay, Card</p>
                                </div>
                            </label>
                        </div>

                        <!-- Wallet Options (Hidden by default) -->
                        <div id="wallet-options" class="hidden mt-6 grid grid-cols-2 gap-4">
                            <label class="wallet-btn flex flex-col items-center justify-center border-2 border-gray-200 rounded-2xl p-6 cursor-pointer hover:border-purple-500" data-wallet="esewa">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Esewa_logo.svg/512px-Esewa_logo.svg.png" alt="eSewa" class="h-10 mb-3">
                                <p class="font-medium">eSewa</p>
                            </label>

                            <label class="wallet-btn flex flex-col items-center justify-center border-2 border-gray-200 rounded-2xl p-6 cursor-pointer hover:border-blue-500" data-wallet="khalti">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Khalti_Logo.svg/512px-Khalti_Logo.svg.png" alt="Khalti" class="h-10 mb-3">
                                <p class="font-medium">Khalti</p>
                            </label>
                        </div>

                        <input type="hidden" name="wallet_type" id="wallet_type" value="">
                    </div>

                    <button type="submit" id="place-order-btn"
                            class="mt-10 w-full bg-black hover:bg-gray-900 text-white font-semibold py-5 rounded-2xl text-lg transition-all">
                        Place Order
                    </button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-3xl shadow-sm p-8 sticky top-6">
                    <h2 class="text-2xl font-semibold mb-6">Order Summary</h2>
                    
                    @foreach($cart as $id => $item)
                    <div class="flex gap-4 py-4 border-b">
                        <img src="{{ $item['image'] ? asset('storage/products/' . $item['image']) : asset('images/products/default.jpg') }}" 
                             class="w-16 h-16 object-cover rounded-xl" alt="">
                        <div class="flex-1">
                            <p class="font-medium">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                        </div>
                        <p class="font-semibold">Rs {{ number_format($item['price']*$item['quantity']) }}</p>
                    </div>
                    @endforeach

                    <div class="mt-8 space-y-3 text-sm">
                        <div class="flex justify-between"><span>Subtotal</span><span id="subtotal">Rs 0</span></div>
                        <div class="flex justify-between"><span>Tax (5%)</span><span id="tax">Rs 0</span></div>
                        <div class="flex justify-between"><span>Shipping</span><span>Rs 100</span></div>
                        <div class="border-t pt-4 flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span id="total">Rs 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show/Hide wallet options
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                const isWallet = this.dataset.type === 'wallet';
                document.getElementById('wallet-options').classList.toggle('hidden', !isWallet);
                
                if (!isWallet) {
                    document.getElementById('wallet_type').value = '';
                }
            });
        });

        // Select Wallet
        document.querySelectorAll('.wallet-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.wallet-btn').forEach(b => b.classList.remove('border-purple-500', 'border-blue-500'));
                this.classList.add(this.dataset.wallet === 'esewa' ? 'border-purple-500' : 'border-blue-500');
                
                document.getElementById('wallet_type').value = this.dataset.wallet;
            });
        });

        // Calculate Total
        function calculateTotal() {
            let subtotal = 0;
            @foreach($cart as $item)
                subtotal += {{ $item['price'] * $item['quantity'] }};
            @endforeach
            const tax = Math.round(subtotal * 0.05);
            const total = subtotal + tax + 100;

            document.getElementById('subtotal').innerText = 'Rs ' + subtotal.toLocaleString('en-IN');
            document.getElementById('tax').innerText = 'Rs ' + tax.toLocaleString('en-IN');
            document.getElementById('total').innerText = 'Rs ' + total.toLocaleString('en-IN');
        }
        window.onload = calculateTotal;
    </script>
</x-frontend-layout>