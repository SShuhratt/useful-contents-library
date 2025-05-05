<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContentApiController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\AuthorController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/genres', GenreController::class);
    Route::apiResource('/authors', AuthorController::class);
    Route::apiResource('/contents', ContentApiController::class);
});

// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/contents', [ContentApiController::class, 'index']);
