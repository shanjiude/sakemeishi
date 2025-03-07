<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FollowlistController;
use App\Http\Controllers\RakutenController;
use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'show'])->name('account'); // 自分のプロフィール
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit'); // プロフィール編集
    Route::patch('/account/update', [AccountController::class, 'update'])->name('account.update');
    Route::patch('/account/icon-upload', [AccountController::class, 'uploadIcon'])->name('account.icon.upload');
    Route::get('/account/{user}', [AccountController::class, 'showOther'])->name('account.showOther'); // 他人のプロフィール
    Route::get('/followlist', [FollowlistController::class, 'index'])->name('followlist.index');
});

Route::get('/search', [AccountController::class, 'searchForm'])->name('account.search');
Route::post('/search', [AccountController::class, 'search'])->name('account.search.post');

Route::post('/follow/{userId}', [FriendController::class, 'toggleFollow'])->name('follow.toggle');

Route::get('/rakuten', [RakutenController::class, 'search'])->name('rakuten.search');
Route::post('/rakuten/save', [RakutenController::class, 'saveFavorite'])->name('rakuten.save');
Route::delete('/rakuten/{drink}', [RakutenController::class, 'destroy'])->name('rakuten.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
