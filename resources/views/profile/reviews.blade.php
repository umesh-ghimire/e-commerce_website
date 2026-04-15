<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">My Reviews</h1>
            
            @if($reviews->count() > 0)
                <div class="space-y-4">
                    @foreach($reviews as $review)
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="flex justify-between">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $review->product->name }}</h3>
                                <div class="flex items-center gap-1 mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-gray-600 mt-2">{{ $review->comment }}</p>
                                <p class="text-xs text-gray-400 mt-2">{{ $review->created_at->format('M d, Y') }}</p>
                            </div>
                            <form action="{{ route('profile.review.delete', $review->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Delete this review?')">Delete</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6">{{ $reviews->links() }}</div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center">
                    <p class="text-gray-500">No reviews yet</p>
                    <a href="{{ route('frontend.products.index') }}" class="text-emerald-600 hover:underline mt-2 inline-block">Write a Review →</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>