<?php

use App\Http\Controllers\BandController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\YoutubeController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

//Ruta de idioma con middleware
Route::post('/language/change', [LanguageController::class, 'change'])
    ->name('language.change')
    ->middleware(SetLocale::class);
Route::get('/test-session', function () {
    session(['test_key' => 'Hello, session!']);
    return session('test_key');
});
//Rutas generales
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/banda', [BandController::class, 'index'])->name('banda');
Route::get('/videos', [YoutubeController::class, 'index'])->name('videos');
Route::get('/conciertos', [ConcertController::class, 'index'])->name('conciertos');
Route::get('/tienda', [ShopController::class, 'index'])->name('tienda');


//Rutas de perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'dashboard'])->name('profile.dashboard');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
