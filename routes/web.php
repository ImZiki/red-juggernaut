<?php

use App\Http\Controllers\BandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\YoutubeController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;


//Ruta de idioma con middleware
/*Route::post('/language/change', [LanguageController::class, 'change'])
    ->name('language.change')
    ->middleware(SetLocale::class);
*/

//Rutas generales
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/racf', [BandController::class, 'index'])->name('racf');
Route::get('/ops', [YoutubeController::class, 'index'])->name('ops');
Route::get('/comms', [ConcertController::class, 'index'])->name('comms');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/bio', [BandController::class, 'bio'])->name('bio');
Route::get('/skills', [BandController::class, 'skills'])->name('skills');
Route::get('/member/{id}', [BandController::class, 'showMember'])->name('racf.member.show');

//Rutas de perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'dashboard'])->name('profile.dashboard');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/orderhistory', [ProfileController::class, 'orderhistory'])->name('profile.orderhistory');
});
//Rutas temporales de la tienda
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');
require __DIR__.'/auth.php';
