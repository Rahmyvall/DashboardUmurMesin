<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MachineController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// =====================================================
// 🔹 USER API
// =====================================================
Route::apiResource('users', UserController::class);


// =====================================================
// 🔥 MACHINE API (SESUAI DATABASE)
// =====================================================
Route::apiResource('machines', MachineController::class);


// =====================================================
// 🔹 OPTIONAL FILTER (custom endpoint)
// =====================================================

// Filter berdasarkan status
Route::get('machines/status/{status}', [MachineController::class, 'index']);


// =====================================================
// 🔹 OPTIONAL DETAIL DENGAN RELASI
// =====================================================
Route::get('machines/{id}/detail', [MachineController::class, 'show']);


// =====================================================
// 🔹 AUTH (Optional)
// =====================================================
// Route::post('login', [AuthController::class, 'login']);
// Route::post('register', [AuthController::class, 'register']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::get('profile', [AuthController::class, 'profile']);
// });


// =====================================================
// 🔹 TEST API
// =====================================================
Route::get('/ping', function () {
    return response()->json([
        'message' => 'API is working',
        'time' => now()
    ]);
});
