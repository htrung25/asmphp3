<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;


// Trang khách hàng
Route::get('/', function () {
    return view('client.home');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])
     ->name('products.index');   // Thêm dòng này là hết lỗi ngay
     
Route::get('/products/{product}', [ProductController::class, 'show'])
     ->name('products.show');    // Nếu sau này có trang chi tiết

// Breeze đã tạo sẵn, chỉ cần khai báo lại tên route cho chắc ăn
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
    ->middleware('guest');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/purchase-history', [ProfileController::class, 'purchaseHistory'])->name('profile.purchase-history');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->as('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/toggle', [UserController::class, 'toggleActive'])->name('users.toggle');
});