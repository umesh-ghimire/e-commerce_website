<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">My Wishlist</h1>
            
            @if($wishlist->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($wishlist as $item)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                            <p class="text-emerald-600 font-bold mt-2">₹{{ number_format($item->product->price, 0) }}</p>
                            <div class="flex gap-2 mt-4">
                                <a href="{{ route('frontend.products.show', $item->product->slug) }}" class="flex-1 text-center px-3 py-2 bg-emerald-600 text-white rounded-lg text-sm">View</a>
                                <form action="{{ route('profile.wishlist.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-red-100 text-red-600 rounded-lg text-sm">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6">{{ $wishlist->links() }}</div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center">
                    <p class="text-gray-500">Your wishlist is empty</p>
                    <a href="{{ route('frontend.products.index') }}" class="text-emerald-600 hover:underline mt-2 inline-block">Browse Products →</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>