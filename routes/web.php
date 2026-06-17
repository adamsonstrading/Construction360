<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [LandingPageController::class, 'contact'])->name('contact.index');
Route::get('/services', [LandingPageController::class, 'services'])->name('services.index');
Route::get('/services/{slug}', [LandingPageController::class, 'showService'])->name('services.show');
Route::get('/projects', [LandingPageController::class, 'projects'])->name('projects.index');
Route::get('/projects/{slug}', [LandingPageController::class, 'showProject'])->name('projects.show');
Route::get('/blog', [LandingPageController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [LandingPageController::class, 'showBlog'])->name('blog.show');
Route::get('/privacy-policy', [LandingPageController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [LandingPageController::class, 'terms'])->name('terms');
Route::get('/tendering-standard', [LandingPageController::class, 'tendering'])->name('tendering');

// Guest Admin Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'login']);
});

// Protected Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Queries
    Route::get('/queries', [QueryController::class, 'index'])->name('queries.index');
    Route::patch('/queries/{id}/status', [QueryController::class, 'updateStatus'])->name('queries.updateStatus');
    
    // Site Content
    Route::get('/content', [ContentController::class, 'edit'])->name('content.edit');
    Route::post('/content/update', [ContentController::class, 'update'])->name('content.update');
    
    // Services CRUD
    Route::resource('services', ServiceController::class);

    // Blogs CRUD
    Route::resource('blogs', BlogController::class);

    // Projects CRUD
    Route::resource('projects', ProjectController::class);

    // Team CRUD
    Route::resource('team', TeamController::class);
});

Route::get('/sync-live-data', function () { Artisan::call('db:seed', ['--class' => 'LiveSyncSeeder']); return 'Live site successfully synced with local database!'; });
