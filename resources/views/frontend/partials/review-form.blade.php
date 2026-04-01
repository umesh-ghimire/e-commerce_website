<div class="bg-white rounded-xl shadow-sm p-6">
    <h3 class="text-xl font-bold text-gray-900 mb-4">Write a Review</h3>
    
    @auth
        <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                <div class="flex gap-2 rating-stars">
                    @for($i = 5; $i >= 1; $i--)
                        <label class="cursor-pointer">
                            <input type="radio" name="rating" value="{{ $i }}" class="hidden rating-input" required>
                            <svg class="w-8 h-8 text-gray-300 hover:text-yellow-400 transition rating-star" 
                                 data-rating="{{ $i }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </label>
                    @endfor
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Review Title</label>
                <input type="text" name="title" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                       placeholder="Summarize your experience">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                <textarea name="comment" rows="5" required
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                          placeholder="Share your experience with this product..."></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Photos (Optional)</label>
                <input type="file" name="images[]" multiple accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <p class="text-xs text-gray-500 mt-1">You can upload up to 5 images (Max 2MB each)</p>
            </div>
            
            <button type="submit" 
                    class="bg-gradient-to-r from-green-800 to-emerald-700 text-white px-6 py-2 rounded-lg font-medium hover:from-green-900 hover:to-emerald-800 transition-all duration-300 transform hover:scale-105">
                Submit Review
            </button>
        </form>
        
        <script>
            // Star rating functionality
            const ratingInputs = document.querySelectorAll('.rating-input');
            const ratingStars = document.querySelectorAll('.rating-star');
            
            ratingStars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    const input = document.querySelector(`.rating-input[value="${rating}"]`);
                    if (input) input.checked = true;
                    
                    // Update star colors
                    ratingStars.forEach((s, index) => {
                        const starRating = parseInt(s.dataset.rating);
                        if (starRating <= rating) {
                            s.classList.add('text-yellow-400');
                            s.classList.remove('text-gray-300');
                        } else {
                            s.classList.remove('text-yellow-400');
                            s.classList.add('text-gray-300');
                        }
                    });
                });
            });
        </script>
    @else
        <div class="text-center py-6">
            <p class="text-gray-600 mb-4">Please login to write a review</p>
            <a href="{{ route('login') }}" 
               class="inline-block bg-gradient-to-r from-green-800 to-emerald-700 text-white px-6 py-2 rounded-lg font-medium hover:from-green-900 hover:to-emerald-800 transition-all duration-300">
                Login to Review
            </a>
        </div>
    @endauth
</div>