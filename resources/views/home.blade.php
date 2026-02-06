@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Welcome Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="h3 mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-muted mb-0">Here's your shopping dashboard with real data from your account.</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="/products" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart me-2"></i>Shop Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <div class="text-primary mb-2">
                        <i class="fas fa-shopping-bag fa-2x"></i>
                    </div>
                    <h2 class="display-6 fw-bold">{{ $totalOrders ?? 0 }}</h2>
                    <p class="text-muted mb-0">Total Orders</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <div class="text-success mb-2">
                        <i class="fas fa-wallet fa-2x"></i>
                    </div>
                    <h2 class="display-6 fw-bold">Rs. {{ number_format($totalSpent ?? 0, 2) }}</h2>
                    <p class="text-muted mb-0">Total Spent</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-center border-warning">
                <div class="card-body">
                    <div class="text-warning mb-2">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <h2 class="display-6 fw-bold">{{ $pendingOrders ?? 0 }}</h2>
                    <p class="text-muted mb-0">Pending Orders</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-center border-info">
                <div class="card-body">
                    <div class="text-info mb-2">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                    <h2 class="display-6 fw-bold">{{ $completedOrders ?? 0 }}</h2>
                    <p class="text-muted mb-0">Completed Orders</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="mb-0 fw-bold">📦 Recent Orders</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders ?? [] as $order)
                        <tr>
                            <td class="fw-bold">#ORD-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                            <td class="fw-bold">Rs. {{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                @if($order->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge bg-warning">Processing</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                    <h5>No orders yet</h5>
                                    <p class="mb-3">Start shopping to see your orders here</p>
                                    <a href="/products" class="btn btn-primary">
                                        <i class="fas fa-shopping-cart me-2"></i>Browse Products
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                    <h5>Account Settings</h5>
                    <p class="text-muted small">Update your profile and preferences</p>
                    <a href="#" class="btn btn-outline-primary">Manage Account</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-history fa-3x text-warning mb-3"></i>
                    <h5>Order History</h5>
                    <p class="text-muted small">View all your past orders</p>
                    <a href="#" class="btn btn-outline-warning">View History</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-question-circle fa-3x text-info mb-3"></i>
                    <h5>Need Help?</h5>
                    <p class="text-muted small">Contact our support team</p>
                    <a href="#" class="btn btn-outline-info">Get Help</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .card {
        border-radius: 10px;
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-3px);
    }
    .badge {
        font-size: 0.85em;
        padding: 5px 12px;
    }
    .table th {
        font-weight: 600;
        border-top: none;
    }
</style>
@endsection