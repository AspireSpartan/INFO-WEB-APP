<?php

use App\Models\Newsfeed;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsfeedController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home'); 
})->name('home');

Route::get('/morenews', function () {
    return view('morenews'); 
})->name('morenews');

Route::get('/sign-in', function () {
    return view('sign-in'); 
})->name('sign-in');

Route::get('/blog', function () {
    $newsfeeds = Newsfeed::all(); 
    return view('blog', compact('newsfeeds')); 
})->name('blog');

Route::get('/admin', function () {
    return view('Components.Admin.signIn.news'); 
})->name('admin'); 

Route::get('/contact-us', function () {
    $newsfeeds = Newsfeed::all(); 
    return view('contact-us'); 
})->name('contact-us');

Route::resource('newsfeeds', NewsfeedController::class);