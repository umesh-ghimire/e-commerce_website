<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #065f46;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #065f46;
            margin: 0;
        }
        .order-details {
            background: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            background: #065f46;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #6b7280;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px 0;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmation</h1>
            <p>Thank you for your order!</p>
        </div>
        
        <p>Dear Customer,</p>
        <p>Your order has been placed successfully!</p>
        
        <div class="order-details">
            <h3>Order Details</h3>
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y, g:i a') }}</p>
            <p><strong>Total Amount:</strong> ₹{{ number_format($order->total, 2) }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
        </div>
        
        <h3>Order Items</h3>
        <table>
            <thead>
                <tr><th>Product</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right"><strong>Subtotal:</strong></td>
                    <td class="text-right">₹{{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right"><strong>Tax:</strong></td>
                    <td class="text-right">₹{{ number_format($order->tax, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right"><strong>Shipping:</strong></td>
                    <td class="text-right">₹{{ number_format($order->shipping, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right"><strong>Total:</strong></td>
                    <td class="text-right"><strong>₹{{ number_format($order->total, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
        
        <div style="text-align: center;">
            <a href="{{ url('/products') }}" class="btn">Continue Shopping</a>
        </div>
        
        <div class="footer">
            <p>Need help? Contact us at support@primehub.com</p>
            <p>&copy; {{ date('Y') }} PrimeHub. All rights reserved.</p>
        </div>
    </div>
</body>
</html>