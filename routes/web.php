<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => []], function () {
    Route::group([
        'prefix' => 'admin'
    ], function () {
        Route::get('/', function () {
            return view('welcome to admin page');
        });
        Route::get('/posts', function () {
            return \App\Models\Post::all();
            return 'This is th posts page';
        });
        // Route::get('/', [AdminController::class, 'index']);
        // Route::get('/users', [AdminController::class, 'fetchUsers']);
        // Route::get('/posts', [AdminController::class, 'fetchPosts']);
    });
});