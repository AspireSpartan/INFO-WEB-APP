<?php

use App\Models\Blogfeed;
use App\Models\NewsItem;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SectionBannerController; // IMPORTANT: Add this import!

Route::get('/', function () {
    return view('welcome');
});

// Correct: Using HomeController for dynamic data
Route::get('/home', [HomeController::class, 'index', 'latestnews1'])->name('home');

// Consider moving /morenews and /blog to dedicated controllers if they grow complex
Route::get('/morenews', function () {
    $newsItems = NewsItem::orderBy('date', 'desc')->get();
    return view('/User_Side_Screen.morenews', compact('newsItems'));
})->name('morenews');

Route::get('/sign-in', function () {
    return view('sign-in');
})->name('sign-in');

Route::get('/blog', [HomeController::class, 'blogIndex'])->name('blog');

// Recommendation: Change this to a POST route for security reasons
Route::get('/logout', function () {
    // For proper logout, you might need Auth::logout();
    return redirect('/home')->with('status', 'You have been logged out.');
})->name('logout');

Route::get('/contact-us', function () {
    return view('/User_Side_Screen.contact-us');
})->name('contact-us');

Route::post('/news/{newsItem}/increment-views', [NewsController::class, 'incrementViews'])
->name('news.incrementViews');

// Admin Routes (Grouped for clarity and potential middleware)
Route::prefix('admin')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('admin.dashboard');
    Route::resource('news', NewsController::class);
    // New route for bulk delete
    Route::delete('news', [NewsController::class, 'bulkDestroy'])->name('news.bulkDestroy');

    Route::resource('blogs', BlogController::class)->parameters([
        'blogs' => 'blogfeed'
    ]);

    Route::put('section-banners/{section_banner}', [SectionBannerController::class, 'update'])->name('admin.section_banners.update');


});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Route for displaying all messages (the inbox screen)
Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications');


// Routes for Notification Actions (AJAX endpoints)
Route::post('/admin/notifications/{message}/mark-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.mark_read');
Route::delete('/admin/notifications/{message}', [NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
Route::get('/admin/notifications/{message}/show', [NotificationController::class, 'show'])->name('admin.notifications.show');
Route::put('/section-banners/{section_banner}', [SectionBannerController::class, 'update'])->name('admin.section_banners.update');

