<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back!</title>
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
            margin: 0;
        }
        .email-body {
            padding: 40px 30px;
            text-align: center;
        }
        .discount-badge {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 100px;
            padding: 30px;
            margin: 30px 0;
        }
        .discount-percentage {
            font-size: 48px;
            font-weight: bold;
            color: #065f46;
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
        .email-footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer-text {
            color: #6b7280;
            font-size: 12px;
        }
    </style>
</head>
<body style="margin: 0; padding: 20px; background-color: #f5f5f5;">
    <div class="email-container">
        <div class="email-header">
            <h1>👋 Welcome Back, {{ $user->name }}!</h1>
        </div>
        
        <div class="email-body">
            <p style="font-size: 18px; color: #1f2937;">We've missed you at PrimeHub!</p>
            <p>As a token of our appreciation, here's a special gift for your next purchase:</p>
            
            <div class="discount-badge">
                <div class="discount-percentage">{{ $discount }}% OFF</div>
                <p>on your next order</p>
                <div class="coupon-code">
                    🎁 {{ $couponCode }}
                </div>
                <p style="font-size: 12px; margin-top: 10px;">Valid for 30 days. Minimum purchase ₹500</p>
            </div>
            
            <p>Discover what's new at PrimeHub!</p>
            <a href="{{ url('/products') }}" class="btn-primary">
                Shop Now & Save →
            </a>
            
            <div style="margin-top: 30px; padding: 20px; background: #f9fafb; border-radius: 12px;">
                <p style="color: #6b7280; font-size: 14px;">✨ Featured Collections</p>
                <div style="display: flex; justify-content: center; gap: 20px; margin-top: 15px;">
                    <a href="{{ url('/products?sort=newest') }}" style="color: #065f46; text-decoration: none;">New Arrivals</a>
                    <a href="{{ url('/products?is_best_seller=1') }}" style="color: #065f46; text-decoration: none;">Best Sellers</a>
                    <a href="{{ url('/products?is_trending=1') }}" style="color: #065f46; text-decoration: none;">Trending Now</a>
                </div>
            </div>
        </div>
        
        <div class="email-footer">
            <div class="footer-text">
                <p>Need help? Contact us at support@primehub.com</p>
                <p>&copy; {{ date('Y') }} PrimeHub. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>