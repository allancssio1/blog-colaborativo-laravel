<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ValidateToken;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
  Route::post('/register', [AuthController::class, 'register']);
  Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('post')->group(function() {
  Route::get('/{id}', [PostController::class, 'getById']);
  Route::get('/', [PostController::class, 'listPost']);
  
  Route::middleware([ValidateToken::class])->group(function() {
    Route::post('/', [PostController::class, 'createPost']);
    Route::patch('/{id}', [PostController::class, 'updatePost']);
    Route::delete('/{id}', [PostController::class, 'deletePost']);
  });
});