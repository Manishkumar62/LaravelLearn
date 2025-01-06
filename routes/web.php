<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
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


    Route::get('/bookmark/create', [BookmarkController::class, 'create'])->name('bookmark.create');
    Route::post('/bookmark/store', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::get('/bookmark/list/{category?}', [BookmarkController::class, 'list'])->name('bookmark.list');
    Route::get('/bookmark/edit/{id}', [BookmarkController::class, 'edit'])->name('bookmark.edit');
    Route::post('/bookmark/update', [BookmarkController::class, 'update'])->name('bookmark.update');
    Route::get('/bookmark/delete/{id}', [BookmarkController::class, 'delete'])->name('bookmark.delete');

    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/list/{name?}', [CategoryController::class, 'list'])->name('category.list');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

});
