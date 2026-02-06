<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's orders (limit to 5 most recent)
        $orders = Order::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
        
        // Calculate stats
        $totalOrders = Order::where('user_id', $user->id)->count();
        $totalSpent = Order::where('user_id', $user->id)->sum('total_amount');
        $pendingOrders = Order::where('user_id', $user->id)
                          ->where('status', 'pending')
                          ->count();
        $completedOrders = Order::where('user_id', $user->id)
                            ->where('status', 'completed')
                            ->count();
        
        return view('home', compact(
            'user', 
            'orders', 
            'totalOrders', 
            'totalSpent', 
            'pendingOrders', 
            'completedOrders'
        ));
    }
}