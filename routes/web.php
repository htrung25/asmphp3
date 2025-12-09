<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;


// Trang khách hàng
Route::get('/', function () {
    $categories = \App\Models\Category::orderBy('name')->get();

    // Hot products: top 6 by views
    try {
        $hotProducts = \App\Models\Product::orderBy('views', 'desc')->take(6)->get();
    } catch (\Throwable $e) {
        // In case the migration hasn't been run yet, fallback to price
        $hotProducts = \App\Models\Product::orderBy('price', 'desc')->take(6)->get();
    }
    // Cheapest products: bottom 6 by price
    $cheapProducts = \App\Models\Product::orderBy('price', 'asc')->take(6)->get();

    return view('client.home', compact('categories', 'hotProducts', 'cheapProducts'));
})->name('home');

Route::get('/products', [ProductController::class, 'index'])
     ->name('products.index');   // Thêm dòng này là hết lỗi ngay
     
Route::get('/products/{product}', [ProductController::class, 'show'])
     ->name('products.show');    // Nếu sau này có trang chi tiết

// Cart routes (require authentication)
use App\Http\Controllers\CartController;
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

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

Route::prefix('admin')->middleware(['auth'])->as('admin.')->group(function () {
    // Admin dashboard
    Route::get('/', function () {
        $user = Auth::user();
        if (! $user || ! $user->hasRole('admin')) {
            abort(403);
        }

        $productsCount = \App\Models\Product::count();
        $categoriesCount = \App\Models\Category::count();
        $usersCount = \App\Models\User::count();

        return view('admin.dashboard', compact('productsCount', 'categoriesCount', 'usersCount'));
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/toggle', [UserController::class, 'toggleActive'])->name('users.toggle');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    // Admin product management
    Route::resource('/products', AdminProductController::class)->except(['show']);
    // Admin category management
    Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
});