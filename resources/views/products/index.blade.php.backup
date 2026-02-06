<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - QuickMart</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-shopping-cart"></i> QuickMart
            </a>
            
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/">
                    <i class="fas fa-home me-1"></i> Home
                </a>
                <a class="nav-link active" href="/products">
                    <i class="fas fa-box me-1"></i> Products
                </a>
                <a class="nav-link" href="/cart">
                    <i class="fas fa-shopping-cart me-1"></i> Cart
                    @php
                        $cartCount = count(session()->get('cart', []));
                    @endphp
                    @if($cartCount > 0)
                    <span class="badge bg-danger cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>
                @auth
                    <a class="nav-link" href="/home">
                        <i class="fas fa-user-circle me-1"></i> Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                @else
                    <a class="nav-link" href="/login">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                    <a class="nav-link btn btn-primary text-white ms-2" href="/register">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-3">Discover Amazing Products</h1>
                    <p class="lead mb-4">Shop from our wide collection of premium products at unbeatable prices</p>
                    
                    <!-- Search Bar -->
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" placeholder="Search products...">
                                <button class="btn btn-light btn-lg" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select form-select-lg">
                                <option>All Categories</option>
                                @foreach($categories ?? [] as $category)
                                <option>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="hero-icon">
                        <i class="fas fa-shopping-bag fa-5x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="category-sidebar">
                    <h5 class="category-title">
                        <i class="fas fa-filter me-2"></i> Categories
                    </h5>
                    
                    @if(isset($categories) && $categories->count() > 0)
                        @foreach($categories as $category)
                        <a href="#" class="category-item">
                            <span>{{ $category->name }}</span>
                            <span class="category-count">{{ $category->products_count ?? 0 }}</span>
                        </a>
                        @endforeach
                    @else
                        <p class="text-muted small">No categories available</p>
                    @endif
                    
                    <hr class="my-3">
                    
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-sliders-h me-2"></i> Price Range
                    </h6>
                    
                    <input type="range" class="form-range" min="0" max="5000" step="100" id="priceRange">
                    <div class="d-flex justify-content-between mt-2">
                        <small>Rs. 0</small>
                        <small>Rs. 5,000</small>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="category-sidebar">
                    <h5 class="category-title">
                        <i class="fas fa-chart-bar me-2"></i> Shop Stats
                    </h5>
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="text-primary">
                                <i class="fas fa-box fa-2x mb-2"></i>
                                <h6 class="mb-0">{{ $products->total() ?? 0 }}</h6>
                                <small>Products</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="text-success">
                                <i class="fas fa-tags fa-2x mb-2"></i>
                                <h6 class="mb-0">{{ $categories->count() ?? 0 }}</h6>
                                <small>Categories</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <!-- Products Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-0">
                            <i class="fas fa-cubes me-2"></i>All Products
                        </h4>
                        <p class="text-muted mb-0">
                            Showing {{ $products->count() }} of {{ $products->total() }} products
                        </p>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm w-auto">
                            <option>Sort by: Popular</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest First</option>
                        </select>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                @if(isset($products) && $products->count() > 0)
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="product-card">
                            <!-- Product Image -->
                            <div class="product-image-container">
                                <!-- Placeholder image based on category -->
                                @if($product->category && $product->category->name == 'Electronics')
                                <div class="product-image-placeholder d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-mobile-alt fa-4x text-primary opacity-50"></i>
                                </div>
                                @elseif($product->category && $product->category->name == 'Clothing')
                                <div class="product-image-placeholder d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-tshirt fa-4x text-success opacity-50"></i>
                                </div>
                                @else
                                <div class="product-image-placeholder d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-box fa-4x text-secondary opacity-50"></i>
                                </div>
                                @endif
                                
                                <!-- Stock Badge -->
                                <div class="stock-badge">
                                    @if($product->stock > 0)
                                    <span class="badge bg-success">In Stock</span>
                                    @else
                                    <span class="badge bg-danger">Out of Stock</span>
                                    @endif
                                </div>
                                
                                <!-- Category Badge -->
                                @if($product->category)
                                <div class="product-badges">
                                    <span class="badge bg-primary badge-category">{{ $product->category->name }}</span>
                                </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="product-info">
                                <h5 class="product-title">{{ $product->name }}</h5>
                                <p class="product-description">
                                    {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                                </p>
                                
                                <!-- Rating -->
                                <div class="rating mb-2">
                                    @php
                                        $rating = rand(3, 5); // Random rating for demo
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    <small class="text-muted ms-1">({{ rand(10, 99) }})</small>
                                </div>
                                
                                <!-- Price -->
                                <div class="d-flex align-items-center mb-3">
                                    <span class="product-price">Rs. {{ number_format($product->price, 2) }}</span>
                                    @if($product->price > 500)
                                    <span class="product-old-price ms-2">
                                        Rs. {{ number_format($product->price * 1.2, 2) }}
                                    </span>
                                    <span class="badge bg-danger small">Save 20%</span>
                                    @endif
                                </div>
                                
                                <!-- Quantity Selector -->
                                @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="quantity-group">
                                    @csrf
                                    <div class="input-group quantity-input-group">
                                        <button type="button" class="btn btn-outline-secondary quantity-btn decrease-btn">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" name="quantity" value="1" min="1" 
                                               max="{{ $product->stock }}" class="form-control text-center">
                                        <button type="button" class="btn btn-outline-secondary quantity-btn increase-btn">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <button type="submit" class="btn btn-success flex-grow-1">
                                        <i class="fas fa-cart-plus me-1"></i> Add
                                    </button>
                                </form>
                                @endif
                                
                                <!-- Action Buttons -->
                                <div class="product-actions">
                                    <a href="{{ route('products.show', $product->id) }}" 
                                       class="btn btn-primary btn-view-details">
                                        <i class="fas fa-eye me-1"></i> View Details
                                    </a>
                                    
                                    @if($product->stock > 0)
                                    <button class="btn btn-outline-success btn-wishlist" data-id="{{ $product->id }}">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-box-open fa-4x text-muted mb-4"></i>
                        <h4>No Products Found</h4>
                        <p class="text-muted">Check back later for new arrivals!</p>
                        <a href="/" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i> Go to Home
                        </a>
                    </div>
                </div>
                @endif

                <!-- Pagination -->
                @if(isset($products) && $products->count() > 0)
                <div class="pagination-container">
                    <nav aria-label="Page navigation">
                        {{ $products->links() }}
                    </nav>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-shopping-cart me-2"></i> QuickMart
                    </h5>
                    <p class="text-light small">
                        Your one-stop destination for all shopping needs. Quality products at affordable prices.
                    </p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6>Quick Links</h6>
                    <div class="footer-links d-flex flex-column">
                        <a href="/" class="mb-2">Home</a>
                        <a href="/products" class="mb-2">Products</a>
                        <a href="/cart" class="mb-2">Cart</a>
                        <a href="/home" class="mb-2">Dashboard</a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <h6>Support</h6>
                    <div class="footer-links d-flex flex-column">
                        <a href="#" class="mb-2">Contact Us</a>
                        <a href="#" class="mb-2">FAQ</a>
                        <a href="#" class="mb-2">Shipping Policy</a>
                        <a href="#" class="mb-2">Returns</a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <h6>Connect With Us</h6>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-light"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-light my-4">
            <div class="text-center">
                <p class="mb-0 small">
                    © 2026 QuickMart - Laravel E-commerce Demo | For Backend Internship Application
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity buttons functionality
        document.querySelectorAll('.increase-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.closest('.quantity-input-group').querySelector('input');
                const max = parseInt(input.getAttribute('max'));
                if (parseInt(input.value) < max) {
                    input.value = parseInt(input.value) + 1;
                }
            });
        });

        document.querySelectorAll('.decrease-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.closest('.quantity-input-group').querySelector('input');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                }
            });
        });

        // Wishlist button
        document.querySelectorAll('.btn-wishlist').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                this.classList.toggle('text-danger');
                this.querySelector('i').classList.toggle('far');
                this.querySelector('i').classList.toggle('fas');
                
                // Show toast notification
                const toast = new bootstrap.Toast(document.getElementById('wishlistToast'));
                toast.show();
            });
        });

        // Price range slider
        const priceRange = document.getElementById('priceRange');
        if (priceRange) {
            priceRange.addEventListener('input', function() {
                document.getElementById('priceValue').textContent = 'Rs. ' + this.value;
            });
        }
    });
    </script>
    
    <!-- Wishlist Toast (hidden by default) -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="wishlistToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-heart text-danger me-2"></i>
                <strong class="me-auto">QuickMart</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Product added to wishlist!
            </div>
        </div>
    </div>
</body>
</html>