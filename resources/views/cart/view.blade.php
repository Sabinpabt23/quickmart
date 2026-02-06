<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - QuickMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">🛒 QuickMart</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="/products">Products</a>
                <a class="nav-link active" href="/cart">Cart</a>
                @auth
                    <a class="nav-link" href="/home">Dashboard</a>
                @else
                    <a class="nav-link" href="/login">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>🛒 Shopping Cart</h1>
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        @if(empty($cartItems))
        <div class="alert alert-info mt-4">
            Your cart is empty. <a href="/products">Browse products</a>
        </div>
        @else
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>Rs. {{ number_format($item['price'], 2) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td>
                            <a href="/cart/remove/{{ $id }}" class="btn btn-danger btn-sm">Remove</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                        <td><strong>Rs. {{ number_format($total, 2) }}</strong></td>
                        <td>
                            <a href="/checkout" class="btn btn-success">Checkout</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @endif
        
        <div class="mt-3">
            <a href="/products" class="btn btn-outline-primary">Continue Shopping</a>
        </div>
    </div>
</body>
</html>