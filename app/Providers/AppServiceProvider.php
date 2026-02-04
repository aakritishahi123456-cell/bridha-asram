<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

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
        // Set default string length for MySQL
        Schema::defaultStringLength(191);
        
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        
        // Share NGO configuration with all views
        View::composer('*', function ($view) {
            $view->with([
                'ngoName' => config('app.ngo_name', env('NGO_NAME', 'Buddhabhoomi Human Service Ashram')),
                'ngoNameEnglish' => config('app.ngo_name_english', env('NGO_NAME_ENGLISH', 'Buddhabhoomi Human Service Ashram')),
                'ngoEmail' => config('app.ngo_email', env('NGO_EMAIL', 'info@buddhabhoomi.org.np')),
                'ngoPhone' => config('app.ngo_phone', env('NGO_PHONE', '+977-83-123456')),
                'ngoAddress' => config('app.ngo_address', env('NGO_ADDRESS', 'Surkhet, Nepal')),
                'currentLocale' => app()->getLocale(),
            ]);
        });
        
        // Set locale from session
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }
    }
}