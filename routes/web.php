<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\NewsBarController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymobController;
use App\Http\Controllers\promoCodeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\userController;
use App\Http\Controllers\usersMessagesController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


Route::fallback(function () {
    return response()->view('error-404', [], 404);
});
Route::get('/admin/login',[userController::class,'showLoginForm'])->name('admin.login');
Route::post('/admin/login',[userController::class,'loginAdmin'])->name('admin.login.post');

//////////////////////////////////////////////////////ADMIN////////////////////////////////////////////////
// admin routes
Route::prefix('/admin')->middleware('auth','admin')->group(function () {
Route::get('/', [userController::class, 'showAdminHome'])->name('admin.home');
//messages
Route::get('/messages',[usersMessagesController::class,'index'])->name('messages.index');
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
Route::get('/admins/index', [userController::class, 'index'])->name('admins.index');
Route::get('/profile/show/{user}', [userController::class, 'show'])->name('admins.show');
Route::get('/profile/{user}/edit', [userController::class, 'edit'])->name('admins.edit');
Route::put('/profile/{user}', [userController::class, 'update'])->name('admins.update');
Route::delete('/profile//destroy/{user}', [userController::class, 'destroy'])->name('admins.destroy');
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
Route::delete('/orders/destroy/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
//reviews
Route::get('/reviews',[ReviewController::class,'index'])->name('reviews.index');
Route::get('/reviews/show/{review}', [ReviewController::class, 'show'])->name('reviews.show');
Route::delete('/reviews/delete/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
//brands
Route::get('/brands',[BrandController::class,'index'])->name('brands.index');
Route::get('/brands/create',[BrandController::class,'create'])->name('brands.create');
Route::post('/product/create',[BrandController::class,'store'])->name('brands.store');
Route::get('/brands/edit/{brand}', [BrandController::class, 'edit'])->name('brands.edit');
Route::put('/brands/update/{brand}', [BrandController::class, 'update'])->name('brands.update');
Route::post('/brands/store', [BrandController::class, 'store'])->name('brands.store');
Route::delete('/brands/destroy/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
//promoCodes
Route::get('/promocodes',[promoCodeController::class,'index'])->name('promoCodes.index');
Route::post('/add-promo', [promoCodeController::class, 'store'])->name('promoCodes.store');
Route::get('/promo/create', [promoCodeController::class, 'create'])->name('promoCodes.create');
Route::delete('/promo/destroy/{PromoCode}', [promoCodeController::class, 'destroy'])->name('promoCodes.destroy');
//news bar
Route::get('/news-bar', [NewsBarController::class, 'index'])->name('news-bar.index');
Route::post('/news-bar', [NewsBarController::class, 'update'])->name('news-bar.update');
//logout

});

Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');



    Route::post('/logout',[userController::class,'logout'])->name('logout');

});
////////////////////////////////////////////////USER//////////////////////////////////////////////////////
// user routes
Route::get('/register', [userController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [userController::class, 'register'])->name('register.post');
Route::get('/login', [userController::class, 'showUserLoginForm'])->name('login');
Route::post('/login', [userController::class, 'login'])->name('login.post');
Route::get('/profile', [userController::class, 'showProfile'])->name('profile');
Route::put('/profile/{user}', [userController::class, 'update'])->name('update.user');
Route::post('/change-password/{user}', [UserController::class, 'changePassword'])->name('password.update');

//forget password
Route::get('/forgot-password', [userController::class, 'showForgotPasswordForm'])->name('forgot.password.form');
Route::post('/forgot-password', [userController::class, 'sendForgetLinkEmail'])->name('forgot.password.send');
Route::get('/password/reset', [userController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [userController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [userController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [userController::class, 'reset'])->name('update.password');

Route::get('products/search', [ProductController::class, 'search'])->name('search.products');
//reviews
Route::post('products/reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store');
//usersMessages
Route::post('/messages/store', [usersMessagesController::class, 'store'])->name('messages.store');
Route::get('/messages/index', [usersMessagesController::class, 'index'])->name('messages.index');
Route::get('/messages/show/{message}', [usersMessagesController::class, 'show'])->name('messages.show');
// cart

Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::patch('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');


//products
Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/shop/filter', [ProductController::class, 'filterByCategory'])->name('shop.filter');
Route::get('/brand/{brand}', [ProductController::class, 'showByBrand'])->name('brand.products');

//orders
//Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');

//otp
Route::post('/resend-otp', [OrderController::class, 'resendOTP'])->name('resendOTP');
Route::post('/order/store', [OrderController::class, 'store'])->name('placeOrder'); // This is the order placement route
Route::get('/verify-otp', [OrderController::class, 'showOTPForm'])->name('verifyOTP'); // This is for displaying the OTP form
Route::post('/verify-otp', [OrderController::class, 'verifyOTP'])->name('verifyOTP.post'); // This is for verifyin

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
//promo code
Route::post('/apply-promo', [promoCodeController::class, 'applyPromo'])->name('apply.promo');
