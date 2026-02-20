<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserController::class, 'getUser']);
Route::post('/user', [UserController::class, 'createUser']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/post', [PostController::class, 'listPost']);
Route::get('/post/:id', [PostController::class, 'getById']);
Route::post('/post', [PostController::class, 'createPost']);
Route::patch('/post', [PostController::class, 'updatePost']);
Route::delete('/post', [PostController::class, 'deletePost']);

