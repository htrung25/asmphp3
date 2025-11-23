<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

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
//     return view('welcome');
// });

Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::get('/categories/{categoryId}/books', [BookController::class, 'listByCategory'])->name('books.list');
Route::get('/search', [BookController::class, 'search'])->name('books.search');
Route::get('/books/category/{id}', [BookController::class, 'listByCategory'])->name('books.list');
Route::get('/books', [BookController::class, 'showAll'])->name('books.listall');
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('/gio-hang/them/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/gio-hang/xoa/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/gio-hang/cap-nhat', [CartController::class, 'update'])->name('cart.update');
Route::post('/gio-hang/xoa-het', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/tat-ca-sach', [BookController::class, 'showAll'])->name('books.all');





