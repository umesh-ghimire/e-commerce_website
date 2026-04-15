<nav class="bg-white shadow-sm border-b relative">
    <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-6">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center space-x-2">
            <span class="text-2xl font-bold text-green-700">PrimeHub</span>
        </a>

        {{-- Center Menu --}}
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ url('/') }}" class="font-medium hover:text-gray-700">Home</a>
            <a href="{{ route('frontend.products.index') }}" class="font-medium hover:text-gray-700">Shop</a>
            <a href="{{ route('profile.orders') }}" class="font-medium hover:text-gray-700">My Orders</a>
            <a href="{{ route('profile.wishlist') }}" class="font-medium hover:text-gray-700">Wishlist</a>
        </div>

        {{-- Search --}}
        <form action="{{ url('/search') }}" method="GET" class="hidden md:block">
            <div class="relative w-72">
                <input type="text"
                    name="query"
                    value="{{ request('query') }}"
                    class="w-full border rounded-full py-2 pl-4 pr-10 focus:outline-none focus:ring-2 focus:ring-emerald-500"
                    placeholder="Search products...">
                <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
        </form>

        {{-- Right Section --}}
        <div class="flex items-center space-x-6">
            {{-- Cart --}}
            <a href="{{ route('cart') }}" class="relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                @php
                    $cartCount = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
                @endphp
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center cart-count">
                    {{ $cartCount }}
                </span>
            </a>

            {{-- User Menu --}}
            @guest
                <a href="{{ route('login') }}" class="font-medium hover:text-gray-700">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Sign Up</a>
            @endguest

            @auth
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 font-medium hover:text-gray-700 focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 flex items-center justify-center text-white font-semibold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-3 w-56 bg-white rounded-lg shadow-xl border z-50" style="display: none;">
                    <div class="py-2">
                        <div class="px-4 py-3 border-b">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Dashboard</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">My Profile</a>
                        <a href="{{ route('profile.orders') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">My Orders</a>
                        <a href="{{ route('profile.wishlist') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Wishlist</a>
                        <a href="{{ route('profile.addresses') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Addresses</a>
                        <div class="border-t my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Alpine.js is required for the dropdown. If not installed, use this vanilla JS
    document.addEventListener('alpine:init', () => {
        // Alpine is available
    });
    
    // Fallback for Alpine.js dropdown
    if (typeof Alpine === 'undefined') {
        document.querySelectorAll('[x-data]').forEach(el => {
            const data = {};
            if (el.getAttribute('x-data')) {
                eval('data = {' + el.getAttribute('x-data') + '}');
            }
            el.__x = new Proxy(data, {
                set(obj, prop, value) {
                    obj[prop] = value;
                    if (prop === 'open' && value) {
                        const dropdown = el.querySelector('[x-show]');
                        if (dropdown) dropdown.style.display = 'block';
                    } else if (prop === 'open' && !value) {
                        const dropdown = el.querySelector('[x-show]');
                        if (dropdown) dropdown.style.display = 'none';
                    }
                    return true;
                }
            });
            
            const button = el.querySelector('button');
            if (button) {
                button.addEventListener('click', () => {
                    el.__x.open = !el.__x.open;
                });
            }
            
            document.addEventListener('click', (e) => {
                if (!el.contains(e.target)) {
                    el.__x.open = false;
                }
            });
        });
    }
</script>