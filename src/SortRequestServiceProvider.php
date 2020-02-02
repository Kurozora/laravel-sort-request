<?php

namespace musa11971\SortRequest;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class SortRequestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot() { }

    /**
     * Register the application services.
     */
    public function register()
    {
        Builder::macro('sortViaRequest', function ($request) {
            $handler = new EloquentSortingHandler($request, $this);

            return $handler->handle();
        });
    }
}
