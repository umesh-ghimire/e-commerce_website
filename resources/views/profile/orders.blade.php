<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">My Orders</h1>
            
            <!-- Status Filters -->
            <div class="flex flex-wrap gap-2 mb-6">
                <a href="{{ route('profile.orders') }}" class="px-4 py-2 rounded-lg {{ !request('status') ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">All</a>
                <a href="{{ route('profile.orders', ['status' => 'pending']) }}" class="px-4 py-2 rounded-lg {{ request('status') == 'pending' ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">Pending</a>
                <a href="{{ route('profile.orders', ['status' => 'processing']) }}" class="px-4 py-2 rounded-lg {{ request('status') == 'processing' ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">Processing</a>
                <a href="{{ route('profile.orders', ['status' => 'shipped']) }}" class="px-4 py-2 rounded-lg {{ request('status') == 'shipped' ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">Shipped</a>
                <a href="{{ route('profile.orders', ['status' => 'delivered']) }}" class="px-4 py-2 rounded-lg {{ request('status') == 'delivered' ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">Delivered</a>
                <a href="{{ route('profile.orders', ['status' => 'cancelled']) }}" class="px-4 py-2 rounded-lg {{ request('status') == 'cancelled' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">Cancelled</a>
            </div>

            @if($orders->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">#{{ $order->order_number }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 font-semibold text-gray-900">₹{{ number_format($order->total, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        @if($order->status == 'delivered') bg-green-100 text-green-800
                                        @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('profile.order.details', $order->id) }}" class="text-emerald-600 hover:text-emerald-700">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center">
                    <p class="text-gray-500">No orders yet</p>
                    <a href="{{ route('frontend.products.index') }}" class="text-emerald-600 hover:underline mt-2 inline-block">Start Shopping →</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>