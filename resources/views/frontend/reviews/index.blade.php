<x-frontend-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reviews for {{ $product->name }}
            </h2>
            <div class="text-sm text-gray-600">
                {{ $reviews->total() }} Reviews
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    {{-- Product Info --}}
                    <div class="flex items-center gap-6 pb-6 border-b mb-6">
                        <a href="{{ route('frontend.products.show', $product->slug) }}" class="block">
                            @if($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-20 h-20 object-cover rounded-lg">
                            @else
                                <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </a>
                        <div>
                            <a href="{{ route('frontend.products.show', $product->slug) }}" class="hover:text-green-700">
                                <h3 class="font-semibold text-lg text-gray-900">{{ $product->name }}</h3>
                            </a>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($ratingSummary['average']))
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-sm text-gray-600">{{ number_format($ratingSummary['average'], 1) }} out of 5</span>
                                <span class="text-sm text-gray-500">({{ $ratingSummary['total'] }} reviews)</span>
                            </div>
                        </div>
                    </div>

                    {{-- Rating Summary --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="text-center p-6 bg-gray-50 rounded-lg">
                            <div class="text-5xl font-bold text-gray-900">{{ number_format($ratingSummary['average'], 1) }}</div>
                            <div class="flex justify-center mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($ratingSummary['average']))
                                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Based on {{ $ratingSummary['total'] }} reviews</p>
                        </div>
                        
                        <div class="col-span-2">
                            @foreach([5,4,3,2,1] as $star)
                                @php
                                    $count = $ratingSummary['distribution'][$star] ?? 0;
                                    $percentage = $ratingSummary['total'] > 0 ? ($count / $ratingSummary['total']) * 100 : 0;
                                @endphp
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-12 text-sm text-gray-600">{{ $star }} ★</div>
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="w-12 text-sm text-gray-500">{{ $count }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Write a Review Button --}}
                    @auth
                        @php
                            $userReview = $product->reviews()->where('user_id', auth()->id())->first();
                        @endphp
                        @if(!$userReview)
                            <div class="mb-8">
                                <button onclick="toggleReviewForm()" 
                                        class="bg-gradient-to-r from-green-800 to-emerald-700 text-white px-6 py-2 rounded-lg font-medium hover:from-green-900 hover:to-emerald-800 transition-all duration-300">
                                    Write a Review
                                </button>
                            </div>
                            
                            <div id="review-form-container" class="hidden mb-8">
                                @include('frontend.partials.review-form', ['product' => $product])
                            </div>
                        @endif
                    @endauth

                    {{-- Reviews List --}}
                    <div class="space-y-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">All Reviews</h3>
                        
                        @if($reviews->count() > 0)
                            @foreach($reviews as $review)
                                @include('frontend.partials.review-card', ['review' => $review])
                            @endforeach
                            
                            <div class="mt-6">
                                {{ $reviews->links() }}
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <p class="text-gray-500 mt-2">No reviews yet. Be the first to review this product!</p>
                                @auth
                                    <button onclick="toggleReviewForm()" 
                                            class="mt-4 text-green-700 hover:text-green-900 font-medium">
                                        Write a Review →
                                    </button>
                                @endauth
                            </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleReviewForm() {
            const form = document.getElementById('review-form-container');
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
            }
        }
    </script>
</x-frontend-layout>