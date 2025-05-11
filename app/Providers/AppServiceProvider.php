<?php

namespace App\Providers;

use App\Services\CloudinaryService;
use App\Services\ImageKitService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // * Buat jadi singelton
        $this->app->singleton(ImageKitService::class, function ($app)
        {
            return new ImageKitService();
        });

        $this->app->singleton(CloudinaryService::class, function ($app)
        {
            return new CloudinaryService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // * Di layout
        Blade::component('components.layouts.app', 'app');
        Blade::component('components.layouts.user', 'user-layout');
        Blade::component('components.layouts.admin', 'admin-layout');


        // * Di layout parts
        Blade::component('components.layout-parts.header', 'header');
        Blade::component('components.layout-parts.user-header', 'user-header');
        Blade::component('components.layout-parts.admin-header', 'admin-header');
        Blade::component('components.layout-parts.footer', 'footer');
        Blade::component('components.layout-parts.admin-sidebar', 'admin-sidebar');

        if (env('CURL_CA_BUNDLE'))
        {
            putenv('CURL_CA_BUNDLE=' . env('CURL_CA_BUNDLE'));

            // Juga mengatur konstanta untuk PHP stream
            if (!defined('CURLOPT_CAINFO'))
            {
                define('CURLOPT_CAINFO', env('CURL_CA_BUNDLE'));
            }
        }
    }
}
