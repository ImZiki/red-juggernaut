<?php

use App\Http\Controllers\BandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\ConcertController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OpsController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;




//Rutas generales
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/racf', [BandController::class, 'index'])->name('racf');
Route::get('/racf/{codename}', [BandController::class, 'showMember'])->name('racf.member.show');
Route::get('/ops', [OpsController::class, 'index'])->name('ops');
Route::get('/ops/{post}', [OpsController::class, 'show'])->name('ops.show');
Route::get('/comms', [ConcertController::class, 'index'])->name('comms');
Route::get('/api/concerts', [ConcertController::class, 'getConcerts']);
Route::post('/comms', [ConcertController::class, 'handleRequestForm'])->name('concert.handleRequest');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/bio', [BandController::class, 'bio'])->name('bio');
Route::get('/skills', [BandController::class, 'skills'])->name('skills');

//Rutas de perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'dashboard'])->name('profile.dashboard');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/orderhistory', [ProfileController::class, 'showOrderHistory'])->name('profile.orderhistory');
});
//Rutas temporales de la tienda
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.show');
Route::post('/payment-intent', [OrderController::class, 'createPayment'])->name('payment.intent');
Route::post('/update-payment-status/{paymentIntentId}', [OrderController::class, 'updatePaymentStatus']);
Route::get('/order/{orderId}/success', [OrderController::class, 'showSuccess']);

Route::middleware(['auth'])->group(function() {
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
});

//Rutas del carrito
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

//Rutas para manejo de pedidos
Route::middleware('auth')->group(function () {
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
    Route::post('/orders/{order}/return-request', [OrderController::class, 'requestReturn'])->name('orders.returnRequest');
});

//Ruta regalo para Diego 😉

Route::get('/kit-prensa', function () {
    // Lanzamos la excepción 418
    throw new HttpException(418, "I'm a teapot");
});
Route::get('/about-me', function () {
    return view('aboutme');
})->name('aboutme');

require __DIR__ . '/admin.php';
require __DIR__.'/auth.php';
