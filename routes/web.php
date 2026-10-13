<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\WhyUsItemController;
use App\Http\Controllers\Admin\ProcessStepController;
use App\Http\Controllers\Admin\EngagementModelController;
use App\Http\Controllers\Admin\FaqItemController;
use App\Http\Controllers\Admin\TechStackItemController;
use App\Http\Controllers\Admin\ContactInquiryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SeoKeywordController;
use App\Http\Controllers\Admin\SeoBacklinkController;
use App\Http\Controllers\Admin\SeoRedirectController;
use App\Http\Controllers\Admin\SeoTechnicalController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Admin\NavigationItemController;
use App\Http\Controllers\Admin\FooterLinkController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Free tools (link-magnet pages — must be above the catch-all {slug} route)
Route::get('/website-cost-calculator', [CalculatorController::class, 'index'])->name('calculator');

Route::get('robots.txt', [RobotsController::class, 'index'])->name('robots');
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Admin routes
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('services', ServiceController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('why-us', WhyUsItemController::class)->parameters(['why-us' => 'whyUsItem']);
    Route::resource('process-steps', ProcessStepController::class)->parameters(['process-steps' => 'processStep']);
    Route::resource('engagement-models', EngagementModelController::class)->parameters(['engagement-models' => 'engagementModel']);
    Route::resource('faq', FaqItemController::class)->parameters(['faq' => 'faqItem']);
    Route::resource('tech-stack', TechStackItemController::class)->parameters(['tech-stack' => 'techStackItem']);
    Route::resource('contact-inquiries', ContactInquiryController::class)->only(['index', 'show', 'destroy']);
    Route::post('contact-inquiries/{contactInquiry}/status', [ContactInquiryController::class, 'updateStatus'])
        ->name('contact-inquiries.update-status');
    Route::resource('pages', AdminPageController::class);
    Route::resource('blog-posts', AdminBlogPostController::class);
    Route::resource('navigation', NavigationItemController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('footer-links', FooterLinkController::class)->only(['index', 'store', 'update', 'destroy']);

    // SEO Routes
    Route::prefix('seo')->name('seo.')->group(function () {
        Route::get('/', [SeoTechnicalController::class, 'index'])->name('index');
        Route::post('audit', [SeoTechnicalController::class, 'audit'])->name('audit');
        Route::resource('keywords', SeoKeywordController::class);
        Route::resource('backlinks', SeoBacklinkController::class);
        Route::resource('redirects', SeoRedirectController::class);
    });

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';

// Dynamic pages catch-all — MUST be last so it doesn't intercept other routes
Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '^(?!admin|api|blog|storage|assets|favicon|robots|sitemap|_next|_ignition|livewire|horizon|telescope|up|health).*$')
    ->name('page.show');
