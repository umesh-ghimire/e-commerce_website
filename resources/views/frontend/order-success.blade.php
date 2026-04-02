<x-frontend-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <div class="mb-6">
                    <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-2xl font-bold text-gray-900 mb-4">Order Confirmed! 🎉</h1>
                
                <p class="text-gray-600 mb-2">
                    Thank you for your order! Your order number is:
                </p>
                
                <p class="text-xl font-bold text-green-700 mb-6">
                    {{ $order->order_number }}
                </p>
                
                <p class="text-gray-600 mb-8">
                    @if($order->payment_method === 'cash_on_delivery')
                        You will pay cash on delivery. Our delivery partner will contact you soon.
                    @else
                        We've sent a confirmation email to <strong>{{ $order->user->email ?? 'your email' }}</strong>
                    @endif
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('frontend.products.index') }}" 
                       class="bg-gradient-to-r from-green-800 to-emerald-700 text-white px-6 py-3 rounded-lg font-medium hover:from-green-900 hover:to-emerald-800 transition">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>