<x-frontend-layout>
    <div class="min-h-screen bg-[#f9f6ee] flex items-center justify-center py-12">
        <div class="max-w-lg w-full bg-white rounded-3xl shadow-sm p-12 text-center">
            <div class="text-7xl mb-6">🎉</div>
            <h1 class="text-4xl font-bold text-green-600 mb-3">Order Placed Successfully!</h1>
            <p class="text-gray-600 text-lg mb-8">Thank you for shopping with us.</p>

            <div class="bg-gray-50 rounded-2xl p-8 mb-10">
                <p class="text-sm text-gray-500">Order Number</p>
                <p class="text-2xl font-bold text-gray-900">#{{ $order->order_number }}</p>
                
                <div class="h-px bg-gray-200 my-6"></div>
                
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Total Amount</span>
                    <span class="font-semibold">Rs {{ number_format($order->total, 0) }}</span>
                </div>
                <div class="flex justify-between text-sm mt-3">
                    <span class="text-gray-600">Payment Method</span>
                    <span class="font-medium">{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</span>
                </div>
                <div class="flex justify-between text-sm mt-3">
                    <span class="text-gray-600">Status</span>
                    <span class="text-green-600 font-medium">Pending</span>
                </div>
            </div>

            <a href="{{ route('frontend.products.index') }}" 
               class="block w-full bg-black text-white py-4 rounded-2xl font-semibold hover:bg-gray-900 transition">
                Continue Shopping
            </a>
        </div>
    </div>
</x-frontend-layout>