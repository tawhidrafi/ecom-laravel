<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Registration
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// verification notice
Route::get('/email/verify', fn() => view('auth.verify-email'))->name('verification.notice');

// verification link (from email)
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/email/verified-success');
})->middleware(['signed'])->name('verification.verify');

// resending verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth'])->name('verification.send');

//email verified success page
Route::get(
    '/email/verified-success',
    fn() =>
    'Email verified! You can now use the app.'
)->name('verification.success');

// OTP routes
Route::get('/otp', [OtpController::class, 'index'])->name('otp.show');
Route::post('/otp/verify', [OtpController::class, 'verify'])->name('otp.verify');
Route::post('/otp/resend', [OtpController::class, 'resend'])->name('otp.resend');

// Login & Logout
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
