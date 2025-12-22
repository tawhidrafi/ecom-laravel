<?php
use App\Http\Controllers\User\ContactController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;

use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\WebController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\WishListController;

use App\Http\Controllers\Auth\Admin\AdminLoginController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Home & about
Route::get('/', [App\Http\Controllers\User\WebController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\User\WebController::class, 'about'])->name('about');

// shop
Route::get('/shop', [WebController::class, 'shop'])->name('shop.index');
Route::get('/product/{slug}', [WebController::class, 'show'])->name('shop.show');

// contact us
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Guest Routes
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    // Login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    // Password Reset Routes
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

// Auth Routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // Email Verification
    // index
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');
    // verification
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed'])
        ->name('verification.verify');
    // resend
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware(['throttle:3,1'])
        ->name('verification.send');
    // success
    Route::get('/email/verified-success', [EmailVerificationController::class, 'success'])
        ->name('verification.success');
    // OTP Verification
    // index
    Route::get('/otp', [OtpController::class, 'index'])
        ->name('otp.show');
    // verify
    Route::post('/otp/verify', [OtpController::class, 'verify'])
        ->name('otp.verify');
    // resend
    Route::post('/otp/resend', [OtpController::class, 'resend'])
        ->middleware(['throttle:3,1'])
        ->name('otp.resend');
    // user routes
    Route::get('dashboard', [UserController::class, 'index'])
        ->name('user.dashboard');
});

// Cart
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// Coupon
Route::middleware('auth')->group(function () {
    Route::post('/cart/apply-coupon', [CouponController::class, 'apply'])->name('coupon.apply');
    Route::put('/cart/remove-coupon', [CouponController::class, 'remove'])->name('coupon.remove');
});

// Wishlist
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishListController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishListController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishListController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/clear', [WishListController::class, 'clear'])->name('wishlist.clear');
});

//Address
Route::middleware('auth')->group(function () {
    Route::get('/addresses', [AddressController::class, 'index'])->name('address.index');
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('address.create');
    Route::post('/addresses', [AddressController::class, 'store'])->name('address.store');
    Route::get('/addresses/{address}/edit', [AddressController::class, 'edit'])->name('address.edit');
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('address.update');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('address.destroy');
});

// checkout
Route::middleware('auth')->group(function () {
    Route::get('/checkout/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/confirm/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
});

// orders
Route::middleware('auth')->group(function () {
    Route::get('/orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('user.orders.show');
    Route::delete('/orders/{order}', [UserOrderController::class, 'cancel'])->name('user.order.cancel');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile/', [UserController::class, 'update'])->name('user.profile.update');
});


// Admin
Route::prefix('admin')->group(function () {
    // Admin if not authenticated
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
    });
    // Admin if authenticated
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        // admin routes
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        // brand routes
        Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
        Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
        Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
        Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
        // category routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        // product routes
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        // coupons
        Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
        Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
        Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
        Route::get('/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
        Route::put('/coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
        Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');
        // orders
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::put('/orders/{order}/update-payment-status', [OrderController::class, 'updatePaymentStatus'])
            ->name('admin.orders.update-payment-status');
        Route::put('/orders/{order}/update-delivery-status', [OrderController::class, 'updateDeliveryStatus'])
            ->name('admin.orders.update-delivery-status');

        // settings
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/settings/', [AdminController::class, 'update'])->name('admin.settings.update');
    });
});