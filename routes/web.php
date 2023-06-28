<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.guest');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect('/All');
    });

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');

    Route::post('/order', [OrderController::class, 'update'])->name('order.update');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart', [CartController::class, 'update'])->name('cart.update');

    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::post('/cart/checkout', [CartController::class, 'purchase'])->name('cart.purchase');

    Route::get('/{category}', [ListingController::class, 'filter'])->name('listing.filter');

    Route::get('/{category}/{id}',[ListingController::class, 'show'])->name('listing.show');

    Route::get('/{category}/{id}/store', [CartController::class, 'store'])->name('cart.store');

});











