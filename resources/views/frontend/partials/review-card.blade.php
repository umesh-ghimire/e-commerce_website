<div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-all duration-300 border border-gray-100">
    <div class="flex items-start justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-100 to-emerald-100 flex items-center justify-center">
                @if($review->user->avatar)
                    <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="{{ $review->user->name }}" class="w-full h-full rounded-full object-cover">
                @else
                    <span class="text-green-700 font-semibold text-lg">
                        {{ substr($review->user->name, 0, 2) }}
                    </span>
                @endif
            </div>
            <div>
                <h4 class="font-semibold text-gray-900">{{ $review->user->name }}</h4>
                <div class="flex items-center gap-1 mt-1">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $review->rating)
                            <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @else
                            <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <div class="text-xs text-gray-500">
            {{ $review->created_at->format('M d, Y') }}
            @if($review->is_verified_purchase)
                <span class="ml-2 bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-medium">
                    Verified Purchase
                </span>
            @endif
        </div>
    </div>

    @if($review->title)
        <h3 class="font-semibold text-gray-900 mt-4">{{ $review->title }}</h3>
    @endif

    <p class="text-gray-600 mt-2 leading-relaxed">{{ $review->comment }}</p>

    @if($review->images && count($review->images) > 0)
        <div class="flex gap-2 mt-4 flex-wrap">
            @foreach($review->images as $image)
                <a href="{{ asset('storage/' . $image) }}" target="_blank" class="block">
                    <img src="{{ asset('storage/' . $image) }}" 
                         alt="Review image" 
                         class="w-20 h-20 object-cover rounded-lg border hover:scale-110 transition-transform duration-300">
                </a>
            @endforeach
        </div>
    @endif

    @if($review->admin_reply)
        <div class="mt-4 pl-4 border-l-4 border-green-500 bg-green-50 rounded-r-lg p-4">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <span class="font-semibold text-green-800 text-sm">Seller Response</span>
                @if($review->replied_at)
                    <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($review->replied_at)->format('M d, Y') }}</span>
                @endif
            </div>
            <p class="text-gray-700 text-sm">{{ $review->admin_reply }}</p>
        </div>
    @endif
</div>