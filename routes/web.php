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

Route::get('/morenews', function () {
    $newsItems = NewsItem::orderBy('date', 'desc')->get();
    return view('/User_Side_Screen.morenews', compact('newsItems'));
})->name('morenews'); // Added a name for easier referencing

Route::get('/sign-in', function () {
    return view('sign-in');
})->name('sign-in');

Route::get('/blog', function () {
    $newsfeeds = Newsfeed::all();
    return view('/User_Side_Screen.blog', compact('newsfeeds'));
})->name('blog');

// Admin Routes (Grouped for clarity and potential middleware)
Route::prefix('admin')->group(function () {
    // This route will show the admin dashboard and list news items
    Route::get('/', [NewsController::class, 'index'])->name('admin.dashboard');
    Route::resource('news', NewsController::class);
});

Route::get('/logout', function () {
    return redirect('/sign-in')->with('status', 'You have been logged out.');
})->name('logout');

Route::get('/contact-us', function () {
    return view('/User_Side_Screen.contact-us');
})->name('contact-us');

// Resource route for NewsfeedController
Route::resource('newsfeeds', NewsfeedController::class);

Route::post('/news/{newsItem}/increment-views', [NewsController::class, 'incrementViews'])
    ->name('news.incrementViews');


// Removed the old individual routes for news-items and admin
// Route::get('/admin', [NewsController::class, 'showNews'])->name('admin'); // Replaced by admin.dashboard and news.index
// Route::get('/news', [NewsController::class, 'showNews'])->name('news.show'); // Replaced by news.index or news.show
// Route::post('/news-items', [NewsController::class, 'store'])->name('news-items.store'); // Replaced by news.store

