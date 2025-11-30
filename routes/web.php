<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\Admin\AdminLoginController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Guest Routes
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
    // Login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
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
    // Password Reset Routes
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
    // user routes
    Route::get('/user/dashboard', [UserController::class, 'index'])
        ->name('user.dashboard');
});

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
        Route::get('/brands', [App\Http\Controllers\Admin\BrandController::class, 'index'])
            ->name('brands.index');
        Route::get('/brands/create', [App\Http\Controllers\Admin\BrandController::class, 'create'])
            ->name('brands.create');
        Route::post('/brands', [App\Http\Controllers\Admin\BrandController::class, 'store'])
            ->name('brands.store');
        Route::get('/brands/{brand}/edit', [App\Http\Controllers\Admin\BrandController::class, 'edit'])
            ->name('brands.edit');
        Route::put('/brands/{brand}', [App\Http\Controllers\Admin\BrandController::class, 'update'])
            ->name('brands.update');
        Route::delete('/brands/{brand}', [App\Http\Controllers\Admin\BrandController::class, 'destroy'])
            ->name('brands.destroy');
    });
});


Route::any('{any}', function () {
    return view('app');
})->where('any', '^(?!assets).*$');
