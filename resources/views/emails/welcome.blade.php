{{-- resources/views/emails/welcome.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ config('app.name') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            animation: pulse 3s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        
        .logo {
            font-size: 48px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        
        h1 {
            color: white;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
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
            position: relative;
            z-index: 1;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .message {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .features {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
        }
        
        .feature {
            text-align: center;
            padding: 20px;
            background: #f9fafb;
            border-radius: 16px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .feature-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }
        
        .feature-desc {
            font-size: 12px;
            color: #6b7280;
        }
        
        .offer-card {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            padding: 25px;
            border-radius: 16px;
            text-align: center;
            margin: 30px 0;
            position: relative;
            overflow: hidden;
        }
        
        .offer-card::before {
            content: '🎁';
            position: absolute;
            font-size: 80px;
            opacity: 0.1;
            right: -20px;
            bottom: -20px;
            transform: rotate(-15deg);
        }
        
        .offer-title {
            font-size: 20px;
            font-weight: 700;
            color: #92400e;
            margin-bottom: 10px;
        }
        
        .offer-code {
            display: inline-block;
            background: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            color: #92400e;
            margin-top: 10px;
            font-family: monospace;
            letter-spacing: 2px;
        }
        
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 14px 35px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            margin: 20px 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.4);
        }
        
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(102, 126, 234, 0.5);
        }
        
        .social-links {
            text-align: center;
            margin: 30px 0;
        }
        
        .social-icon {
            display: inline-block;
            margin: 0 10px;
            color: #9ca3af;
            text-decoration: none;
            font-size: 20px;
            transition: color 0.3s ease;
        }
        
        .social-icon:hover {
            color: #667eea;
        }
        
        .footer {
            background: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        
        .footer-text {
            color: #6b7280;
            font-size: 12px;
            line-height: 1.5;
        }
        
        @media (max-width: 480px) {
            .features {
                grid-template-columns: 1fr;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">🛍️</div>
            <h1>Welcome to {{ config('app.name') }}!</h1>
            <div class="welcome-badge">✨ New Member ✨</div>
        </div>
        
        <div class="content">
            <div class="greeting">
                Hello <span>{{ $user->name }}</span>! 👋
            </div>
            
            <div class="message">
                We're absolutely thrilled to have you join our community! Get ready for an amazing shopping experience filled with exclusive deals, premium products, and exceptional service.
            </div>
            
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">🚚</div>
                    <div class="feature-title">Free Shipping</div>
                    <div class="feature-desc">On orders over ₹999</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">🎁</div>
                    <div class="feature-title">Welcome Gift</div>
                    <div class="feature-desc">Special surprise on first order</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">⭐</div>
                    <div class="feature-title">Reward Points</div>
                    <div class="feature-desc">Earn on every purchase</div>
                </div>
                <div class="feature">
                    <div class="feature-icon">🛡️</div>
                    <div class="feature-title">Secure Shopping</div>
                    <div class="feature-desc">100% payment protection</div>
                </div>
            </div>
            
            <div class="offer-card">
                <div class="offer-title">🎉 Exclusive Welcome Offer! 🎉</div>
                <div class="message" style="margin-bottom: 10px; color: #92400e;">
                    Get 20% OFF on your first purchase
                </div>
                <div class="offer-code">WELCOME20</div>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ url('/admin') }}" class="cta-button">
                    Start Shopping Now →
                </a>
            </div>
            
            <div class="social-links">
                <a href="#" class="social-icon">📘</a>
                <a href="#" class="social-icon">📷</a>
                <a href="#" class="social-icon">🐦</a>
                <a href="#" class="social-icon">💼</a>
            </div>
        </div>
        
        <div class="footer">
            <div class="footer-text">
                <strong>{{ config('app.name') }}</strong><br>
                Your trusted shopping partner<br><br>
                Need help? Contact us at support@{{ strtolower(config('app.name')) }}.com<br>
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>