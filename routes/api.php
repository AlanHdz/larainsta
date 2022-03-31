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

Route::prefix('v1')->group(function () {
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
        Route::delete('/posts/{id}', [\App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');

        Route::post('/friendships/{id}/follow', [\App\Http\Controllers\FriendshipController::class, 'followUser'])->name('follow.user');
        Route::post('/friendships/{id}/unfollow', [\App\Http\Controllers\FriendshipController::class, 'unfollowUser'])->name('unfollow.user');
        Route::post('/refresh', [\App\Http\Controllers\AuthController::class, 'refresh'])->name('refresh');
        Route::get('/feed', [\App\Http\Controllers\FeedController::class, 'getFeed'])->name('user.feed');
    });
});
