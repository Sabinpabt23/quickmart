<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickMart - Your Online Shopping Destination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
        }
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-shop {
            padding: 12px 30px;
            font-size: 1.1rem;
        }
        .navbar-brand {
            font-weight: bold;
            color: #0d6efd !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">
                🛒 QuickMart
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="/">Home</a>
                <a class="nav-link" href="/products">Products</a>
                <a class="nav-link" href="/cart">🛒 Cart</a>
                @auth
                    <a class="nav-link" href="/home">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                @else
                    <a class="nav-link" href="/login">Login</a>
                    <a class="nav-link btn btn-primary text-white" href="/register">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Welcome to QuickMart</h1>
            <p class="lead mb-4">Your one-stop destination for all shopping needs</p>
            <a href="/products" class="btn btn-light btn-lg btn-shop">Start Shopping →</a>
        </div>
    </section>

    <!-- Features Section -->
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100">
                    <div class="feature-icon">🚚</div>
                    <h4>Free Shipping</h4>
                    <p class="text-muted">On orders over Rs. 5000</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100">
                    <div class="feature-icon">↩️</div>
                    <h4>Easy Returns</h4>
                    <p class="text-muted">30-day return policy</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100">
                    <div class="feature-icon">🔒</div>
                    <h4>Secure Payment</h4>
                    <p class="text-muted">100% secure transactions</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center py-5">
            <h2 class="mb-4">Ready to shop?</h2>
            <p class="lead mb-4">Browse our wide range of products</p>
            <a href="/products" class="btn btn-primary btn-lg btn-shop">View All Products</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2026 QuickMart - Laravel E-commerce Demo</p>
            <p class="text-muted small">Built for Backend (Laravel) Internship Application</p>
            <p class="text-muted small mt-2">
                <strong>Features:</strong> User Authentication • Product Management • Shopping Cart • Database Integration
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>