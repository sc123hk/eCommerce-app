<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PayPalController;

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

// Route::get('/', function () {
//     return view('layouts.guest');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::get('/{suffix?}', function () {
    return redirect('/listings/All');
})->whereIn('suffix',['listings']);

Route::get('/listings/{category?}/{title?}',[ListingController::class, 'read'])->name('listing.read');

Route::middleware('auth')->group(function () {

    Route::get('/order', [OrderController::class, 'read'])->name('order.read');

    Route::post('/order', [OrderController::class, 'update'])->name('order.update');

    Route::get('/cart', [CartController::class, 'read'])->name('cart.read');

    Route::post('/cart', [CartController::class, 'update'])->name('cart.update');

    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::post('/listings/{category}/{title}', [CartController::class, 'create'])->name('cart.create');

    Route::post('/paypal/pay', [PayPalController::class, 'pay'])->name('paypal.pay');

    Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');
    
    Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');

});

Route::middleware('admin')->group(function () {

    Route::get('/admin', [AdminController::class, 'read'])->name('admin.read');

    Route::post('/admin', [AdminController::class, 'create'])->name('admin.create');

    Route::delete('/admin', [AdminController::class, 'delete'])->name('admin.delete');

    Route::patch('/admin', [AdminController::class, 'update'])->name('admin.update');
    
});












