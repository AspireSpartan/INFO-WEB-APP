<?php

use App\Models\Project;
use App\Models\Blogfeed;
use App\Models\NewsItem;
use App\Models\PageContent; 
use App\Models\ContactMessage;
use App\Models\ProjectDescription;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectDescriptionController;

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

return redirect('/home')->with('status', 'You have been logged out.');
})->name('logout');

Route::get('/contact-us', function () {
    return view('/User_Side_Screen.contact-us');
})->name('contact-us');

Route::get('/showallproject', function () {
    $projects = Project::all();
    $description = ProjectDescription::first(); // Fetch the single description row
    return view('User_Side_Screen.showallproject', compact('projects', 'description'));
})->name('showallproject');

Route::get('/cedula', function () {
    return view('User_Side_Screen.cedula');
})->name('cedula');

Route::get('/about-us', function () {
    return view('User_Side_Screen.about-us');
})->name('about-us');

Route::get('/businesspermit', function () {
    return view('User_Side_Screen.businesspermit');
})->name('businesspermit');

Route::get('/reportconcern', function () {
    return view('User_Side_Screen.reportconcern');
})->name('reportconcern');

Route::post('/news/{newsItem}/increment-views', [NewsController::class, 'incrementViews'])
    ->name('news.incrementViews');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications');
Route::post('/admin/notifications/{message}/mark-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.mark_read');
Route::delete('/admin/notifications/{message}', [NotificationController::class, 'destroy'])->name('admin.notifications.destroy');
Route::get('/admin/notifications/{message}/show', [NotificationController::class, 'show'])->name('admin.notifications.show');

Route::get('/page-content', [PageContentController::class, 'show'])->name('page.content.show');
Route::post('/page-content', [PageContentController::class, 'update'])->name('page.content.update');

Route::get('/cedula', function () {
    return view('User_Side_Screen.cedula');
})->name('cedula');

// Admin Routes (Grouped for clarity and potential middleware)
Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        $pageContent = PageContent::pluck('value', 'key')->toArray(); 
        $newsItems = NewsItem::all();
        $contactMessages = ContactMessage::all();
        $blogfeeds = Blogfeed::all();
        $projects = Project::all();
        $description = ProjectDescription::first(); 

       return view('Components.Admin.Ad-Header.Ad-Header', compact('newsItems', 'contactMessages', 'blogfeeds', 'pageContent', 'projects', 'description'));
    })->name('admin.dashboard');

    Route::resource('news', NewsController::class);
    Route::delete('news', [NewsController::class, 'bulkDestroy'])->name('news.bulkDestroy');

    Route::resource('blogs', BlogController::class)->parameters([
        'blogs' => 'blogfeed'
    ]);
    Route::resource('projects', ProjectController::class);
    Route::get('projects', [ProjectController::class, 'indexAdmin'])->name('projects.indexAdmin');
    Route::post('/project-description/update', [ProjectDescriptionController::class, 'update'])->name('project-description.update');
});
