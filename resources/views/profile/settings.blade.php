<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Account Settings</h1>

            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Notification Preferences</h2>
                <form action="{{ route('profile.preferences') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <label class="flex items-center justify-between cursor-pointer">
                        <span>Email Newsletter</span>
                        <input type="checkbox" name="email_newsletter" value="1" {{ ($user->preferences['email_newsletter'] ?? true) ? 'checked' : '' }} class="toggle">
                    </label>
                    <label class="flex items-center justify-between cursor-pointer">
                        <span>Special Offers</span>
                        <input type="checkbox" name="email_offers" value="1" {{ ($user->preferences['email_offers'] ?? true) ? 'checked' : '' }} class="toggle">
                    </label>
                    <label class="flex items-center justify-between cursor-pointer">
                        <span>Order Updates</span>
                        <input type="checkbox" name="email_order_updates" value="1" {{ ($user->preferences['email_order_updates'] ?? true) ? 'checked' : '' }} class="toggle">
                    </label>
                    <button type="submit" class="mt-4 px-6 py-2 bg-emerald-600 text-white rounded-lg">Save Preferences</button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 mt-6 border border-red-200">
                <h2 class="text-lg font-semibold text-red-600 mb-4">Delete Account</h2>
                <p class="text-gray-600 text-sm mb-4">This action cannot be undone.</p>
                <button onclick="document.getElementById('deleteModal').classList.remove('hidden')" class="px-4 py-2 bg-red-600 text-white rounded-lg">Delete Account</button>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4">
            <h2 class="text-xl font-bold text-red-600 mb-4">Delete Account</h2>
            <form action="{{ route('profile.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <textarea name="reason" rows="3" class="w-full border rounded-lg p-3 mb-3" placeholder="Why are you leaving?"></textarea>
                <input type="password" name="password" placeholder="Enter password to confirm" required class="w-full border rounded-lg p-3 mb-4">
                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')" class="flex-1 px-4 py-2 border rounded-lg">Cancel</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .toggle {
            width: 44px;
            height: 24px;
            appearance: none;
            background: #ddd;
            border-radius: 24px;
            position: relative;
            cursor: pointer;
            transition: 0.3s;
        }
        .toggle:checked {
            background: #10b981;
        }
        .toggle::before {
            content: '';
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: 0.3s;
        }
        .toggle:checked::before {
            left: 22px;
        }
    </style>
</x-app-layout>