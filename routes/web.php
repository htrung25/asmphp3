<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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






