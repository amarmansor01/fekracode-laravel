<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\UserApiController;

use App\Http\Controllers\NotificationController;

use App\Http\Controllers\Api\ReportController;

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');

// مدير
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('api-users', UserApiController::class);
    Route::apiResource('api-products', ProductApiController::class);
    Route::apiResource('api-orders', OrderApiController::class);
    Route::apiResource('api-clients', ClientApiController::class);
});

// موظف
Route::middleware(['auth:sanctum', 'role:employee'])->group(function () {
    Route::apiResource('api-orders', OrderApiController::class);
});

// زبون
Route::middleware(['auth:sanctum', 'role:client'])->group(function () {
    Route::get('api-products', [ProductApiController::class, 'index']);
    Route::post('api-orders', [OrderApiController::class, 'store']);
     Route::get('client-orders/my', [OrderApiController::class, 'myOrders']);
});



// مدير
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('notifications/unread', [NotificationController::class, 'unread']);
    Route::post('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::get('/reports', [ReportController::class, 'index']);

});

// موظف
Route::middleware(['auth:sanctum', 'role:employee'])->group(function () {
    Route::get('employee-notifications', [NotificationController::class, 'index']);
    Route::get('employee-notifications/unread', [NotificationController::class, 'unread']);
    Route::post('employee-notifications/{id}/read', [NotificationController::class, 'markAsRead']);
});

