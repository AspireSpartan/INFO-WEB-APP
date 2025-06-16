<?php

use App\Models\Newsfeed;
use App\Models\NewsItem;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsfeedController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('/User_Side_Screen.home'); 
})->name('home');

//Route::get('/morenews', function () {
  //  return view('morenews'); 
//})->name('morenews');

Route::get('/morenews', function () {
    $newsItems = NewsItem::orderBy('date', 'desc')->get();
    return view('/User_Side_Screen.morenews', compact('newsItems'));
});

Route::get('/sign-in', function () {
    return view('sign-in'); 
})->name('sign-in');

Route::get('/blog', function () {
    $newsfeeds = Newsfeed::all(); 
    return view('/User_Side_Screen.blog', compact('newsfeeds')); 
})->name('blog');

Route::get('/admin', function () {
    return view('/Admin_Side_Screen.Admin-Dashboard'); 
})->name('admin');

Route::get('/logout', function () {
    return redirect('/sign-in')->with('status', 'You have been logged out.');
})->name('logout');

Route::get('/contact-us', function () {
    return view('/User_Side_Screen.contact-us'); 
})->name('contact-us'); 

Route::resource('newsfeeds', NewsfeedController::class);

Route::get('/admin', [NewsController::class, 'showNews'])->name('admin');