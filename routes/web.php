<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MachineUsageController;
use App\Http\Controllers\MaintenanceController;
use Illuminate\Support\Facades\Route;

// ==================== ROOT ====================
Route::get('/', function () {
    return view('welcome');
});

// ==================== AUTH ====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginProses'])->name('loginProses');
});

// ==================== PROTECTED ====================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ USERS (FULL CRUD)
    Route::resource('user', UserController::class);

    Route::resource('location', LocationController::class);

    Route::resource('machine', MachineController::class);

    Route::resource('machine-usage', MachineUsageController::class);

    Route::resource('maintenance', MaintenanceController::class);

    Route::get('/maintenance/print', [MaintenanceController::class, 'print'])
     ->name('maintenance.print');


    // ✅ PRINT USERS
    Route::get('/user/print', [UserController::class, 'print'])->name('user.print');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // (opsional)
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');
});