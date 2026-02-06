<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - QuickMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .back-btn {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">🛒 QuickMart</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="/products">Products</a>
                @auth
                    <a class="nav-link" href="/home">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                @else
                    <a class="nav-link" href="/login">Login</a>
                    <a class="nav-link" href="/register">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Back Button -->
        <a href="/products" class="btn btn-outline-secondary back-btn">← Back to Products</a>
        
        @if(isset($product))
        <div class="row">
            <!-- Product Image (Left Column) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Placeholder for product image -->
                        <div class="bg-light p-5 rounded mb-3">
                            <span class="display-1">🛒</span>
                        </div>
                        <h2 class="mb-3">{{ $product->name }}</h2>
                    </div>
                </div>
            </div>
            
            <!-- Product Details (Right Column) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-success product-price">Rs. {{ number_format($product->price, 2) }}</h3>
                        
                        <!-- Stock Status -->
                        @if($product->stock > 0)
                        <span class="badge bg-success mb-3">In Stock ({{ $product->stock }} available)</span>
                        @else
                        <span class="badge bg-danger mb-3">Out of Stock</span>
                        @endif
                        
                        <!-- Category -->
                        @if($product->category)
                        <p><strong>Category:</strong> <span class="badge bg-primary">{{ $product->category->name }}</span></p>
                        @endif
                        
                        <!-- Description -->
                        <div class="mb-4">
                            <h5>Description</h5>
                            <p class="text-muted">{{ $product->description }}</p>
                        </div>
                        
                        <!-- Quantity Selector -->
                        @if($product->stock > 0)
                        <div class="mb-4">
                            <label for="quantity" class="form-label"><strong>Quantity:</strong></label>
                            <div class="input-group" style="max-width: 150px;">
                                <button class="btn btn-outline-secondary" type="button" id="decrease-qty">-</button>
                                <input type="number" class="form-control text-center" value="1" min="1" max="{{ $product->stock }}" id="quantity">
                                <button class="btn btn-outline-secondary" type="button" id="increase-qty">+</button>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-success btn-lg add-to-cart" data-id="{{ $product->id }}">
                                <span>🛒 Add to Cart</span>
                            </button>
                            <a href="/products" class="btn btn-outline-primary btn-lg">Continue Shopping</a>
                        </div>
                        @else
                        <div class="alert alert-warning">
                            <strong>Out of Stock!</strong> This product is currently unavailable.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-danger">
            <strong>Error!</strong> Product not found.
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2026 QuickMart - Laravel E-commerce Demo</p>
            <p class="text-muted small">For Backend (Laravel) Internship Application</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Quantity controls
        document.getElementById('increase-qty')?.addEventListener('click', function() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.getAttribute('max'));
            let value = parseInt(input.value);
            if (value < max) {
                input.value = value + 1;
            }
        });
        
        document.getElementById('decrease-qty')?.addEventListener('click', function() {
            const input = document.getElementById('quantity');
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        });
        
        // Add to cart functionality
        document.querySelector('.add-to-cart')?.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const quantity = document.getElementById('quantity')?.value || 1;
            alert(`✅ Added ${quantity} × ${productId} to cart!`);
        });
    </script>
</body>
</html>