<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/invitation/{id}', [App\Http\Controllers\UserPanelController::class, 'showInvitation'])->name('invitation.show');

Route::post('/rsvp/submit', [App\Http\Controllers\RsvpController::class, 'store'])->name('rsvp.submit');

Route::controller(PageController::class)->group(function () {
    Route::get('/about', 'about')->name('about');
    Route::get('/features', 'features')->name('features');
    Route::get('/templates', 'templates')->name('templates');
    Route::get('/pricing', 'pricing')->name('pricing');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'submitContact')->name('contact.submit');
    Route::get('/sitemap', 'sitemap')->name('sitemap');
    Route::get('/privacy', 'privacy')->name('privacy');
});

use App\Http\Controllers\UserPanelController;

// User Dashboard Routes (Authenticated)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(UserPanelController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/builder/preview/{template}', [UserPanelController::class, 'previewTemplate'])->name('builder.preview');
        Route::get('/invitations', 'invitations')->name('invitations');
        Route::get('/dashboard/templates', 'templates')->name('dashboard.templates');
        Route::get('/builder', 'builder')->name('builder');
        Route::post('/builder/save', 'saveDraft')->name('builder.save');
        Route::get('/plans', 'getPlans')->name('plans.get');
        Route::post('/coupon/validate', 'validateCoupon')->name('coupon.validate');
        Route::get('/rsvps', 'rsvps')->name('rsvps');
        Route::get('/billing', 'billing')->name('billing');
        Route::get('/settings', 'settings')->name('settings');
        Route::post('/settings', 'updateSettings')->name('settings.update');
    });
});



Route::middleware(['auth'])->get('/stop-impersonating', [\App\Http\Controllers\Admin\UserController::class, 'stopImpersonating'])->name('impersonate.stop');

// Auth Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Google Auth
    Route::get('auth/google', [App\Http\Controllers\GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [App\Http\Controllers\GoogleAuthController::class, 'handleGoogleCallback']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{id}/impersonate', [App\Http\Controllers\Admin\UserController::class, 'impersonate'])->name('users.impersonate');

    // Plans
    Route::get('/plans', [App\Http\Controllers\Admin\PlanController::class, 'index'])->name('plans.index');
    Route::post('/plans', [App\Http\Controllers\Admin\PlanController::class, 'store'])->name('plans.store');
    Route::put('/plans/{id}', [App\Http\Controllers\Admin\PlanController::class, 'update'])->name('plans.update');
    Route::delete('/plans/{id}', [App\Http\Controllers\Admin\PlanController::class, 'destroy'])->name('plans.destroy');
    
    // Designs
    // Designs
    Route::get('/designs', [App\Http\Controllers\Admin\DesignController::class, 'index'])->name('designs.index');
    Route::get('/designs/builder', [App\Http\Controllers\Admin\DesignController::class, 'builder'])->name('designs.builder');
    Route::post('/designs/save', [App\Http\Controllers\Admin\DesignController::class, 'store'])->name('designs.store');
    Route::delete('/designs/{id}', [App\Http\Controllers\Admin\DesignController::class, 'destroy'])->name('designs.destroy');
    
    // Coupons (Couple Codes)
    Route::post('/designs/coupons', [App\Http\Controllers\Admin\DesignController::class, 'storeCoupon'])->name('coupons.store');
    Route::delete('/designs/coupons/{id}', [App\Http\Controllers\Admin\DesignController::class, 'deleteCoupon'])->name('coupons.delete');

    // Partner Credits
    Route::post('/users/{id}/credits', [App\Http\Controllers\Admin\UserController::class, 'manageCredits'])->name('users.credits');
    Route::put('/users/{id}/partner', [App\Http\Controllers\Admin\UserController::class, 'updatePartner'])->name('users.partner.update');
    
    // Transactions & Logs
    Route::get('/transactions', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/logs', [App\Http\Controllers\Admin\LogController::class, 'index'])->name('logs.index');

    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

// Partner Routes
Route::middleware(['auth', 'verified', 'partner'])->prefix('partner')->name('partner.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\PartnerController::class, 'index'])->name('dashboard');
    Route::post('/clients', [App\Http\Controllers\PartnerController::class, 'storeClient'])->name('clients.store');
    Route::post('/coupons', [App\Http\Controllers\PartnerController::class, 'generateCoupon'])->name('coupons.store');
    Route::post('/coupons/{id}/delete', [App\Http\Controllers\PartnerController::class, 'deleteCoupon'])->name('coupons.delete');
    Route::post('/settings', [App\Http\Controllers\PartnerController::class, 'updateSettings'])->name('settings.update');
    
    // Builder Routes
    Route::get('/builder', [App\Http\Controllers\PartnerController::class, 'builder'])->name('builder');
    Route::post('/builder/save', [App\Http\Controllers\PartnerController::class, 'saveBuilder'])->name('builder.save');
    Route::post('/buy-credits', [App\Http\Controllers\PartnerController::class, 'buyCredits'])->name('credits.buy');
    Route::get('/invoices/{id}/download', [App\Http\Controllers\PartnerController::class, 'downloadInvoice'])->name('invoices.download');
    Route::post('/clients/{id}/update', [App\Http\Controllers\PartnerController::class, 'updateClient'])->name('clients.update');
    Route::post('/invitations/{id}/delete', [App\Http\Controllers\PartnerController::class, 'deleteInvitation'])->name('invitations.delete');
});
