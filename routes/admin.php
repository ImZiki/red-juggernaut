<?php
// En routes/web.php o routes/admin.php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminConcertController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'can:accessAdminPanel'])->group(function () {
    //Rutas de administración
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.index');

    //Rutas de administracion de conciertos
    Route::get('admin/concerts/', [AdminConcertController::class, 'index'])->name('admin.concerts.index');
    Route::get('admin/concerts/create', [AdminConcertController::class, 'create'])->name('admin.concerts.create');
    Route::post('admin/concerts/store', [AdminConcertController::class, 'store'])->name('admin.concerts.store');
    Route::post('admin/concerts/request/{request}/accept', [AdminConcertController::class, 'acceptRequest'])->name('admin.concerts.acceptRequest');
    Route::get('admin/concerts/request/{request}/accept', [AdminConcertController::class, 'acceptRequestForm'])->name('admin.concerts.acceptRequestForm');
    Route::put('admin/concerts/request/{request}/reject', [AdminConcertController::class, 'rejectRequest'])->name('admin.concerts.rejectRequest');

    //Rutas de administracion de productos de la tienda
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::put('/admin/products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('admin.products.toggleFeatured');
    Route::put('/admin/products/{product}/toggle-active', [ProductController::class, 'toggleActive'])->name('admin.products.toggleActive');
    //Rutas de administracion de pedidos
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    //Rutas de administracion de posts

    Route::get('/admin/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
});
