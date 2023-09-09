<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:sanctum', 'namespace' => 'API'], function () {
    Route::put('/books/{book}',[App\Http\Controllers\API\BookApiController::class,'update']);
    Route::delete('/books/{book}',[App\Http\Controllers\API\BookApiController::class,'destroy']);

    Route::put('/users/',[App\Http\Controllers\API\UserApiController::class,'update']);
});

Route::get('/books',[App\Http\Controllers\API\BookApiController::class,'index']);
Route::get('/books/{book}',[App\Http\Controllers\API\BookApiController::class,'show']);

Route::get('/users',[App\Http\Controllers\API\UserApiController::class,'index']);
Route::get('/users/{user}',[App\Http\Controllers\API\UserApiController::class,'show']);

Route::get('/genres',[App\Http\Controllers\API\GenreApiController::class,'index']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



