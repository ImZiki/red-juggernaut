<?php
// En routes/web.php o routes/admin.php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\IsAdminOrSuperAdmin;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'can:accessAdminPanel'])->group(function () {
    //Rutas de administración
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.index');

    //Rutas de administracion de conciertos
    Route::get('/admin/concerts', [ConcertController::class, 'adminIndex'])->name('admin.concerts');
    Route::get('/admin/concerts/create', [ConcertController::class, 'create'])->name('admin.concerts.create');
    Route::post('/admin/concerts', [ConcertController::class, 'store'])->name('admin.concerts.store');
    Route::get('/admin/concerts/{concert}/edit', [ConcertController::class, 'edit'])->name('admin.concerts.edit');
    Route::put('/admin/concerts/{concert}', [ConcertController::class, 'update'])->name('admin.concerts.update');
    Route::delete('/admin/concerts/{concert}', [ConcertController::class, 'destroy'])->name('admin.concerts.destroy');

    //Rutas de administracion de productos de la tienda
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::put('/admin/products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('admin.products.toggleFeatured');
    Route::put('/admin/products/{product}/toggle-active', [ProductController::class, 'toggleActive'])->name('admin.products.toggleActive');

    Route::prefix('admin')->middleware(['auth', isAdminOrSuperAdmin::class])->group(function () {
        Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::patch('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
        Route::patch('orders/{order}/approve-return', [AdminOrderController::class, 'approveReturn'])->name('admin.orders.approveReturn');
        Route::patch('orders/{order}/reject-return', [AdminOrderController::class, 'rejectReturn'])->name('admin.orders.rejectReturn');
    });
});
