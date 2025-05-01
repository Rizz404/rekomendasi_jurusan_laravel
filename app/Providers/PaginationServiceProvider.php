<?php

namespace App\Providers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;

// * Buat pagination service
class PaginationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register custom pagination view
        LengthAwarePaginator::defaultView('components.pagination');

        // Optional: Register a simple view for simplePaginate as well
        LengthAwarePaginator::defaultSimpleView('components.simple-pagination');
    }
}
