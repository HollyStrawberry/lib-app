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

Route::get('/', function () {
    return redirect()->route('book.index');
});

Route::group(['middleware' => 'auth'], function () {

    //Routing of books
    Route::get('/books',[BookController::class, 'index'])->name('book.index');
    Route::get('/books/create',[BookController::class, 'create'])->name('book.create');
    Route::get('/books/edit',[BookController::class, 'edit'])->name('book.edit');
    Route::post('/books',[BookController::class,'store'])->name('book.store');
    Route::put('/books/{book}',[BookController::class, 'update'])->name('book.update');
    Route::delete('/books/{book}',[BookController::class, 'destroy'])->name('book.delete');

//Routing users
    Route::get('/users',[UserController::class, 'index'])->name('user.index');
    Route::get('/users/create',[UserController::class, 'create'])->name('user.create');
    Route::post('/users',[UserController::class, 'store'])->name('user.store');
    Route::get('/users/edit/{user}',[UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}',[UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{user}',[UserController::class,'destroy'])->name('user.delete');

//Routing genres
    Route::get('/genres',[GenreController::class,'index'])->name('genre.index');
    Route::get('/genres/create',[GenreController::class,'create'])->name('genre.create');
    Route::get('/genres/update',[GenreController::class,'update'])->name('genre.update');
    Route::get('/genres/delete',[GenreController::class,'delete'])->name('genre.delete');
    Route::post('/genres',[GenreController::class,'store'])->name('genre.store');

});


require __DIR__.'/auth.php';

//Auth::routes();
