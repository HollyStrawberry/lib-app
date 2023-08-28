<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

//Routing of books
Route::get('/books',[BookController::class, 'index'])->name('book.index');
Route::get('/books/create',[BookController::class, 'create'])->name('book.create');
Route::post('/books',[BookController::class, 'store'])->name('book.store');
Route::get('/books/update',[BookController::class, 'update'])->name('book.update');
Route::get('/books/delete',[BookController::class, 'delete'])->name('book.delete');

//Routing users
Route::get('/users',[UserController::class, 'index'])->name('user.index');
Route::get('/users/create',[UserController::class, 'create'])->name('user.create');
Route::post('/users',[UserController::class, 'store'])->name('user.store');

//Routing genres
Route::get('/genres',[GenreController::class,'index'])->name('genre.index');
Route::get('/genres/create',[GenreController::class,'create'])->name('genre.create');
Route::post('/genres',[GenreController::class,'store'])->name('genre.store');

//Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Auth::routes();
