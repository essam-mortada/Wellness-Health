<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
Route::get('/',[homeController::class,'ShowHome']);
Route::get('/home',[homeController::class,'ShowHome'])->name('home');
Route::get('/shop',[homeController::class,'ShowShop'])->name('shop');
Route::get('/checkout',[homeController::class,'ShowCheckout'])->name('checkout');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');



Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('products.show');
// admin
Route::get('/products',[ProductController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::post('/product/create',[ProductController::class,'store'])->name('products.store');
Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('products.update');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


// cart

Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::patch('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

//orders
Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders',[OrderController::class,'index'])->name('orders.index');

Route::get('/orders/show/{orderId}', [OrderController::class, 'show'])->name('orders.show');
