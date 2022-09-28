<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//User / Profile
Route::middleware('auth')->group(function () {
    Route::get('logout', [UserController::class , 'logout'])->name('logout');
    Route::get('profile', [UserController::class , 'getProfile'])->name('profile');
    // Route::get('borrow/{id}', [BooksController::class , 'getBookBorrow'])->name('book.borrow');
    // Route::get('order/cancel/{id}', [BooksController::class , 'getCancelOrder'])->name('book.borrow.cancel');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
