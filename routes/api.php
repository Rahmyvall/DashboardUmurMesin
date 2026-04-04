<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini kita definisikan semua route API untuk aplikasi.
| Menggunakan apiResource untuk CRUD users.
|
*/

// Route CRUD Users
Route::apiResource('users', UserController::class);

/*
| Optional: Contoh Auth Routes (jika menggunakan Sanctum/JWT)
| Route::post('login', [AuthController::class, 'login']);
| Route::post('register', [AuthController::class, 'register']);
| Route::middleware('auth:sanctum')->group(function () {
|     Route::post('logout', [AuthController::class, 'logout']);
|     Route::get('profile', [AuthController::class, 'profile']);
| });
*/

/*
| Test route to check API working
*/
Route::get('/ping', function () {
    return response()->json(['message' => 'API is working']);
});
