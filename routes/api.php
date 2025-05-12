<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContentApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\GenreApiController;
use App\Http\Controllers\Api\AuthorApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/categories', CategoryApiController::class);
    Route::apiResource('/genres', GenreApiController::class);
    Route::apiResource('/authors', AuthorApiController::class);
    Route::apiResource('/contents', ContentApiController::class);

    Route::get('/api/users', [UserApiController::class, 'index']);
    Route::put('/api/users/{user}/promote', [UserApiController::class, 'promote']);
    Route::put('/api/users/{user}/demote', [UserApiController::class, 'demote']);
    Route::delete('/api/users/{user}', [UserApiController::class, 'destroy']);
});

// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);

//Route::get('/categories', [CategoryApiController::class, 'index']);
//Route::get('/genres', [GenreApiController::class, 'index']);
//Route::get('/authors', [AuthorApiController::class, 'index']);
//Route::get('/contents', [ContentApiController::class, 'index']);
