{{-- resources/views/emails/welcome-back.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Back to {{ config('app.name') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            margin: 0;
            padding: 40px 20px;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '👋';
            position: absolute;
            font-size: 150px;
            opacity: 0.1;
            right: -30px;
            top: -30px;
        }
        
        .logo {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        h1 {
            color: white;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .welcome-badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            padding: 8px 20px;
            border-radius: 50px;
            color: white;
            font-size: 14px;
            font-weight: 500;
            margin-top: 15px;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 15px;
        }
        
        .greeting span {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .stats {
            display: flex;
            justify-content: space-around;
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            padding: 20px;
            border-radius: 16px;
            margin: 25px 0;
            text-align: center;
        }
        
        .stat-item {
            flex: 1;
        }
        
        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #92400e;
        }
        
        .stat-label {
            font-size: 12px;
            color: #92400e;
            margin-top: 5px;
        }
        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 25px 0;
        }
        
        .product-card {
            background: #f9fafb;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-3px);
        }
        
        .product-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }
        
        .product-name {
            font-weight: 600;
            color: #1f2937;
            font-size: 14px;
        }
        
        .product-price {
            color: #f5576c;
            font-weight: 600;
            margin-top: 5px;
        }
        
        .coupon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 25px;
            border-radius: 16px;
            text-align: center;
            margin: 25px 0;
            color: white;
        }
        
        .coupon-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .coupon-code {
            background: rgba(255,255,255,0.2);
            padding: 10px;
            border-radius: 50px;
            font-family: monospace;
            font-size: 18px;
            letter-spacing: 2px;
            margin-top: 10px;
        }
        
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 14px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            margin: 20px 0;
            transition: transform 0.3s ease;
            box-shadow: 0 10px 20px -5px rgba(240, 147, 251, 0.4);
        }
        
        .cta-button:hover {
            transform: translateY(-2px);
        }
        
        .footer {
            background: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        
        @media (max-width: 480px) {
            .stats {
                flex-direction: column;
                gap: 15px;
            }
            
            .product-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">🎉</div>
            <h1>Welcome Back!</h1>
            <div class="welcome-badge">✨ We Missed You! ✨</div>
        </div>
        
        <div class="content">
            <div class="greeting">
                Hey <span>{{ $user->name }}</span>! 👋
            </div>
            
            <div class="message">
                It's been a while since we last saw you. We've missed you! Great news - we've got some exciting updates and exclusive offers waiting just for you.
            </div>
            
            <div class="stats">
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['points'] ?? '500' }}</div>
                    <div class="stat-label">Reward Points</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['offers'] ?? '5' }}</div>
                    <div class="stat-label">New Offers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['products'] ?? '100+' }}</div>
                    <div class="stat-label">New Products</div>
                </div>
            </div>
            
            <div class="message">
                <strong>🔥 What's new at {{ config('app.name') }}:</strong>
            </div>
            
            <div class="product-grid">
                <div class="product-card">
                    <div class="product-icon">👕</div>
                    <div class="product-name">Summer Collection</div>
                    <div class="product-price">Up to 40% OFF</div>
                </div>
                <div class="product-card">
                    <div class="product-icon">📱</div>
                    <div class="product-name">Electronics</div>
                    <div class="product-price">New Arrivals</div>
                </div>
                <div class="product-card">
                    <div class="product-icon">👟</div>
                    <div class="product-name">Footwear</div>
                    <div class="product-price">Buy 1 Get 1</div>
                </div>
                <div class="product-card">
                    <div class="product-icon">💄</div>
                    <div class="product-name">Beauty</div>
                    <div class="product-price">30% OFF</div>
                </div>
            </div>
            
            <div class="coupon">
                <div class="coupon-title">🎁 Exclusive Welcome-Back Gift! 🎁</div>
                <div>Use this coupon on your next purchase</div>
                <div class="coupon-code">{{ $coupon ?? 'WELCOMEBACK25' }}</div>
                <div style="font-size: 12px; margin-top: 10px;">Valid for 7 days only!</div>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ url('/admin') }}" class="cta-button">
                    Shop Now & Save →
                </a>
            </div>
        </div>
        
        <div class="footer">
            <div class="footer-text">
                <strong>{{ config('app.name') }}</strong><br>
                We're here to serve you better!<br>
                <br>
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>