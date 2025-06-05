<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsfeedController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/home', [HomeController::class, 'index']);
Route::resource('newsfeeds', NewsfeedController::class);
Route::get('/home', [HomeController::class, 'index'])->name('home');