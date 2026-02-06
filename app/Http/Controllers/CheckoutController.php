<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show checkout page
     */
    public function show()
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $shipping = $subtotal > 5000 ? 0 : 100;
        $tax = $subtotal * 0.13;
        $total = $subtotal + $shipping + $tax;
        
        return view('checkout.show', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }
        
        // Validate form data
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|in:Cash on Delivery,eSewa,Khalti,Credit Card',
        ]);
        
        // Calculate total
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $shipping = $subtotal > 5000 ? 0 : 100;
        $tax = $subtotal * 0.13;
        $total = $subtotal + $shipping + $tax;
        
        // Create order using DB transaction
        DB::beginTransaction();
        
        try {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
            ]);
            
            // Create order items
            foreach ($cartItems as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
            }
            
            DB::commit();
            
            // Clear cart after successful order
            session()->forget('cart');
            
            // Redirect to success page
            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Order placed successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();
        }
    }

    /**
     * Show order success page
     */
    public function success($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);
        
        // Check if order belongs to current user
        if ($order->user_id != Auth::id()) {
            abort(403, 'Unauthorized access.');
        }
        
        return view('checkout.success', compact('order'));
    }
}