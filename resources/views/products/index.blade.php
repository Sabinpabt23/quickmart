<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - QuickMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            transition: transform 0.3s;
            border: 1px solid #e0e0e0;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: #0d6efd;
        }
        .product-card {
            height: 100%;
        }
        .badge-category {
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">🛒 QuickMart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/products">Products</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/home">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white" href="/register">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h1 class="mb-4">📦 Our Products</h1>
        
        <!-- Categories Filter (Optional) -->
        @if(isset($categories) && $categories->count() > 0)
        <div class="mb-4">
            <h5>Browse by Category:</h5>
            <div class="d-flex flex-wrap gap-2">
                @foreach($categories as $category)
                <span class="badge bg-secondary badge-category">{{ $category->name }}</span>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Products Grid -->
        @if(isset($products) && $products->count() > 0)
            <p class="text-muted">Showing {{ $products->count() }} of {{ $products->total() }} products</p>
            
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card product-card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</p>
                            <p class="text-success fw-bold">Rs. {{ number_format($product->price, 2) }}</p>
                            
                            <!-- Category Badge -->
                            @if($product->category)
                            <span class="badge bg-primary badge-category">{{ $product->category->name }}</span>
                            @endif
                            
                            <!-- Stock Status -->
                            @if($product->stock > 0)
                            <span class="badge bg-success badge-category">In Stock</span>
                            @else
                            <span class="badge bg-danger badge-category">Out of Stock</span>
                            @endif
                            
                            <!-- Action Buttons -->
                            <div class="mt-3">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">View Details</a>
                                @if($product->stock > 0)
                                <button class="btn btn-success btn-sm add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <strong>No products found!</strong> Please check back later.
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
        // Simple add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                alert('✅ Product ID ' + productId + ' added to cart!');
                // In a real app, you would send an AJAX request to add to cart
            });
        });
    </script>
</body>
</html>