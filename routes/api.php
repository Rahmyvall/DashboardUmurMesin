<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MachineController;
use App\Http\Controllers\Api\MachineUsageApiController;
use App\Http\Controllers\Api\MaintenanceApiController;   // ← Tambahan Baru
use App\Http\Controllers\Api\MaintenanceScheduleApiController;
use App\Http\Controllers\MachineConditionController;

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
// 🔥 MACHINE API
// =====================================================
Route::apiResource('machines', MachineController::class);


// =====================================================
// 🔥 MACHINE USAGE API
// =====================================================
Route::apiResource('machine-usage', MachineUsageApiController::class);




// =====================================================
// 🔹 OPTIONAL FILTER & CUSTOM ENDPOINT
// =====================================================

// Filter machine berdasarkan status
Route::get('machines/status/{status}', [MachineController::class, 'index']);

// Filter usage berdasarkan machine
Route::get('machine-usage/machine/{machine_id}', [MachineUsageApiController::class, 'index']);

// Filter usage berdasarkan tanggal
Route::get('machine-usage/date', [MachineUsageApiController::class, 'index']);


// =====================================================
// 🔹 OPTIONAL DETAIL DENGAN RELASI
// =====================================================
Route::get('machines/{id}/detail', [MachineController::class, 'show']);
Route::get('machine-usage/{id}/detail', [MachineUsageApiController::class, 'show']);


Route::apiResource('maintenance', MaintenanceApiController::class);

// =====================================================
// 🔹 AUTH (Optional)
// =====================================================
// Route::post('login', [AuthController::class, 'login']);
// Route::post('register', [AuthController::class, 'register']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::get('profile', [AuthController::class, 'profile']);
// });

Route::prefix('maintenance-schedules')->group(function () {

    Route::get('/', [MaintenanceScheduleApiController::class, 'index']);
    Route::post('/', [MaintenanceScheduleApiController::class, 'store']);

    Route::get('/upcoming', [MaintenanceScheduleApiController::class, 'upcoming']);

    Route::get('{maintenance_schedule}', [MaintenanceScheduleApiController::class, 'show']);
    Route::put('{maintenance_schedule}', [MaintenanceScheduleApiController::class, 'update']);
    Route::delete('{maintenance_schedule}', [MaintenanceScheduleApiController::class, 'destroy']);

    // Complete Maintenance
    Route::post('{maintenance_schedule}/complete', [MaintenanceScheduleApiController::class, 'complete']);
});
// =====================================================
// 🔹 TEST API
// =====================================================
Route::get('/ping', function () {
    return response()->json([
        'message' => 'API is working',
        'time' => now()
    ]);
});
