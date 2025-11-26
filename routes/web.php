<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Registration
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');

// verification notice
Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
    ->middleware(['auth'])
    ->name('verification.notice');

// verification link (from email)
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// resending verification email
Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:3,1'])
    ->name('verification.send');

// success page
Route::get('/email/verified-success', [EmailVerificationController::class, 'success'])
    ->middleware(['auth'])
    ->name('verification.success');

// OTP routes
Route::get('/otp', [OtpController::class, 'index'])
    ->middleware(['auth'])
    ->name('otp.show');

Route::post('/otp/verify', [OtpController::class, 'verify'])
    ->middleware(['auth'])
    ->name('otp.verify');

Route::post('/otp/resend', [OtpController::class, 'resend'])
    ->middleware(['auth', 'throttle:3,1'])
    ->name('otp.resend');

// Login & Logout
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');