<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - QuickMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .success-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .success-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .success-header {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        
        .success-icon {
            font-size: 5rem;
            margin-bottom: 20px;
            animation: bounce 1s infinite alternate;
        }
        
        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-10px); }
        }
        
        .order-details {
            background: white;
            padding: 30px;
        }
        
        .detail-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .order-items {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .item-row {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .item-row:last-child {
            border-bottom: none;
        }
        
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
        }
        
        .btn-continue {
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        
        .btn-continue:hover {
            transform: translateY(-2px);
            color: white;
        }
        
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #0d6efd;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -24px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: white;
            border: 3px solid #0d6efd;
        }
        
        .timeline-item.completed::before {
            background: #0d6efd;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">
                <i class="fas fa-shopping-cart"></i> QuickMart
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/products">
                    <i class="fas fa-store me-1"></i> Products
                </a>
                <a class="nav-link" href="/home">
                    <i class="fas fa-user-circle me-1"></i> My Account
                </a>
            </div>
        </div>
    </nav>

    <!-- Success Content -->
    <div class="success-container">
        <div class="success-card">
            <!-- Success Header -->
            <div class="success-header">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h1 class="display-5 fw-bold mb-3">Order Confirmed!</h1>
                <p class="lead mb-0">Thank you for your purchase, {{ Auth::user()->name }}!</p>
                <p class="mb-0">Your order has been successfully placed.</p>
            </div>

            <!-- Success Message -->
            <div class="order-details">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Order Summary -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-receipt me-2"></i>Order Details
                            </h5>
                            <div class="mb-2">
                                <span class="text-muted">Order ID:</span>
                                <strong class="ms-2">#{{ $order->id }}</strong>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted">Order Date:</span>
                                <strong class="ms-2">{{ $order->created_at->format('F d, Y \a\t h:i A') }}</strong>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted">Status:</span>
                                <span class="status-badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'processing' ? 'warning' : 'secondary') }} ms-2">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted">Payment Method:</span>
                                <strong class="ms-2">{{ $order->payment_method }}</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-truck me-2"></i>Shipping Details
                            </h5>
                            <div class="mb-2">
                                <span class="text-muted">Shipping To:</span>
                                <strong class="ms-2">{{ Auth::user()->name }}</strong>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted">Address:</span>
                                <div class="ms-2">
                                    {{ $order->shipping_address }}
                                </div>
                            </div>
                            <div class="mb-2">
                                <span class="text-muted">Email:</span>
                                <strong class="ms-2">{{ Auth::user()->email }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Timeline -->
                <div class="detail-box mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-history me-2"></i>Order Timeline
                    </h5>
                    <div class="timeline">
                        <div class="timeline-item completed">
                            <h6 class="fw-bold">Order Placed</h6>
                            <p class="text-muted small mb-0">Your order has been received</p>
                            <small class="text-muted">{{ $order->created_at->format('M d, h:i A') }}</small>
                        </div>
                        <div class="timeline-item {{ $order->status == 'processing' || $order->status == 'completed' ? 'completed' : '' }}">
                            <h6 class="fw-bold">Order Processing</h6>
                            <p class="text-muted small mb-0">We're preparing your order</p>
                            @if($order->status == 'processing' || $order->status == 'completed')
                            <small class="text-muted">In progress</small>
                            @endif
                        </div>
                        <div class="timeline-item {{ $order->status == 'completed' ? 'completed' : '' }}">
                            <h6 class="fw-bold">Shipped</h6>
                            <p class="text-muted small mb-0">Your order is on the way</p>
                        </div>
                        <div class="timeline-item">
                            <h6 class="fw-bold">Delivered</h6>
                            <p class="text-muted small mb-0">Order delivered to your address</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="order-items mb-4">
                    <div class="p-3 bg-light">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-boxes me-2"></i>Order Items
                        </h5>
                    </div>
                    
                    @foreach($order->orderItems as $item)
                    <div class="item-row">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded p-2 me-3">
                                        <i class="fas fa-box fa-2x text-muted"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $item->product->name ?? 'Product' }}</h6>
                                        <small class="text-muted">SKU: {{ $item->product_id ?? 'N/A' }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <span class="text-muted">Quantity:</span>
                                <strong class="ms-1">{{ $item->quantity }}</strong>
                            </div>
                            <div class="col-md-3 text-end">
                                <span class="text-muted">Price:</span>
                                <strong class="ms-1">Rs. {{ number_format($item->total, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    <!-- Order Total -->
                    <div class="p-3 bg-light">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="mb-0 fw-bold">Order Total</h6>
                            </div>
                            <div class="col-md-4 text-end">
                                <h4 class="mb-0 text-primary">Rs. {{ number_format($order->total_amount, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="text-center mt-4">
                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                        <a href="/products" class="btn btn-continue">
                            <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                        <a href="/home" class="btn btn-outline-primary">
                            <i class="fas fa-user-circle me-2"></i>View My Orders
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-secondary">
                            <i class="fas fa-print me-2"></i>Print Receipt
                        </button>
                    </div>
                    
                    <!-- Order Help -->
                    <div class="mt-4">
                        <p class="text-muted small">
                            <i class="fas fa-question-circle me-2"></i>
                            Need help with your order? 
                            <a href="#" class="text-decoration-none">Contact our support team</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2026 QuickMart - Laravel E-commerce Demo</p>
            <p class="text-muted small">Thank you for shopping with us!</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide success alert after 5 seconds
        setTimeout(() => {
            const alert = document.querySelector('.alert-success');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
        
        // Print receipt with better formatting
        window.printReceipt = function() {
            const printContent = `
                <html>
                <head>
                    <title>Receipt - Order #{{ $order->id }}</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        .receipt-header { text-align: center; margin-bottom: 20px; }
                        .receipt-details { margin-bottom: 20px; }
                        .receipt-items { width: 100%; border-collapse: collapse; }
                        .receipt-items th, .receipt-items td { padding: 8px; border-bottom: 1px solid #ddd; }
                        .receipt-total { text-align: right; margin-top: 20px; font-size: 18px; font-weight: bold; }
                    </style>
                </head>
                <body>
                    <div class="receipt-header">
                        <h2>QuickMart</h2>
                        <p>Order Receipt</p>
                    </div>
                    <div class="receipt-details">
                        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
                        <p><strong>Customer:</strong> {{ Auth::user()->name }}</p>
                    </div>
                    <table class="receipt-items">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name ?? 'Product' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rs. {{ number_format($item->price, 2) }}</td>
                                <td>Rs. {{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="receipt-total">
                        <p>Total: Rs. {{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </body>
                </html>
            `;
            
            const printWindow = window.open('', '_blank');
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        };
    });
    </script>
</body>
</html>