<?php
// En routes/web.php o routes/admin.php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ConcertController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'can:accessAdminPanel'])->group(function () {
    //Rutas de administración
    //Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    //Rutas de administracion de usuarios
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

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

});
