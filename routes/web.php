<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ProductController;


// Trang khách hàng
Route::get('/', function () {
    return view('client.home');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])
     ->name('products.index');   // Thêm dòng này là hết lỗi ngay
     
Route::get('/products/{product}', [ProductController::class, 'show'])
     ->name('products.show');    // Nếu sau này có trang chi tiết

Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');