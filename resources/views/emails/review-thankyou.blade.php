<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Review!</title>
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
        }
        .review-card {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-radius: 16px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
        }
        .stars {
            color: #fbbf24;
            font-size: 24px;
            margin-bottom: 15px;
        }
        .review-text {
            font-style: italic;
            color: #92400e;
            margin: 15px 0;
        }
        .product-info {
            display: flex;
            gap: 15px;
            background: #f9fafb;
            border-radius: 12px;
            padding: 15px;
            margin: 20px 0;
        }
        .product-info img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .product-name {
            font-weight: 600;
            color: #1f2937;
        }
        .btn-primary {
            display: inline-block;
            background: linear-gradient(135deg, #065f46 0%, #064e3b 100%);
            color: white;
            padding: 14px 30px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            margin: 10px;
        }
        .coupon-code {
            display: inline-block;
            background: #fef3c7;
            padding: 12px 24px;
            border-radius: 50px;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #065f46;
            margin: 15px 0;
            border: 2px dashed #065f46;
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
            <h1>🌟 Thank You for Your Review! 🌟</h1>
        </div>
        
        <div class="email-body">
            <div class="review-card">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $review->rating)
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </div>
                <div class="review-text">
                    "{{ Str::limit($review->comment, 100) }}"
                </div>
                <div class="product-info">
                    @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                    @endif
                    <div>
                        <div class="product-name">{{ $product->name }}</div>
                        <div style="color: #6b7280; font-size: 14px;">Reviewed by {{ $user->name }}</div>
                    </div>
                </div>
            </div>
            
            <h3 style="text-align: center;">You're Awesome! 🎉</h3>
            <p style="text-align: center; color: #6b7280;">Your review helps other customers make better decisions. Thank you for being part of our community!</p>
            
            <div style="text-align: center;">
                <div class="coupon-code">
                    🎁 REVIEW{{ rand(100, 999) }}
                </div>
                <p style="font-size: 12px; margin: 10px 0;">Use this code for 15% off your next purchase!</p>
                <a href="{{ route('frontend.products.show', $product->slug) }}" class="btn-primary">
                    Shop More Like This →
                </a>
                <a href="{{ route('frontend.products.index') }}" class="btn-primary" style="background: white; color: #065f46; border: 2px solid #065f46;">
                    Explore New Arrivals
                </a>
            </div>
        </div>
        
        <div class="email-footer">
            <div class="footer-text">
                <p>Your review will be published after admin approval. We'll notify you once it's live!</p>
                <p>&copy; {{ date('Y') }} PrimeHub. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>