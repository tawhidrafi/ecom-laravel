<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

require __DIR__ . '/auth.php';

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');