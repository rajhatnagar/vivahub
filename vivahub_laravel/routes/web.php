<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

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
        Route::get('/builder/preview/wedding-1', function () {
            return view('templates.wedding_theme_1');
        })->name('builder.preview.wedding-1');
        Route::get('/invitations', 'invitations')->name('invitations');
        Route::get('/templates', 'templates')->name('templates');
        Route::get('/builder', 'builder')->name('builder');
        Route::get('/rsvps', 'rsvps')->name('rsvps');
        Route::get('/billing', 'billing')->name('billing');
        Route::get('/settings', 'settings')->name('settings');
    });
});

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
    Route::get('/designs', [App\Http\Controllers\Admin\DesignController::class, 'index'])->name('designs.index');
    Route::post('/designs', [App\Http\Controllers\Admin\DesignController::class, 'store'])->name('designs.store');
    Route::delete('/designs/{id}', [App\Http\Controllers\Admin\DesignController::class, 'destroy'])->name('designs.destroy');
    
    // Transactions & Logs
    Route::get('/transactions', [App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/logs', [App\Http\Controllers\Admin\LogController::class, 'index'])->name('logs.index');

    // Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
