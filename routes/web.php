<?php

use App\Models\Newsfeed;
use App\Models\NewsItem;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsfeedController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home'); 
})->name('home');

//Route::get('/morenews', function () {
  //  return view('morenews'); 
//})->name('morenews');

Route::get('/morenews', function () {
    $newsItems = NewsItem::orderBy('date', 'desc')->get();
    return view('morenews', compact('newsItems'));
});

Route::get('/sign-in', function () {
    return view('sign-in'); 
})->name('sign-in');

Route::get('/blog', function () {
    $newsfeeds = Newsfeed::all(); 
    return view('blog', compact('newsfeeds')); 
})->name('blog');

Route::get('/contact-us', function () {
    return view('contact-us'); 
})->name('contact-us'); 

Route::get('/admin', function () {
    return view('Components.Admin.signIn.news'); 
})->name('admin'); 

Route::resource('newsfeeds', NewsfeedController::class);