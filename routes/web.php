<?php

use Spatie\Permission\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::put('/admin/users/{user}/promote', [UserController::class, 'promote'])->name('admin.users.promote');
    Route::put('/admin/users/{user}/demote', [UserController::class, 'demote'])->name('admin.users.demote');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::resource('categories', CategoryController::class);
Route::resource('genres', GenreController::class);
Route::resource('authors', AuthorController::class);
Route::resource('contents', ContentController::class);

//Route::post('/contents', [ContentController::class, 'store'])->name('contents.store');
//
//Route::get('/contents', [ContentController::class, 'index'])->name('contents.index');
//Route::get('/contents/create', [ContentController::class, 'create'])->name('contents.create');
//
//Route::get('/contents/{content}/edit', [ContentController::class, 'edit'])->name('contents.edit');
//Route::patch('/contents/{content}', [ContentController::class, 'update'])->name('contents.update');
//Route::delete('/contents/{content}', [ContentController::class, 'destroy'])->name('contents.destroy');
//Route::get('/contents/{content}', [ContentController::class, 'show'])->name('contents.show');


// Authentication Routes
require __DIR__.'/auth.php';
