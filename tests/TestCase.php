<?php

namespace kiritokatklian\SortRequest\Tests;

use Illuminate\Routing\Router;
use kiritokatklian\SortRequest\SortRequestServiceProvider;
use kiritokatklian\SortRequest\Tests\Support\Resources\ItemResource;
use \Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Snapshots\MatchesSnapshots;

class TestCase extends Orchestra
{
    use MatchesSnapshots;

    /**
     * Register the provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            SortRequestServiceProvider::class,
        ];
    }

    /**
     * Set up the test environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        // Enable debug mode
        $app['config']->set('app.debug', true);

        // Configure database
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Disable resource wrapping
        ItemResource::withoutWrapping();

        // Set up routes
        $this->loadRoutesFromFile($app, __DIR__ . '/Support/routes.php');
    }

    /**
     * Loads the routes from a file.
     *
     * @param \Illuminate\Foundation\Application $app
     * @param string $file
     */
    private function loadRoutesFromFile($app, $file) {
        /** @var Router $router */
        $router = $app->make('router');

        require $file;
    }
}
