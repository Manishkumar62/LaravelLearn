<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('bookmark.list');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // Admin-only routes
    Route::middleware('role:Admin')->group(function () {
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('/bookmark/list/{category?}', [BookmarkController::class, 'list'])->name('bookmark.list');
        Route::get('/bookmark/create', [BookmarkController::class, 'create'])->name('bookmark.create');
        Route::post('/bookmark/store', [BookmarkController::class, 'store'])->name('bookmark.store');
        Route::get('/bookmark/edit/{id}', [BookmarkController::class, 'edit'])->name('bookmark.edit');
        Route::post('/bookmark/update', [BookmarkController::class, 'update'])->name('bookmark.update');
        Route::get('/user/list/{name?}', [UserController::class, 'list'])->name('user.list');
        Route::post('/assign-role', [UserController::class, 'assignRole'])->name('assign.role');

        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/role/list', [RoleController::class, 'list'])->name('role.list');
    });

    // Admin and Editor routes (no delete access for Editor)
    Route::middleware('role:Admin,Editor')->group(function () {
        Route::get('/category/list/{name?}', [CategoryController::class, 'list'])->name('category.list');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    });

    // Editor-only routes
    Route::middleware('role:Editor')->group(function () {



    });

    // Prevent Editor from deleting bookmarks
    Route::middleware('role:Admin')->group(function () {
        Route::get('/bookmark/delete/{id}', [BookmarkController::class, 'delete'])->name('bookmark.delete');
    });


    // All routes for bookmarks and categories
    // Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    // Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    // Route::get('/category/list/{name?}', [CategoryController::class, 'list'])->name('category.list');
    // Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    // Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    // Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // Route::get('/bookmark/create', [BookmarkController::class, 'create'])->name('bookmark.create');
    // Route::post('/bookmark/store', [BookmarkController::class, 'store'])->name('bookmark.store');
    // Route::get('/bookmark/list/{category?}', [BookmarkController::class, 'list'])->name('bookmark.list');
    // Route::get('/bookmark/edit/{id}', [BookmarkController::class, 'edit'])->name('bookmark.edit');
    // Route::post('/bookmark/update', [BookmarkController::class, 'update'])->name('bookmark.update');
    // Route::get('/bookmark/delete/{id}', [BookmarkController::class, 'delete'])->name('bookmark.delete');
});
