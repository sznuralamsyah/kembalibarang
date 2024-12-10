<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClosedCaseController;
use App\Http\Controllers\LeaderboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('category', CategoryController::class)->except('show');
    Route::get('leaderboard', LeaderboardController::class)->name('leaderboard');
    Route::resource('item', ItemController::class);
    Route::post('item/{item}/founded', [ItemController::class, 'founded'])->name('item.founded');
    Route::post('item/{item}/done', [ItemController::class, 'done'])->name('item.done');
    Route::post('item/{item}/owner-founded', [ItemController::class, 'ownerFounded'])->name('item.owner-founded');
});
