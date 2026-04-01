<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #065f46 0%, #064e3b 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .email-header h1 {
            color: #ffffff;
            font-size: 28px;
            margin: 0 0 10px 0;
        }
        .email-header p {
            color: #d1fae5;
            margin: 0;
        }
        .email-body {
            padding: 40px 30px;
        }
        .order-info {
            background-color: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .order-number {
            font-size: 24px;
            font-weight: bold;
            color: #065f46;
            margin-bottom: 10px;
        }
        .order-date {
            color: #6b7280;
            font-size: 14px;
        }
        .order-items {
            margin: 30px 0;
        }
        .order-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .order-item img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
        }
        .item-details {
            flex: 1;
        }
        .item-name {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }
        .item-price {
            color: #6b7280;
            font-size: 14px;
        }
        .order-summary {
            background-color: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin-top: 30px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }
        .summary-total {
            font-size: 18px;
            font-weight: bold;
            color: #065f46;
            border-top: 2px solid #e5e7eb;
            margin-top: 10px;
            padding-top: 15px;
        }
        .btn-primary {
            display: inline-block;
            background: linear-gradient(135deg, #065f46 0%, #064e3b 100%);
            color: white;
            padding: 14px 30px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            margin-top: 20px;
        }
        .btn-secondary {
            display: inline-block;
            background: white;
            color: #065f46;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            border: 2px solid #065f46;
            margin-top: 10px;
        }
        .email-footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .social-links {
            margin-bottom: 20px;
        }
        .social-links a {
            margin: 0 10px;
            color: #065f46;
            text-decoration: none;
        }
        .footer-text {
            color: #6b7280;
            font-size: 12px;
        }
        .thankyou-message {
            text-align: center;
            padding: 30px 0;
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 12px;
            margin-bottom: 30px;
        }
        .thankyou-message h3 {
            color: #92400e;
            margin-bottom: 10px;
        }
        .coupon-code {
            display: inline-block;
            background: #ffffff;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #065f46;
            margin: 15px 0;
            border: 2px dashed #065f46;
        }
    </style>
</head>
<body style="margin: 0; padding: 20px; background-color: #f5f5f5;">
    <div class="email-container">
        <div class="email-header">
            <h1>🎉 Thank You for Your Order! 🎉</h1>
            <p>Your order has been confirmed successfully</p>
        </div>
        
        <div class="email-body">
            <div class="thankyou-message">
                <h3>Hey {{ $order->user->name }}! 👋</h3>
                <p>We're thrilled you chose to shop with us!</p>
                <p>Your order is being processed and will be shipped soon.</p>
                <div class="coupon-code">
                    🎁 WELCOME{{ rand(100, 999) }}
                </div>
                <p style="font-size: 12px; margin-top: 10px;">Use this coupon for 10% off your next purchase!</p>
            </div>
            
            <div class="order-info">
                <div class="order-number">Order #{{ $order->order_number }}</div>
                <div class="order-date">Placed on {{ $order->created_at->format('F j, Y, g:i a') }}</div>
            </div>
            
            <h3>Order Summary</h3>
            <div class="order-items">
                @foreach($order->items as $item)
                <div class="order-item">
                    @if($item->product && $item->product->image)
                    <img src="{{ asset('storage/products/' . $item->product->image) }}" alt="{{ $item->product_name }}">
                    @else
                    <div style="width: 70px; height: 70px; background: #e5e7eb; border-radius: 8px;"></div>
                    @endif
                    <div class="item-details">
                        <div class="item-name">{{ $item->product_name }}</div>
                        <div class="item-price">Qty: {{ $item->quantity }} × ₹{{ number_format($item->price, 0) }}</div>
                    </div>
                    <div style="font-weight: 600;">₹{{ number_format($item->total, 0) }}</div>
                </div>
                @endforeach
            </div>
            
            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>₹{{ number_format($order->subtotal, 0) }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>₹{{ number_format($order->shipping, 0) }}</span>
                </div>
                <div class="summary-row">
                    <span>Tax</span>
                    <span>₹{{ number_format($order->tax, 0) }}</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>₹{{ number_format($order->total, 0) }}</span>
                </div>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ route('frontend.products.index') }}" class="btn-primary">
                    Continue Shopping →
                </a>
                <br>
                <a href="{{ route('frontend.order.track', $order) }}" class="btn-secondary">
                    Track Your Order
                </a>
            </div>
        </div>
        
        <div class="email-footer">
            <div class="social-links">
                <a href="#">📘 Facebook</a>
                <a href="#">📸 Instagram</a>
                <a href="#">🐦 Twitter</a>
                <a href="#">▶️ YouTube</a>
            </div>
            <div class="footer-text">
                <p>Need help? Contact us at support@primehub.com or call +977 9800000000</p>
                <p>&copy; {{ date('Y') }} PrimeHub. All rights reserved.</p>
                <p>This email was sent to {{ $order->user->email }}</p>
            </div>
        </div>
    </div>
</body>
</html>