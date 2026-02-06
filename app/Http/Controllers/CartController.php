<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
 public function add(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $cart = session()->get('cart', []);
    
    $quantity = $request->input('quantity', 1);

    // Check if product already in cart
    if(isset($cart[$id])) {
        // Increment by specified quantity
        $cart[$id]['quantity'] += $quantity;
    } else {
        // Add new product to cart with specified quantity
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => $quantity,
            "price" => $product->price,
            "image" => null
        ];
    }

    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Product added to cart!');
} 

public function update(Request $request, $id)
{
    $cart = session()->get('cart', []);
    
    if(isset($cart[$id])) {
        $quantity = $request->input('quantity', 1);
        
        if($quantity <= 0) {
            // Remove if quantity is 0 or negative
            unset($cart[$id]);
        } else {
            $cart[$id]['quantity'] = $quantity;
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Cart updated!');
    }
    
    return redirect()->back()->with('error', 'Product not found in cart!');
}

    public function view()
    {
        $cartItems = session()->get('cart', []);
        $total = 0;
        
        foreach($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart.view', compact('cartItems', 'total'));
    }
    
    public function remove($id)
    {
        $cart = session()->get('cart');
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}