<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::post('/', [AuthController::class, 'login'])->name('auth.login');

Route::middleware('isAuth')->group(function () {
    Route::middleware('isAdmin')->group(function () {
        Route::prefix('/role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('role.index');
            Route::post('/', [RoleController::class, 'store'])->name('role.store');
            Route::get('/create', [RoleController::class, 'create'])->name('role.create');
            Route::get('/{id}', [RoleController::class, 'show'])->name('role.show');
            Route::put('/{id}', [RoleController::class, 'update'])->name('role.update');
            Route::delete('/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        });

        Route::prefix('/user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::post('/', [UserController::class, 'store'])->name('user.store');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
            Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        });
    });

    Route::prefix('/post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::post('/', [PostController::class, 'store'])->name('post.store');
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::get('/{id}', [PostController::class, 'show'])->name('post.show');
        Route::put('/{id}', [PostController::class, 'update'])->name('post.update');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
