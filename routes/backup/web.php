<?php

use App\Models\Blogfeed;
use App\Models\Newsfeed;
use App\Models\NewsItem;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsfeedController;
use App\Http\Controllers\NotificationController; 

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/home', function () {
//    return view('/User_Side_Screen.home');
//})->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/morenews', function () {
    $newsItems = NewsItem::orderBy('date', 'desc')->get();
    return view('/User_Side_Screen.morenews', compact('newsItems'));
})->name('morenews'); // Added a name for easier referencing

Route::get('/sign-in', function () {
    return view('sign-in');
})->name('sign-in');

Route::get('/blog', function () {
    $blogfeeds = Blogfeed::all();
    return view('/User_Side_Screen.blog', compact('blogfeeds'));
})->name('blog');

Route::get('/logout', function () {
    return redirect('/home')->with('status', 'You have been logged out.');
})->name('logout');

Route::get('/contact-us', function () {
    return view('/User_Side_Screen.contact-us');
})->name('contact-us');

// Resource route for NewsfeedController
//Route::resource('newsfeeds', NewsfeedController::class);

Route::post('/news/{newsItem}/increment-views', [NewsController::class, 'incrementViews'])
->name('news.incrementViews');

// Admin Routes (Grouped for clarity and potential middleware)
Route::prefix('admin')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('admin.dashboard');
    Route::resource('news', NewsController::class);
    // New route for bulk delete
    Route::delete('news', [NewsController::class, 'bulkDestroy'])->name('news.bulkDestroy');

    Route::resource('blogs', BlogController::class)->parameters([
        'blogs' => 'blogfeed' // This tells Laravel to use 'blogfeed' instead of default 'blog'
    
    ]);

});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Route for displaying all messages (the inbox screen)
Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications');


// Routes for Notification Actions (AJAX endpoints)
Route::post('/admin/notifications/{message}/mark-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.mark_read');
Route::delete('/admin/notifications/{message}', [NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
Route::get('/admin/notifications/{message}/show', [NotificationController::class, 'show'])->name('admin.notifications.show');




// Removed the old individual routes for news-items and admin
// Route::get('/admin', [NewsController::class, 'showNews'])->name('admin'); // Replaced by admin.dashboard and news.index
// Route::get('/news', [NewsController::class, 'showNews'])->name('news.show'); // Replaced by news.index or news.show
// Route::post('/news-items', [NewsController::class, 'store'])->name('news-items.store'); // Replaced by news.store

