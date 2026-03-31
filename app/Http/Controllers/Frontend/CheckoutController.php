<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);

        // Support "Buy Now" from product page
        if ($request->has('product') && $request->has('quantity')) {
            $product = Product::find($request->product);
            if ($product) {
                $cart = [
                    $product->id => [
                        'name'      => $product->name,
                        'price'     => $product->price,
                        'image'     => $product->image ?? null,
                        'quantity'  => (int)$request->quantity,
                    ]
                ];
                session()->put('cart', $cart);
            }
        }

        if (empty($cart)) {
            return redirect()->route('cart')
                             ->with('error', 'Your cart is empty!');
        }

        return view('frontend.checkout', compact('cart'));
    }

public function store(Request $request)
{
    $request->validate([
        'name'              => 'required|string|max:255',
        'email'             => 'required|email',
        'phone'             => 'required|string|max:20',
        'shipping_address'  => 'required|string',
        'payment_method'    => 'required|in:cash_on_delivery,digital_wallet',
        'wallet_type'       => 'required_if:payment_method,digital_wallet|in:esewa,khalti',
        'notes'             => 'nullable|string',
    ]);

    $cart = session()->get('cart', []);

    if (empty($cart) && $request->has('product')) {
        $product = Product::find($request->product);
        if ($product) {
            $cart = [
                $product->id => [
                    'name'     => $product->name,
                    'price'    => $product->price,
                    'quantity' => (int) ($request->quantity ?? 1),
                ]
            ];
        }
    }

    if (empty($cart)) {
        return redirect()->route('cart')->with('error', 'Your cart is empty!');
    }

    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    $tax      = round($subtotal * 0.05, 2);
    $shipping = 100.00;
    $total    = $subtotal + $tax + $shipping;

    $paymentMethod = $request->payment_method === 'digital_wallet' 
                     ? $request->wallet_type 
                     : 'cash_on_delivery';

    // Create Order
    $order = Order::create([
        'order_number'     => 'ORD-' . strtoupper(uniqid()),
        'user_id'          => auth()->id(),
        'status'           => 'pending',
        'subtotal'         => $subtotal,
        'tax'              => $tax,
        'shipping'         => $shipping,
        'total'            => $total,
        'shipping_address' => $request->shipping_address,
        'billing_address'  => $request->shipping_address,
        'payment_method'   => $paymentMethod,
        'payment_status'   => 'pending',                    // ← Fixed for now
        'notes'            => $request->notes,
    ]);

    // Save Order Items
    foreach ($cart as $productId => $item) {
        OrderItem::create([
            'order_id'      => $order->id,
            'product_id'    => $productId,
            'product_name'  => $item['name'],
            'price'         => $item['price'],
            'quantity'      => $item['quantity'],
            'total'         => $item['price'] * $item['quantity'],
            'item_status'   => 'pending',
        ]);
    }

    session()->forget('cart');

    // Redirect to QR Code for eSewa / Khalti
    if ($request->payment_method === 'digital_wallet' && in_array($request->wallet_type, ['esewa', 'khalti'])) {
        return redirect()->route('frontend.payment.qr', [
            'order'  => $order->id,
            'wallet' => $request->wallet_type
        ]);
    }

    // Cash on Delivery
    return redirect()->route('frontend.order.success', $order->id)
                     ->with('success', 'Your order has been placed successfully!');
}


// Show QR Code Page
public function showQr(Order $order, $wallet)
{
    if (!in_array($wallet, ['esewa', 'khalti'])) {
        abort(404);
    }

    return view('frontend.payment-qr', compact('order', 'wallet'));
}

// Store Payment Proof
public function storePaymentProof(Request $request, Order $order)
{
    $request->validate([
        'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
        'payment_notes' => 'nullable|string|max:500',
    ]);

    if ($request->hasFile('payment_proof')) {
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');
        
        $order->update([
            'payment_proof'       => $path,
            'payment_notes'       => $request->payment_notes,
            'payment_status'      => 'pending',     // Waiting for admin verification
            'payment_verified_at' => null,
        ]);

        return redirect()->route('frontend.order.success', $order->id)
                         ->with('success', 'Payment proof submitted successfully! We will verify it shortly.');
    }

    return back()->with('error', 'Please upload payment proof.');
}
    public function success(Order $order)
    {
        return view('frontend.order-success', compact('order'));
    }
}