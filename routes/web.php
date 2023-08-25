<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', 'MainController@index')->name('main.index');

//Routing of books
Route::get('/books','BookController@index')->name('book.index');
Route::get('/books/create','BookController@create')->name('book.create');
Route::post('/books','BookController@store')->name('book.store');

Route::get('/books/update','BookController@update');
Route::get('/books/delete','BookController@delete');

//Routing users
Route::get('/users','UserController@index')->name('user.index');
Route::get('/users/create','UserController@create')->name('user.create');
Route::post('/users','UserController@store')->name('user.store');

//Routing genres
Route::get('/genres','GenreController@index')->name('genre.index');
Route::get('/genres/create','GenreController@create')->name('genre.create');
Route::post('/genres','GenreController@store')->name('genre.store');

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
