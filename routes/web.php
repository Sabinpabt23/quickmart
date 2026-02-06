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