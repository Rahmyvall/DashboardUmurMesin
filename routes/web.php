<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\MachineUsageController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MaintenanceScheduleController;
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

   Route::resource('maintenance-schedule', MaintenanceScheduleController::class);

   // Web Routes
    Route::resource('alerts', AlertController::class);

    
    Route::post('alerts/{alert}/read', [AlertController::class, 'markAsRead'])->name('alerts.read');
    Route::post('alerts/{alert}/resolve', [AlertController::class, 'markAsResolved'])->name('alerts.resolve');

   // Form Complete (GET)
    Route::get('maintenance-schedule/{maintenance_schedule}/complete',
        [MaintenanceScheduleController::class, 'showCompleteForm'])
        ->name('maintenance-schedule.complete.form');

    // Proses Complete (POST)
    Route::post('maintenance-schedule/{maintenance_schedule}/complete',
        [MaintenanceScheduleController::class, 'complete'])
        ->name('maintenance-schedule.complete');
    // ✅ PRINT USERS
    Route::get('/user/print', [UserController::class, 'print'])->name('user.print');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // (opsional)
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');
});