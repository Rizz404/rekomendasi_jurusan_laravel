<?php

namespace App\Providers;

use App\Services\CloudinaryService;
use App\Services\ImageKitService;
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
