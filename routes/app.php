<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/', function () {
    return redirect()->route('menu');
});

Route::get('/cart', [MenuController::class, 'cart'])->name('cart');
Route::post('/cart/add', [MenuController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [MenuController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/clear', [MenuController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/update', [MenuController::class, 'update'])->name('cart.update');

Route::get('/checkout', [MenuController::class, 'checkout'])->name('checkout');
Route::post('/checkout/store', [MenuController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{orderId}', [MenuController::class, 'orderSuccess'])->name('checkout.success');

// Admin routes
Route::middleware('role:admin')->group(function () {
    Route::resource('items', ItemController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('categories', CategoryController::class);
});

Route::middleware('role:admin|cashier|chef')->group(function () {
    Route::resource('orders', OrderController::class);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('orders/update/{order}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});
