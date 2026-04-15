<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-emerald-50/30 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="mb-8">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl p-6 md:p-8 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-24 -mb-24"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="flex items-center gap-4">
                            @if(auth()->user()->avatar)
                                <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar" 
                                     class="w-16 h-16 rounded-full border-2 border-white object-cover">
                            @else
                                <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-2xl font-bold">
                                    {{ substr(auth()->user()->name, 0, 2) }}
                                </div>
                            @endif
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold">Account Settings</h1>
                                <p class="text-emerald-100">Manage your profile and preferences</p>
                            </div>
                        </div>
                        <a href="{{ route('profile.dashboard') }}" 
                           class="mt-4 md:mt-0 inline-flex items-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-sm rounded-xl hover:bg-white/30 transition-all">
                            ← Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm p-4 sticky top-24">
                        <nav class="space-y-1">
                            <a href="#profile" class="sidebar-link flex items-center gap-3 px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all active" data-target="profile">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span>Profile Information</span>
                            </a>
                            <a href="#address" class="sidebar-link flex items-center gap-3 px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all" data-target="address">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Address Book</span>
                                @if($addresses->count())<span class="ml-auto text-xs bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-full">{{$addresses->count()}}</span>@endif
                            </a>
                            <a href="#password" class="sidebar-link flex items-center gap-3 px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all" data-target="password">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                <span>Security</span>
                            </a>
                            <a href="#preferences" class="sidebar-link flex items-center gap-3 px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all" data-target="preferences">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Preferences</span>
                            </a>
                            <a href="#delete" class="sidebar-link flex items-center gap-3 px-4 py-3 text-red-600 rounded-xl hover:bg-red-50 transition-all" data-target="delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span>Delete Account</span>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3">

                    <!-- Profile Information -->
<div id="profile-section" class="content-section bg-white rounded-2xl shadow-sm p-6 md:p-8 mb-6">
    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
        <div class="p-2 bg-emerald-100 rounded-lg">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900">Profile Information</h2>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Avatar -->
        <div class="flex items-center gap-6 pb-6 border-b">
            <div class="relative">
                @if(auth()->user()->avatar)
                    <img id="avatar-preview" src="{{ Storage::url(auth()->user()->avatar) }}" class="w-24 h-24 rounded-full object-cover border-4 border-emerald-200">
                @else
                    <div id="avatar-preview" class="w-24 h-24 rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 flex items-center justify-center text-3xl font-bold text-white">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                @endif
                <label for="avatar" class="absolute -bottom-1 -right-1 bg-white rounded-full p-1.5 shadow cursor-pointer hover:bg-gray-50">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/></svg>
                </label>
                <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*">
            </div>
            <div>
                <p class="font-medium text-gray-700">Profile Picture</p>
                <p class="text-xs text-gray-500">JPG, PNG or GIF • Max 2MB</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required 
                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required 
                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Improved Phone Field -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
            <input type="tel" name="phone" value="{{ old('phone', $user->phone ?? '') }}" 
                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                   placeholder="+977 98XXXXXXXX">
            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" 
                    class="px-8 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl hover:scale-[1.02] transition-all shadow-md">
                Save Changes
            </button>
        </div>

        @if(session('success'))
            <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-center">
                {{ session('success') }}
            </div>
        @endif
    </form>
</div>

                    <!-- Address Book -->
                    <div id="address-section" class="content-section bg-white rounded-2xl shadow-sm p-6 md:p-8 mb-6 hidden">
                        <div class="flex justify-between items-center mb-6 pb-4 border-b">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-emerald-100 rounded-lg">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-900">Address Book</h2>
                            </div>
                            <button onclick="document.getElementById('addAddressModal').classList.remove('hidden')" 
                                    class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl flex items-center gap-2 transition">
                                + Add New Address
                            </button>
                        </div>

                        @if($addresses->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($addresses as $address)
                                <div class="border {{ $address->is_default ? 'border-emerald-500 bg-emerald-50/30' : 'border-gray-200' }} rounded-2xl p-5 hover:shadow transition-all relative">
                                    @if($address->is_default)
                                        <span class="absolute top-4 right-4 px-3 py-1 text-xs bg-emerald-100 text-emerald-700 rounded-full">Default</span>
                                    @endif
                                    <div class="flex gap-4">
                                        <div class="text-3xl text-emerald-600 mt-1">📍</div>
                                        <div>
                                            <p class="font-semibold">{{ $address->address_line1 }}</p>
                                            @if($address->address_line2)<p class="text-sm text-gray-600">{{ $address->address_line2 }}</p>@endif
                                            <p class="text-sm text-gray-600">{{ $address->city }}, {{ $address->state }} - {{ $address->postal_code }}</p>
                                            <p class="text-sm text-gray-600">{{ $address->country }}</p>
                                            
                                            <div class="mt-4 flex gap-4 text-sm">
                                                @if(!$address->is_default)
                                                <form action="{{ route('profile.address.default', $address->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-emerald-600 hover:underline">Set Default</button>
                                                </form>
                                                @endif
                                                <form action="{{ route('profile.address.delete', $address->id) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Delete this address?')" class="text-red-600 hover:underline">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-16 text-gray-500">
                                No addresses saved yet.<br>
                                <button onclick="document.getElementById('addAddressModal').classList.remove('hidden')" 
                                        class="mt-4 text-emerald-600 hover:underline">Add your first address</button>
                            </div>
                        @endif
                    </div>

                    <!-- Password Section -->
                    <div id="password-section" class="content-section bg-white rounded-2xl shadow-sm p-6 md:p-8 mb-6 hidden">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b">
                            <div class="p-2 bg-emerald-100 rounded-lg">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Update Password</h2>
                        </div>
                        <form method="POST" action="{{ route('profile.password') }}" class="space-y-6">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                <input type="password" name="current_password" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                                @error('current_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                    <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                                    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                                    <input type="password" name="password_confirmation" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl hover:scale-105 transition-all">Update Password</button>
                            </div>
                            @if(session('password_success'))
                                <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-center">{{ session('password_success') }}</div>
                            @endif
                        </form>
                    </div>

                    <!-- Preferences Section -->
                    <div id="preferences-section" class="content-section bg-white rounded-2xl shadow-sm p-6 md:p-8 mb-6 hidden">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b">
                            <div class="p-2 bg-emerald-100 rounded-lg">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Notification Preferences</h2>
                        </div>
                        <form action="{{ route('profile.preferences') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            <div class="space-y-3">
                                <label class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl cursor-pointer hover:bg-gray-100">
                                    <div>
                                        <span class="font-medium">Email Newsletter</span>
                                        <p class="text-xs text-gray-500">Monthly updates and exclusive offers</p>
                                    </div>
                                    <input type="checkbox" name="email_newsletter" value="1" {{ ($user->preferences['email_newsletter'] ?? true) ? 'checked' : '' }} class="toggle">
                                </label>
                                <label class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl cursor-pointer hover:bg-gray-100">
                                    <div>
                                        <span class="font-medium">Special Offers</span>
                                        <p class="text-xs text-gray-500">Sales and promotions</p>
                                    </div>
                                    <input type="checkbox" name="email_offers" value="1" {{ ($user->preferences['email_offers'] ?? true) ? 'checked' : '' }} class="toggle">
                                </label>
                                <label class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl cursor-pointer hover:bg-gray-100">
                                    <div>
                                        <span class="font-medium">Order Updates</span>
                                        <p class="text-xs text-gray-500">Shipping and order status</p>
                                    </div>
                                    <input type="checkbox" name="email_order_updates" value="1" {{ ($user->preferences['email_order_updates'] ?? true) ? 'checked' : '' }} class="toggle">
                                </label>
                            </div>
                            <div class="flex justify-end pt-4">
                                <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700">Save Preferences</button>
                            </div>
                        </form>
                    </div>

                    <!-- Delete Account -->
                    <div id="delete-section" class="content-section bg-white rounded-2xl shadow-sm p-6 md:p-8 hidden">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b">
                            <div class="p-2 bg-red-100 rounded-lg">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Delete Account</h2>
                        </div>
                        <div class="text-center py-8">
                            <div class="mx-auto w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">This action cannot be undone</h3>
                            <p class="text-gray-500 max-w-md mx-auto mb-8">Deleting your account will permanently remove all your data and orders.</p>
                            <form method="POST" action="{{ route('profile.delete') }}" class="max-w-md mx-auto">
                                @csrf
                                @method('DELETE')
                                <textarea name="reason" rows="3" class="w-full px-4 py-3 border rounded-2xl mb-4" placeholder="Optional: Why are you leaving?"></textarea>
                                <input type="password" name="password" placeholder="Enter your password to confirm" required 
                                       class="w-full px-4 py-3 border rounded-2xl mb-6">
                                <button type="submit" onclick="return confirm('Are you sure? This cannot be undone.')" 
                                        class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl transition">
                                    Permanently Delete Account
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Add Address Modal -->
    <div id="addAddressModal" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl p-8 max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold mb-6">Add New Address</h2>
            <form action="{{ route('profile.address.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <input type="text" name="address_line1" placeholder="Street Address *" required class="w-full px-4 py-3 border rounded-2xl focus:ring-2 focus:ring-emerald-500">
                    <input type="text" name="address_line2" placeholder="Apartment, Suite, etc." class="w-full px-4 py-3 border rounded-2xl focus:ring-2 focus:ring-emerald-500">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="city" placeholder="City *" required class="w-full px-4 py-3 border rounded-2xl focus:ring-2 focus:ring-emerald-500">
                        <input type="text" name="state" placeholder="State/Province *" required class="w-full px-4 py-3 border rounded-2xl focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="postal_code" placeholder="Postal Code *" required class="w-full px-4 py-3 border rounded-2xl focus:ring-2 focus:ring-emerald-500">
                        <input type="text" name="country" placeholder="Country *" required class="w-full px-4 py-3 border rounded-2xl focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_default" value="1"> 
                        <span class="text-sm">Set as default shipping address</span>
                    </label>
                </div>
                <div class="flex gap-3 mt-8">
                    <button type="button" onclick="document.getElementById('addAddressModal').classList.add('hidden')" 
                            class="flex-1 py-3 border rounded-2xl hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="flex-1 py-3 bg-emerald-600 text-white rounded-2xl hover:bg-emerald-700">Save Address</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar tabs
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                
                document.querySelectorAll('.content-section').forEach(section => section.classList.add('hidden'));
                document.getElementById(this.dataset.target + '-section').classList.remove('hidden');
            });
        });

        // Avatar preview
        const avatarInput = document.getElementById('avatar');
        if (avatarInput) {
            avatarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        let preview = document.getElementById('avatar-preview');
                        if (preview.tagName === 'IMG') {
                            preview.src = ev.target.result;
                        } else {
                            const img = document.createElement('img');
                            img.id = 'avatar-preview';
                            img.src = ev.target.result;
                            img.className = 'w-24 h-24 rounded-full object-cover border-4 border-emerald-200';
                            preview.parentNode.replaceChild(img, preview);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>

    <style>
        .sidebar-link.active {
            background-color: rgb(236 253 245);
            color: rgb(4 120 87);
            font-weight: 500;
        }
        .toggle {
            width: 48px; height: 24px; appearance: none; background: #ddd; border-radius: 9999px; position: relative; cursor: pointer;
        }
        .toggle:checked { background: #10b981; }
        .toggle::before {
            content: ''; position: absolute; top: 2px; left: 3px; width: 20px; height: 20px; background: white; border-radius: 50%; transition: 0.3s;
        }
        .toggle:checked::before { left: 25px; }
    </style>
</x-app-layout>