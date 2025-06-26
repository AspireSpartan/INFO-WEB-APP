<?php

use App\Models\Blogfeed;
use App\Models\NewsItem;
use App\Models\ContactMessage;
use App\Models\PageContent; // Ensure PageContent model is imported
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsfeedController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageContentController;

Route::get('/', function () {
    return view('welcome');
});

// Route for your main LGU homepage that uses the banner
// This passes dynamic background image data to the home view
Route::get('/home', function () {
    $mainContainerBgUrl = PageContent::where('key', 'main-container-bg')->value('value');
    if (empty($mainContainerBgUrl) || !filter_var($mainContainerBgUrl, FILTER_VALIDATE_URL)) {
        $mainContainerBgUrl = asset('storage/LGU_bg.png'); 
    }
    return view('User_Side_Screen.home', [ 
        'mainContainerBgUrl' => $mainContainerBgUrl
    ]);
})->name('home');

// Consider moving /morenews and /blog to dedicated controllers if they grow complex
Route::get('/morenews', function () {
    $newsItems = NewsItem::orderBy('date', 'desc')->get();
    return view('/User_Side_Screen.morenews', compact('newsItems'));
})->name('morenews');
})->name('morenews');

Route::get('/sign-in', function () {
    return view('sign-in');
})->name('sign-in');

Route::get('/blog', function () {
    $blogfeeds = Blogfeed::all();
    return view('/User_Side_Screen.blog', compact('blogfeeds'));
})->name('blog');

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
    // Updated admin dashboard route to fetch and pass mainContainerBgUrl
    Route::get('/', function () {
        $mainContainerBgUrl = PageContent::where('key', 'main-container-bg')->value('value');
        if (empty($mainContainerBgUrl) || !filter_var($mainContainerBgUrl, FILTER_VALIDATE_URL)) {
            $mainContainerBgUrl = asset('storage/LGU_bg.png');
        }

        // Fetch other necessary data for the Admin Dashboard
        $newsItems = NewsItem::all(); 
        $contactMessages = ContactMessage::all(); 
        $blogfeeds = Blogfeed::all(); 

        return view('Admin_Side_Screen.Admin-Dashboard', compact('newsItems', 'contactMessages', 'blogfeeds', 'mainContainerBgUrl'));
    })->name('admin.dashboard');

    Route::resource('news', NewsController::class);
    Route::delete('news', [NewsController::class, 'bulkDestroy'])->name('news.bulkDestroy');

    Route::resource('blogs', BlogController::class)->parameters([
        'blogs' => 'blogfeed'
        'blogs' => 'blogfeed'
    ]);
});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications');
Route::post('/admin/notifications/{message}/mark-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.mark_read');
Route::delete('/admin/notifications/{message}', [NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
Route::get('/admin/notifications/{message}/show', [NotificationController::class, 'show'])->name('admin.notifications.show');

// --- NEW CONTENT MANAGEMENT ROUTES ---
Route::get('/page-content', [PageContentController::class, 'show'])->name('page.content.show');
Route::post('/page-content', [PageContentController::class, 'update'])->name('page.content.update');
Route::get('/initialize-content', [PageContentController::class, 'initializeDefaultContent'])->name('page.content.initialize');
