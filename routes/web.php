<?php

use App\Models\Project;
use App\Models\NewsItem;
use App\Models\ProjectDescription;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\AboutGovphController;
use App\Http\Controllers\FooterLogoController;
use App\Http\Controllers\FooterTitleController;
use App\Http\Controllers\KeepInTouchController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StrategicPlanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GovernmentLinkController;
use App\Http\Controllers\AdminAnnouncementController;
use App\Http\Controllers\ProjectDescriptionController;
use App\Http\Controllers\PreviewSection2LogoController;
use App\Http\Controllers\AdminReportedConcernController;
use App\Http\Controllers\PublicOfficialCaptionController; // For header caption
use App\Http\Controllers\PublicOfficialController;      // <-- ADD THIS FOR INDIVIDUAL OFFICIALS
use App\Http\Controllers\PreviewSection2CaptionController;
use App\Http\Controllers\ContentManagerLogosImageController;
use App\Http\Controllers\CedulaReportController;
use App\Http\Controllers\BusinessPermitController;
use App\Http\Controllers\DeveloperController;


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

// User-facing Contact Us page (if applicable)
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

// Make sure your user-facing about-us page loads content from the controller
Route::get('/about-us', [AboutUsController::class, 'showUserAboutUs'])->name('about-us');


Route::get('/businesspermit', [BusinessPermitController::class, 'showForm'])->name('businesspermit');
Route::post('/businesspermit', [BusinessPermitController::class, 'submitApplication'])->name('businesspermit.submit');

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


// Admin Routes (Grouped for clarity and potential middleware)
Route::prefix('admin')->group(function () {
    // Apply 'auth' middleware here if all admin routes require authentication
    // Route::middleware('auth')->group(function () {

    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/keep-in-touch/edit', [KeepInTouchController::class, 'edit'])->name('keep-in-touch.edit');
    Route::post('/keep-in-touch/update', [KeepInTouchController::class, 'update'])->name('keep-in-touch.update');
    Route::post('/footer-logo/update', [FooterLogoController::class, 'update'])->name('footer.logo.update');

    // Existing header update route (for title, caption of the officials page)
    Route::post('/teamdev/update', [PublicOfficialCaptionController::class, 'update'])->name('teamdev.update');
    Route::get('/teamdev', [PublicOfficialCaptionController::class, 'index'])->name('teamdev.index');

    Route::resource('public-officials', PublicOfficialController::class)->except(['create', 'show', 'edit', 'index']);

    Route::resource('news', NewsController::class);
    Route::delete('news', [NewsController::class, 'hulkDestroy'])->name('news.hulkDestroy');
    
    Route::get('projects', [ProjectController::class, 'indexAdmin'])->name('projects.indexAdmin');
    Route::resource('projects', ProjectController::class)->except(['index']);

    Route::post('/project-description/update', [ProjectDescriptionController::class, 'update'])->name('project-description.update');
    Route::post('/logos', [PreviewSection2LogoController::class, 'store'])->name('logos.store');
    Route::delete('/logos/{id}', [PreviewSection2LogoController::class, 'destroy'])->name('logos.destroy');
    Route::post('/caption/update', [PreviewSection2CaptionController::class, 'update'])->name('caption.update');
    Route::post('/admin/strategic-plan/update', [StrategicPlanController::class, 'update'])->name('strategic-plan.update');
    Route::post('/admin/content-manager/update', [ContentManagerLogosImageController::class, 'update'])->name('content-manager.update');
    Route::resource('blogs', BlogController::class)->parameters(['blogs' => 'blogfeed']);
    Route::post('/about-govph/update', [AboutGovphController::class, 'update'])->name('about-govph.update');

    // ABOUT US ADMIN ROUTES - UPDATED/ADDED HERE
    // This route now specifically handles the admin view for about-us, including developers
    Route::get('/about-us', [AdminDashboardController::class, 'index'])->name('admin.about-us.index'); // Use AdminDashboardController for the main admin about-us page
    Route::post('/about-us/update-content', [AboutUsController::class, 'updateContent'])->name('admin.about-us.updateContent');
    Route::post('/about-us/store-offer', [AboutUsController::class, 'storeOffer'])->name('admin.about-us.storeOffer');
    Route::delete('/about-us/delete-offer/{id}', [AboutUsController::class, 'deleteOffer'])->name('admin.about-us.deleteOffer');
    Route::get('/about-us/offers-json', [AboutUsController::class, 'getOffersJson'])->name('admin.about-us.offersJson');

    // MOVED AND REFINED: Developer CRUD routes are now correctly nested under the 'admin' prefix
    Route::resource('developers', DeveloperController::class)->except(['create', 'show', 'edit']);

    Route::get('/reported_concerns', [AdminReportedConcernController::class, 'index'])->name('reported_concerns.index');
    Route::get('/reported_concerns/{id}/edit', [AdminReportedConcernController::class, 'edit'])->name('reported_concerns.edit');
    Route::put('/reported_concerns/{id}', [AdminReportedConcernController::class, 'update'])->name('reported_concerns.update');
    Route::post('/reportconcern', [AdminReportedConcernController::class, 'store'])->name('reportconcern.store');
    Route::get('/government-links', [GovernmentLinkController::class, 'index'])->name('government-links.index');
    Route::post('/government-links', [GovernmentLinkController::class, 'update'])->name('government-links.update');
    Route::post('/footer-title/update', [FooterTitleController::class, 'update'])->name('footer-title.update');

    // **IMPORTANT FIXES FOR CONTACT US ROUTES**
    // This GET route should be for displaying the admin contact us *management* page
    Route::get('/contact-us-manager', [ContactUsController::class, 'Indexshow'])->name('admin.contact-us.manager');
    // This POST route is your API endpoint for updating contact us data
    Route::post('/contact-us-api', [ContactUsController::class, 'update'])->name('api.contact-us.update');

    Route::get('/community', [CommunityController::class, 'index'])->name('admin.community.index');
    Route::post('/community/update-content', [CommunityController::class, 'updateContent'])->name('admin.community.updateContent');
    Route::post('/community/store-image', [CommunityController::class, 'storeCarouselImage'])->name('admin.community.storeCarouselImage'); // For new images
    Route::post('/community/update-image/{id}', [CommunityController::class, 'updateCarouselImage'])->name('admin.community.updateCarouselImage'); // For updating existing images (title/image file)
    Route::delete('/community/delete-image/{id}', [CommunityController::class, 'deleteCarouselImage'])->name('admin.community.deleteCarouselImage');
    Route::post('/community/update-image-order', [CommunityController::class, 'updateImageOrder'])->name('admin.community.updateImageOrder');

    // Announcement Routes
    Route::get('/announcements/data', [AdminAnnouncementController::class, 'getAnnouncementsData'])->name('admin.announcements.data');
    Route::post('/announcements', [AdminAnnouncementController::class, 'store'])->name('admin.announcements.store');
    Route::put('/announcements/{announcement}', [AdminAnnouncementController::class, 'update'])->name('admin.announcements.update');
    Route::delete('/announcements/{announcement}', [AdminAnnouncementController::class, 'destroy'])->name('admin.announcements.destroy');
    Route::delete('admin/announcements/bulk-delete', [AdminAnnouncementController::class, 'bulkDestroy'])->name('admin.announcements.bulkDestroy');

    Route::get('/cedulareports', [CedulaReportController::class, 'index'])->name('cedulareports.index');
    Route::post('/cedula', [CedulaReportController::class, 'store'])->name('cedula.store');
    Route::put('/cedulareports/{cedulaReport}', [CedulaReportController::class, 'update'])->name('cedulareports.update');

    Route::get('/business-permits', [BusinessPermitController::class, 'adminIndex'])->name('admin.business-permits');
    Route::post('/business-permits/{application}/update-status', [BusinessPermitController::class, 'updateStatus'])->name('admin.business-permits.update-status');
    Route::get('/admin/business-permits/{application}/details', [BusinessPermitController::class, 'showDetails'])->name('admin.business-permits.details');
});