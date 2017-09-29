<?php

namespace BrooksYang\ApiDoc;

use Illuminate\Support\ServiceProvider;

class ApiDocServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/views', 'api_doc');

        // Publish assets
        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/api_doc'),
        ], 'api-doc');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register the application bindings.
        $this->app->bind('doc', function () {
            return new Doc();
        });
    }
}
