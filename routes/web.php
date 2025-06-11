<?php

use App\Models\Newsfeed;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsfeedController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/morenews', function () {
    $newsfeeds = Newsfeed::all(); // Fetch the newsfeeds from the database
    return view('morenews', compact('newsfeeds')); // Pass the variable to the view
})->name('morenews');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('newsfeeds', NewsfeedController::class);