<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Main landing page
Route::get('/', function () {
    return view('welcome');
});

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart routes
Route::get('/cart', [App\Http\Controllers\CartController::class, 'view'])->name('cart.view');
Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

// Authentication routes
Auth::routes();

// Dashboard after login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Test if user is logged in
Route::get('/check-auth', function() {
    if (auth()->check()) {
        return 'Logged in as: ' . auth()->user()->name . ' (ID: ' . auth()->id() . ')';
    } else {
        return 'NOT logged in';
    }
});

// Checkout Routes
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show')->middleware('auth');
Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process')->middleware('auth');
Route::get('/checkout/success/{order}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success')->middleware('auth');