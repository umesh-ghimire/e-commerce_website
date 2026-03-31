<x-frontend-layout>
    <div class="min-h-screen bg-[#f9f6ee] py-12">
        <div class="max-w-lg mx-auto bg-white rounded-3xl shadow-sm p-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Complete Your Payment</h2>
                <p class="text-gray-600 mt-2">Order #{{ $order->order_number }}</p>
                <p class="text-2xl font-semibold text-green-600 mt-1">Rs {{ number_format($order->total, 0) }}</p>
            </div>

            @if($wallet === 'esewa')
                <div class="bg-purple-50 border-2 border-purple-200 rounded-2xl p-8 mb-8 text-center">
                    <p class="font-bold text-purple-700 mb-4 text-lg">eSewa Payment</p>
                    <img src="https://via.placeholder.com/280x280/6b21a8/ffffff?text=eSewa+QR+Code" 
                         alt="eSewa QR" class="mx-auto rounded-xl shadow-md">
                    <p class="mt-6 text-sm text-gray-500">Scan with eSewa Mobile App</p>
                </div>
            @elseif($wallet === 'khalti')
                <div class="bg-blue-50 border-2 border-blue-200 rounded-2xl p-8 mb-8 text-center">
                    <p class="font-bold text-blue-700 mb-4 text-lg">Khalti Payment</p>
                    <img src="https://via.placeholder.com/280x280/1e40af/ffffff?text=Khalti+QR+Code" 
                         alt="Khalti QR" class="mx-auto rounded-xl shadow-md">
                    <p class="mt-6 text-sm text-gray-500">Scan with Khalti Mobile App</p>
                </div>
            @endif

            <div class="bg-yellow-50 border border-yellow-300 rounded-2xl p-6 mb-8">
                <p class="font-medium text-yellow-800">After making payment:</p>
                <ol class="list-decimal list-inside text-sm text-yellow-700 mt-3 space-y-1">
                    <li>Take a screenshot of the payment confirmation</li>
                    <li>Upload the screenshot below</li>
                    <li>We will verify and confirm your order</li>
                </ol>
            </div>

            <!-- Payment Proof Upload Form -->
            <form method="POST" action="{{ route('frontend.payment.proof.store', $order->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="wallet" value="{{ $wallet }}">

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Upload Payment Proof (Screenshot)</label>
                    <input type="file" name="payment_proof" accept="image/*" required
                           class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:border-green-500">
                    <p class="text-xs text-gray-500 mt-2">Accepted: JPG, PNG (Max 5MB)</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes (Optional)</label>
                    <textarea name="payment_notes" rows="3"
                              class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:border-green-500"
                              placeholder="Transaction ID, Reference number, etc."></textarea>
                </div>

                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-5 rounded-2xl text-lg transition-all">
                    Submit Payment Proof
                </button>
            </form>

            <div class="text-center mt-6">
                <a href="{{ route('frontend.order.success', $order->id) }}" 
                   class="text-sm text-gray-500 hover:text-gray-700">
                    I will upload later →
                </a>
            </div>
        </div>
    </div>
</x-frontend-layout>