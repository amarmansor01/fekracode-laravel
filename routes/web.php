<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;


use App\Http\Controllers\ShopController;

use App\Http\Controllers\ServiceController;


use App\Http\Middleware\RoleMiddleware;

use App\Http\Controllers\WebNotificationController;

use App\Http\Controllers\ContactController;

use App\Http\Controllers\Admin\ServiceController as AdminServiceController;

use App\Http\Controllers\Admin\UserController;


Auth::routes();


Route::get('/services', function () {
    return view('services.index');
});
Route::get('/', [ServiceController::class, 'index'])->name('home');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('service');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications/{id}', [App\Http\Controllers\NotificationController::class, 'read'])->name('notifications.read');
// routes/web.php
Route::view('/about', 'about')->name('about');




Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('services', AdminServiceController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->names([
        'index'   => 'admin.products.index',
        'create'  => 'admin.products.create',
        'store'   => 'admin.products.store',
        'edit'    => 'admin.products.edit',
        'update'  => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
    Route::get('reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.reports');
});



Route::middleware(['auth', 'role:employee'])->prefix('employee')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.dashboard');
    Route::get('/orders', [\App\Http\Controllers\Employee\OrderController::class, 'index'])->name('employee.orders.index');
    Route::get('/orders/{order}/edit', [\App\Http\Controllers\Employee\OrderController::class, 'edit'])->name('employee.orders.edit');
    Route::put('/orders/{order}', [\App\Http\Controllers\Employee\OrderController::class, 'update'])->name('employee.orders.update');
});


Route::middleware(['auth', 'role:employee'])->prefix('admin')->group(function () {
    Route::resource('orders', OrderController::class);
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::post('/client/orders', [OrderController::class, 'storeFromClient'])->name('client.orders.store');
    Route::get('/client/orders', [OrderController::class, 'clientOrders'])->name('client.orders.index');

});





