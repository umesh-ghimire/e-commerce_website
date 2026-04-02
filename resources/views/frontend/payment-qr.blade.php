<x-frontend-layout>
    @php
        $paymentMethod = \App\Models\PaymentMethod::where('slug', $wallet)->first();
    @endphp
    
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <div class="mb-6">
                        <div class="mx-auto w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center">
                            @if($paymentMethod && $paymentMethod->logo)
                                <img src="{{ asset('storage/' . $paymentMethod->logo) }}" 
                                     alt="{{ $paymentMethod->name }}" 
                                     class="w-12 h-12 object-contain">
                            @else
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                            @endif
                        </div>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">
                        Pay with {{ $paymentMethod->name ?? ucfirst($wallet) }}
                    </h2>
                    
                    <p class="text-gray-600 mb-6">
                        Order #: <strong>{{ $order->order_number }}</strong><br>
                        Amount: <strong class="text-green-700">₹{{ number_format($order->total, 2) }}</strong>
                    </p>
                    
                    @if($paymentMethod && $paymentMethod->instructions)
                        <div class="bg-blue-50 rounded-lg p-4 mb-6 text-left">
                            <h3 class="font-semibold text-blue-900 mb-2">Payment Instructions:</h3>
                            <p class="text-sm text-blue-800">{{ $paymentMethod->instructions }}</p>
                            @if($paymentMethod->merchant_id)
                                <p class="text-sm text-blue-800 mt-2">
                                    <strong>Merchant ID:</strong> {{ $paymentMethod->merchant_id }}
                                </p>
                            @endif
                        </div>
                    @endif
                    
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <div class="text-center">
                            @if($paymentMethod && $paymentMethod->qr_code)
                                <img src="{{ asset('storage/' . $paymentMethod->qr_code) }}" 
                                     alt="{{ $paymentMethod->name }} QR Code"
                                     class="w-48 h-48 mx-auto object-contain mb-4">
                            @else
                                <div class="w-48 h-48 mx-auto bg-white rounded-lg shadow-md flex items-center justify-center mb-4">
                                    <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <p class="text-sm text-gray-600">Scan QR code with {{ $paymentMethod->name ?? ucfirst($wallet) }} app to pay</p>
                        </div>
                    </div>
                    
                    <form action="{{ route('frontend.payment.proof.store', $order) }}" method="POST" enctype="multipart/form-data" class="mt-6">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Payment Screenshot</label>
                            <input type="file" name="payment_proof" accept="image/*" required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <p class="text-xs text-gray-500 mt-1">Upload screenshot of payment confirmation</p>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Notes (Optional)</label>
                            <textarea name="payment_notes" rows="2"
                                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                                      placeholder="Transaction ID or any notes"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-green-800 to-emerald-700 text-white py-3 rounded-lg font-semibold hover:from-green-900 hover:to-emerald-800 transition">
                            Submit Payment Proof
                        </button>
                    </form>
                    
                    <p class="text-sm text-gray-500 mt-4">
                        After payment, please upload the screenshot. Our team will verify and confirm your order.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>