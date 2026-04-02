<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'payment_method'    => 'required|in:cash_on_delivery,esewa,khalti',
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

        // Determine payment method
        $paymentMethod = $request->payment_method;

        DB::beginTransaction();

        try {
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
                'payment_status'   => 'pending',
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

            // Clear cart
            session()->forget('cart');

            DB::commit();

            // ✅ ONLY send order confirmation email (NO welcome email after purchase)
            try {
                Mail::to($request->email)->send(new OrderConfirmationMail($order));
                Log::info('Order confirmation email sent to: ' . $request->email . ' for order: ' . $order->order_number);
            } catch (\Exception $e) {
                Log::error('Failed to send order confirmation email: ' . $e->getMessage());
            }

            // Redirect based on payment method
            if ($paymentMethod === 'cash_on_delivery') {
                return redirect()->route('frontend.order.success', $order)
                    ->with('success', 'Order placed successfully! You will pay cash on delivery.');
            }

            // Redirect to QR Code for eSewa / Khalti
            if ($paymentMethod === 'esewa' || $paymentMethod === 'khalti') {
                return redirect()->route('frontend.payment.qr', [
                    'order'  => $order->id,
                    'wallet' => $paymentMethod
                ]);
            }

            return redirect()->route('frontend.order.success', $order)
                ->with('success', 'Order placed successfully! Check your email for confirmation.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function showQr(Order $order, $wallet)
    {
        if (!in_array($wallet, ['esewa', 'khalti'])) {
            abort(404);
        }

        return view('frontend.payment-qr', compact('order', 'wallet'));
    }

    public function storePaymentProof(Request $request, Order $order)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'payment_notes' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            
            $order->update([
                'payment_proof'       => $path,
                'payment_notes'       => $request->payment_notes,
                'payment_status'      => 'pending',
                'payment_verified_at' => null,
            ]);

            return redirect()->route('frontend.order.success', $order->id)
                             ->with('success', 'Payment proof submitted successfully! We will verify it shortly.');
        }

        return back()->with('error', 'Please upload payment proof.');
    }
    
    public function success(Order $order)
    {
        if (auth()->check() && $order->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('frontend.order-success', compact('order'));
    }
}