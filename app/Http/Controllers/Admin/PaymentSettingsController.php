<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentSettingsController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::ordered()->get();
        return view('admin.payment-settings', compact('paymentMethods'));
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->orders as $order) {
            PaymentMethod::where('id', $order['id'])->update(['order' => $order['position']]);
        }
        return response()->json(['success' => true]);
    }
}