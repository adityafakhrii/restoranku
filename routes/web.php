<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('items', ItemController::class);
Route::resource('orders', OrderController::class);
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('categories', CategoryController::class);
