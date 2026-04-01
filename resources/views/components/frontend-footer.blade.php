@props([
    'footerSettings' => null,
    'footerLinks' => null,
    'socialLinks' => null
])

@php
    // If data not passed, fetch it
    if (!$footerSettings) {
        $footerSettings = \App\Models\FooterSetting::first() ?? new \App\Models\FooterSetting();
    }
    if (!$footerLinks) {
        $footerLinks = \App\Models\FooterLink::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('section');
    }
    if (!$socialLinks) {
        $socialLinks = \App\Models\SocialMediaLink::where('is_active', true)
            ->orderBy('order')
            ->get();
    }
@endphp

<footer class="w-full bg-green-900 mt-10 border-t border-green-800 pt-10">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-10">

            {{-- Logo + Description --}}
            <div class="col-span-1 lg:col-span-2">
                <div class="flex items-center space-x-2">
                    @if($footerSettings->logo)
                        <img src="{{ asset('storage/' . $footerSettings->logo) }}" class="h-12" alt="{{ $footerSettings->company_name }}">
                    @endif
                    <h1 class="text-2xl font-bold text-white">{{ $footerSettings->company_name ?? 'PrimeHub' }}</h1>
                </div>

                <p class="text-green-100 mt-4">
                    {{ $footerSettings->company_description ?? 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.' }}
                </p>

                {{-- Contact Info --}}
                @if($footerSettings->email || $footerSettings->phone)
                    <div class="mt-4 space-y-2">
                        @if($footerSettings->email)
                            <p class="text-green-100 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $footerSettings->email }}
                            </p>
                        @endif
                        @if($footerSettings->phone)
                            <p class="text-green-100 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $footerSettings->phone }}
                            </p>
                        @endif
                        @if($footerSettings->address)
                            <p class="text-green-100 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $footerSettings->address }}
                            </p>
                        @endif
                    </div>
                @endif

                {{-- Social Media Links (Optional) --}}
                @if($socialLinks->count() > 0)
                <div class="mt-6">
                    <div class="flex gap-3">
                        @foreach($socialLinks as $social)
                            <a href="{{ $social->url }}" target="_blank" class="w-8 h-8 rounded-full flex items-center justify-center transition hover:scale-110"
                               style="background-color: {{ $social->color ?? '#2d6a4f' }};">
                                <i class="{{ $social->icon_class ?? 'fab fa-' . strtolower($social->platform) }} text-white text-sm"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Department Section --}}
            @if(isset($footerLinks['department']) && $footerLinks['department']->count() > 0)
            <div>
                <h3 class="font-semibold text-white mb-3">Department</h3>
                <ul class="space-y-2">
                    @foreach($footerLinks['department'] as $link)
                        <li>
                            <a href="{{ $link->url }}" class="cursor-pointer text-green-200 hover:text-yellow-400 hover:translate-x-1 transition-all duration-200 inline-block">
                                {{ $link->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- About Us Section --}}
            @if(isset($footerLinks['about']) && $footerLinks['about']->count() > 0)
            <div>
                <h3 class="font-semibold text-white mb-3">About Us</h3>
                <ul class="space-y-2">
                    @foreach($footerLinks['about'] as $link)
                        <li>
                            <a href="{{ $link->url }}" class="cursor-pointer text-green-200 hover:text-yellow-400 hover:translate-x-1 transition-all duration-200 inline-block">
                                {{ $link->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Services Section --}}
            @if(isset($footerLinks['services']) && $footerLinks['services']->count() > 0)
            <div>
                <h3 class="font-semibold text-white mb-3">Services</h3>
                <ul class="space-y-2">
                    @foreach($footerLinks['services'] as $link)
                        <li>
                            <a href="{{ $link->url }}" class="cursor-pointer text-green-200 hover:text-yellow-400 hover:translate-x-1 transition-all duration-200 inline-block">
                                {{ $link->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Newsletter Section (Optional) --}}
            @if($footerSettings->show_newsletter && Route::has('newsletter.subscribe'))
            <div>
                <h3 class="font-semibold text-white mb-3">{{ $footerSettings->newsletter_title ?? 'Newsletter' }}</h3>
                <p class="text-green-200 text-sm mb-3">
                    {{ $footerSettings->newsletter_description ?? 'Subscribe to get updates on new products and offers.' }}
                </p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col gap-2">
                    @csrf
                    <input type="email" name="email" placeholder="Your email address" 
                           class="px-3 py-2 rounded-lg border border-green-700 bg-green-800 text-white placeholder-green-300 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 text-sm">
                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition text-sm font-medium">
                        Subscribe
                    </button>
                </form>
            </div>
            @endif

        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-green-800 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center">

            {{-- Bottom Links (Become Seller, Gift Cards, Help Center) --}}
            <div class="flex items-center gap-6 text-yellow-400 font-medium flex-wrap justify-center">
                @if(isset($footerLinks['bottom_links']) && $footerLinks['bottom_links']->count() > 0)
                    @foreach($footerLinks['bottom_links'] as $link)
                        <a href="{{ $link->url }}" class="flex items-center space-x-2 hover:text-yellow-300 transition">
                            @if($link->icon)
                                <span>{{ $link->icon }}</span>
                            @endif
                            <span>{{ $link->title }}</span>
                        </a>
                    @endforeach
                @else
                    {{-- Default bottom links if none in database --}}
                    <div class="flex items-center space-x-2 cursor-pointer hover:text-yellow-300 transition">
                        <span>💼</span><span>Become Seller</span>
                    </div>
                    <div class="flex items-center space-x-2 cursor-pointer hover:text-yellow-300 transition">
                        <span>🎁</span><span>Gift Cards</span>
                    </div>
                    <div class="flex items-center space-x-2 cursor-pointer hover:text-yellow-300 transition">
                        <span>❓</span><span>Help Center</span>
                    </div>
                @endif
            </div>

            {{-- Legal Links (Terms of Service, Privacy & Policy) --}}
            <div class="flex items-center gap-6 mt-4 md:mt-0 flex-wrap justify-center">
                @if(isset($footerLinks['legal']) && $footerLinks['legal']->count() > 0)
                    @foreach($footerLinks['legal'] as $link)
                        <a href="{{ $link->url }}" class="text-green-200 hover:text-yellow-400 transition">{{ $link->title }}</a>
                    @endforeach
                @else
                    <a href="#" class="text-green-200 hover:text-yellow-400 transition">Terms of Service</a>
                    <a href="#" class="text-green-200 hover:text-yellow-400 transition">Privacy & Policy</a>
                @endif
            </div>

            {{-- Copyright --}}
            <p class="text-green-200 mt-4 md:mt-0 text-sm">
                {{ $footerSettings->copyright_text ?? 'All Rights Reserved by primehub PrimeHub Web | 2025' }}
            </p>

        </div>
    </div>
</footer>