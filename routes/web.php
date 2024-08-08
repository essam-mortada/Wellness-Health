<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymobController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



Route::get('/admin/login',[userController::class,'showLoginForm'])->name('login');
Route::post('/admin/login',[userController::class,'Login']);

//////////////////////////////////////////////////////ADMIN////////////////////////////////////////////////
// admin routes
Route::prefix('/admin')->middleware('auth')->group(function () {
Route::get('/', [userController::class, 'showAdminHome'])->name('admin.home');

//products
Route::get('/products',[ProductController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::post('/product/create',[ProductController::class,'store'])->name('products.store');
Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('products.update');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/show/{product}', [ProductController::class, 'showProductAdmin'])->name('products.show.admin');
//blogs
Route::get('/blogs',[BlogController::class,'index'])->name('blogs.index');
Route::get('/blogs/create',[BlogController::class,'create'])->name('blogs.create');
Route::post('/product/create',[BlogController::class,'store'])->name('blogs.store');
Route::get('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blogs/update/{blog}', [blogController::class, 'update'])->name('blogs.update');
Route::post('/blogs/store', [blogController::class, 'store'])->name('blogs.store');
Route::delete('/blogs/destroy/{blog}', [blogController::class, 'destroy'])->name('blogs.destroy');
Route::get('/blogs/show/{blog}', [blogController::class, 'showBlogAdmin'])->name('blogs.show.admin');
//profile
Route::get('/profile/show/{user}', [userController::class, 'show'])->name('admins.show');
Route::get('/profile/{user}/edit', [userController::class, 'edit'])->name('admins.edit');
Route::put('/profile/{user}', [userController::class, 'update'])->name('admins.update');
Route::get('/change-password/{user}', [UserController::class, 'showChangepasswordForm'])->name('password.change.form');
Route::post('/change-password/{user}', [UserController::class, 'changePassword'])->name('password.change');
Route::get('/add', [userController::class,'showAddadminForm'])->name('add-admin');
Route::post('/add', [userController::class,'addAdmin'])->name('add-admin-post');
//orders
Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
Route::get('/orders/show/{orderId}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders/delivery/{order}', [OrderController::class, 'out_for_delivery'])->name('orders.delivery');
Route::post('/orders/delivered/{order}', [OrderController::class, 'delivered'])->name('orders.delivered');
Route::get('/orders/delivered',[OrderController::class,'deliveredOrders'])->name('orders.deliveredOrders');
Route::get('/orders/pending',[OrderController::class,'pendingOrders'])->name('orders.pendingOrders');
Route::get('/orders/out-for-delivery',[OrderController::class,'out_for_delivery_orders'])->name('orders.out_for_delivery_orders');
//logout
Route::post('/logout',[userController::class,'logout'])->name('logout');

});
////////////////////////////////////////////////USER//////////////////////////////////////////////////////
// user routes
// cart

Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::patch('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

//orders
Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');

//products
Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/blogs/show/{blog}', [BlogController::class, 'show'])->name('blogs.show');

//views
Route::get('/',[homeController::class,'ShowHome']);
Route::get('/home',[homeController::class,'ShowHome'])->name('home');
Route::get('/shop',[homeController::class,'ShowShop'])->name('shop');
Route::get('/checkout',[homeController::class,'ShowCheckout'])->name('checkout');
Route::get('/about', [homeController::class,'ShowAbout'])->name('about');
Route::get('/contact', [homeController::class,'ShowContact'])->name('contact');
Route::get('/blog', [homeController::class,'ShowBlog'])->name('blog');
Route::get('/payment',[homeController::class,'ShowPayment']);
Route::get('/payment-button',function(){
    return view('payment');});

//paymob routes
Route::post('/credit', [PaymobController::class, 'credit'])->name('credit'); // this route send all functions data to paymob
Route::get('/callback', [PaymobController::class, 'callback'])->name('callback'); // this route get all reponse data to paymob
