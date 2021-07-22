<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LibraryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    // Books
    Route::prefix('books')->group(function () {
        Route::get('/search', [BookController::class, 'search']);
    });
    Route::resource('books', BookController::class);

    // Authors
    Route::prefix('authors')->group(function () {
        Route::get('/search', [AuthorController::class, 'search']);
    });
    Route::resource('authors', AuthorController::class);

    // Libraries
    Route::prefix('libraries')->group(function () {
        Route::get('/search', [LibraryController::class, 'search']);
    });
    Route::resource('libraries', LibraryController::class);
});
