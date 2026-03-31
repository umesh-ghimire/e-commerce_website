<nav class="bg-white shadow-sm border-b relative">
    <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-6">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center space-x-2">
            <span class="text-2xl font-bold text-green-700">PrimeHub</span>
        </a>

        {{-- Center Menu --}}
        <div class="hidden md:flex items-center space-x-8">

            {{-- Category Mega Menu --}}
            @php
                // Get active categories from database
                $categories = \App\Models\Category::where('is_active', true)
                    ->whereNull('parent_id') // Get only parent categories
                    ->withCount('products')
                    ->orderBy('name')
                    ->limit(6) // Limit to 12 categories for mega menu
                    ->get();
            @endphp

            @if($categories->count() > 0)
            <div class="relative">
                <button id="megaMenuToggle" data-dropdown-toggle="megaMenu"
                    class="cursor-pointer relative pb-1 font-medium text-black-700 hover:text-gray-700
                    after:2-[''] after:absolute after:left-0 after:bottom-0 after:w-0
                    hover:after:w-full after:h-0.5 after:bg-blue-600 after:transition-all flex items-center space-x-1">
                    <span>Categories</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="megaMenu"
                    class="absolute top-full left-0 z-20 hidden bg-white border shadow-xl rounded-lg mt-2 py-6 px-8 w-[700px]">
                    <h2 class="text-lg font-semibold mb-6">Shop by Category</h2>

                    <div class="grid grid-cols-3 gap-4">
                        @foreach($categories as $category)
                        <a href="{{ route('frontend.category.show', $category->slug) }}" 
                           class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 border hover:border-green-300 transition-colors">
                            @php
                                // Check if category has an image
                                $hasImage = false;
                                $imagePath = null;
                                
                                // First check if category has image field
                                if ($category->image) {
                                    // Check in storage
                                    $storagePath = 'storage/categories/' . $category->image;
                                    if (file_exists(public_path($storagePath))) {
                                        $hasImage = true;
                                        $imagePath = asset($storagePath);
                                    }
                                    // Check in images folder
                                    elseif (file_exists(public_path('images/categories/' . $category->image))) {
                                        $hasImage = true;
                                        $imagePath = asset('images/categories/' . $category->image);
                                    }
                                    // Check if it's a full URL
                                    elseif (filter_var($category->image, FILTER_VALIDATE_URL)) {
                                        $hasImage = true;
                                        $imagePath = $category->image;
                                    }
                                }
                            @endphp
                            
                            @if($hasImage)
                                {{-- Show Category Image --}}
                                <img src="{{ $imagePath }}"
                                     alt="{{ $category->name }}"
                                     class="w-10 h-10 rounded bg-gray-50 p-1 object-cover">
                            @else
                                {{-- Fallback to icon or default icon --}}
                                <div class="w-10 h-10 rounded bg-gray-100 p-2 flex items-center justify-center">
                                    @if($category->icon)
                                        <div class="text-green-700 text-lg">{!! $category->icon !!}</div>
                                    @else
                                        {{-- Default category icons based on category name --}}
                                        @php
                                            $defaultIcons = [
                                                'electronics' => '<i class="fas fa-tv"></i>',
                                                'fashion' => '<i class="fas fa-tshirt"></i>',
                                                'home' => '<i class="fas fa-home"></i>',
                                                'books' => '<i class="fas fa-book"></i>',
                                                'sports' => '<i class="fas fa-basketball-ball"></i>',
                                                'beauty' => '<i class="fas fa-spa"></i>',
                                                'toys' => '<i class="fas fa-gamepad"></i>',
                                                // 'food' => '<i class="fas fa-utensils"></i>',
                                                // 'health' => '<i class="fas fa-heartbeat"></i>',
                                                // 'automotive' => '<i class="fas fa-car"></i>',
                                                // 'garden' => '<i class="fas fa-seedling"></i>',
                                                // 'office' => '<i class="fas fa-briefcase"></i>',
                                            ];
                                            
                                            $iconFound = false;
                                            $categoryNameLower = strtolower($category->name);
                                            foreach ($defaultIcons as $key => $icon) {
                                                if (str_contains($categoryNameLower, $key)) {
                                                    echo $icon;
                                                    $iconFound = true;
                                                    break;
                                                }
                                            }
                                            
                                            if (!$iconFound) {
                                                echo '<i class="fas fa-box text-gray-400"></i>';
                                            }
                                        @endphp
                                    @endif
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-sm text-gray-900 hover:text-green-700">
                                    {{ $category->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $category->products_count ?? 0 }} {{ Str::plural('item', $category->products_count ?? 0) }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    
                    <!-- View All Categories Link -->
                    <div class="mt-6 pt-6 border-t">
                        <a href="{{ route('frontend.category.index') }}" 
                           class="flex items-center justify-center gap-2 text-green-700 hover:text-green-800 font-medium">
                            <span>View All Categories</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- Brands Mega Menu --}}
            @php
                // Check if products table has brand column
                $hasBrandColumn = false;
                try {
                    $hasBrandColumn = \Schema::hasColumn('products', 'brand');
                } catch (\Exception $e) {
                    $hasBrandColumn = false;
                }
            @endphp

            @if($hasBrandColumn)
            <div class="relative">
                <button id="megaMenuToggle1" data-dropdown-toggle="megaMenu1"
                    class="cursor-pointer relative pb-1 font-medium text-black-700 hover:text-gray-700
                    after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0
                    hover:after:w-full after:h-[2px] after:bg-blue-600 after:transition-all flex items-center space-x-1">
                    <span>Brands</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="megaMenu1"
                    class="absolute top-full left-0 z-20 hidden bg-white border shadow-xl rounded-lg mt-2 py-6 px-8 w-[600px]">
                    <h2 class="text-lg font-semibold mb-6">Popular Brands</h2>

                    <div class="grid grid-cols-3 gap-4">
                        @php
                            // Get unique brands from products if brand column exists
                            $brands = \App\Models\Product::whereNotNull('brand')
                                ->select('brand')
                                ->distinct()
                                ->where('brand', '!=', '')
                                ->orderBy('brand')
                                ->limit(6)
                                ->get()
                                ->map(function($item) {
                                    return [
                                        'name' => $item->brand,
                                        'image' => strtolower($item->brand) . '.png',
                                        'slug' => Str::slug($item->brand)
                                    ];
                                });
                        @endphp

                        @foreach($brands as $brand)
                        <a href="{{ route('frontend.products.index') }}?brand={{ $brand['slug'] }}" 
                           class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 border">
                            @if(file_exists(public_path('images/brands/' . $brand['image'])))
                                <img src="{{ asset('images/brands/' . $brand['image']) }}"
                                     alt="{{ $brand['name'] }}"
                                     class="w-10 h-10 rounded bg-gray-50 p-1 object-contain">
                            @elseif(file_exists(public_path('storage/products/' . $brand['image'])))
                                <img src="{{ asset('storage/products/' . $brand['image']) }}"
                                     alt="{{ $brand['name'] }}"
                                     class="w-10 h-10 rounded bg-gray-50 p-1 object-contain">
                            @else
                                <div class="w-10 h-10 rounded bg-gray-100 flex items-center justify-center">
                                    <span class="text-sm font-semibold text-gray-600">{{ substr($brand['name'], 0, 2) }}</span>
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-sm">{{ $brand['name'] }}</p>
                                <p class="text-xs text-gray-500">
                                    @php
                                        $brandCount = \App\Models\Product::where('brand', $brand['name'])->count();
                                    @endphp
                                    {{ $brandCount }} {{ Str::plural('item', $brandCount) }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    
                    <!-- View All Brands Link -->
                    <div class="mt-6 pt-6 border-t">
                        <a href="{{ route('frontend.products.index') }}?view=brands" 
                           class="flex items-center justify-center gap-2 text-green-700 hover:text-green-800 font-medium">
                            <span>View All Brands</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @else
                {{-- If no brand column, show static brands --}}
                <div class="relative">
                    <button id="megaMenuToggle1" data-dropdown-toggle="megaMenu1"
                        class="cursor-pointer relative pb-1 font-medium text-black-700 hover:text-gray-700
                        after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0
                        hover:after:w-full after:h-0.5 after:bg-blue-600 after:transition-all flex items-center space-x-1">
                        <span>Brands</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div id="megaMenu1"
                        class="absolute top-full left-0 z-20 hidden bg-white border shadow-xl rounded-lg mt-2 py-6 px-8 w-[600px]">
                        <h2 class="text-lg font-semibold mb-6">Popular Brands</h2>

                        <div class="grid grid-cols-3 gap-4">
                            @php
                                $staticBrands = [
                                    ['name' => 'Apple', 'image' => 'apple.png'],
                                    ['name' => 'Samsung', 'image' => 'samsung.png'],
                                    ['name' => 'LG', 'image' => 'lg.png'],
                                    ['name' => 'Nike', 'image' => 'nike.png'],
                                    ['name' => 'Adidas', 'image' => 'adidas.png'],
                                    ['name' => 'Boat', 'image' => 'boat.png'],
                                    
                                ];
                            @endphp

                            @foreach($staticBrands as $brand)
                            <a href="{{ route('frontend.products.index') }}?search={{ urlencode($brand['name']) }}" 
                               class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 border">
                                @if(file_exists(public_path('images/brands/' . $brand['image'])))
                                    <img src="{{ asset('images/brands/' . $brand['image']) }}"
                                         alt="{{ $brand['name'] }}"
                                         class="w-10 h-10 rounded bg-gray-50 p-1 object-contain">
                                @elseif(file_exists(public_path('storage/products/' . $brand['image'])))
                                    <img src="{{ asset('storage/products/' . $brand['image']) }}"
                                         alt="{{ $brand['name'] }}"
                                         class="w-10 h-10 rounded bg-gray-50 p-1 object-contain">
                                @else
                                    <div class="w-10 h-10 rounded bg-gray-100 flex items-center justify-center">
                                        <span class="text-sm font-semibold text-gray-600">{{ substr($brand['name'], 0, 2) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-sm">{{ $brand['name'] }}</p>
                                    <p class="text-xs text-gray-500">
                                        @php
                                            // Try to get count from product name search
                                            $brandCount = \App\Models\Product::where('name', 'like', '%' . $brand['name'] . '%')->count();
                                        @endphp
                                        {{ $brandCount > 0 ? $brandCount : '240' }} items
                                    </p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        
                        <!-- View All Brands Link -->
                        <div class="mt-6 pt-6 border-t">
                            <a href="{{ route('frontend.products.index') }}?view=brands" 
                               class="flex items-center justify-center gap-2 text-green-700 hover:text-green-800 font-medium">
                                <span>View All Brands</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <a href="{{ route('frontend.products.index') }}?sort=newest" class="font-medium hover:text-gray-700">What's New</a>
            <a href="{{ route('frontend.products.index') }}" class="font-medium hover:text-gray-700">Shopping</a>
        </div>

       

       {{-- Search --}}
        <form action="{{ url('/search') }}" method="GET">
            <div class="hidden md:flex items-center w-72 relative">
                <input type="text"
                    name="query"
                    value="{{ request('query') }}"
                    class="w-full border rounded-full py-2 pl-4 pr-10 focus:ring-0"
                    placeholder="Search Product">

                <button type="submit" class="absolute right-3 focus:outline-none">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
        </form>

        {{-- Right Section --}}
        <div class="hidden md:flex items-center space-x-6">

            {{-- Cart --}}
            <a href="{{ route('cart') }}" class="relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                @if(session('cart'))
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center cart-count">
                        {{ array_sum(array_column(session('cart'), 'quantity')) }}
                    </span>
                @else
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center cart-count">0</span>
                @endif
            </a>

            {{-- Auth --}}
            @guest
                <a href="{{ route('register') }}" class="font-medium hover:text-gray-700">SignUp</a>
                <a href="{{ route('login') }}" class="font-medium hover:text-gray-700">Login</a>
            @endguest

            @auth
            <div class="relative">
                <button id="accountToggle" data-dropdown-toggle="accountMenu"
                    class="flex items-center space-x-2 font-medium hover:text-gray-700">
                    <i class="fa-solid fa-user"></i>
                    <span>{{ Auth::user()->name }}</span>
                </button>

                <div id="accountMenu"
                    class="hidden absolute right-0 mt-3 w-52 bg-white rounded-lg shadow border z-50">
                    <ul class="py-2 text-sm">
                        <li><a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Manage Account</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Wishlist</a></li>
                        <li><a href="{{ route('cart') }}" class="block px-4 py-2 hover:bg-gray-100">Cart</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">My Orders</a></li>
                        <li><hr></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endauth
        </div>
    </div>
</nav>