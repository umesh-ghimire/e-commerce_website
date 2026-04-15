<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('profile.orders') }}" class="text-emerald-600 hover:text-emerald-700">← Back to Orders</a>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-4">Order #{{ $order->order_number }}</h1>
                <p class="text-gray-500 mb-6">Placed on {{ $order->created_at->format('F d, Y') }}</p>
                
                <div class="border-t border-gray-200 pt-4">
                    <h2 class="font-semibold text-gray-900 mb-3">Order Items</h2>
                    @foreach($order->items as $item)
                    <div class="flex justify-between py-3 border-b border-gray-100">
                        <div>
                            <p class="font-medium">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                        </div>
                        <p class="font-semibold">₹{{ number_format($item->price * $item->quantity, 2) }}</p>
                    </div>
                    @endforeach
                    
                    <div class="mt-4 pt-3">
                        <div class="flex justify-between py-2">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span>Shipping</span>
                            <span>₹{{ number_format($order->shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between py-2 font-bold text-lg border-t border-gray-200 mt-2 pt-3">
                            <span>Total</span>
                            <span class="text-emerald-600">₹{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
                
                @if(in_array($order->status, ['pending', 'processing']))
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <form action="{{ route('profile.order.cancel', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700" onclick="return confirm('Cancel this order?')">Cancel Order</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>