<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContentApiController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;

Route::middleware('auth:sanctum')->group(function () {
Route::apiResource('categories', CategoryController::class);
Route::apiResource('genres', GenreController::class);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('contents', ContentApiController::class);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
