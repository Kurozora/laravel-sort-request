<?php

namespace kiritokatklian\SortRequest;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use kiritokatklian\SortRequest\Console\SorterMakeCommand;

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
        $this->registerConsoleCommands();
        $this->registerMacros();
    }

    /**
     * Register the console commands the package provides.
     */
    private function registerConsoleCommands()
    {
        $this->commands([
            SorterMakeCommand::class
        ]);
    }

    /**
     * Register the macros the package provides.
     */
    private function registerMacros()
    {
        Builder::macro('sortViaRequest', function ($request) {
            $handler = new EloquentSortingHandler($request, $this);

            return $handler->handle();
        });
    }
}
