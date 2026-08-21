<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\MasyarakatController;
use App\Http\Controllers\Api\SupirController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Ambulans Siaga Mobile App (Masyarakat & Supir)
|--------------------------------------------------------------------------
*/

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/app-config', [GeneralController::class, 'getAppConfig']);
Route::get('/rumahsakit', [MasyarakatController::class, 'getRumahSakit']);

// Protected Routes (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Auth & Profile
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/profile/update', [AuthController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Notifications
    Route::get('/notifications', [GeneralController::class, 'getNotifications']);
    Route::post('/notifications/read-all', [GeneralController::class, 'markAsRead']);
    Route::post('/notifications/{id}/read', [GeneralController::class, 'markAsRead']);

    // -------------------------------------------------------------
    // MODUL MASYARAKAT / CITIZEN API
    // -------------------------------------------------------------
    Route::prefix('masyarakat')->group(function () {
        Route::post('/orders', [MasyarakatController::class, 'createOrder']);
        Route::get('/orders/active', [MasyarakatController::class, 'getActiveOrder']);
        Route::get('/orders', [MasyarakatController::class, 'getOrders']);
        Route::get('/orders/{id}', [MasyarakatController::class, 'getOrderDetail']);
        Route::post('/orders/{id}/complete-form', [MasyarakatController::class, 'completeForm']);
        Route::post('/orders/{id}/rating', [MasyarakatController::class, 'submitRating']);
        Route::post('/orders/{id}/cancel', [MasyarakatController::class, 'cancelOrder']);
        Route::get('/donasi', [MasyarakatController::class, 'getDonasi']);
    });

    // -------------------------------------------------------------
    // MODUL SUPIR / DRIVER API
    // -------------------------------------------------------------
    Route::prefix('supir')->group(function () {
        Route::get('/dashboard', [SupirController::class, 'dashboard']);
        Route::post('/status-online', [SupirController::class, 'toggleStatusOnline']);
        Route::get('/tugas', [SupirController::class, 'getTasks']);
        Route::post('/tugas/{id}/accept', [SupirController::class, 'acceptTask']);
        Route::post('/tugas/{id}/reject', [SupirController::class, 'rejectTask']);
        Route::get('/trip/active', [SupirController::class, 'getActiveTrip']);
        Route::post('/trip/{id}/update-status', [SupirController::class, 'updateTripStatus']);
        Route::post('/location', [SupirController::class, 'updateLocation']);
        Route::get('/riwayat', [SupirController::class, 'getTripHistory']);
    });
});
