<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==================== ROOT ====================
Route::get('/', function () {
    return view('welcome'); // ✅ tampilkan halaman welcome
});

// ==================== AUTH ====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginProses'])->name('loginProses');
});

// ==================== PROTECTED ====================
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('user');

    // Logout POST (direkomendasikan) → setelah logout redirect ke login
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Opsional: logout via GET untuk link langsung (tidak disarankan)
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');
});