<?php

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

Route::post('/v1/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/v1/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('/v1/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::delete('/v1/posts/{id}', [\App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');
});
