<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AuthorApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ContentApiController;
use App\Http\Controllers\Api\GenreApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryApiController::class);
    Route::apiResource('genres', GenreApiController::class);
    Route::apiResource('authors', AuthorApiController::class);
    Route::apiResource('contents', ContentApiController::class);

    Route::get('/api/users', [UserApiController::class, 'index']);
    Route::put('/api/users/{user}/promote', [UserApiController::class, 'promote']);
    Route::put('/api/users/{user}/demote', [UserApiController::class, 'demote']);
    Route::delete('/api/users/{user}', [UserApiController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('categories', CategoryController::class)->except(['index', 'show']);
    Route::resource('genres', GenreController::class)->except(['index', 'show']);
    Route::resource('authors', AuthorController::class)->except(['index', 'show']);
    Route::resource('contents', ContentController::class)->except(['index', 'show']);

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::put('/admin/users/{user}/promote', [UserController::class, 'promote'])->name('admin.users.promote');
    Route::put('/admin/users/{user}/demote', [UserController::class, 'demote'])->name('admin.users.demote');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::resource('categories', CategoryController::class)->only(['index', 'show']);
Route::resource('genres', GenreController::class)->only(['index', 'show']);
Route::resource('authors', AuthorController::class)->only(['index', 'show']);
Route::resource('contents', ContentController::class)->only(['index', 'show']);

// Authentication Routes
require __DIR__.'/auth.php';
