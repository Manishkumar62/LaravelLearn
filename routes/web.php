<?php

use App\Http\Controllers\BookmarkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/bookmark/create', [BookmarkController::class, 'create'])->name('bookmark.create');
Route::post('/bookmark/store', [BookmarkController::class, 'store'])->name('bookmark.store');
Route::get('/bookmark/list/{category?}', [BookmarkController::class, 'list'])->name('bookmark.list');
Route::get('/bookmark/edit/{id}', [BookmarkController::class, 'edit'])->name('bookmark.edit');
Route::post('/bookmark/update', [BookmarkController::class, 'update'])->name('bookmark.update');
Route::get('/bookmark/delete/{id}', [BookmarkController::class, 'delete'])->name('bookmark.delete');
