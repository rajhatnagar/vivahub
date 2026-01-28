<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        \Illuminate\Support\Facades\Gate::define('admin', function (\App\Models\User $user) {
            return $user->role === 'admin';
        });
        
        // Share theme color with all views to prevent layout errors
        try {
            $themeColor = \App\Models\Setting::where('key', 'theme_color')->value('value') ?? '#ec1313';
            \Illuminate\Support\Facades\View::share('themeColor', $themeColor);
        } catch (\Exception $e) {
            // DB might not be ready during migration
            \Illuminate\Support\Facades\View::share('themeColor', '#ec1313');
        }
    }
}
