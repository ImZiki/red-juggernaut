<?php
// En routes/web.php o routes/admin.php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware(CheckAdmin::class)->group(function () {
    // Tus rutas de administración aquí
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});
