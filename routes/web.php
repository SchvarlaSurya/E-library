<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\BookmarkController;

// Auth Routes
Route::get('/login', [AuthController::class , 'showLogin'])->name('login');
Route::post('/login', [AuthController::class , 'login']);
Route::get('/register', [AuthController::class , 'showRegister'])->name('register');
Route::post('/register', [AuthController::class , 'register']);
Route::post('/logout', [AuthController::class , 'logout'])->name('logout');
Route::view('/sso-callback', 'auth.sso-callback');

Route::get('/', [HomeController::class , 'index'])->name('home');

Route::get('/library', [BookController::class , 'index'])->name('books.library');
Route::get('/book/{id}', [BookController::class , 'show'])->name('books.show');

// Bookmark Routes
Route::post('/bookmarks/toggle', [BookmarkController::class , 'toggle'])->name('bookmarks.toggle');
Route::get('/bookmarks/count', [BookmarkController::class , 'count'])->name('bookmarks.count');
Route::get('/borrowed', [BookmarkController::class , 'index'])->name('books.borrowed');

// Profile Route
Route::view('/profile', 'profile')->name('profile');
Route::view('/upgrade', 'upgrade')->name('upgrade');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class , 'index'])->name('admin.dashboard');
    Route::post('/users/{id}/role', [AdminController::class , 'updateUserRole'])->name('admin.users.update-role');
    Route::post('/books', [AdminController::class , 'storeBook'])->name('admin.books.store');
});