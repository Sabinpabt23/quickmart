<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - QuickMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .checkout-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        
        .checkout-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }
        
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            position: relative;
        }
        
        .step {
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .step-number {
            width: 40px;
            height: 40px;
            background: #e9ecef;
            color: #6c757d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 auto 10px;
        }
        
        .step.active .step-number {
            background: #0d6efd;
            color: white;
        }
        
        .step.completed .step-number {
            background: #198754;
            color: white;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .payment-method {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .payment-method:hover {
            border-color: #0d6efd;
            background-color: #f8f9fa;
        }
        
        .payment-method.selected {
            border-color: #0d6efd;
            background-color: #e7f1ff;
        }
        
        .order-summary-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .btn-checkout {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            width: 100%;
            transition: transform 0.3s;
        }
        
        .btn-checkout:hover {
            transform: translateY(-2px);
            color: white;
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
                <a class="nav-link" href="/cart">
                    <i class="fas fa-shopping-cart me-1"></i> Cart
                    @if(count(session()->get('cart', [])) > 0)
                    <span class="badge bg-danger">{{ count(session()->get('cart', [])) }}</span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="checkout-container py-4">
        <!-- Header -->
        <div class="checkout-card">
            <div class="checkout-header">
                <h1 class="h3 mb-0"><i class="fas fa-lock me-2"></i>Secure Checkout</h1>
                <p class="mb-0 opacity-75">Complete your purchase in just a few steps</p>
            </div>
        </div>

        <!-- Progress Steps -->
        <div class="checkout-card">
            <div class="card-body">
                <div class="step-indicator">
                    <div class="step completed">
                        <div class="step-number">1</div>
                        <div class="step-label">Cart</div>
                    </div>
                    <div class="step active">
                        <div class="step-number">2</div>
                        <div class="step-label">Information</div>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-label">Payment</div>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <div class="step-label">Confirmation</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="row">
            <!-- Left Column - Shipping & Payment -->
            <div class="col-lg-8">
                <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                    @csrf


    <!-- Error Display Section -->
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5 class="alert-heading">
            <i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:
        </h5>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
                    
                    <!-- Shipping Information -->
                    <div class="checkout-card">
                        <div class="card-body">
                            <h4 class="mb-4">
                                <i class="fas fa-truck me-2"></i>Shipping Information
                            </h4>
                            
                            <div class="mb-3">
                                <label for="shipping_address" class="form-label fw-bold">Shipping Address *</label>
                                <textarea class="form-control" id="shipping_address" name="shipping_address" 
                                          rows="3" placeholder="Enter your complete shipping address" required>{{ Auth::user()->address ?? '' }}</textarea>
                                <small class="text-muted">Please include street, city, and postal code</small>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-bold">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" 
                                           placeholder="Enter phone number" value="{{ Auth::user()->phone ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input type="email" class="form-control" id="email" 
                                           value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="checkout-card">
                        <div class="card-body">
                            <h4 class="mb-4">
                                <i class="fas fa-credit-card me-2"></i>Payment Method
                            </h4>
                            
                            <div class="payment-methods">
                                <div class="payment-method selected" data-method="Cash on Delivery">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" 
                                               id="cod" value="Cash on Delivery" checked>
                                        <label class="form-check-label d-flex align-items-center" for="cod">
                                            <i class="fas fa-money-bill-wave fa-2x text-success me-3"></i>
                                            <div>
                                                <h6 class="mb-1">Cash on Delivery</h6>
                                                <small class="text-muted">Pay when you receive your order</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="payment-method" data-method="eSewa">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" 
                                               id="esewa" value="eSewa">
                                        <label class="form-check-label d-flex align-items-center" for="esewa">
                                            <i class="fas fa-mobile-alt fa-2x text-primary me-3"></i>
                                            <div>
                                                <h6 class="mb-1">eSewa</h6>
                                                <small class="text-muted">Pay via eSewa wallet</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="payment-method" data-method="Khalti">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" 
                                               id="khalti" value="Khalti">
                                        <label class="form-check-label d-flex align-items-center" for="khalti">
                                            <i class="fas fa-qrcode fa-2x text-warning me-3"></i>
                                            <div>
                                                <h6 class="mb-1">Khalti</h6>
                                                <small class="text-muted">Pay via Khalti digital wallet</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="payment-method" data-method="Credit Card">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" 
                                               id="creditcard" value="Credit Card">
                                        <label class="form-check-label d-flex align-items-center" for="creditcard">
                                            <i class="fas fa-credit-card fa-2x text-info me-3"></i>
                                            <div>
                                                <h6 class="mb-1">Credit/Debit Card</h6>
                                                <small class="text-muted">Pay with your card securely</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="col-lg-4">
                <div class="checkout-card sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h4 class="mb-4">
                            <i class="fas fa-receipt me-2"></i>Order Summary
                        </h4>
                        
                        <!-- Order Items -->
                        <div class="mb-4">
                            @foreach($cartItems as $productId => $item)
                            <div class="order-summary-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="mb-1">{{ $item['name'] }}</h6>
                                        <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold">Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                        <small class="text-muted">Rs. {{ number_format($item['price'], 2) }} each</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Price Breakdown -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span class="fw-bold">Rs. {{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Shipping</span>
                                <span class="fw-bold">
                                    @if($shipping == 0)
                                        <span class="text-success">FREE</span>
                                    @else
                                        Rs. {{ number_format($shipping, 2) }}
                                    @endif
                                </span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Tax (13%)</span>
                                <span class="fw-bold">Rs. {{ number_format($tax, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="h5 mb-0">Total</span>
                                <span class="h4 mb-0 text-primary">Rs. {{ number_format($total, 2) }}</span>
                            </div>
                            
                            <!-- Shipping Info -->
                            @if($subtotal < 5000)
                            <div class="alert alert-info small">
                                <i class="fas fa-info-circle me-2"></i>
                                Add Rs. {{ number_format(5000 - $subtotal, 2) }} more for FREE shipping!
                            </div>
                            @else
                            <div class="alert alert-success small">
                                <i class="fas fa-check-circle me-2"></i>
                                You've qualified for FREE shipping!
                            </div>
                            @endif
                        </div>
                        
                        <!-- Checkout Button -->
                        <button type="submit" form="checkoutForm" class="btn btn-checkout">
                            <i class="fas fa-lock me-2"></i>Complete Order
                        </button>
                        
                        <!-- Security Note -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-shield-alt me-1"></i>
                                Your payment is secure and encrypted
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2026 QuickMart - Laravel E-commerce Demo</p>
            <p class="text-muted small">Secure Checkout System</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Payment method selection
        const paymentMethods = document.querySelectorAll('.payment-method');
        
        paymentMethods.forEach(method => {
            method.addEventListener('click', function() {
                // Remove selected class from all
                paymentMethods.forEach(m => m.classList.remove('selected'));
                // Add to clicked
                this.classList.add('selected');
                // Check the radio input
                const radio = this.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;
            });
        });
        
       // Form validation - just focus, don't prevent
const form = document.getElementById('checkoutForm');
form.addEventListener('submit', function(e) {
    const address = document.getElementById('shipping_address').value.trim();
    if (!address) {
        // Just focus, let Laravel handle validation
        document.getElementById('shipping_address').focus();
    }
});
    });
    </script>
</body>
</html>