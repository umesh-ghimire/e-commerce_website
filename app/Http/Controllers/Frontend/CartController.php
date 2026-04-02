<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Show Cart Page
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('frontend.cart', compact('cart'));
    }

    // Add to Cart (AJAX)
    public function add(Request $request)
{
    $product = Product::find($request->product_id);
    
    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found']);
    }
    
    $cart = session()->get('cart', []);
    
    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity'] += $request->quantity ?? 1;
    } else {
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,  // Add this line
            'quantity' => $request->quantity ?? 1,
        ];
    }
    
    session()->put('cart', $cart);
    
    return response()->json([
        'success' => true,
        'message' => 'Product added to cart',
        'cart_count' => count($cart)
    ]);
}

    // Update Quantity (AJAX)
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Cart updated'
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    // Remove Item (AJAX)
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart'
            ]);
        }

        return response()->json(['success' => false], 404);
    }
}