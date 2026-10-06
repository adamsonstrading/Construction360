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
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/googlebae0409faabb7371.html', function () {
    return response('google-site-verification: googlebae0409faabb7371.html', 200, ['Content-Type' => 'text/html']);
});
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [LandingPageController::class, 'contact'])->name('contact.index');
Route::get('/about-us', [LandingPageController::class, 'about'])->name('about');
Route::get('/about-us/leadership', function () {
    return redirect('/about-us#leadership');
})->name('about.leadership');
Route::get('/services', [LandingPageController::class, 'services'])->name('services.index');
Route::get('/services/{slug}', [LandingPageController::class, 'showService'])->name('services.show');
Route::get('/services/{service_slug}/{sub_service_slug}', [LandingPageController::class, 'showSubService'])->name('subservices.show');
Route::get('/projects', [LandingPageController::class, 'projects'])->name('projects.index');
Route::get('/projects/{slug}', [LandingPageController::class, 'showProject'])->name('projects.show');
Route::get('/blog', [LandingPageController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [LandingPageController::class, 'showBlog'])->name('blog.show');
Route::get('/privacy-policy', [LandingPageController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [LandingPageController::class, 'terms'])->name('terms');
Route::get('/tendering-standard', [LandingPageController::class, 'tendering'])->name('tendering');

// Admin entrypoint redirect
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

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

    // Partners CRUD
    Route::resource('partners', PartnerController::class);
});

Route::get('/sync-live-data', function () { \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'LiveSyncSeeder']); return 'Live site successfully synced with local database!'; });
Route::get('/run-migrations', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return 'Migrations run successfully!';
});
Route::get('/restore-service-1', function () {
    $service = \App\Models\Service::find(1);
    if (!$service) {
        return response('Service ID 1 not found in database!', 404);
    }
    $controller = new \App\Http\Controllers\LandingPageController();
    $details = $controller->getServiceDetails('pre-construction');
    if (!$details || empty($details['services_offered'])) {
        return response('Canonical sub-services data not found!', 500);
    }
    $service->services_offered = $details['services_offered'];
    if (empty($service->about) && !empty($details['about'])) {
        $service->about = $details['about'];
    }
    if (empty($service->why_choose_us) && !empty($details['why_choose_us'])) {
        $service->why_choose_us = $details['why_choose_us'];
    }
    if (empty($service->faqs) && !empty($details['faqs'])) {
        $service->faqs = $details['faqs'];
    }
    $service->save();
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return '<h3>✅ SUCCESS: Service ID 1 (Pre-Construction) restored successfully with ' . count($details['services_offered']) . ' sub-services!</h3><p>Other services remained 100% untouched.</p>';
});

Route::get('/clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return 'All Laravel caches (routes, config, views, cache) cleared successfully!';
});

// SMTP Test Route — visit /test-smtp to verify email configuration
Route::get('/test-smtp', function () {
    $recipient = env('MAIL_ENQUIRY_RECIPIENT', env('MAIL_FROM_ADDRESS'));
    $from      = env('MAIL_FROM_ADDRESS');
    $fromName  = env('MAIL_FROM_NAME', 'Construction 360');
    $host      = env('MAIL_HOST');
    $port      = env('MAIL_PORT');
    $username  = env('MAIL_USERNAME');

    try {
        \Illuminate\Support\Facades\Mail::raw(
            "✅ SMTP test email from Construction 360.\n\n"
            . "Sent at: " . now()->toDateTimeString() . "\n"
            . "Host: {$host}:{$port}\n"
            . "Username: {$username}",
            function ($message) use ($recipient, $from, $fromName) {
                $message->to($recipient)
                        ->from($from, $fromName)
                        ->subject('✅ SMTP Test — Construction 360');
            }
        );

        return response(
            "<h2 style='font-family:sans-serif;color:green;'>✅ SMTP Test Passed!</h2>"
            . "<p style='font-family:sans-serif;'>Test email successfully sent to <strong>{$recipient}</strong>.</p>"
            . "<ul style='font-family:sans-serif;'>"
            . "<li><strong>Host:</strong> {$host}:{$port}</li>"
            . "<li><strong>Username:</strong> {$username}</li>"
            . "<li><strong>From:</strong> {$fromName} &lt;{$from}&gt;</li>"
            . "</ul>",
            200
        )->header('Content-Type', 'text/html');

    } catch (\Exception $e) {
        return response(
            "<h2 style='font-family:sans-serif;color:red;'>❌ SMTP Test Failed</h2>"
            . "<p style='font-family:sans-serif;'><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>"
            . "<ul style='font-family:sans-serif;'>"
            . "<li><strong>Host:</strong> {$host}:{$port}</li>"
            . "<li><strong>Username:</strong> {$username}</li>"
            . "<li><strong>Recipient:</strong> {$recipient}</li>"
            . "</ul>",
            500
        )->header('Content-Type', 'text/html');
    }
});
