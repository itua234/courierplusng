<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return [
        'app' => 'Courier-Plus API',
        'version' => '1.0.0'
    ];
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::group([
        'prefix' => 'posts', 
        'middleware' => 'auth:sanctum'
    ], function () {
        Route::get('/', [PostController::class, 'getUserPosts'])->name('get-user-posts');
        Route::get('/{id}', [PostController::class, 'getPostById'])->name('get-post-by-id');
        Route::post('/', [PostController::class, 'store'])->name('create-post');
        Route::put('/{id}', [PostController::class, 'update'])->name('update-post');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('delete-post');
    });
});