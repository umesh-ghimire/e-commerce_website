<x-frontend-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Checkout</h2>
                    
                    <form action="{{ route('frontend.checkout.store') }}" method="POST" id="checkout-form">
                        @csrf
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Left Column - Billing Details -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Billing Details</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                                        <input type="text" name="name" required 
                                               value="{{ auth()->user()->name ?? '' }}"
                                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                                        <input type="email" name="email" required 
                                               value="{{ auth()->user()->email ?? '' }}"
                                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                                        <input type="text" name="phone" required 
                                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Shipping Address *</label>
                                        <textarea name="shipping_address" rows="3" required
                                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Order Notes (Optional)</label>
                                        <textarea name="notes" rows="2"
                                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                                                  placeholder="Special instructions for delivery"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Column - Order Summary & Payment -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                                
                                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    
                                    <!-- Order Items with Images -->
                                    <div class="space-y-3 max-h-96 overflow-y-auto">
                                        @foreach($cart as $id => $item)
                                            @php
                                                $itemTotal = $item['price'] * $item['quantity'];
                                                $subtotal += $itemTotal;
                                            @endphp
                                            <div class="flex gap-3 py-3 border-b border-gray-200">
                                                <!-- Product Image -->
                                                <div class="flex-shrink-0">
                                                    @if(isset($item['image']) && $item['image'])
                                                        <img src="{{ asset('storage/products/' . $item['image']) }}" 
                                                             alt="{{ $item['name'] }}"
                                                             class="w-16 h-16 object-cover rounded-lg">
                                                    @else
                                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <!-- Product Details -->
                                                <div class="flex-1">
                                                    <div class="flex justify-between">
                                                        <div>
                                                            <h4 class="font-medium text-gray-900">{{ $item['name'] }}</h4>
                                                            <p class="text-sm text-gray-500">Quantity: {{ $item['quantity'] }}</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="font-semibold text-gray-900">₹{{ number_format($itemTotal, 2) }}</p>
                                                            <p class="text-xs text-gray-500">₹{{ number_format($item['price'], 2) }} each</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <!-- Order Totals -->
                                    <div class="mt-4 pt-3 border-t border-gray-200">
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">Subtotal</span>
                                            <span class="font-medium">₹{{ number_format($subtotal, 2) }}</span>
                                        </div>
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">Shipping</span>
                                            <span class="font-medium">₹100.00</span>
                                        </div>
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">Tax (5%)</span>
                                            <span class="font-medium">₹{{ number_format($subtotal * 0.05, 2) }}</span>
                                        </div>
                                        <div class="flex justify-between py-2 text-lg font-bold border-t border-gray-300 mt-2 pt-3">
                                            <span>Total</span>
                                            <span class="text-green-700">₹{{ number_format($subtotal + 100 + ($subtotal * 0.05), 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Method</h3>
                                
                                <!-- Dynamic Payment Methods from Database -->
                                <div class="space-y-3">
                                    @php
                                        $paymentMethods = \App\Models\PaymentMethod::where('is_active', true)
                                            ->orderBy('order')
                                            ->get();
                                    @endphp
                                    
                                    @forelse($paymentMethods as $method)
                                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50 payment-method-option transition-all duration-200">
                                        <input type="radio" name="payment_method" value="{{ $method->slug }}" class="w-4 h-4 text-green-600 payment-radio">
                                        <div class="ml-3 flex-1">
                                            <div class="flex items-center">
                                                @if($method->logo)
                                                    <img src="{{ asset('storage/' . $method->logo) }}" 
                                                         alt="{{ $method->name }}" 
                                                         class="w-6 h-6 object-contain mr-2">
                                                @endif
                                                <span class="font-medium">{{ $method->name }}</span>
                                                @if($method->additional_charge > 0)
                                                    <span class="ml-2 text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                                                        +₹{{ number_format($method->additional_charge, 0) }}
                                                    </span>
                                                @endif
                                                @if($method->slug === 'cash_on_delivery')
                                                    <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Pay when delivered</span>
                                                @else
                                                    <span class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Digital Wallet</span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-gray-500 mt-1">{{ $method->description }}</p>
                                            @if($method->min_amount > 0)
                                                <p class="text-xs text-gray-400 mt-1">Min. order: ₹{{ number_format($method->min_amount, 0) }}</p>
                                            @endif
                                        </div>
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </label>
                                    @empty
                                    <div class="text-center py-4 text-gray-500">
                                        No payment methods available. Please contact support.
                                    </div>
                                    @endforelse
                                </div>
                                
                                <button type="submit" class="w-full mt-6 bg-gradient-to-r from-green-800 to-emerald-700 text-white py-3 rounded-lg font-semibold hover:from-green-900 hover:to-emerald-800 transition-all duration-300">
                                    Place Order
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentRadios = document.querySelectorAll('.payment-radio');
            const totalAmount = {{ $subtotal + 100 + ($subtotal * 0.05) }};
            
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const selectedMethod = this.value;
                    
                    // Get the selected payment method data
                    const selectedLabel = this.closest('label');
                    const additionalChargeElem = selectedLabel.querySelector('.bg-yellow-100');
                    
                    let additionalCharge = 0;
                    if (additionalChargeElem) {
                        const chargeText = additionalChargeElem.innerText;
                        const match = chargeText.match(/₹(\d+)/);
                        if (match) {
                            additionalCharge = parseInt(match[1]);
                        }
                    }
                    
                    // Update total display if needed
                    if (additionalCharge > 0) {
                        const newTotal = totalAmount + additionalCharge;
                        const totalElement = document.querySelector('.text-green-700');
                        if (totalElement) {
                            totalElement.innerText = '₹' + newTotal.toLocaleString('en-IN', {minimumFractionDigits: 2});
                        }
                    } else {
                        const totalElement = document.querySelector('.text-green-700');
                        if (totalElement && totalElement.innerText !== '₹{{ number_format($subtotal + 100 + ($subtotal * 0.05), 2) }}') {
                            totalElement.innerText = '₹{{ number_format($subtotal + 100 + ($subtotal * 0.05), 2) }}';
                        }
                    }
                    
                    console.log('Selected payment method:', selectedMethod);
                });
            });
            
            // Form validation
            const form = document.getElementById('checkout-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
                    
                    if (!selectedPayment) {
                        e.preventDefault();
                        alert('Please select a payment method');
                        return false;
                    }
                    
                    // Check minimum amount requirements
                    const selectedMethod = selectedPayment.value;
                    const paymentMethods = @json($paymentMethods);
                    const method = paymentMethods.find(m => m.slug === selectedMethod);
                    
                    if (method && method.min_amount > 0 && {{ $subtotal + 100 + ($subtotal * 0.05) }} < method.min_amount) {
                        e.preventDefault();
                        alert(`Minimum order amount for ${method.name} is ₹${method.min_amount.toLocaleString('en-IN')}. Your order total is ₹{{ number_format($subtotal + 100 + ($subtotal * 0.05), 2) }}`);
                        return false;
                    }
                    
                    if (method && method.max_amount && {{ $subtotal + 100 + ($subtotal * 0.05) }} > method.max_amount) {
                        e.preventDefault();
                        alert(`Maximum order amount for ${method.name} is ₹${method.max_amount.toLocaleString('en-IN')}. Please contact us for large orders.`);
                        return false;
                    }
                    
                    return true;
                });
            }
        });
    </script>
</x-frontend-layout>