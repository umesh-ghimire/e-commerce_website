<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">My Addresses</h1>
                <button onclick="document.getElementById('addAddressModal').classList.remove('hidden')" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                    + Add New Address
                </button>
            </div>

            @if($addresses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($addresses as $address)
                    <div class="bg-white rounded-2xl shadow-sm p-6 relative">
                        @if($address->is_default)
                            <span class="absolute top-4 right-4 px-2 py-1 bg-emerald-100 text-emerald-700 text-xs rounded-full">Default</span>
                        @endif
                        <p class="font-semibold text-gray-900">{{ $address->address_line1 }}</p>
                        @if($address->address_line2)<p class="text-gray-600">{{ $address->address_line2 }}</p>@endif
                        <p class="text-gray-600">{{ $address->city }}, {{ $address->state }} - {{ $address->postal_code }}</p>
                        <p class="text-gray-600">{{ $address->country }}</p>
                        <div class="flex gap-3 mt-4 pt-4 border-t border-gray-100">
                            @if(!$address->is_default)
                                <form action="{{ route('profile.address.default', $address->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:text-blue-700 text-sm">Set as Default</button>
                                </form>
                            @endif
                            <form action="{{ route('profile.address.delete', $address->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 text-sm" onclick="return confirm('Delete this address?')">Delete</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center">
                    <p class="text-gray-500">No addresses saved</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Address Modal -->
    <div id="addAddressModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4">
            <h2 class="text-xl font-bold mb-4">Add New Address</h2>
            <form action="{{ route('profile.address.store') }}" method="POST">
                @csrf
                <div class="space-y-3">
                    <input type="text" name="address_line1" placeholder="Address Line 1" required class="w-full px-4 py-2 border rounded-lg">
                    <input type="text" name="address_line2" placeholder="Address Line 2" class="w-full px-4 py-2 border rounded-lg">
                    <div class="grid grid-cols-2 gap-3">
                        <input type="text" name="city" placeholder="City" required class="w-full px-4 py-2 border rounded-lg">
                        <input type="text" name="state" placeholder="State" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="text" name="postal_code" placeholder="Postal Code" required class="w-full px-4 py-2 border rounded-lg">
                        <input type="text" name="country" placeholder="Country" required class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_default" value="1"> Set as default address
                    </label>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="document.getElementById('addAddressModal').classList.add('hidden')" class="flex-1 px-4 py-2 border rounded-lg">Cancel</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-emerald-600 text-white rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>