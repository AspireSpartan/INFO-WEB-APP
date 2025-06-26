<?php

use App\Models\Blogfeed;
use App\Models\Newsfeed;
use App\Models\NewsItem;
use App\Models\ContactMessage;
use App\Models\PageContent; // Ensure PageContent is imported!
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
// If NewsfeedController is truly deprecated, you can remove this:
// use App\Http\Controllers\NewsfeedController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SectionBannerController;
use App\Http\Controllers\PageContentController; // Ensure PageContentController is imported!

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/morenews', function () {
    $newsItems = NewsItem::orderBy('date', 'desc')->get();
    return view('/User_Side_Screen.morenews', compact('newsItems'));
})->name('morenews');

Route::get('/sign-in', function () {
    return view('sign-in');
})->name('sign-in');

Route::get('/blog', [HomeController::class, 'blogIndex'])->name('blog');

Route::get('/logout', function () {
    // Recommendation: Change this to a POST route for security reasons
    // For proper logout, you might need Auth::logout();
    return redirect('/home')->with('status', 'You have been logged out.');
})->name('logout');

Route::get('/contact-us', function () {
    return view('/User_Side_Screen.contact-us');
})->name('contact-us');

Route::get('/showallproject', function () {
    return view('/User_Side_Screen.showallproject');
})->name('showallproject');
// This was commented out - confirm if NewsfeedController is no longer used.
// Route::resource('newsfeeds', NewsfeedController::class);

Route::post('/news/{newsItem}/increment-views', [NewsController::class, 'incrementViews'])
    ->name('news.incrementViews');

// Admin Routes (Grouped for clarity and potential middleware)
Route::prefix('admin')->group(function () {
    // FIX IS HERE: Change to fetch all PageContent and pass as 'pageContent'
    Route::get('/', function () {
        // Fetch all page content as a key-value array
        $pageContent = PageContent::pluck('value', 'key')->toArray(); // <--- THIS IS THE KEY CHANGE

        // No need for the separate $mainContainerBgUrl logic here anymore
        // as your banner.blade.php handles the fallback itself.

        // Fetch other necessary data for the Admin Dashboard
        $newsItems = NewsItem::all();
        $contactMessages = ContactMessage::all();
        $blogfeeds = Blogfeed::all();

        // Pass the entire $pageContent array along with other data
        return view('Admin_Side_Screen.Admin-Dashboard', compact('newsItems', 'contactMessages', 'blogfeeds', 'pageContent')); // <--- CHANGE VARIABLE NAME HERE
    })->name('admin.dashboard');

    Route::resource('news', NewsController::class);
    Route::delete('news', [NewsController::class, 'bulkDestroy'])->name('news.bulkDestroy');

    Route::resource('blogs', BlogController::class)->parameters([
        'blogs' => 'blogfeed'
    ]);


    Route::put('section-banners/{section_banner}', [SectionBannerController::class, 'update'])->name('admin.section_banners.update');
});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications');
Route::post('/admin/notifications/{message}/mark-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.mark_read');
Route::delete('/admin/notifications/{message}', [NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
Route::get('/admin/notifications/{message}/show', [NotificationController::class, 'show'])->name('admin.notifications.show');


// Removed the old individual routes for news-items and admin
// Route::get('/admin', [NewsController::class, 'showNews'])->name('admin'); // Replaced by admin.dashboard and news.index
// Route::get('/news', [NewsController::class, 'showNews'])->name('news.show'); // Replaced by news.index or news.show
// Route::post('/news-items', [NewsController::class, 'store'])->name('news-items.store'); // Replaced by news.store

// --- NEW CONTENT MANAGEMENT ROUTES ---
Route::get('/page-content', [PageContentController::class, 'show'])->name('page.content.show');
Route::post('/page-content', [PageContentController::class, 'update'])->name('page.content.update');

// The initialize-content route has been removed. Use `php artisan db:seed` instead.
